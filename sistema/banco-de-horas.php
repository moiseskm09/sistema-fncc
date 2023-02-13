<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (!empty($_POST["pessoa"] || $_POST["dataRefIncialF"] || $_POST["dataRefFinalF"])) {
    
$primeiroDia = $_POST["dataRefIncialF"];
$UltimodiaDia = $_POST["dataRefFinalF"];    
$pessoa = $_POST["pessoa"];


$buscaBancodeHoras = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( bh_horas ) ) ),'%H:%i') as SaldoBancoMes FROM banco_de_horas WHERE bh_dia >= '$primeiroDia' and bh_dia <= '$UltimodiaDia' and bh_user like '%$pessoa%'");
$ResultadoBancoTotal = mysqli_fetch_assoc($buscaBancodeHoras);

$buscaHorasAtraso = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoAtrasoMes FROM controle_de_ponto WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user like '%$pessoa%'");
$ResultadoAtrasoTotal = mysqli_fetch_assoc($buscaHorasAtraso);

$buscaHorasAtrasoJustificado = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoJustificadoMes FROM justificativa_ponto INNER JOIN controle_de_ponto on just_dia = ponto_dia and just_user = ponto_user WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user like '%$pessoa%' and just_tipo = 'atraso' and just_situacao = '1' and ponto_justificativa_aprovada = '1'");
$ResultadoAtrasoJustificadoTotal = mysqli_fetch_assoc($buscaHorasAtrasoJustificado);

$buscaHorasAtrasoNJustificado = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoNJustificadoMes FROM controle_de_ponto WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user like '%$pessoa%' and ponto_justificativa_aprovada = '0'");
$ResultadoAtrasoNJustificadoTotal = mysqli_fetch_assoc($buscaHorasAtrasoNJustificado);

$buscaSaldoDeHoras = mysqli_query($conexao, "SELECT TIME_FORMAT(TIMEDIFF(time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( qb.SaldoBancoMes ) ) ),'%H:%i'), time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( qb.SaldoNJustificadoMes ) ) ),'%H:%i')) ,'%H:%i')AS saldo_de_horas FROM (
SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( bh_horas ) ) ),'%H:%i') as SaldoBancoMes, 0  as SaldoNJustificadoMes FROM banco_de_horas WHERE bh_dia >= '$primeiroDia' and bh_dia <= '$UltimodiaDia' and bh_user like '%$pessoa%'
UNION
SELECT 0 as SaldoBancoMes, time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoNJustificadoMes FROM controle_de_ponto WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user like '%$pessoa%' and ponto_justificativa_aprovada = '0') AS qb");
$ResultadoSaldoHorasTotal = mysqli_fetch_assoc($buscaSaldoDeHoras);       
        
$buscaPonto = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_user like '%$pessoa%' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_hora_atraso != '00:00:00' OR ponto_user like '%$pessoa%' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_hora_extra != '00:00:00' ORDER BY ponto_dia DESC");
    
}else{
 
$primeiroDia = date("Y-m-01");
$UltimodiaDia = date("Y-m-t");

$buscaBancodeHoras = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( bh_horas ) ) ),'%H:%i') as SaldoBancoMes FROM banco_de_horas WHERE bh_dia >= '$primeiroDia' and bh_dia <= '$UltimodiaDia' and bh_user = '$CODIGOUSUARIO'");
$ResultadoBancoTotal = mysqli_fetch_assoc($buscaBancodeHoras);

$buscaHorasAtraso = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoAtrasoMes FROM controle_de_ponto WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user = '$CODIGOUSUARIO'");
$ResultadoAtrasoTotal = mysqli_fetch_assoc($buscaHorasAtraso);

$buscaHorasAtrasoJustificado = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoJustificadoMes FROM justificativa_ponto INNER JOIN controle_de_ponto on just_dia = ponto_dia and just_user = ponto_user WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user = '$CODIGOUSUARIO' and just_tipo = 'atraso' and just_situacao = '1' and ponto_justificativa_aprovada = '1'");
$ResultadoAtrasoJustificadoTotal = mysqli_fetch_assoc($buscaHorasAtrasoJustificado);

