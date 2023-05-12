<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];
    $sql_buscaCoops = mysqli_query($conexao, "SELECT * FROM cooperativas where cooperativa LIKE '%$nome%'");
    $numeroLinhas = mysqli_num_rows($sql_buscaCoops);
    $filtroON = 1;
} else {

    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT cod_coop FROM cooperativas");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina = 10;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);

    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaCoops = mysqli_query($conexao, "SELECT cod_coop, coop_matricula, cooperativa, coop_cnpj, coop_telefone, coop_status FROM cooperativas ORDER BY coop_status DESC, cooperativa LIMIT $inicio, $itens_por_pagina ");
    $numeroLinhas = mysqli_num_rows($sql_buscaCoops);
    $filtroON = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <title>Cadastro de Cooperativas</title>
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
      <?php include_once "../ferramentas/navbar.php"; ?>
    <div id="layoutSidenav">
        <?php include_once "../ferramentas/menu.php"; ?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <!--conteudo da tela aqui!-->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
              <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Cadastro</span>
                      <span class="breadcrumb-item active text-success">Cooperativas</span>
                  </div>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="mr-2">
                  <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i>Voltar</a>
                  <a class="btn btn-sm btn-success mb-1" href="#adicionaCoop" data-toggle="modal" data-target="#adicionaCoop"><i class="uil uil-plus"></i> Adicionar</a>
                  <a class="btn btn-sm btn-secondary mb-1" title="Solicitar Atualização Cadastral das Cooperativas" href="../ferramentas/solicitar-atualizacao-cadastral.php"><i class="bi bi-building-fill-gear"></i> Atualização Cadastral</a>
                  <?php if ($filtroON === 1) { ?>
                      <a class="btn btn-sm btn-dark mb-1" href="cad-cooperativas.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                  <?php } ?>
                  <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-borderless bg-white">
                <thead class="theadN">
                  <tr>
                    <th>Mátricula</th>
                    <th>Cooperativa</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th class="text-center">Ações</th>
                  </tr>
                </thead>
                <tbody class="bg-white p-0">
                    <?php
                    if ($numeroLinhas > 0) {
                        while ($resultadoCoop = mysqli_fetch_assoc($sql_buscaCoops)) {
                            ?>
                          <tr class="linha-hover">
                            <td><span class="badge badge-info rounded-pill d-inline"><?php echo $resultadoCoop['coop_matricula']; ?></span></td>
                            <td><?php echo $resultadoCoop['cooperativa']; ?></td>
                            <td><?php echo $resultadoCoop['coop_cnpj']; ?></td>
                            <td><?php echo $resultadoCoop['coop_telefone']; ?></td>
                            <td><?php if ($resultadoCoop['coop_status'] == 1) {
                        echo '<span class="badge badge-success rounded-pill d-inline">Ativo</span>';
                    } else {
                        echo '<span class="badge badge-danger rounded-pill d-inline">Inativo</span>';
                    } ?></td>
                            <td class="text-center">
                                <a href="../ferramentas/relatorios/rel-cooperativa.php?id=<?php echo $resultadoCoop['cod_coop']; ?>" title="Gerar PDF" target="blank"><i class="bi bi-filetype-pdf btn-sm btn-dark"></i></a>
                              <a href="editar-cooperativa.php?id=<?php echo $resultadoCoop['cod_coop']; ?>" title="Editar Cadastro"><i class="bi bi-pencil-square text-dark btn-sm btn-warning"></i></a>
                              <a href="../ferramentas/desativa-cooperativa.php?id=<?php echo $resultadoCoop['cod_coop']; ?>" title="Desativar Cooperativa" desativar-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="bi bi-trash text-white btn-sm btn-danger"></i></a>
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
                    <td colspan="2"><?php echo "Mostrando " . $numeroLinhas; ?> de <?php echo $numeroTotalLinhas; ?> registros</td>
                    <td colspan="4">
                      <nav>
                        <ul class="pagination pagination-sm justify-content-end">
                          <li class="page-item">
                            <a class="page-link" href="?pagina=1" tabindex="-1"><span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Primeira</span></a>
                          </li>
                          <?php
                          for ($i = 1; $i < $numero_paginas + 1; $i++) {
                              $estilo = "";
                              if ($pagina == $i) {
                                  $estilo = 'active';
                              }
                              ?>
                              <li class="page-item <?php echo $estilo; ?>"><a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php }
?>
                          <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $numero_paginas ?>"><span aria-hidden="true">&raquo;</span>
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
      <input type="text" name="nome" class="form-control focoInput" id="nome" placeholder="Nome" autocomplete="off" required>
      <label for="nome">Nome da Cooperativa</label>
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

            <!-- Modal adiciona usuario -->
            <div class="modal fade" id="adicionaCoop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header header-filtro">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Cooperativa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body card-fundo-body">
                    <form action="../ferramentas/adiciona-cooperativa.php" method="POST">
                      <!-- info obrigatoria -->
                      <div class="form-row">
                        <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_razao" class="form-control" id="coop_razao" placeholder="Razão Social" autocomplete="off" required>
                            <label for="coop_razao">Razão Social</label>
                          </div>  
                        </div>
                        <div class="col-lg-5 col-md-5 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_fantasia" class="form-control" id="coop_fantasia" placeholder="Nome Fantasia" autocomplete="off" required>
                            <label for="coop_fantasia">Nome Fantasia</label>
                          </div>  
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                          <div class="form-floating mb-3">
                            <input type="tel" name="coop_cnpj" class="form-control cnpj" id="coop_cnpj" placeholder="CNPJ" autocomplete="off" required>
                            <label for="coop_cnpj">CNPJ</label>
                          </div>  
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                          <div class="form-floating mb-3">
                            <input type="tel" name="coop_matricula" class="form-control" id="coop_matricula" placeholder="Matrícula" autocomplete="off" required>
                            <label for="coop_matricula">Matrícula</label>
                          </div>  
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                        <h5 class="destaque">Contato Principal</h5>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <input type="tel" name="coop_telefone" class="form-control phone" id="coop_telefone" placeholder="Telefone" autocomplete="off" required>
                                <label for="coop_telefone">Telefone</label>
                              </div>  
                            </div>
                        <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <input type="tel" name="coop_whatsapp" class="form-control phone_with_ddd" id="coop_whatsapp" autocomplete="off" placeholder="Whatsapp">
                                <label for="coop_whatsapp">Whatsapp</label>
                              </div>  
                            </div>
                        <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <input type="email" name="coop_email" class="form-control" id="coop_email" placeholder="E-mail" autocomplete="off" required>
                                <label for="coop_email">E-mail</label>
                              </div>  
                            </div>
                        <div class="col-12 text-left">
                          <button type="submit" class="btn btn-success btn-md"><i class="uil uil-plus"></i> Adicionar</button>
                        </div>
                      </div>                           
                      <!-- info obrigatoria -->
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
                    <span> Cooperativa criada com sucesso!</span>
                </div>
            </div>
        </div>';
      } else if ($sucesso === 2) {
          echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #fff3cd; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #fff3cd; color: #1c1d3c;"">
                    <span> Cooperativa desativada com sucesso!</span>
                </div>
            </div>
        </div>';
      }else if ($sucesso === 3) {
          echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <span> Atualização Cadastral solicitada!</span>
                </div>
            </div>
        </div>';
      }
      
      
      if (isset($_GET["erro"])) {
                            $erro = (int) $_GET["erro"];
            if($erro === 1){
             
           echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro ao solicitar Atualização! Tente novamente!</span>
                </div>
            </div>
        </div>'; 
        }
                        }
      ?>
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
  </body>
</html>
