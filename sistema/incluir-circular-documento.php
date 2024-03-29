<?php 
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';


if($_GET['titulo_doc']){
     $titulo_doc = $_GET['titulo_doc'];
    $sql_buscaDocs = mysqli_query($conexao, "SELECT * FROM documentos_circulares INNER JOIN categoria_circulares ON docc_categoria = cod_categoria WHERE docc_titulo LIKE '%$titulo_doc%'");
    $numeroLinhas = mysqli_num_rows($sql_buscaDocs);
    $filtroON = 1;
       
}else{
   $categoria_documento = $_GET['id'];
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 
    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT * FROM documentos_circulares INNER JOIN categoria_circulares ON docc_categoria = cod_categoria");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina =10;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);
    
    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaDocs = mysqli_query($conexao, "SELECT * FROM documentos_circulares INNER JOIN categoria_circulares ON docc_categoria = cod_categoria LIMIT $inicio, $itens_por_pagina ");
    $numeroLinhas = mysqli_num_rows($sql_buscaDocs);
    $filtroON = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Inclusão Circular e Documentos</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="manifest" href="../manifest.json">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
       <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

        <script src="../js/mask.js"></script>
        <script src="../js/busca-cep.js"></script>
        <script src="../js/loading.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <style>
            </style>
    </head>
    <body class="sb-nav-fixed fundo_tela">
       <?php include_once "../ferramentas/navbar.php";?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                       <!--conteudo da tela aqui!-->
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Circular</span>
                      <span class="breadcrumb-item active text-success">Inclusão de Circular e Documentos</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-3">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-success mb-1" href="#addDocumento" data-toggle="modal" data-target="#addDocumento"><i class="uil uil-plus"></i> Adicionar Circular</a>
                                   <div class="btn-group dropstart mb-1">
  <button class="btn btn-sm btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
    Mais opções
  </button>
                                       <div class="dropdown-menu p-0" style="font-size: 13px;">
    <a class="dropdown-item" href="#addCategoria" data-toggle="modal" data-target="#addCategoria"><i class="uil uil-plus"></i> Adicionar Categoria</a>
    <a class="dropdown-item" href="#addSubCategoria" data-toggle="modal" data-target="#addSubCategoria"><i class="uil uil-plus"></i> Adicionar SubCategoria</a>
  </div>
</div>
                                    <?php if($filtroON === 1){ ?>
                                    <a class="btn btn-sm btn-dark mb-1" href="incluir-circular-documento.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                        <th>Código</th>
                                        <th>Título</th>
                                        <th>Categoria</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="p-0 bg-white">
                                    <?php
                                    if ($numeroLinhas > 0) {
                                        while ($resultadoDoc = mysqli_fetch_assoc($sql_buscaDocs)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td><span class="badge badge-info rounded-pill d-inline"><?php echo $resultadoDoc['cod_docc']; ?></span></td>
                                                <td style="font-size:15px;"><?php echo ucwords(strtolower($resultadoDoc['docc_titulo']));?></td>
                                                <td style="font-size:15px;"><?php echo $resultadoDoc['categoria'];?></td>
                                                <td class="text-center">
                                                <a title="Apagar Documento" href="../ferramentas/deleta-circular.php?cod_categoria=<?php echo $resultadoDoc['docc_categoria']; ?>&cod_subcategoria=<?php echo $resultadoDoc['docc_subcategoria']; ?>&cod_doc=<?php echo $resultadoDoc['cod_docc']; ?>&nome_doc=<?php echo $resultadoDoc['docc_arquivo']; ?>" desativar-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="bi bi-trash text-white btn-sm btn-danger"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr class="linha-hover">
                                            <td colspan="4" class="text-center">Não há itens para exibir</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="p-0">
                                    <tr>
                                        <td colspan="3"><?php echo "Mostrando ".$numeroLinhas; ?> de <?php echo $numeroTotalLinhas; ?> registros</td>
                                        <td colspan="4">
                                            <nav>
                                    <ul class="pagination pagination-sm justify-content-end">
                                        <li class="page-item ">
                                            <a class="page-link" href="<?php echo "?id=".$categoria_documento?>&pagina=1" tabindex="-1"><span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Primeira</span></a>
                                        </li>
<?php
for ($i = 1; $i < $numero_paginas + 1; $i++) {
    $estilo = "";
    if ($pagina == $i) {
        $estilo = 'active';
    }
    ?>
                                            <li class="page-item <?php echo $estilo; ?>"><a class="page-link" href="<?php echo "?id=".$categoria_documento?>&pagina=<?php echo $i;?>"><?php echo $i;?></a></li>
                                        <?php }
                                        ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo "?id=".$categoria_documento?>&pagina=<?php echo $numero_paginas?>"><span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Última</span></a>
                                        </li>
                                    </ul>
                                </nav>
                                        </td>
                                    </tr>
                                </tfoot>
                                
                            </table>
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
              <input type="hidden" name="cod_categoria_doc" id="cod_categoria_doc" class="form-control digitacao" value="<?php echo $categoria_documento;?>">
                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="titulo_doc" id="titulo_doc" class="form-control focoInput" placeholder="Insira o título do documento" autocomplete="off" required>
                            <label for="nome">Título do Documento</label>
                          </div>  
                        </div>
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
          <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-filter"></i> Filtrar</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- fim modal filtro -->



<!-- Modal documento-->
<div class="modal fade" id="addDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header header-filtro">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Circular e Documentos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          <form action="../ferramentas/inclui-circular.php" method="POST" enctype="multipart/form-data">
            <div class="row">
       <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select carregaSubcat" id="categoriaCircularN" name="categoriaCircularN" required>
        <option value="">Selecione</option>
        <?php
        $buscaCategorias = mysqli_query($conexao, "SELECT * FROM categoria_circulares");
        while ($resultadoCategorias = mysqli_fetch_assoc($buscaCategorias)) {
            ?>
            <option value="<?php echo $resultadoCategorias['cod_categoria'] ?>"><?php echo $resultadoCategorias['categoria'] ?></option>
            <?php
        }
        ?> 
      </select>
      <label for="categoriaCircularN">Categoria Circular</label>
    </div>
  </div>
                <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select recebeSubcat" id="subcategoriaCircularN" name="subcategoriaCircularN" required>
        <option value="">Selecione</option>
      </select>
      <label for="id_sub_categoria">SubCategoria Circular</label>
    </div>
  </div>
                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="tituloCircularN" id="tituloCircularN" class="form-control" placeholder="Insira o título do documento" autocomplete="off" required>
                            <label for="tituloCircularN">Título do Documento</label>
                          </div>  
                        </div>
              
              <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group files">
                  <input type="file" class="form-control" name="arquivoCircularN" id="arquivoN" required>
                </div>
              </div>
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
          <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-plus"></i> Adicionar</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- fim modal documento -->

<!-- Modal categoria-->
<div class="modal fade" id="addCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header header-filtro">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          <form action="../ferramentas/adiciona-categoria-circular.php" method="POST" id="formmodal">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="nomeCategoriaN" id="nomeCategoriaN" class="form-control" placeholder="Insira um nome para Categoria" autocomplete="off" required>
                            <label for="nomeCategoriaN">Nome da Categoria</label>
                          </div>  
                        </div>
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
        <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-plus"></i> Adicionar</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- fim modal categoria -->

<!-- Modal subcategoria-->
<div class="modal fade" id="addSubCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header header-filtro">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar SubCategoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          <form action="../ferramentas/adiciona-subcategoria-circular.php" method="POST" id="formmodal">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select carregaSubcat" name="categoriaCircularN" required>
        <option value="">Selecione</option>
        <?php
        $buscaCategorias = mysqli_query($conexao, "SELECT * FROM categoria_circulares");
        while ($resultadoCategorias = mysqli_fetch_assoc($buscaCategorias)) {
            ?>
            <option value="<?php echo $resultadoCategorias['cod_categoria'] ?>"><?php echo $resultadoCategorias['categoria'] ?></option>
            <?php
        }
        ?> 
      </select>
      <label for="categoriaCircularN">Categoria Circular</label>
    </div>
  </div>
                
                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="nomeSubCategoriaN" id="nomeSubCategoriaN" class="form-control" placeholder="Insira um nome para Categoria" autocomplete="off" required>
                            <label for="nomeSubCategoriaN">Nome da SubCategoria</label>
                          </div>  
                        </div>
                
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
          <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-plus"></i> Adicionar</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- fim modal subcategoria -->
<?php include_once "../ferramentas/modal_loading.php";?>
                       <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php";?>
            </div>
            
            <?php
            if(isset($_GET["erro"])){
                $erro = (int) $_GET["erro"];
                if($erro === 1){
                   echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível Adicionar! Tente Novamente!</span>
                </div>
            </div>
        </div>'; 
                }
            }
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
                    <span>Documento Adicionado!</span>
                </div>
            </div>
        </div>';
                            }
                            else if($sucesso === 2){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #fff3cd; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #fff3cd; color: #1c1d3c;">
                    <span>Documento Excluído!</span>
                </div>
            </div>
        </div>';
                            } else if($sucesso === 3){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <span>Categoria Adicionada!</span>
                </div>
            </div>
        </div>';
                            }
                            ?>
        </div>
        <script>
$( '.pesquisa-select' ).select2( {
    theme: 'bootstrap-5';
} );
        </script>  
<script src="../js/toast.js"></script>
        <script src="../js/campos_adicionais.js"></script>
        <script src="../js/cp_mascaras.js"></script>
        <script src="../js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> 
<script src="../js/desativar.js"></script>
<script>
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".menu-ativo").removeClass("menu-ativo");
   $(this).addClass("menu-ativo");
});
</script>
<script>
    $('#filtro').on('shown.bs.modal', function () {
    $('.focoInput').focus();
});  
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
		$(function(){
			$('.carregaSubcat').change(function(){
				if( $(this).val() ) {
					$('.recebeSubcat').hide();
					$('.carregando').show();
					$.getJSON('../ferramentas/buscaSubcategoriaCircular.php?search=',{id_categoria: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolha a Subcategoria</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome_sub_categoria + '</option>';
						}	
						$('.recebeSubcat').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('.recebeSubcat').html('<option value="">Escolha Subcategoria</option>');
				}
			});
		});
		</script>
                
    </body>
</html>
