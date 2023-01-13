<?php 
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';


if(isset($_GET['data_vencimento'], $_GET["competencia"], $_GET["situacaoBol"])){
    $data_vencimento = $_GET['data_vencimento'];
    $competencia = $_GET['competencia'];
    $situacaoBol = $_GET['situacaoBol'];
    $sql_buscaBols = mysqli_query($conexao, "SELECT * FROM boletos INNER JOIN boleto_situacao ON bol_situacao = cod_bol_s INNER JOIN cooperativas ON  bol_coop = cod_coop WHERE bol_vencimento like '%$data_vencimento%' and bol_competencia like '%$competencia%' and bol_situacao like '%$situacaoBol%'");
    $numeroLinhas = mysqli_num_rows($sql_buscaBols);
    $filtroON = 1;   
}else{
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 
    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT * FROM boletos");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina =12;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);
    
    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaBols = mysqli_query($conexao, "SELECT * FROM boletos INNER JOIN boleto_situacao ON bol_situacao = cod_bol_s  INNER JOIN cooperativas ON  bol_coop = cod_coop ORDER BY bol_situacao DESC, bol_vencimento ASC LIMIT $inicio, $itens_por_pagina ");
    $numeroLinhas = mysqli_num_rows($sql_buscaBols);
    $filtroON = 0;
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
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
                            <h5 class="titulo">Inclusão de Boletos</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-success mb-1" href="#addDocumento" data-toggle="modal" data-target="#addDocumento"><i class="uil uil-plus"></i> Adicionar Boleto</a>
                                    <?php if($filtroON === 1){ ?>
                                    <a class="btn btn-sm btn-dark mb-1" href="incluir-boleto.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-sm" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                        <th>Mês Competência</th>
                                        <th>Vencimento</th>
                                        <th>Cooperativa</th>
                                        <th>Situação</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
                                    <?php
                                    if ($numeroLinhas > 0) {
                                        while ($resultadoBol = mysqli_fetch_assoc($sql_buscaBols)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;"><?php echo $resultadoBol['bol_competencia']; ?></td>
                                                <td style="font-size:15px;"><?php echo strftime('%d/%m/%Y', strtotime($resultadoBol['bol_vencimento']));?></td>
                                                <td style="font-size:15px;"><?php echo $resultadoBol['cooperativa'];?></td>
                                                <td style="font-size:15px;"> <?php 
                                                  if($resultadoBol['situacao'] == "CONFIRMANDO PAGAMENTO"){
                                                      echo '<span class="badge badge-success rounded-pill d-inline">'.$resultadoBol['situacao'].'</span>';
                                                  }elseif($resultadoBol['situacao'] == "PAGAMENTO CONFIRMADO"){
                                                     echo '<span class="badge badge-dark rounded-pill d-inline">'.$resultadoBol['situacao'].'</span>'; 
                                                  }elseif($resultadoBol['situacao'] == "AGUARDANDO PAGAMENTO"){
                                                     echo '<span class="badge badge-warning rounded-pill d-inline">'.$resultadoBol['situacao'].'</span>'; 
                                                  }elseif($resultadoBol['situacao'] == "VENCIDO"){
                                                     echo '<span class="badge badge-danger rounded-pill d-inline">'.$resultadoBol['situacao'].'</span>';  
                                                  }
                                                  ?></td>
                                                <td class="text-center">
                                                    <?php if($resultadoBol['situacao'] == "CONFIRMANDO PAGAMENTO"){ ?>  
                                      <a title="Marcar como Recebido" href="../ferramentas/atualiza-pag-boleto.php?cod_coopR=<?php echo $resultadoBol['bol_coop']; ?>&cod_boletoR=<?php echo $resultadoBol['cod_boleto']; ?>" bol-confirm="Marcar boleto como recebido?"><i class="uil uil-bill text-white btn-sm btn-success"></i></a>              
                                                    <?php }else{} ?>
                                                <a title="Fazer Download" href="../ferramentas/download-boleto.php?cod_coop=<?php echo $resultadoBol['bol_coop']; ?>&nome_doc=<?php echo $resultadoBol['arquivo']; ?>" data-confirm="Tem certeza de que deseja o item selecionado?"><i class="uil uil-import text-dark btn-sm btn-info"></i></a>
                                      <a title="Deletar Boleto" href="../ferramentas/deleta-boleto.php?cod_coop=<?php echo $resultadoBol['bol_coop']; ?>&nome_bol=<?php echo $resultadoBol['arquivo']; ?>&cod_bol=<?php echo $resultadoBol['cod_boleto']; ?>" desativar-confirm="Tem certeza de que deseja o item selecionado?"><i class="bi bi-trash text-white btn-sm btn-danger"></i></a>
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="date" name="data_vencimento" id="data_vencimento" class="form-control" placeholder="Insira a data do vencimento" autocomplete="off">
                            <label for="nome">Data de Vencimento</label>
                          </div>  
                        </div>
              <div class="col-lg-6 col-md-6 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="competencia" name="competencia">
        <option value="" selected>Selecione um Mês</option>
        <option value="JANEIRO/<?php echo date("Y")?>">JANEIRO/<?php echo date("Y")?></option>
        <option value="FEVEREIRO/<?php echo date("Y")?>">FEVEREIRO/<?php echo date("Y")?></option>
        <option value="MARÇO/<?php echo date("Y")?>">MARÇO/<?php echo date("Y")?></option>
        <option value="ABRIL/<?php echo date("Y")?>">ABRIL/<?php echo date("Y")?></option>
        <option value="MAIO/<?php echo date("Y")?>">MAIO/<?php echo date("Y")?></option>
        <option value="JUNHO/<?php echo date("Y")?>">JUNHO/<?php echo date("Y")?></option>
        <option value="JULHO/<?php echo date("Y")?>">JULHO/<?php echo date("Y")?></option>
        <option value="AGOSTO/<?php echo date("Y")?>">AGOSTO/<?php echo date("Y")?></option>
        <option value="SETEMBRO/<?php echo date("Y")?>">SETEMBRO/<?php echo date("Y")?></option>
        <option value="OUTUBRO/<?php echo date("Y")?>">OUTUBRO/<?php echo date("Y")?></option>
        <option value="NOVEMBRO/<?php echo date("Y")?>">NOVEMBRO/<?php echo date("Y")?></option>
        <option value="DEZEMBRO/<?php echo date("Y")?>">DEZEMBRO/<?php echo date("Y")?></option>                               
      </select>
      <label for="competencia">Competência</label>
    </div>
  </div>
                
                <div class="col-lg-6 col-md-6 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="situacaoBol" name="situacaoBol">
        <option value="">Selecione</option>
        <?php
        $buscaSituacao = mysqli_query($conexao, "SELECT * FROM boleto_situacao");
        while ($resultadoSituacao = mysqli_fetch_assoc($buscaSituacao)) {
            ?>
            <option value="<?php echo $resultadoSituacao['cod_bol_s'] ?>"><?php echo $resultadoSituacao['situacao'] ?></option>
            <?php
        }
        ?>
      </select>
      <label for="situacaoBol">Situação</label>
    </div>
  </div>
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-filter"></i> Filtrar</button>
        
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
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Boleto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          <form action="../ferramentas/inclui-boleto.php" method="POST" enctype="multipart/form-data">
            <div class="row">
       <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="cooperativaBolN" name="cooperativaBolN" required>
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
        <label for="cooperativaBolN">Cooperativa <span class="text-danger">*</span></label>
    </div>
  </div>
                <div class="col-lg-6 col-md-6 col-12">
    <div class="form-floating mb-3">
        <select class="form-select pesquisa-select" id="competenciaBolN" name="competenciaBolN" required>
        <option value="">Selecione um Mês</option>
        <option value="JANEIRO/<?php echo date("Y")?>">JANEIRO/<?php echo date("Y")?></option>
        <option value="FEVEREIRO/<?php echo date("Y")?>">FEVEREIRO/<?php echo date("Y")?></option>
        <option value="MARÇO/<?php echo date("Y")?>">MARÇO/<?php echo date("Y")?></option>
        <option value="ABRIL/<?php echo date("Y")?>">ABRIL/<?php echo date("Y")?></option>
        <option value="MAIO/<?php echo date("Y")?>">MAIO/<?php echo date("Y")?></option>
        <option value="JUNHO/<?php echo date("Y")?>">JUNHO/<?php echo date("Y")?></option>
        <option value="JULHO/<?php echo date("Y")?>">JULHO/<?php echo date("Y")?></option>
        <option value="AGOSTO/<?php echo date("Y")?>">AGOSTO/<?php echo date("Y")?></option>
        <option value="SETEMBRO/<?php echo date("Y")?>">SETEMBRO/<?php echo date("Y")?></option>
        <option value="OUTUBRO/<?php echo date("Y")?>">OUTUBRO/<?php echo date("Y")?></option>
        <option value="NOVEMBRO/<?php echo date("Y")?>">NOVEMBRO/<?php echo date("Y")?></option>
        <option value="DEZEMBRO/<?php echo date("Y")?>">DEZEMBRO/<?php echo date("Y")?></option>                               
      </select>
      <label for="competenciaBolN">Competência <span class="text-danger">*</span></label>
    </div>
  </div>
                <div class="col-lg-6 col-md-6 col-12">
                          <div class="form-floating mb-3">
                              <input type="date" name="dataVencimentoBolN" id="dataVencimentoBolN" class="form-control" placeholder="Insira a data do vencimento" autocomplete="off" required>
                            <label for="dataVencimentoBolN">Data de Vencimento <span class="text-danger">*</span></label>
                          </div>  
                        </div>
              
              <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group files">
                  <input type="file" class="form-control" name="bolN" id="bolN" required>
                </div>
              </div>
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-plus"></i> Adicionar</button>
        
        </form>
      </div>
    </div>
  </div>
</div>
<!-- fim modal documento -->

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
                    <span>Não foi possível finalizar o pagamento! Tente Novamente!</span>
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
                    <span>Não foi possível incluir o boleto! Tente Novamente!</span>
                </div>
            </div>
        </div>'; 
                }elseif($erro === 3){
                   echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível excluir o boleto! Tente Novamente!</span>
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
                    <span>Recebimento confirmado!</span>
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
                    <span>Boleto Incluído!</span>
                </div>
            </div>
        </div>';
                            }
                            elseif($sucesso === 3) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Boleto excluído!</span>
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
