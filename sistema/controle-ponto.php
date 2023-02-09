<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

$primeiroDia = date("Y-m-01");
$UltimodiaDia = date("Y-m-t");
$buscaPonto = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' ORDER BY ponto_dia DESC");

$buscaHorasTrabalhadas = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_executada ) ) ),'%H') as HorasTrabalhadas FROM controle_de_ponto WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia'");
$ResultadoHorasTrabalhadas = mysqli_fetch_assoc($buscaHorasTrabalhadas);

$buscaUsuario = mysqli_query($conexao, "SELECT nome, sobrenome FROM usuarios WHERE id_usuario = '$CODIGOUSUARIO' LIMIT 1");
$ResultadoUsuario = mysqli_fetch_assoc($buscaUsuario);


// busca para o grafico de circulo
$totalPontoMes = 0; $totalNoHorario = 0; $totalAtraso = 0; $totalFalta = 0;
$buscaTotalPonto = mysqli_query($conexao, "SELECT  COUNT(cod_ponto) as total_ponto FROM  controle_de_ponto WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia'");
$resultadoTotalPontoMes = mysqli_fetch_assoc($buscaTotalPonto);
$totalPontoMes = $resultadoTotalPontoMes["total_ponto"];

if($totalPontoMes > 0 ){
$buscaNohorario = mysqli_query($conexao, "SELECT count(cod_ponto) as total_ponto FROM  controle_de_ponto WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_hora_atraso = '00:00:00' and ponto_situacao = '1'");
$resultadototalNoHorario = mysqli_fetch_assoc($buscaNohorario);
$totalNoHorario = $resultadototalNoHorario["total_ponto"];
$percentualNohorario = number_format($totalNoHorario / $totalPontoMes * 100, 0, '.', '');

$buscaAtraso = mysqli_query($conexao, "SELECT count(cod_ponto) as total_ponto FROM  controle_de_ponto WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_hora_atraso != '00:00:00' and ponto_situacao = '1'");
$resultadototalAtraso = mysqli_fetch_assoc($buscaAtraso);
$totalAtraso = $resultadototalAtraso["total_ponto"];
$percentualAtraso = number_format($totalAtraso / $totalPontoMes * 100, 0, '.', '');

$buscaFalta = mysqli_query($conexao, "SELECT count(cod_ponto) as total_ponto FROM  controle_de_ponto WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_situacao = '2'");
$resultadototalFalta = mysqli_fetch_assoc($buscaFalta);
$totalFalta = $resultadototalFalta["total_ponto"];
$percentualFalta = number_format($totalFalta / $totalPontoMes * 100, 0, '.', '');
}else{
   $percentualNohorario = 0; $percentualAtraso = 0; $percentualFalta = 0;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Controle de Ponto</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link href="../css/perfis.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/grafico_circulo_ponto.css" rel="stylesheet" />
        <link href="../css/marcar-ponto.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!-- header -->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                                <span class="breadcrumb-item text-primary">Recursos Humanos</span>
                                <span class="breadcrumb-item active text-success">Controle de Ponto</span>
                            </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-primary mb-1" href="#registraPonto" data-toggle="modal" data-target="#registraPonto"><i class="bi bi-check2-circle"></i> Registrar Ponto</a>
                                    <a class="btn btn-sm btn-danger mb-1" href="#justificarAF" data-toggle="modal" data-target="#justificarAF"><i class="bi bi-clipboard-check"></i> Justificar</a>
                                </div>
                            </div>
                        </div>
                        <!-- fim header -->
                        <!--conteudo da tela aqui-->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="card mb-3" style="border-radius: 15px;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 col-12 borda d-lg-flex align-items-lg-center mb-2">
                                                <div class="text-center">
                                                    <img itle="Foto Perfil" src="../img/foto_perfil/cooperativas/<?php echo $LOGO_COOP; ?>" alt="foto perfil" class="rounded-circle img-fluid bg-light" style="width: 85px;"> 
                                                </div>
                                                <h5 class="text-primary info-usuario ml-2"><?php echo ucfirst($ResultadoUsuario["nome"]); ?><br><span class="text-muted"><?php echo ucfirst($ResultadoUsuario["sobrenome"]); ?></span></h5>
                                            </div>
                                            <div class="col-md-3 col-12 text-center mb-2 my-2">
                                                <p class="texto-horas text-muted">Horas Trabalhadas</p>
                                                <h6 class="horas text-muted fw-bold"><span class="text-primary"><?php if($ResultadoHorasTrabalhadas["HorasTrabalhadas"] == null){ echo "0"; }else{ echo $ResultadoHorasTrabalhadas["HorasTrabalhadas"];}?>h</span> / 220h</h6>
                                            </div>
                                            <div class="col-md-5 text-center borda mb-2">
                                                <!-- inicio grafico circulo -->
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4 col-4">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $percentualNohorario;?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar nohorario"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar nohorario"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 h5-progress-ponto mb-0"><?php echo $percentualNohorario."%"; ?><br><span class="desc-progress-ponto">No horário</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-4 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $percentualAtraso;?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar atraso"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar atraso"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 h5-progress-ponto mb-0"><?php echo $percentualAtraso."%"; ?><br><span class="desc-progress-ponto">Atrasos</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-4 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $percentualFalta;?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar faltas"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar faltas"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 h5-progress-ponto mb-0"><?php echo $percentualFalta."%"; ?><br><span class="desc-progress-ponto">Faltas</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    

                                                </div>
                                                <!-- fim grafico circulo -->
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="card mb-3" style="border-radius: 15px;">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless" id="tabelacontroleponto" style= "white-space: nowrap;">
                                                <thead class="theadPonto">
                                                    <tr class="cab-info">
                                                        <th>Status</th>
                                                        <th>Dia</th>
                                                        <th>Entrada</th>
                                                        <th>Intervalo 1</th>
                                                        <th>Intervalo 2</th>
                                                        <th>Saída</th>
                                                        <th>Horas Previstas</th>
                                                        <th>Horas Executadas</th>
                                                        <th>Horas Atraso</th>
                                                        <th>Horas Extra</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    <?php
                                                    if (mysqli_num_rows($buscaPonto) > 0) {
                                                        while ($resultadoPonto = mysqli_fetch_assoc($buscaPonto)) {
                                                            ?>
                                                            <tr class="linha-hover info-td">
                                                                <td class="info-td">
                                                                    <?php
                                                                    if($resultadoPonto["ponto_situacao"] == 1 && $resultadoPonto["ponto_hora_atraso"] == "00:00:00"){
                                                                        echo '<i title="Tudo Certo" class="btn btn-sm btn-outline-success rounded bi bi-check-circle"></i>';
                                                                    }elseif($resultadoPonto["ponto_situacao"] == 1 && $resultadoPonto["ponto_hora_atraso"] != "00:00:00"){
                                                  echo '<i title="Atraso" class="btn btn-sm btn-outline-warning rounded bi bi-exclamation-circle"></i>';                       
                                                                    }elseif($resultadoPonto["ponto_situacao"] == 2){
                                                  echo '<i title="Ausência" class="btn btn-sm btn-outline-danger rounded bi bi-x-circle"></i>';                       
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="info-td"><?php echo utf8_encode(strftime('%d/%b - %a', strtotime($resultadoPonto["ponto_dia"]))); ?></td>
                                                                <td class="info-td text-success fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_entrada"])); ?></td>
                                                                <td class="info-td"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_intervalo_um"])); ?></td>
                                                                <td class="info-td"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_intervalo_dois"])); ?></td>
                                                                <td class="info-td text-danger fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_saida"])); ?></td>
                                                                <td class="info-td"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_hora_prevista"])); ?></td>
                                                                <td class="info-td text-primary fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_hora_executada"])); ?></td>
                                                                <td class="info-td text-danger fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_hora_atraso"])); ?></td>
                                                                <td class="info-td text-success fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_hora_extra"])); ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<tr><td class="text-danger text-center" colspan="10">Não há informações a serem exibidas</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal registra ponto -->
                        <div class="modal fade" id="registraPonto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header header-filtro">
                                        <h5 class="modal-title" id="exampleModalLabel">Registrar Ponto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="../ferramentas/registrar_ponto.php" method="POST">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select pesquisa-select" id="opcaoPonto" name="opcaoPonto" required>
                                                            <option value="">Selecione</option>
                                                            <option value="1">Entrada</option>
                                                            <option value="2">Intervalo 1</option>
                                                            <option value="3">Intervalo 2</option>
                                                            <option value="4">Saída</option>
                                                        </select>
                                                        <label for="opcaoPonto">Registrar</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer card-fundo-body p-1">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-success loading btn-sm"><i class="bi bi-check2-circle"></i> Registrar</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- modal registra ponto -->
                        
                        <!-- Modal justificativa ponto -->
                        <div class="modal fade" id="justificarAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header header-filtro">
                                        <h5 class="modal-title" id="exampleModalLabel">Justificar Atraso / Ausência / Extra</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="../ferramentas/justificar-ponto.php"  method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                
                                                    <?php 
                                                    $buscaPontoJustificativa = mysqli_query($conexao, "SELECT * FROM controle_de_ponto LEFT JOIN justificativa_ponto ON ponto_dia = just_dia and ponto_user = just_user WHERE ponto_hora_atraso != '00:00:00' and ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_justificado = '0' OR ponto_situacao = '2' and ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_justificado = '0' OR ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_justificado = '0' and ponto_hora_extra != '00:00:00'");
                                                    if(mysqli_num_rows($buscaPontoJustificativa) > 0){                    
                                                    ?>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select pesquisa-select" id="dataJustificativa" name="dataJustificativa" required>
                                                            <option value="" selected>Selecione</option>
                                                            <?php
                                                            while($resultadoJustificativa = mysqli_fetch_assoc($buscaPontoJustificativa)){
                                                                if($resultadoJustificativa["just_dia"] == null){    
                                                            ?>
                                                                <option value="<?php echo date("Y-m-d", strtotime($resultadoJustificativa["ponto_dia"])); ?>"><?php echo date("d/m/Y", strtotime($resultadoJustificativa["ponto_dia"])); if($resultadoJustificativa["ponto_hora_extra"] != "00:00:00"){ echo "- Hora Extra";}elseif($resultadoJustificativa["ponto_hora_atraso"] != "00:00:00"){echo "- Hora Atraso";}elseif($resultadoJustificativa["ponto_situacao"] == "2"){echo "- Ausência";}?></option>
                                                            <?php } } ?>
                                                        </select>
                                                        <label for="dataJustificativa">Dia Justificativa</label>
                                                    </div>
                                                    </div>
                                                
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                            <input type="text" name="motivoJustificativa" class="form-control" id="motivoJustificativa" placeholder="Motivo" autocomplete="off" maxlength="50" required>
                            <label for="motivoJustificativa">Motivo Atraso / Ausência</label>
                          </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group files">
                  <input type="file" class="form-control" name="arquivoJustificativa" id="arquivoJustificativa">
                </div>
              </div>
<?php 
                                                    }else{
                                                        echo '<div class="alert alert-warning" role="alert">Você não tem nada para justificar!</div>';
                                                    }
