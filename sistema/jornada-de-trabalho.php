<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

$buscaJornada = mysqli_query($conexao, "SELECT * FROM jornada");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Jornada de Trabalho</title>
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
                                <span class="breadcrumb-item active text-success">Jornada de Trabalho</span>
                            </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                </div>
                            </div>
                        </div>
                        <!-- fim header -->
                        <!--conteudo da tela aqui-->
                        <?php if ($SUPERVISOR == "1" || $NIVEL == "1"){?>
                        <form action="../ferramentas/atualiza-jornada.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="card mb-3 p-0 bg-transparent" style="border-radius: 15px; border:none;">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-borderless" id="tabelacontroleponto" style= "white-space: nowrap;">
                                                <thead class="theadPonto">
                                                    <tr class="cab-info">
                                                        <th>DIA</th>
                                                        <th>ENTRADA</th>
                                                        <th>INTERVALO</th>
                                                        <th>FIM INTERVALO</th>
                                                        <th>SAÍDA</th>
                                                        <th>TOLERÂNCIA</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="p-0">
                                                    <?php
                                                    if (mysqli_num_rows($buscaJornada) > 0) {
                                                        while ($resultadoJornada = mysqli_fetch_assoc($buscaJornada)) {
                                                            ?>
                                                            <tr class="linha-hover info-td" <?php if ($resultadoJornada["cod_jornada"] == 6 || $resultadoJornada["cod_jornada"] == 7){ echo 'style="background-color: #FFD70F89;"';}?> >
                                                                <td class="info-td fw-bold cor-primaria">
                                                                    <?php echo $resultadoJornada["dia"]; ?>
                                                                    <input type="hidden" name="cod_dia[]" class="form-control" value="<?php echo $resultadoJornada["cod_jornada"]; ?>">
                                                                    <input type="hidden" name="dia_semana[]" class="form-control" value="<?php echo $resultadoJornada["dia"]; ?>">
                                                                    <input type="hidden" name="dia_abreviado[]" class="form-control" value="<?php echo $resultadoJornada["dia_abreviado"]; ?>">
                                                                </td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="entrada[]" class="form-control" value="<?php echo strftime('%H:%M', strtotime($resultadoJornada["jor_entrada"])); ?>"></td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="intervalo[]" class="form-control" value="<?php echo strftime('%H:%M', strtotime($resultadoJornada["jor_intervalo"])); ?>"></td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="fim_intervalo[]" class="form-control" value="<?php echo strftime('%H:%M', strtotime($resultadoJornada["jor_fim_intervalo"])); ?>"></td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="saida[]" class="form-control" value="<?php echo strftime('%H:%M', strtotime($resultadoJornada["jor_saida"])); ?>"></td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="tolerancia[]" class="form-control" value="<?php echo strftime('%H:%M', strtotime($resultadoJornada["jor_tolerancia"])); ?>"></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<tr><td class="text-danger text-center" colspan="6">Não há informações a serem exibidas</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" class="btn btn-success btn-md float-end"><i class="bi bi-arrow-clockwise"></i> Atualizar Jornada</button>
                            </div>
                        </div>
                            </form>
                        <?php 
                        }else{
                         echo '<div class="row"><div class="col-12"><p class="text-center alert alert-warning">Você é do Administrativo, porém não é um <strong>SUPERVISOR!</strong> Por isso não pode visualizar esta tela de jornada de trabalho!</p></div></div>';
                        }
                        ?>
<?php
                   if (isset($_GET["sucesso"])) {
                            $sucesso = (int) $_GET["sucesso"];
            if($sucesso === 1){
            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Jornada Atualizada!</span>
                </div>
            </div>
        </div>';
            }
                        }
                        if (isset($_GET["erro"])) {
                            $erro = (int) $_GET["erro"];
            if($erro === 1){
             
           echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro ao atualizar! Tente novamente!</span>
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
