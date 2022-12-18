<?php 
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_POST['nome'] , $_POST['fcooperativa'])) {
    $nome = $_POST['nome'];
    $fcooperativa = $_POST['fcooperativa'];
    $sql_buscaUsuarios = mysqli_query($conexao, "SELECT * FROM usuarios INNER JOIN cooperativas ON user_coop = cod_coop WHERE nome LIKE '%$nome%' and cod_coop LIKE '%$fcooperativa%'");
    $numeroLinhas = mysqli_num_rows($sql_buscaUsuarios);
} else{

    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 

    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT id_usuario FROM usuarios WHERE u_status != '0'");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina =12;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);
    
    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaUsuarios = mysqli_query($conexao, "SELECT id_usuario, nome, sobrenome, email, cooperativa FROM usuarios INNER JOIN cooperativas ON user_coop = cod_coop WHERE u_status != '0' ORDER BY nome LIMIT $inicio, $itens_por_pagina ");
    $numeroLinhas = mysqli_num_rows($sql_buscaUsuarios);
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
                            <h5 class="titulo">Modelos de Documentos</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i>Voltar</a>
                                    <a class="btn btn-sm btn-primary" href="#filtro" data-toggle="modal" data-target="#filtro">Filtrar <i class="uil uil-filter"></i></a>
                                </div>
                            </div>
                        </div>

                       
                       <div class="row">
                           <?php 
                           $buscaCategoriasDocumentos = mysqli_query($conexao, "SELECT cod_categoria, categoria, COUNT(categoria_documento) AS qtd_arquivos FROM categoria_documentos INNER JOIN modelos_de_documentos ON cod_categoria = categoria_documento GROUP BY categoria_documento");
                           
                           if(mysqli_num_rows($buscaCategoriasDocumentos) > 0 ){
                               while($categorias = mysqli_fetch_assoc($buscaCategoriasDocumentos)){
                                   
                           ?>
                           <div class="col-lg-6 col-md-6 col-12">
                               <a href="docs_visualizacao.php?id=<?php echo $categorias["cod_categoria"]; ?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title titulo-acesso-rapido"><?php echo $categorias["categoria"];?></h5>
      <h6 class="card-text texto-acessorapido"><?php echo $categorias["qtd_arquivos"];?> DOCUMENTOS</h6>
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
          <form action="" method="POST">
              <div class="form-group col-md-12">
               <label for="fnome">Nome</label>
                                <input type="text" name="nome" id="fnome" class="form-control digitacao" placeholder="Insira um nome" autocomplete="off">
              </div>
                                <div class="form-group col-md-12">
                                                            <label for="fcooperativa">Cooperativa</label><br>
                                                            <select id="fcooperativa" name="fcooperativa" class="digitacao pesquisa-select">
                                                                <option value="">Selecione</option>
                                                                   <?php 
                                                                   $buscaCoop = mysqli_query($conexao, "SELECT * FROM cooperativas");
                                                                   while($resultadoCoop = mysqli_fetch_assoc($buscaCoop)){
                                                                      ?>
                                                                    <option value="<?php echo $resultadoCoop['cod_coop']?>"><?php echo $resultadoCoop['cooperativa']?></option>
                                                                    <?php
                                                                   }
                                                                   ?>                                                                </select>
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
    </body>
</html>