$buscaHorasAtrasoNJustificado = mysqli_query($conexao, "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoNJustificadoMes FROM controle_de_ponto WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user = '$CODIGOUSUARIO' and ponto_justificativa_aprovada = '0'");
$ResultadoAtrasoNJustificadoTotal = mysqli_fetch_assoc($buscaHorasAtrasoNJustificado);

$buscaSaldoDeHoras = mysqli_query($conexao, "SELECT TIME_FORMAT(TIMEDIFF(time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( qb.SaldoBancoMes ) ) ),'%H:%i'), time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( qb.SaldoNJustificadoMes ) ) ),'%H:%i')) ,'%H:%i')AS saldo_de_horas FROM (
SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( bh_horas ) ) ),'%H:%i') as SaldoBancoMes, 0  as SaldoNJustificadoMes FROM banco_de_horas WHERE bh_dia >= '$primeiroDia' and bh_dia <= '$UltimodiaDia' and bh_user = '$CODIGOUSUARIO'
UNION
SELECT 0 as SaldoBancoMes, time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as SaldoNJustificadoMes FROM controle_de_ponto WHERE ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_user = '$CODIGOUSUARIO' and ponto_justificativa_aprovada = '0') AS qb");
$ResultadoSaldoHorasTotal = mysqli_fetch_assoc($buscaSaldoDeHoras);       
        
$buscaPonto = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_hora_atraso != '00:00:00' OR ponto_user = '$CODIGOUSUARIO' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia' and ponto_hora_extra != '00:00:00' ORDER BY ponto_dia DESC");

