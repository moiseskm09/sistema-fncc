<?php
require_once '../config/conexao.php';
require_once '../config/sessao.php';
require_once '../config/config_geral.php';
require_once 'sql-grafico-circulo-home.php';

function saudacao() {
    $hora = date('H');
    if ($hora >= 6 && $hora <= 12)
        return 'Bom dia';
    else if ($hora > 12 && $hora <= 18)
        return 'Boa tarde';
    else
        return 'Boa noite';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Tela Principal</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link href="../css/home.css" rel="stylesheet" />
        <link rel="manifest" href="../manifest.json">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/grafico_circulo_home.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="form-row mt-1">
                            <div class="col-md-12">
                                <h6><?php echo saudacao(); ?>, <span class="destaque"><?php echo ucwords($NOME); ?></span></h6>
                                <p>Que bom te ver por aqui! <i class=" fw-bold destaque bi bi-emoji-smile"></i></p>
                            </div>

                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <h4 class="blockquote-footer" style="font-size: 20px;">Acesso Rápido</h4>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $buscaSubmenu = mysqli_query($conexao, "SELECT submenu, icone_sub, caminho FROM submenu INNER JOIN nivel_acesso ON cod_submenu = codSubmenu WHERE cod_perfil = $NIVEL and marcado = 1 ORDER BY RAND() LIMIT 12");
                            while ($resultadoAcessoRapido = mysqli_fetch_assoc($buscaSubmenu)) {
                                ?>


                                <div class="col-lg-2 col-md-2 col-6">
                                    <a href="<?php echo $resultadoAcessoRapido['caminho']; ?>" class="link-rapido">
                                        <div class="card mb-2 border-0" style="border-radius:15px;">
                                            <div class="card-body text-center card-acesso-rapido p-1">
                                                <h5><i class="<?php echo $resultadoAcessoRapido['icone_sub']; ?>"></i></h5>
                                                <h6><?php echo substr($resultadoAcessoRapido['submenu'], 0, 18); ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="blockquote-footer mt-2" style="font-size: 20px;">Quadro de Avisos</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="card mb-2 border-0 card-aviso" style="border-radius:15px; height: 240px;">
                                            <div class="card-header fw-bold" style="background-color: #e7f1ff;color: #785aa2;">
                                                <div class="row">
                                                    <div class="col text-center" style="white-space: nowrap;">Aviso</div>
                                                    <div class="col text-center">Data</div>
                                                    <div class="col text-center">Ação</div>
                                                </div>
                                            </div>
                                            <div class="card-body text-center p-1">
                                                <?php
                                                $queryAviso = "SELECT * FROM avisos WHERE coop_aviso in($COOPERATIVA, 0) ORDER BY cod_aviso DESC LIMIT 4 ";
                                                $buscaAviso = mysqli_query($conexao, $queryAviso);
                                                if (mysqli_num_rows($buscaAviso) > 0) {
                                                    ?>
                                                    <ul class="list-group list-group-flush"> 
                                                        <?php
                                                        while ($resultadoAviso = mysqli_fetch_assoc($buscaAviso)) {
                                                            ?>
                                                            <li class="list-group-item list-group-item-action">
                                                                <div class="row">
                                                                    <div class="col col-4" style="white-space: nowrap;"><?php echo $resultadoAviso["aviso"]; ?></div>
                                                                    <div class="col col-4"><?php echo strftime('%d.%m.%Y', strtotime($resultadoAviso["data_aviso"])); ?></div>
                                                                    <div class="col col-4"><a class="btn btn-sm btn-outline-info" title="Visualizar" href="<?php echo $resultadoAviso["link_aviso"]; ?>">Visualizar</a></div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <h6 class="destaque" style="margin-top:18%;">Ainda não temos avisos para exibir! <i class="bi bi-emoji-neutral"></i></h6>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="blockquote-footer mt-2" style="font-size: 20px;">Dashboard</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="card mb-2 border-0 home-dashboard">
                                            <div class="card-header fw-bold" style="background-color: #e7f1ff;color: #785aa2;">
                                                <div class="row">

                                                    <div class="col text-center">Dashboard Consultas</div>
                                                </div>
                                            </div>
                                            <div class="card-body text-center p-1 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2" >
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalAbertos; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar aberto"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar aberto"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalAbertos; ?><br><span style="font-size: 13px;">Abertos</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalAndamento; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar emAndamento"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar emAndamento"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalAndamento; ?><br><span style="font-size: 13px;">Andamento</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalAguardando; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar aguardando"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar aguardando"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalAguardando; ?><br><span style="font-size: 13px;">Aguardando</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalPendente; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar pendente"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar pendente"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalPendente; ?><br><span style="font-size: 13px;">Pendente</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        
                        
                        <!-- Modal atualiza cadastro-->
            <div class="modal fade" id="atualizaCadastroCoop" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" >
      <div class="modal-content border-0" style="box-shadow: 0 0 2px 1px #FFD70F;">
      <div class="modal-body p-2">
          <p style="font-size:18px;" class="cor-primaria">Olá <strong class="destaque"><?php echo $NOME; ?></strong>.<br> Os dados cadastrais da sua Cooperativa estão desatualizados!<br>Gostaria de atualizá-los agora?</p>
      </div>
      <div class="modal-footer p-0 border-0">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="bi bi-emoji-frown"></i> NÃO</button>
        <a type="button" href="editar-cooperativa.php?id=<?php echo $COOPERATIVA;?>" class="btn btn-lg btn-success"><i class="bi bi-emoji-smile"></i> SIM</a>
      </div>
    </div>
  </div>
</div>
                        <!-- modal atualiza cadastro -->
                        <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php"; ?>
            </div>
        </div>
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
        <script src="../js/grafico_circulo_home.js"></script>
        
        
        <?php
        if($NIVEL == 3 || $NIVEL == 4){  
        }else{
        $ConsultaCoopCadastro = mysqli_query($conexao, "SELECT coop_dados_atualizados FROM cooperativas WHERE cod_coop = '$COOPERATIVA'");
        if(mysqli_num_rows($ConsultaCoopCadastro) > 0 ){
            $resultadoCadastroCoop = mysqli_fetch_assoc($ConsultaCoopCadastro);
            $coopDadosAtualizado = $resultadoCadastroCoop["coop_dados_atualizados"];
            if($coopDadosAtualizado == 1){
            }else{
               echo '<script type="text/javascript">
    $(window).on("load",function(){
    $("#atualizaCadastroCoop").modal("show"); });
</script>'; 
            }
        }
        }
        ?>



    </body>
</html>