?>
                                            </div>
                                            <div class="modal-footer card-fundo-body p-0">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Fechar</button>
                                                <?php 
                                                if(mysqli_num_rows($buscaPontoJustificativa) > 0){
                                                ?>
                                                <button type="submit" class="btn btn-success loading btn-sm"><i class="bi bi-check2-circle"></i> Registrar</button>
                                                <?php
                                                }
                                                ?>

                                        
                                    </div>
                                            </form>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- modal registra justificativa -->
<?php
    if(isset($_GET["sucesso"])){
                            $sucesso = (int) $_GET["sucesso"];
                            if ($sucesso === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Entrada Registrada!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 2) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Intervalo 1 Registrado!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 3) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Intervalo 2 Registrado!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 4) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Saída Registrada!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 5) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Justificativa Registrada!</span>
                </div>
            </div>
        </div>';
                            }
                            }
                            ?>

                        <?php
                        if (isset($_GET["erro"])) {
                            $erro = (int) $_GET["erro"];
                            if ($erro === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Os campos não foram preenchidos!</span>
                </div>
            </div>
        </div>';
                            }elseif($erro === 2){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Opção Inválida!</span>
                </div>
            </div>
        </div>';
                            }elseif($erro === 3){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Já registrado!</span>
                </div>
            </div>
        </div>';
                            }elseif($erro === 4){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Falha ao registrar! Tente novamente!</span>
                </div>
            </div>
        </div>';
                            }elseif($erro === 5){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Você precisa registrar a <strong>ENTRADA</strong> primeiro!</span>
                </div>
            </div>
        </div>';
                            }elseif($erro === 6){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Falha ao salvar o <strong>ARQUIVO</strong>! Tente Novamente!</span>
                </div>
            </div>
        </div>';
                            }
                        }
                        ?>
                        <!--fim conteudo da tela aqui-->
                        <?php include_once "../ferramentas/modal_loading.php"; ?>
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php"; ?>
            </div>
        </div>
        <script>
            $('.pesquisa-select').select2({
                theme: 'bootstrap-5';
            });

        </script>  
        <script src="../js/toast.js"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>     
        <script>
            $(".nav .nav-link").on("click", function () {
                $(".nav").find(".menu-ativo").removeClass("menu-ativo");
                $(this).addClass("menu-ativo");
            });
        </script>

        <script src="../js/loading.js"></script>
        <script src="../js/grafico_circulo_home.js"></script>
    </body>
</html>