$pessoa = $CODIGOUSUARIO;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Banco de Horas</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
         <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/graficos.css" rel="stylesheet" />
        <link href="../css/marcar-ponto.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Recursos Humanos</span>
                      <span class="breadcrumb-item active text-success">Banco de Horas</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <!--<a class="btn btn-sm btn-primary mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-question"></i> Ajuda</a>     -->                             
                                </div>
                            </div>

                        </div>

                        <div class="row" id="renderPDF">

                            <div class="col-md-12">
                                <div class="accordion mb-2" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span class="destaque fw-bold">Filtro</span>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <form action="" method="POST">
                                                    <div class="row">
                                                        
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                            <?php if ($SUPERVISOR == "1" || $NIVEL == "1"){?>
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select pesquisa-select" id="pessoa" name="pessoa">
                                                                    <option value="">Todos</option>
                                                                    <?php
                                                                    $buscaResponsavel = mysqli_query($conexao, "SELECT * FROM usuarios WHERE user_controla_ponto = '1'");
                                                                    while ($resultadoResponsavel = mysqli_fetch_assoc($buscaResponsavel)) {
                                                                        if($pessoa == $resultadoResponsavel['id_usuario']){
         echo '<option selected value='.$resultadoResponsavel['id_usuario'].'>'.$resultadoResponsavel['nome'].'</option>';                                                                   
                                                                        }else{
                                                                        ?>
                                                                        <option value="<?php echo $resultadoResponsavel['id_usuario'] ?>"><?php echo $resultadoResponsavel['nome'] ?></option>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <label for="pessoa">Pessoa</label>
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-floating mb-3">
                              <input type="hidden" name="pessoa" id="pessoa" class="form-control" placeholder="Pessoa" autocomplete="off" maxlength="60" value="<?php echo $CODIGOUSUARIO; ?>" required>
                              <input type="text" class="form-control" placeholder="Pessoa" autocomplete="off" maxlength="60" value="<?php echo $NOME; ?>" readonly="">
                            <label for="Pessoa">Pessoa <span class="text-danger">*</span></label>
                          </div>
                                                            
                                                            
                                                            <?php } ?>
                                                            
                                                            
                                                        </div>
                                                  <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="date" name="dataRefIncialF" id="dataRefIncialF" class="form-control" placeholder="Insira a data ref inicial" value="<?php echo $primeiroDia; ?>" required>
                                                                <label for="dataRefIncialF">Data Inicial <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="date" name="dataRefFinalF" id="dataRefFinalF" class="form-control" placeholder="Insira a data ref final" value="<?php echo $UltimodiaDia; ?>" required>
                                                                <label for="dataRefFinalF">Data Final <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <button type="submit" id="filtrarAtendimento" class="btn btn-sm btn-success"><i class="bi bi-funnel"></i> Filtrar Banco de Horas</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="accordion mb-2" id="accordionExample" >
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDois" aria-expanded="true" aria-controls="collapseDois">
                                                <span class="destaque fw-bold">Resultado</span>
                                            </button>
                                        </h2>
                                        <div id="collapseDois" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#collapseDois">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    
                                                <?php
                                                if($ResultadoBancoTotal["SaldoBancoMes"] != "00:00:00"){ ?>
                                                    <div class="col-md-12 col-12 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relbancodehoras" style="border: 1px solid rgba(0,143,251,0.85); border-radius: 10px; box-shadow: 0 0px 4px 0px rgba(0,143,251,0.85);">
      <span>Horas Extras</span>
      <h6><?php if($ResultadoBancoTotal["SaldoBancoMes"] != "00:00:00" && $ResultadoBancoTotal["SaldoBancoMes"] != null){ echo $ResultadoBancoTotal["SaldoBancoMes"]; }else { echo "00:00";} ?></h6>
  </div>
</div>
                                                                
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relbancodehoras" style="border: 1px solid rgba(255,69,96,0.85); border-radius: 10px; box-shadow: 0 0px 4px 0px rgba(255,69,96,0.85);">
      <span>Horas Atraso</span>
      <h6><?php if($ResultadoAtrasoTotal["SaldoAtrasoMes"] != "00:00:00" && $ResultadoAtrasoTotal["SaldoAtrasoMes"] != null){ echo $ResultadoAtrasoTotal["SaldoAtrasoMes"]; }else { echo "00:00";} ?></h6>
  </div>
</div>
                                                            </div>
                                                            
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relbancodehoras" style="border: 1px solid rgba(254,176,25,0.85); border-radius: 10px; box-shadow: 0 0px 3px 0px rgba(254,176,25,0.85);">
      <span>Atraso Justificado</span>
      <h6><?php if($ResultadoAtrasoJustificadoTotal["SaldoJustificadoMes"] != "00:00:00" && $ResultadoAtrasoJustificadoTotal["SaldoJustificadoMes"] != null ){ echo $ResultadoAtrasoJustificadoTotal["SaldoJustificadoMes"]; }else { echo "00:00";} ?></h6>
  </div>
</div>
                                                            </div>
                                                            
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relbancodehoras" style="border: 1px solid rgba(119,93,208,0.85); border-radius: 10px; box-shadow: 0 0px 4px 0px rgba(119,93,208,0.85);">
      <span>Atraso Não Justificado</span>
      <h6><?php if($ResultadoAtrasoNJustificadoTotal["SaldoNJustificadoMes"] != "00:00:00" && $ResultadoAtrasoNJustificadoTotal["SaldoNJustificadoMes"] != null){ echo $ResultadoAtrasoNJustificadoTotal["SaldoNJustificadoMes"]; }else { echo "00:00";} ?></h6>
  </div>
</div>
                                                            </div>
                                                            
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relbancodehoras" style="border: 1px solid rgba(0,227,150,0.85); border-radius: 10px; box-shadow: 0 0px 4px 0px rgba(0,227,150,0.85);">
      <span>Saldo de Horas</span>
      <h6><?php if($ResultadoSaldoHorasTotal["saldo_de_horas"] != "00:00:00"){ echo $ResultadoSaldoHorasTotal["saldo_de_horas"]; }else { echo "00:00";} ?></h6>
  </div>
</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                            <table class="table table-borderless" id="tabelacontroleponto" style= "white-space: nowrap;">
                                                <thead class="theadPonto">
                                                    <tr class="cab-info">
                                                        <th>Status</th>
                                                        <th>Dia</th>
                                                        <th>Atraso</th>
                                                        <th>Extra</th>
                                                        <th>Justificado</th>
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
                                                                    if($resultadoPonto["ponto_hora_atraso"] != "00:00:00" && $resultadoPonto["ponto_hora_extra"] == "00:00:00"){
                                                                        echo '<i title="Atraso" class="btn btn-sm btn-outline-danger rounded bi bi-exclamation-circle"></i>'; 
                                                                    }elseif($resultadoPonto["ponto_hora_atraso"] == "00:00:00" && $resultadoPonto["ponto_hora_extra"] != "00:00:00"){
                                                  echo '<i title="Extra" class="btn btn-sm btn-outline-success rounded bi bi-check-circle"></i>';                       
                                                                    }elseif($resultadoPonto["ponto_hora_atraso"] != "00:00:00" && $resultadoPonto["ponto_hora_extra"] != "00:00:00"){
                                                  echo '<i title="Compensação / Extra" class="btn btn-sm btn-outline-primary rounded bi bi-hourglass-split"></i>';                       
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="info-td fw-bold cor-primaria"><?php echo utf8_encode(strftime('%d/%b - %a', strtotime($resultadoPonto["ponto_dia"]))); ?></td>
                                                               
                                                                <td class="info-td text-danger fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_hora_atraso"])); ?></td>
                                                                <td class="info-td text-success fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoPonto["ponto_hora_extra"])); ?></td>
                                                                <td class="info-td text-success fw-bold"><?php if($resultadoPonto["ponto_justificado"] == 1){
         echo '<i title="Justificado" class="btn btn-sm btn-outline-warning rounded bi bi-emoji-neutral"></i>';                                                           
                                                                }elseif($resultadoPonto["ponto_justificado"] == 0 && $resultadoPonto["ponto_hora_atraso"] == "00:00:00" && $resultadoPonto["ponto_hora_extra"] == "00:00:00"){
                                           echo '<i title="Tudo OK" class="btn btn-sm btn-outline-success rounded bi bi-emoji-smile"></i>';                         
                                                                }else{
                                                                  echo '<i title="Não Justificado" class="btn btn-sm btn-outline-danger rounded bi bi-emoji-frown"></i>';  
                                                                }
?></td>
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
                                                    <div class="col-12">

                                                        <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a onclick="printCertificate()" class="btn btn-dark mb-1" id="imprimirtela" title="Exportar Tela"><i class="bi bi-laptop"></i> Exportar Tela</a>
                                </div>
                            </div>
                                                    </div>
                                                <?php
                                                } else {
                                                    
                                                    ?>
                                                    <p class="text-center alert alert-warning">Não há dados para exibir com o filtro selecionado!</p>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                            </div>                  
                        </div> 
                        <!-- Modal Ajuda-->
                        <div class="modal fade" id="ajuda" tabindex="-1" role="dialog" aria-labelledby="ajuda" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-dark p-2">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajuda</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="destaque">Inclusão de vários arquivos</h6>
                                                <p>Para adicionar mais de um arquivo na consulta utilize as teclas <code>CTRL (TECLADO) + CLIQUE DO MOUSE</code> para selecionar ou se preferir selecione com o <code>MOUSE</code> e arraste para o campo.</p>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Fechar"><i class="bi bi-x"></i> Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include_once "../ferramentas/modal_loading.php"; ?>
                        <!--fim conteudo da tela aqui!-->
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
        <script>
        function printCertificate() {
            document.getElementById('filtrarAtendimento').style.display = 'none';
            document.getElementById('imprimirtela').style.display = 'none';
            const printContents = document.getElementById('renderPDF').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            document.getElementById('filtrarAtendimento').style.display = 'inline';
            document.getElementById('imprimirtela').style.display = 'inline';
        }
    </script>
    </body>
</html>
