<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if(isset($_GET["id"])){
    $idNoticia = $_GET["id"];
    $buscaNoticia = mysqli_query($conexao, "SELECT * FROM site_noticias WHERE cod_noticia = '$idNoticia' LIMIT 1");
    if(mysqli_num_rows($buscaNoticia) > 0 ){
        $resultadoNoticia = mysqli_fetch_assoc($buscaNoticia);
    }else{
       header("location: ../sistema/noticias.php"); 
    }
}else{
    header("location: ../sistema/noticias.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Editar Notícia</title>
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
<script src="https://cdn.tiny.cloud/1/4b5xku1ak2vskqvjmlw1biztatmbuzqx29vn314f904u0ktu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
                            <div class="breadcrumb mb-1 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                                <span class="breadcrumb-item text-primary">Notícias</span>
                                <span class="breadcrumb-item active text-success">Editar Notícia</span>
                            </div>
                            <div class="btn-toolbar mb-1 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" href="noticias.php"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <?php if($resultadoNoticia["publicado"] == "1"){ ?>
                                    <a class="btn btn-sm btn-danger mb-1" href="../ferramentas/publicar-noticia.php?cod_noticia=<?php echo $resultadoNoticia["cod_noticia"]; ?>&publicar=0"><i class="bi bi-stickies"></i> Despublicar</a>
                                    <?php }else{ ?>
                                    <a class="btn btn-sm btn-success mb-1" href="../ferramentas/publicar-noticia.php?cod_noticia=<?php echo $resultadoNoticia["cod_noticia"];?>&publicar=1"><i class="bi bi-stickies"></i> Publicar</a>
                                    <?php } ?>
                                    
                                    <a class="btn btn-sm btn-primary mb-1" href="visualizar-noticia.php?cod_noticia=<?php echo $resultadoNoticia["cod_noticia"];?>" target="blank"><i class="bi bi-eye"></i> Visualizar</a>
                                </div>
                            </div>

                        </div>
                        <form action="../ferramentas/editar-noticia.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="accordion" id="DadosNoticia">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <span class="destaque fw-bold">Dados Principais</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#DadosNoticia">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                    <div class="form-floating mb-2">
                                                        <input type="hidden" value="<?php echo $resultadoNoticia["cod_noticia"];?>" name="codNoticia">
                                                        <input type="text" value="<?php echo $resultadoNoticia["titulo_noticia"];?>" name="tituloNoticia" id="tituloNoticia" class="form-control" placeholder="Título da Notícia" autocomplete="off" maxlength="100" required>
                                                        <label for="tituloNoticia">Título da Notícia <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-2">
                                                        <input type="text" value="<?php echo $resultadoNoticia["subtitulo_noticia"];?>" name="subtituloNoticia" id="subtituloNoticia" class="form-control" placeholder="Subtítulo da Notícia" autocomplete="off" maxlength="100" required>
                                                        <label for="subtituloNoticia">Subtítulo da Notícia <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                                                <div class="col-12 mb-2">
                                                                  <div class="form-floating">
                                                                      <textarea class="form-control" name="textoNoticia" placeholder="Texto da Notícia" id="textoNoticia">
                                                                        <?php echo $resultadoNoticia["texto_noticia"];?>
                                                                      </textarea>
  <label for="textoNoticia"></label>
</div>
                                                                 
                                                                </div>
                                                              <div class="col-12 text-end">
                          <button type="submit" class="btn btn-md btn-success loading"><i class="bi bi-arrow-clockwise"></i> Atualizar Notícia</button>
                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                                            <span class="destaque fw-bold">Categoria Notícia</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapsetwo" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="categoriaNoticia" name="categoriaNoticia" required>
                      <option value="<?php echo $resultadoNoticia["categoria_noticia"];?>" selected><?php echo $resultadoNoticia["categoria_noticia"];?></option>
                      <?php if($resultadoNoticia["categoria_noticia"] == "Express"){ ?>
                        <option value="News">News</option>
                      <?php }else{ ?>
                        <option value="Express" >Express</option>
                      <?php } ?>
      </select>
      <label for="categoriaNoticia">Categoria da Notícia <span class="text-danger">*</span></label>
    </div>
                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetree" aria-expanded="true" aria-controls="collapsetree">
                                                            <span class="destaque fw-bold">Imagem Notícia</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapsetree" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-12">
                                                                    <?php if($resultadoNoticia["img_noticia"] == ""){ ?>
                <div class="form-group imgNoticia">
                  <input type="file" class="form-control" name="imgNoticia" id="imgNoticia" required>
                </div>
                                                                    <?php }else{ ?>
                                                                    <img src="../../site-fncc/assets/imagens/imagens_noticias/<?php echo $resultadoNoticia["img_noticia"];?>" width="100%" height="100%" alt="imagem noticia" style="border-radius: 50px 50px 50px 0px;">
                                                                  <?php  } ?>
              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetree" aria-expanded="true" aria-controls="collapsetree">
                                                            <span class="destaque fw-bold">Link Notícia</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapsetree" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-12">
   <div class="form-floating mb-2">
                                                        <input type="text" value="<?php echo "https://bemktech.com.br/site-fncc/noticias/news-express/".$resultadoNoticia["slug_noticia"];?>" class="form-control" placeholder="Título da Notícia" readonly>
                                                        <label for="tituloNoticia">Link Notícia <span class="text-danger">*</span></label>
                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <?php
                        if (isset($_GET["sucesso"])) {
                            $sucesso = (int) $_GET["sucesso"];
                            if($sucesso === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Notícia Criada!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 2) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Notícia Pulicada!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 3) {
                               echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #fff3cd; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #fff3cd; color: #1c1d3c;"">
                    <span> Notícia Despublicada!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 4) {
                              echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Notícia Editada!</span>
                </div>
            </div>
        </div>';
                            }
                        }
                        
                        if (isset($_GET["erro"])) {
                $erro = (int) $_GET["erro"];
                if ($erro === 2) {
                    echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível editar! Tente Novamente!</span>
                </div>
            </div>
        </div>';
            }
                        }
                        ?>
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
    tinymce.init({
      selector: 'textarea',
      menubar: false,
      statusbar: false,
      height: 230,
      plugins: '',
      toolbar: false
      
    });
  </script>
    </body>
</html>
