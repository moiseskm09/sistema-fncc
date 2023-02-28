<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['cod_user'])) {
    $usuario = $_GET['cod_user'];
    $consultaCompensacao = mysqli_query($conexao, "SELECT id_usuario, nome from usuarios WHERE id_usuario = '$usuario'");
    $resultadoCompensacao = mysqli_fetch_assoc($consultaCompensacao);
    $usuario_option = $resultadoCompensacao['nome'];
} else {
    $usuario_option = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <title>Compensação de Horas</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
    <link href="../css/menu.css" rel="stylesheet" />
    <link href="../css/perfis.css" rel="stylesheet" />
    <link rel="manifest" href="../manifest.json">
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
                      <span class="breadcrumb-item active text-success">Compensação de Horas</span>
                  </div>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="mr-2">
                  <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                </div>
              </div>

            </div>
            <div class="card-body bg-white p-2" style="border-radius: 15px;">
            <div class="row">
              <div class="col-md-12">
                        <form action="" method="GET" id="perfil">
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <select class="form-select pesquisa-select" name="cod_user" onchange="this.form.submit()" required>
                                  <option value=""><?php
                                      if (!empty($usuario)) {
                                          echo $usuario_option;
                                      } else {
                                          echo "- Selecione -";
                                      }
                                      ?></.>
                                  <?php
                                  $consultaUsuario = mysqli_query($conexao, "SELECT * FROM usuarios WHERE user_controla_ponto = '1'");
                                  if (mysqli_num_rows($consultaUsuario) > 0) {
                                      while ($usuarios = mysqli_fetch_assoc($consultaUsuario)) {
                                          if ($usuarios["id_usuario"] == $usuario) {
                                              
                                          } else {
                                              ?>
                                              <option value="<?php echo $usuarios["id_usuario"]; ?>"><?php echo $usuarios["nome"]; ?></option>   
                                              <?php
                                          }
                                      }
                                  } else {
                                      
                                  }
                                  ?>
                                </select>
                                <label for="floatingSelect">Pessoa</label>
                              </div>
                            </div>
                              <?php if(!empty($_GET['cod_user'])){ 
                              $querybuscaSaldoGeral = "SELECT TIME_FORMAT(TIMEDIFF(time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( SaldoBanco ) ) ),'%H:%i'), time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( SaldoDesconto ) ) ),'%H:%i')) ,'%H:%i')AS saldo_de_horas FROM ( 
SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( bh_horas ) ) ),'%H:%i') as SaldoBanco, 0 as SaldoDesconto FROM banco_de_horas INNER JOIN controle_de_ponto on bh_dia = ponto_dia WHERE bh_user = '$usuario' and ponto_justificativa_aprovada = '1'
UNION 
SELECT 0 as SaldoBanco, time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( qt.saldoDesconto ) ) ),'%H:%i') as SaldoDesconto FROM (  
SELECT SEC_TO_TIME(TIME_TO_SEC(saldoCompensadas) + TIME_TO_SEC(saldoAtraso)) as saldoDesconto FROM(
SELECT 0 saldoAtraso, time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( comp_hora ) ) ),'%H:%i') as saldoCompensadas FROM compensacao WHERE comp_user = '$usuario' 
UNION 
SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ponto_hora_atraso ) ) ),'%H:%i') as saldoAtraso, 0 saldoCompensadas FROM controle_de_ponto WHERE ponto_user = '$usuario' and ponto_justificativa_aprovada = '0' and horas_compensadas = 0) AS qb)as qt) as qj";    
                             //echo $querybuscaSaldoGeral;
                              $buscaSaldoGeral = mysqli_query($conexao, $querybuscaSaldoGeral);     
                             $resultadoSaldoGeral = mysqli_fetch_assoc($buscaSaldoGeral)
                                  ?>
                                                            
                              <div class="col-lg-8 col-md-8 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" id="saldodeHoras" class="form-control" value="<?php echo $resultadoSaldoGeral["saldo_de_horas"]; ?>" readonly>
                                                                <label for="horasCompensadas">Saldo de Horas Atual <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                              <?php } ?>
                          </div>
                        </form>
                          </div>
                </div>
               
                          <?php if(!empty($_GET['cod_user'])){ ?>
                <form action="../ferramentas/adiciona-compensacao.php" method="POST">
                          <div class="row">
                              <input type="hidden" name="codUsuarioComp" value="<?php echo $usuario; ?>">
                              <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="date" name="dataCompensacao" id="dataCompensacao" class="form-control" placeholder="Insira uma data" required>
                                                                <label for="dataCompensacao">Data da Compensação <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                              <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="time" name="horasCompensadas" id="horasCompensadas" class="form-control" placeholder="Insira a quantidade de horas" required>
                                                                <label for="horasCompensadas">Horas Compensadas <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                              
                              <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <select class="form-select pesquisa-select" name="tipoCompensacao" required>
                                    <option value="">- Selecione - </option>
                                    <option value="compensação">Compensação</option>
                                    <option value="folga">Folga</option>
                                    <option value="pago">Pago</option>

                                </select>
                                <label for="tipoCompensacao">Tipo de Compensação</label>
                              </div>
                            </div>
                              <div class="col-12 text-end">
                                  <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-hourglass"></i> Adicionar Compensação</button>
                              </div>                              
                          </div>
            </form>
                          <?php  } ?>
              </div>
            
            
            <?php if(!empty($_GET['cod_user'])){ ?>
            <div class="card-body mt-2 mb-2" style="border-radius:15px;">
               
                                  <div class="text-center mt-3 mb-3"><h5 class="cor-primaria">Histórico de Compensação</h5></div>
                                
                          
                <div class="table-responsive">
                                            <table class="table table-borderless" style= "white-space: nowrap;">
                                                <thead class="theadPonto">
                                                    <tr class="cab-info">
                                                        <th>DATA COMPENSAÇÃO</th>
                                                        <th>HORAS COMPENSADAS</th>
                                                        <th>TIPO COMPENSAÇÃO</th>
                                                        <th>AÇÃO</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="">
                                                    <?php
                                                    $buscaCompensacao = mysqli_query($conexao, "SELECT * FROM compensacao WHERE comp_user = '$usuario'");
                                                    if (mysqli_num_rows($buscaCompensacao) > 0) {
                                                        while ($resultadoCompensacao = mysqli_fetch_assoc($buscaCompensacao)) {
                                                            ?>
                                                            <tr class="linha-hover info-td">
                                                                <td class="info-td fw-bold cor-primaria"><?php echo utf8_encode(strftime('%d/%b - %a', strtotime($resultadoCompensacao["comp_dia"]))); ?></td>
                                                               
                                                                <td class="info-td text-danger fw-bold"><?php echo strftime('%H:%M', strtotime($resultadoCompensacao["comp_hora"])); ?></td>
                                                                <td class="info-td text-success fw-bold"><?php echo ucfirst($resultadoCompensacao["comp_tipo"]);?></td>
                                                                <td class="info-td text-success fw-bold">
                                                                <a href="../ferramentas/deleta-compensacao.php?codUsuarioComp=<?php echo $resultadoCompensacao["comp_user"]; ?>&dataCompensacao=<?php echo $resultadoCompensacao["comp_dia"]; ?>" title="Excluir Compensação" desativar-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="bi bi-trash3 btn-sm btn-danger"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<tr><td class="text-danger text-center" colspan="4">Não há informações a serem exibidas</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>  
            </div>
            <?php } ?>
                            
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
                    <span>Compensação Adicionada!</span>
                </div>
            </div>
        </div>';
              }elseif ($sucesso === 2) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Compensação excluída!</span>
                </div>
            </div>
        </div>';
              }
              }
              

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
                    <span>Erro ao adicionar!</span>
                </div>
            </div>
        </div>';
                        }elseif ($erro === 2) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro ao excluír!</span>
                </div>
            </div>
        </div>';
                        }
                        
                            }
              ?>
            </div>
            <!--fim conteudo da tela aqui!-->
          
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
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".menu-ativo").removeClass("menu-ativo");
   $(this).addClass("menu-ativo");
});
</script>
  </body>
</html>
