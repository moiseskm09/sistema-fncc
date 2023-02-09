<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
//require_once '../config/config_geral.php';

if (isset($_GET['id'])) {
    $cat_id = $_GET['id'];
    $sql_buscaSubCat = mysqli_query($conexao, "SELECT cod_subcategoria, subcategoria, COUNT(cod_docc) AS qtd_arquivos FROM subcategoria_circulares LEFT JOIN documentos_circulares ON cod_subcategoria = docc_subcategoria WHERE id_categoria = '$cat_id' GROUP BY subcategoria ORDER BY subcategoria");
} else {
header("location: ../sistema/circulares-documentos.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Subcategoria Circulares e Documentos</title>
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="../js/mask.js"></script>
        <script src="../js/busca-cep.js"></script>
        <script src="../js/loading.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/visualizar_doc.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Circular</span>
                      <span class="breadcrumb-item text-primary">Categoria Circular</span>
                      <span class="breadcrumb-item active text-success">Subcategoria Circulares e Documentos</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a> 
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <?php
                            //$buscaCategoriasDocumentos = mysqli_query($conexao, "SELECT cod_categoria, categoria, COUNT(categoria_documento) AS qtd_arquivos FROM categoria_documentos INNER JOIN modelos_de_documentos ON cod_categoria = categoria_documento GROUP BY categoria_documento");

                            if (mysqli_num_rows($sql_buscaSubCat) > 0) {
                                while ($subcategorias = mysqli_fetch_assoc($sql_buscaSubCat)) {
                                    ?>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <a href="visualiza_circulares.php?id=<?php echo $subcategorias["cod_subcategoria"]; ?>" class="link-acesso">
                                            <div class="card border-0 mb-1 mt-1 acesso-rapido">
                                                <div class="card-body p-1">
                                                    <h5 class="card-title titulo-acesso-rapido"><?php echo $subcategorias["subcategoria"]; ?></h5>
                                                    <h6 class="card-text texto-acessorapido"><span class="badge rounded-pill text-bg-light"><?php echo $subcategorias["qtd_arquivos"]; ?> DOCUMENTOS</span></span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <?php
                                }
                            }else{
                                echo '<div class="col-12"><p class="text-center alert alert-warning">Não há dados para exibir!</p></div>';
                            }
                            ?>
                        </div>


                        <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php"; ?>
            </div>


        </div>
        <script>
            $('.pesquisa-select').select2({
                theme: 'bootstrap-5'
            });
        </script>  
        <script src="../js/toast.js"></script>
        <script src="../js/campos_adicionais.js"></script>
        <script src="../js/cp_mascaras.js"></script>
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
