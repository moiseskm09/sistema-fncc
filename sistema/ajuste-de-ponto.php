<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if(isset($_POST["pessoa"], $_POST["dataRefIncialF"], $_POST["dataRefFinalF"])){
$primeiroDia = $_POST["dataRefIncialF"];
$UltimodiaDia = $_POST["dataRefFinalF"];
$pessoa = $_POST["pessoa"];
$buscaPontoAjuste = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_user = '$pessoa' and ponto_dia >= '$primeiroDia' and ponto_dia <= '$UltimodiaDia'");
$filtro = 1;
}else{
$filtro = 0;
$pessoa = "";
$primeiroDia = date("Y-m-01");
$UltimodiaDia = date("Y-m-t");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Ajuste de Ponto</title>
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
                        <!-- header -->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                                <span class="breadcrumb-item text-primary">Recursos Humanos</span>
                                <span class="breadcrumb-item active text-success">Ajuste de Ponto</span>
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
                            <div class="row" id="renderPDF">
                            <div class="col-md-12">
                                <div class="accordion mb-2" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span class="fw-bold">Filtro</span>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <form action="" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                           
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select pesquisa-select" id="pessoa" name="pessoa" required>
                                                                    <option value="">Selecione</option>
                                                                    <?php
                                                                    $buscapessoa = mysqli_query($conexao, "SELECT * FROM usuarios WHERE user_controla_ponto = '1'");
                                                                    while ($resultadoPessoa = mysqli_fetch_assoc($buscapessoa)) {
                                                                        if($pessoa == $resultadoPessoa['id_usuario']){
         echo '<option selected value='.$resultadoPessoa['id_usuario'].'>'.$resultadoPessoa['nome'].'</option>';                                                                   
                                                                        }else{
                                                                        ?>
                                                                        <option value="<?php echo $resultadoPessoa['id_usuario'] ?>"><?php echo $resultadoPessoa['nome'] ?></option>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <label for="pessoa">Pessoa</label>
                                                            </div>
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
                                                            <button type="submit" id="filtrarAtendimento" class="btn btn-sm btn-success"><i class="bi bi-funnel"></i> Buscar Ponto</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form action="../ferramentas/ajusta-ponto.php" method="POST">
                                <div class="card border-0 mb-3" style="border-radius:15px;">
                                    <div class="card-body border-0 bg-white <?php if($filtro == 1){
                                        echo "p-0";
                                    }else{
                                        echo "p-3";
                                    }
?>" style="border-radius:15px;">
                                <?php if($filtro == 1){ ?>
                                               <div class="table-responsive">
                                                   
                                            <table class="table table-borderless" style= "white-space: nowrap;">
                                                <thead class="theadPonto">
                                                    <tr class="cab-info">
                                                        <th>DIA</th>
                                                        <th>ENTRADA</th>
                                                        <th>INTERVALO</th>
                                                        <th>FIM INTERVALO</th>
                                                        <th>SAÍDA</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="p-0">
                                                    
                                                    <?php
                                                    if (mysqli_num_rows($buscaPontoAjuste) > 0) {
                                                        while ($resultadoPontoAjuste = mysqli_fetch_assoc($buscaPontoAjuste)) {
                                                            ?>
                                                            <tr class="linha-hover info-td">
                                                                <td class="info-td fw-bold cor-primaria">
                                                                    <?php echo utf8_encode(strftime('%a - %d/%m', strtotime($resultadoPontoAjuste["ponto_dia"]))); ?>
                                                                    <input type="hidden" name="ponto_user[]" class="form-control" value="<?php echo $resultadoPontoAjuste["ponto_user"]; ?>">
                                                                    <input type="hidden" name="ponto_dia[]" class="form-control" value="<?php echo $resultadoPontoAjuste["ponto_dia"]; ?>">
                                                                    <input type="hidden" name="cod_ponto[]" class="form-control" value="<?php echo $resultadoPontoAjuste["cod_ponto"]; ?>">
                                                                </td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="entrada[]" class="form-control" value="<?php if($resultadoPontoAjuste["ponto_entrada"] == null){ echo ""; }else{ echo strftime('%H:%M', strtotime($resultadoPontoAjuste["ponto_entrada"])); } ?>" required></td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="intervalo[]" class="form-control" value="<?php if($resultadoPontoAjuste["ponto_intervalo_um"] == null){ echo ""; }else{ echo strftime('%H:%M', strtotime($resultadoPontoAjuste["ponto_intervalo_um"])); } ?>" required></td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="fim_intervalo[]" class="form-control" value="<?php if($resultadoPontoAjuste["ponto_intervalo_dois"] == null){ echo ""; }else{ echo strftime('%H:%M', strtotime($resultadoPontoAjuste["ponto_intervalo_dois"]));} ?>" required></td>
                                                                <td class="info-td text-success fw-bold"><input type="time" name="saida[]" class="form-control" value="<?php if($resultadoPontoAjuste["ponto_saida"] == null){ echo ""; }else{ echo strftime('%H:%M', strtotime($resultadoPontoAjuste["ponto_saida"]));} ?>" required></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<tr><td class="text-danger text-center" colspan="5">Não há informações a serem exibidas</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>   
                                        </div> 
                                                <?php } else{ ?> 
                                                <div clas="row">
                                                    <div><p class="text-center alert alert-warning">Defina o <strong>FILTRO</strong> para ajustar o ponto</p></div>
                                                </div>
                                                    <?php } ?> 
                                </div>
                                    
                            </div> 
                                    <?php if($filtro == 1){ ?>
                                    <div class="mt-2 mb-2 mr-3 text-end">
                                                            <button type="submit" id="filtrarAtendimento" class="btn btn-sm btn-success"><i class="bi bi-check2-circle"></i> Ajustar Ponto</button>
                                                        </div>
                                    <?php } ?>
                                    </form>
                                
                        </div> 
                            </div>

                        <?php 
                        }else{
                         echo '<div><p class="text-center alert alert-warning">Você é do Administrativo, porém não é um <strong>SUPERVISOR!</strong> Por isso não pode visualizar esta tela de ajustar o ponto!</p></div>';
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
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <span>Ponto Atualizado!</span>
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
                    <span>Erro ao atualizar o Ponto! Tente novamente!</span>
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
