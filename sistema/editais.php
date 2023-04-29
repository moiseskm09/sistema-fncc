<?php 
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';


if (isset($_GET["cooperativaedital"])) {
    $cooperativaedital = $_GET["cooperativaedital"];
    $sql_buscaEditais = mysqli_query($conexao, "SELECT cod_edital, edital_arquivo, edital_data, edital_coop, cooperativa FROM site_editais INNER JOIN cooperativas ON  edital_coop = cod_coop WHERE edital_coop = '$cooperativaedital' ORDER BY edital_data DESC, cooperativa ASC");
    $filtroON = 1;
} else {
    $sql_buscaEditais = mysqli_query($conexao, "SELECT cod_edital, edital_arquivo, edital_data, edital_coop, cooperativa FROM site_editais INNER JOIN cooperativas ON  edital_coop = cod_coop ORDER BY edital_data DESC, cooperativa ASC LIMIT 100");
    $filtroON = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Editais de Convocação</title>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<!-- Scripts -->
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
                      <span class="breadcrumb-item text-primary">Site</span>
                      <span class="breadcrumb-item active text-success">Editais de convocação</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-success mb-1" href="#addDocumento" data-toggle="modal" data-target="#addDocumento"><i class="uil uil-plus"></i> Adicionar Edital</a>
                                    <?php if($filtroON === 1){ ?>
                                    <a class="btn btn-sm btn-dark mb-1" href="editais.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless" id="tabelaeditais" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                        <th class="text-center">Data Publicação</th>
                                        <th class="text-center">Cooperativa</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="p-0 bg-white">
                                    <?php
                                    if (mysqli_num_rows($sql_buscaEditais) > 0) {
                                        while ($resultadoEditais = mysqli_fetch_assoc($sql_buscaEditais)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td class="text-center" style="font-size:15px;"><?php echo strftime('%d/%m/%Y', strtotime($resultadoEditais['edital_data'])); ?></td>
                                                <td class="text-center" style="font-size:15px;"><?php echo $resultadoEditais['cooperativa']; ?></td>
                                                <td class="text-center">
                                                <a title="Deletar" href="../ferramentas/deleta-edital.php?cod_edital=<?php echo $resultadoEditais['cod_edital']; ?>&edital_arquivo=<?php echo $resultadoEditais['edital_arquivo']; ?>" desativar-confirm="Tem certeza de que deseja o item selecionado?"><i class="bi bi-trash text-white btn-sm btn-danger"></i></a>
                                                </td> 
                                            </tr>
                                            <?php                                          
                                        }
                                    } 
                                    ?>
                                </tbody>                           
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
      <select class="form-select pesquisa-select" id="cooperativaedital" name="cooperativaedital" required>
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
        <label for="cooperativaedital">Cooperativa <span class="text-danger">*</span></label>
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
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Edital</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          <form action="../ferramentas/adiciona-edital.php" method="POST" enctype="multipart/form-data">
            <div class="row">
       <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="cooperativaEdital" name="cooperativaEdital" required>
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
        <label for="cooperativaEdital">Cooperativa <span class="text-danger">*</span></label>
    </div>
  </div>
              
              <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group files">
                  <input type="file" class="form-control" name="arquivoEdital" id="arquivoEdital" required>
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
                    <span>Não foi possível adicionar! Tente Novamente!</span>
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
                    <span>Não foi deletar! Tente Novamente!</span>
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
                    <span>Edital adicionado!</span>
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
                    <span>Edital deletado!</span>
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
<script>
    $('#filtro').on('shown.bs.modal', function () {
    $('.focoInput').focus();
});  
</script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#tabelaeditais').DataTable({
            dom: 'Bfrtip',
            "ordering": false,
            "filter": false,
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json",
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
</script>
    </body>
</html>
