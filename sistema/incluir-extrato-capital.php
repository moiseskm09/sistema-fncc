<?php 
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';


if(isset($_GET['cooperativaExtF'], $_GET["acumuladoAte"])){
    $cooperativaExtF = $_GET['cooperativaExtF'];
    $acumuladoAte = $_GET['acumuladoAte'];
    $sql_buscaExts = mysqli_query($conexao, "SELECT * FROM extrato_de_capital INNER JOIN cooperativas ON  ext_coop = cod_coop WHERE ext_acumulado like '%$acumuladoAte%' and ext_coop like '%$cooperativaExtF%'");
    $sql_buscaObs = mysqli_query($conexao, "SELECT * FROM extrato_de_capital INNER JOIN cooperativas ON  ext_coop = cod_coop WHERE ext_acumulado like '%$acumuladoAte%' and ext_coop like '%$cooperativaExtF%'");
    $numeroLinhas = mysqli_num_rows($sql_buscaExts);
    $filtroON = 1;   
}else{
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 
    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT * FROM extrato_de_capital");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina =10;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);
    
    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaExts = mysqli_query($conexao, "SELECT cod_ext_capital, ext_acumulado, ext_remuneracao_juros, ext_obs, ext_coop, ext_arquivo, cooperativa FROM extrato_de_capital INNER JOIN cooperativas ON  ext_coop = cod_coop LIMIT $inicio, $itens_por_pagina ");
    $sql_buscaObs = mysqli_query($conexao, "SELECT cod_ext_capital, ext_acumulado, ext_remuneracao_juros, ext_obs, ext_coop, ext_arquivo, cooperativa FROM extrato_de_capital INNER JOIN cooperativas ON  ext_coop = cod_coop");
    $numeroLinhas = mysqli_num_rows($sql_buscaExts);
    $filtroON = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Inclusão Extrato de Capital</title>
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
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Financeiro</span>
                      <span class="breadcrumb-item active text-success">Inclusão de Extrato de Capital</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-success mb-1" href="#addDocumento" data-toggle="modal" data-target="#addDocumento"><i class="uil uil-plus"></i> Adicionar Extrato</a>
                                    <?php if($filtroON === 1){ ?>
                                    <a class="btn btn-sm btn-dark mb-1" href="incluir-extrato-capital.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                        <th>Acumulado Até</th>
                                        <th class="text-center">Remuneração de Juros ao Capital</th>
                                        <th>Cooperativa</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="p-0 bg-white">
                                    <?php
                                    if ($numeroLinhas > 0) {
                                        while ($resultadoExts = mysqli_fetch_assoc($sql_buscaExts)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;"><?php echo strftime('%d/%m/%Y', strtotime($resultadoExts['ext_acumulado']));?></td>
                                                <td style="font-size:15px; text-align: center;"><?php echo $resultadoExts['ext_remuneracao_juros']; ?></td>
                                                
                                                <td style="font-size:15px;"><?php echo $resultadoExts['cooperativa'];?></td>
                                                <td class="text-center">
                                                    <?php
                                            if($resultadoExts['ext_obs'] != null){
                                              ?>
                                                <a title="Visualizar Obs" href="#obsExtrato<?php echo $resultadoExts['cod_ext_capital'];?>" data-toggle="modal" data-target="#obsExtrato<?php echo $resultadoExts['cod_ext_capital'];?>"><i class="bi bi-eye text-white btn-sm btn-primary"></i></a>
                                            <?php }?>
                                                <a title="Fazer Download" href="../ferramentas/download-extrato.php?cod_coop=<?php echo $resultadoExts['ext_coop']; ?>&nome_ext=<?php echo $resultadoExts['ext_arquivo']; ?>" data-confirm="Tem certeza de que deseja o item selecionado?"><i class="uil uil-import text-dark btn-sm btn-info"></i></a>
                                                <a title="Deletar Extrato" href="../ferramentas/deleta-extrato.php?cod_coop=<?php echo $resultadoExts['ext_coop']; ?>&nome_ext=<?php echo $resultadoExts['ext_arquivo']; ?>&cod_ext_capital=<?php echo $resultadoExts['cod_ext_capital']; ?>" desativar-confirm="Tem certeza de que deseja o item selecionado?"><i class="bi bi-trash text-white btn-sm btn-danger"></i></a>
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
                                        <td colspan="2"><?php echo "Mostrando ".$numeroLinhas; ?> de <?php echo $numeroTotalLinhas; ?> registros</td>
                                        <td colspan="2">
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
                <div class="col-lg-6 col-md-6 col-12">
                          <div class="form-floating mb-3">
                            <input type="date" name="acumuladoAte" id="acumuladoAte" class="form-control" placeholder="Insira a data" autocomplete="off">
                            <label for="acumuladoAte">Acumulado Até</label>
                          </div>  
                        </div>
                <div class="col-lg-6 col-md-6 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="cooperativaExtF" name="cooperativaExtF">
          <option value="">Selecione</option>
        <?php
        $buscaCooperativas = mysqli_query($conexao, "SELECT cod_coop, cooperativa FROM cooperativas");
        while ($resultadoCooperativas = mysqli_fetch_assoc($buscaCooperativas)) {
            ?>
            <option value="<?php echo $resultadoCooperativas['cod_coop'] ?>"><?php echo $resultadoCooperativas['cooperativa'] ?></option>
            <?php
        }
        ?> 
      </select>
        <label for="cooperativaExtCN">Cooperativa <span class="text-danger">*</span></label>
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
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Extrato de Capital</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          <form action="../ferramentas/inclui-extrato-capital.php" method="POST" enctype="multipart/form-data">
            <div class="row">
       <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="cooperativaExtCN" name="cooperativaExtCN" required>
          <option value="">Selecione</option>
        <?php
        $buscaCooperativas = mysqli_query($conexao, "SELECT cod_coop, cooperativa FROM cooperativas");
        while ($resultadoCooperativas = mysqli_fetch_assoc($buscaCooperativas)) {
            ?>
            <option value="<?php echo $resultadoCooperativas['cod_coop'] ?>"><?php echo $resultadoCooperativas['cooperativa'] ?></option>
            <?php
        }
        ?> 
      </select>
        <label for="cooperativaExtCN">Cooperativa <span class="text-danger">*</span></label>
    </div>
  </div>
                <div class="col-lg-6 col-md-6 col-12">
                          <div class="form-floating mb-3">
                              <input type="date" name="acumuladoExtCN" id="acumuladoExtCN" class="form-control" placeholder="Insira a data do acumulado" autocomplete="off" required>
                            <label for="acumuladoExtCN">Acumulado até <span class="text-danger">*</span></label>
                          </div>  
                        </div>
                
                <div class="col-lg-6 col-md-6 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="jurosCapitalExtCN" id="jurosCapitalExtCN" class="form-control percent" placeholder="Insira o título do documento" autocomplete="off" required>
                            <label for="jurosCapitalExtCN">Juros ao Capital <span class="text-danger">*</span></label>
                          </div>  
                        </div>
                <div class="col-lg-12 col-md-21 col-12">
                  <div class="form-floating mb-3">
                      <textarea class="form-control" name="obsExtCN" id="obsExtCN" placeholder="Adicione uma observação se necessário" style="height: 100px" maxlength="1000" required></textarea>
  <label for="obsExtCN">Observação</label>
</div>  
                </div>
              
              <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group files">
                  <input type="file" class="form-control" name="arquivoExtCN" id="arquivoExtCN" required>
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


<!-- modal obs -->
<?php
if ($numeroLinhas > 0) {
while ($resultadoObs = mysqli_fetch_assoc($sql_buscaObs)) {
if($resultadoObs['ext_obs'] != null){
                                              ?>
                                            <!-- Modal obs-->
<div class="modal fade" id="obsExtrato<?php echo $resultadoObs['cod_ext_capital'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header header-filtro">
        <h5 class="modal-title" id="exampleModalLabel">Observações do Extrato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
            <div class="row">
                <div class="col-12">
                    <?php echo $resultadoObs['ext_obs'];?>
                </div>
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php 
}else{
    //echo "nada a ser feito";
}
}
}else{
    //echo "nada a ser feito 2";
}
?>
                                                                               
<!-- fim modal obs -->

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
                    <span>Não foi possível deletar! Tente Novamente!</span>
                </div>
            </div>
        </div>'; 
                }elseif($erro === 2){
                   echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível incluir o extrato! Tente Novamente!</span>
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
                    <span>Extrato deletado!</span>
                </div>
            </div>
        </div>';
                            }elseif($sucesso === 2) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Extrato de Capital Incluído!</span>
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
<script src="../js/boletos.js"></script>
<script src="../js/confirmacao_pag.js"></script>
<script src="../js/desativar.js"></script>
<script>
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".menu-ativo").removeClass("menu-ativo");
   $(this).addClass("menu-ativo");
});
</script>
    </body>
</html>
