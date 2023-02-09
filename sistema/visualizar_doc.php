<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['titulo_cat'])) {
    $titulo_cat = $_GET['titulo_cat'];
    $sql_buscaCat = mysqli_query($conexao, "SELECT cod_categoria, categoria, COUNT(categoria_documento) AS qtd_arquivos FROM categoria_documentos INNER JOIN modelos_de_documentos ON cod_categoria = categoria_documento WHERE categoria LIKE '%$titulo_cat%' GROUP BY categoria_documento");
    $numeroLinhas = mysqli_num_rows($sql_buscaCat);
    $filtroON = 1;
} else {

    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT cod_categoria, categoria, COUNT(categoria_documento) AS qtd_arquivos FROM categoria_documentos INNER JOIN modelos_de_documentos ON cod_categoria = categoria_documento GROUP BY categoria_documento");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina = 12;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);

    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaCat = mysqli_query($conexao, "SELECT cod_categoria, categoria, COUNT(categoria_documento) AS qtd_arquivos FROM categoria_documentos INNER JOIN modelos_de_documentos ON cod_categoria = categoria_documento GROUP BY categoria_documento ORDER BY categoria LIMIT $inicio, $itens_por_pagina ");
    $numeroLinhas = mysqli_num_rows($sql_buscaCat);
    $filtroON = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Categoria de Documentos</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
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
                            <h5 class="titulo">Modelos de Documentos</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <?php if ($filtroON === 1) { ?>
                                        <a class="btn btn-sm btn-dark" href="visualizar_doc.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <?php
                            //$buscaCategoriasDocumentos = mysqli_query($conexao, "SELECT cod_categoria, categoria, COUNT(categoria_documento) AS qtd_arquivos FROM categoria_documentos INNER JOIN modelos_de_documentos ON cod_categoria = categoria_documento GROUP BY categoria_documento");

                            if (mysqli_num_rows($sql_buscaCat) > 0) {
                                while ($categorias = mysqli_fetch_assoc($sql_buscaCat)) {
                                    ?>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <a href="docs_visualizacao.php?id=<?php echo $categorias["cod_categoria"]; ?>" class="link-acesso">
                                            <div class="card border-0 acesso-rapido mb-1 mt-1">
                                                <div class="card-body  p-1">
                                                    <h5 class="card-title titulo-acesso-rapido"><?php echo $categorias["categoria"]; ?></h5>
                                                    <h6 class="card-text texto-acessorapido"><span class="badge rounded-pill text-bg-light"><?php echo $categorias["qtd_arquivos"]; ?> DOCUMENTOS</span></span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="filtro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header header-filtro">
                                        <h5 class="modal-title" id="exampleModalLabel">Filtrar dados</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="" method="GET">
                                          <div class="row">
                                              <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="titulo_cat" id="titulo_cat" class="form-control" placeholder="Título da Categoria" autocomplete="off" required>
                            <label for="titulo_cat">Título da Categoria</label>
                          </div>  
                        </div>
                                          </div>
                                    </div>
                                    <div class="modal-footer card-fundo-body p-1">
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar <i class="uil uil-times"></i></button>
                                        <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-filter"></i> Filtrar</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
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
