<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['dataRefIncialF'], $_GET["dataRefFinalF"])) {
    $dataRefIncialF = $_GET['dataRefIncialF'];
    $dataRefFinalF = $_GET['dataRefFinalF'];
    $sql_buscaBals = mysqli_query($conexao, "SELECT * FROM balancete INNER JOIN cooperativas ON  bal_coop = cod_coop WHERE bal_ref_inicial >= '$dataRefIncialF' and bal_ref_final <= '$dataRefFinalF' and bal_coop = '$COOPERATIVA' ORDER BY bal_situacao ASC, bal_ref_inicial DESC");
    $filtroON = 1;
} else {
    $sql_buscaBals = mysqli_query($conexao, "SELECT * FROM balancete INNER JOIN cooperativas ON  bal_coop = cod_coop WHERE bal_coop = '$COOPERATIVA' ORDER BY bal_situacao ASC, bal_ref_inicial DESC LIMIT 100");
    $filtroON = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Inclusão de Balancete</title>
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
        <script src="../js/mask.js"></script>
        <script src="../js/busca-cep.js"></script>
        <script src="../js/loading.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <style>
        </style>
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
                            <h5 class="titulo">Inclusão de Balancete</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-success mb-1" href="#addDocumento" data-toggle="modal" data-target="#addDocumento"><i class="uil uil-plus"></i> Adicionar Balancete</a>
                                    <?php if ($filtroON === 1) { ?>
                                        <a class="btn btn-sm btn-dark mb-1" href="balancete.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-sm" id="tabelaBalancete" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                        <th>Mês Ref. Inicial</th>
                                        <th>Mês Ref. Final</th>
                                        <th>Cooperativa</th>
                                        <th>Situação</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
                                    <?php
                                    if ($sql_buscaBals > 0) {
                                        while ($resultadoBal = mysqli_fetch_assoc($sql_buscaBals)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;"><?php echo strftime('%d/%m/%Y', strtotime($resultadoBal['bal_ref_inicial'])); ?></td>
                                                <td style="font-size:15px;"><?php echo strftime('%d/%m/%Y', strtotime($resultadoBal['bal_ref_final'])); ?></td>
                                                <td style="font-size:15px;"><?php echo $resultadoBal['cooperativa']; ?></td>
                                                <td style="font-size:15px;"><?php 
                                                if($resultadoBal['bal_situacao'] == 1){
                                                echo '<span class="badge badge-warning text-dark rounded-pill d-inline">EM ANÁLISE DE RISCO</span>';
                                                }elseif($resultadoBal['bal_situacao'] == 2){
                                                    echo '<span class="badge badge-success rounded-pill d-inline">ANÁLISE DE RISCO OK</span>';
                                                }
                                                ?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    if($resultadoBal['bal_situacao'] == 1){
                                                    ?>
                                                    <a title="Fazer Download Balancete" href="../ferramentas/download-balancete.php?cod_coop=<?php echo $resultadoBal['bal_coop']; ?>&nome_bal=<?php echo $resultadoBal['bal_arquivo']; ?>" data-confirm="Tem certeza de que deseja o item selecionado?"><i class="uil uil-import text-dark btn-sm btn-info"></i></a>
                                                    <a title="Deletar Balancete" href="../ferramentas/deleta-balancete.php?cod_coop=<?php echo $resultadoBal['bal_coop']; ?>&nome_bal=<?php echo $resultadoBal['bal_arquivo']; ?>&cod_bal=<?php echo $resultadoBal['cod_balancete']; ?>" desativar-confirm="Tem certeza de que deseja o item selecionado?"><i class="bi bi-trash text-white btn-sm btn-danger"></i></a>
                                                    <?php 
                                                    }elseif($resultadoBal['bal_situacao'] == 2){
                                                       ?>
                                                    <a title="Ir para Relatório de Riscos" href="rel-gerenciamento-de-riscos.php"><i class="bi bi-building-fill-exclamation btn-sm btn-dark"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
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
                                                    <input type="hidden" name="cod_coopUserF" id="cod_coopUserF" class="form-control" required value="<?php echo $COOPERATIVA; ?>">
                                                    <?php
                                                    $buscaCooperativas = mysqli_query($conexao, "SELECT cooperativa FROM cooperativas WHERE cod_coop = $COOPERATIVA");
                                                    $resultadoCooperativas = mysqli_fetch_assoc($buscaCooperativas);
                                                    ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="coopUserF" id="coopUserF" class="form-control" placeholder="coop user" autocomplete="off" required value="<?php echo $resultadoCooperativas['cooperativa'] ?>" readonly>
                                                        <label for="coopUserF">Cooperativa <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dataRefIncialF" id="dataRefIncialF" class="form-control" placeholder="Insira a data ref inicial" autocomplete="off" required>
                                                        <label for="dataRefIncialF">Data Ref. Inicial <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dataRefFinalF" id="dataRefFinalF" class="form-control" placeholder="Insira a data ref final" autocomplete="off" required>
                                                        <label for="dataRefFinalF">Data Ref. Final <span class="text-danger">*</span></label>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Balancete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="../ferramentas/inclui-balancete.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <input type="hidden" name="cod_coopUser" id="cod_coopUser" class="form-control" required value="<?php echo $COOPERATIVA; ?>">
                                                    <?php
                                                    $buscaCooperativas = mysqli_query($conexao, "SELECT cooperativa FROM cooperativas WHERE cod_coop = $COOPERATIVA");
                                                    $resultadoCooperativas = mysqli_fetch_assoc($buscaCooperativas);
                                                    ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="coopUser" id="coopUser" class="form-control" placeholder="coop user" autocomplete="off" required value="<?php echo $resultadoCooperativas['cooperativa'] ?>" readonly>
                                                        <label for="coopUser">Cooperativa <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dataRefIncial" id="dataRefIncial" class="form-control" placeholder="Insira a data ref inicial" autocomplete="off" required>
                                                        <label for="dataRefIncial">Data Ref. Inicial <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dataRefFinal" id="dataRefFinal" class="form-control" placeholder="Insira a data ref final" autocomplete="off" required>
                                                        <label for="dataRefFinal">Data Ref. Final <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-group files">
                                                        <input type="file" class="form-control" name="balN" id="balN" required>
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
                <?php include_once "../ferramentas/rodape.php"; ?>
            </div>

            <?php
            if (isset($_GET["erro"])) {
                $erro = (int) $_GET["erro"];
                if ($erro === 1) {
                    echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível fazer o download!<br>Tente Novamente!</span>
                </div>
            </div>
        </div>';
                } elseif ($erro === 2) {
                    echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível incluir o balancete! Tente Novamente!</span>
                </div>
            </div>
        </div>';
                } elseif ($erro === 3) {
                    echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível excluir o balancete! Tente Novamente!</span>
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
            } elseif ($sucesso === 2) {
                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Balancete Incluído!</span>
                </div>
            </div>
        </div>';
            } elseif ($sucesso === 3) {
                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Balancete excluído!</span>
                </div>
            </div>
        </div>';
            }
            ?>
        </div>
        <script>
            $('.pesquisa-select').select2({
                theme: 'bootstrap-5';
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
        <script src="../js/boletos.js"></script>
        <script src="../js/confirmacao_pag.js"></script>
        <script src="../js/desativar.js"></script>
        <script>
            $(".nav .nav-link").on("click", function () {
                $(".nav").find(".menu-ativo").removeClass("menu-ativo");
                $(this).addClass("menu-ativo");
            });
        </script>
        <script type="text/javascript">

    $(document).ready(function () {
        $('#tabelaBalancete').DataTable({
            dom: 'Bfrtip',
            "ordering": false,
            "filter": true,
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
