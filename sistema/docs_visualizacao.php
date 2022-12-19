<?php 
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';


if($_GET['id']){
    $categoria_documento = $_GET['id'];
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 
    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT * FROM modelos_de_documentos INNER JOIN categoria_documentos ON categoria_documento = cod_categoria WHERE categoria_documento = '$categoria_documento' ");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina =12;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);
    
    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaDocs = mysqli_query($conexao, "SELECT * FROM modelos_de_documentos INNER JOIN categoria_documentos ON categoria_documento = cod_categoria WHERE categoria_documento = '$categoria_documento'  LIMIT $inicio, $itens_por_pagina ");
    $numeroLinhas = mysqli_num_rows($sql_buscaDocs);
    
}else if(isset($_GET['titulo_doc'] , $_GET['cod_categoria_doc'])) {
    $titulo_doc = $_POST['titulo_doc'];
    $categoria_documento = $_POST['cod_categoria_doc'];
    $sql_buscaDocs = mysqli_query($conexao, "SELECT * FROM modelos_de_documentos INNER JOIN categoria_documentos ON categoria_documento = cod_categoria WHERE titulo_documento LIKE '%$titulo_doc%' and categoria_documento = '$categoria_documento'");
    $numeroLinhas = mysqli_num_rows($sql_buscaDocs);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
       <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
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
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h5 class="titulo">Documentos</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i>Voltar</a>
                                    <a class="btn btn-sm btn-primary" href="#filtro" data-toggle="modal" data-target="#filtro">Filtrar <i class="uil uil-filter"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-sm" style= "white-space: nowrap;">
                                <thead class="border thead-tabela">
                                    <tr>
                                        <th>Código</th>
                                        <th>Título</th>
                                        <th>Categoria</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
                                    <?php
                                    if ($numeroLinhas > 0) {
                                        while ($resultadoDoc = mysqli_fetch_assoc($sql_buscaDocs)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td><?php echo $resultadoDoc['cod_documento']; ?></td>
                                                <td><?php echo ucwords(strtolower($resultadoDoc['titulo_documento']));?></td>
                                                <td><?php echo $resultadoDoc['categoria'];?></td>
                                                <td class="text-center">
                                                <a title="Fazer Download" href="../ferramentas/download_documento.php?cod_categoria=<?php echo $resultadoDoc['categoria_documento']; ?>&nome_doc=<?php echo $resultadoDoc['nome_documento']; ?>" data-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="uil uil-import text-info"></i></i></a>
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
                                <tfoot>
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
              <div class="form-group col-md-12">
               <label for="titulo_doc">Título do Documento</label>
                                <input type="text" name="titulo_doc" id="titulo_doc" class="form-control digitacao" placeholder="Insira o título do documento" autocomplete="off">
                                <input type="hidden" name="cod_categoria_doc" id="cod_categoria_doc" class="form-control digitacao" value="<?php echo $categoria_documento;?>">
              </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar <i class="uil uil-times"></i></button>
        <button type="submit" class="btn btn-success loading btn-sm">Filtrar <i class="uil uil-filter"></i></button>
        
        </form>
      </div>
    </div>
  </div>
</div>

                       <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php";?>
            </div>
            
            <?php
                            $sucesso = (int) $_GET["sucesso"];
                            if ($sucesso === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span> Usuário criado com sucesso!</span>
                </div>
            </div>
        </div>';
                            }else if($sucesso === 2){
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #fff3cd; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #fff3cd; color: #1c1d3c;"">
                    <span> Usuário desativado com sucesso!</span>
                </div>
            </div>
        </div>';
                            }
                            ?>
        </div>
        <script>
$( '.pesquisa-select' ).select2( {
    theme: 'bootstrap-5'
} );
        </script>  
        <script>
            window.onload = (event) => {
                var toastLiveExample = document.getElementById('liveToast')
                var toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            }
        </script>
        <script src="../js/campos_adicionais.js"></script>
        <script src="../js/cp_mascaras.js"></script>
        <script src="../js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> 
<script src="../js/termodeciencia.js"></script>
    </body>
</html>
