<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['id'])) {
    $clicado_perfil = $_GET['id'];
    $consulta_perfil_clicado = mysqli_query($conexao, "SELECT * from perfis_usuarios WHERE p_cod = '$clicado_perfil'");
    $resultado_perfil_clicado = mysqli_fetch_assoc($consulta_perfil_clicado);
    $perfil_option = $resultado_perfil_clicado['perfil'];
} else {
    $clicado_perfil = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <title>Perfis de Acesso</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
    <link href="../css/menu.css" rel="stylesheet" />
    <link href="../css/perfis.css" rel="stylesheet" />
    <link rel="manifest" href="../manifest.json">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="../css/style.css" rel="stylesheet" />
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
              <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Configurações</span>
                      <span class="breadcrumb-item active text-success">Perfis de Usuário</span>
                  </div>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="mr-2">
                  <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                  <a href="#criarPerfil" data-toggle="modal" data-target="#criarPerfil" class="btn btn-sm btn-success"><i class="uil uil-plus"></i> Adicionar</a>
                </div>
              </div>

            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="destaque fw-bold">Selecione Um Perfil</span>
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <form action="../ferramentas/pesquisa_perfil.php" method="POST" id="perfil">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                              <div class="form-floating mb-3">
                                <select class="form-select pesquisa-select" name="nome_perfil" onchange="this.form.submit()" required>
                                  <option value=""><?php
                                      if (isset($perfil_option)) {
                                          echo $perfil_option;
                                      } else {
                                          echo "Selecione ...";
                                      }
                                      ?></option>
                                  <?php
                                  $consulta_perfil = mysqli_query($conexao, "SELECT * FROM perfis_usuarios");
                                  if (mysqli_num_rows($consulta_perfil) > 0) {
                                      while ($perfis = mysqli_fetch_assoc($consulta_perfil)) {
                                          if ($perfis["p_cod"] == $clicado_perfil) {
                                              
                                          } else {
                                              ?>
                                              <option value="<?php echo $perfis["p_cod"]; ?>"><?php echo $perfis["perfil"]; ?></option>   
                                              <?php
                                          }
                                      }
                                  } else {
                                      
                                  }
                                  ?>
                                </select>
                                <label for="floatingSelect">Cooperativa</label>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDois" aria-expanded="true" aria-controls="collapseDois">
                        <span class="destaque fw-bold">Permissões do Perfil <?php
                            if (isset($perfil_option)) {
                                echo "<span style='color: #dc3545'>" . $perfil_option . "</span>";
                            } else {
                                
                            }
                            ?></span>
                      </button>
                    </h2>
                    <div id="collapseDois" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#collapseDois">
                      <div class="accordion-body" style="max-height: 420px; overflow-y: scroll;">
                        <div class="">
                            <?php
                            if ($clicado_perfil == null) {
                                echo '<div class="alert-warning">';
                                echo '<p class="alert p-3">Selecione um perfil para visualizar as permissões!</p>';
                            } else {
                                ?>

                              <ul class="list-unstyled">
                                  <?php
                                  $seleciona_menu_permissao = mysqli_query($conexao, "SELECT * FROM menu");
                                  while ($resultado_permissao = mysqli_fetch_assoc($seleciona_menu_permissao)) {
                                      $idMenuPermissao = $resultado_permissao["id_menu"];
                                      ?>

                                    <li>
                                      <div class="p-2 destaque mb-2 mt-2">
                                        <strong class="">
                                            <?php echo $resultado_permissao['menu']; ?>
                                        </strong>
                                      </div>                    

                                      <?php
                                      $seleciona_submenu_permissao = mysqli_query($conexao, "SELECT submenu, marcado, cod_submenu FROM submenu
                                                            INNER JOIN nivel_acesso ON codSubmenu = cod_submenu and cod_perfil = '$clicado_perfil' WHERE codMenu = '$idMenuPermissao'");
                                      if (mysqli_num_rows($seleciona_submenu_permissao) == 0) {
                                          echo "sem informações para exibir";
                                      } else {
                                          ?>
                                      <form action="../ferramentas/atualiza_permissao_usuario.php" method="POST">
                                          <ul class="list-unstyled list-unstyled" id="">
                                                <div class="form-row">
                                                  <?php
                                                  while ($resultado_submenu_permissao = mysqli_fetch_assoc($seleciona_submenu_permissao)) {

                                                      if ($resultado_submenu_permissao['marcado'] == 1) {
                                                          ?>
                                                        <li>
                                                          <div class="col-md-12">
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" name="permissao_menu[]" value="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>" id="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>" checked>
                                                              <label class="form-check-label" for="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>">
                                                                  <?php echo $resultado_submenu_permissao['submenu']; ?>
                                                              </label>
                                                            </div>
                                                          </div>
                                                        </li>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li>
                                                          <div class="col-md-12">
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" name="permissao_menu[]" value="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>" id="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>">
                                                              <label class="form-check-label" for="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>">
                                                                  <?php echo $resultado_submenu_permissao['submenu']; ?>
                                                              </label>
                                                            </div>
                                                          </div>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                              </div>
                                          </ul>
                                      <?php } ?>
                                    </li>
                                <?php }
                                ?>
                                
                                <input type="hidden" id="id" name="id" value="<?php echo $clicado_perfil; ?>">
                                
                              </ul> 
                          <div class="row">
                          <div class="text-left col-md-12">        
                                  <button class="btn btn-md btn-success loading mt-3 mb-2" type="submit"><i class="uil uil-sync"></i> Atualizar Permissões</button>
                                </div>
                          </div>
                          </form>
                          <?php } ?>             

                        </div>
                      </div>
                    </div>
                  </div>
                </div>     
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
                    <span> Perfil atualizado!</span>
                </div>
            </div>
        </div>';
              }
              ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="criarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header header-filtro">
                    <h5 class="modal-title" id="exampleModalLabel">Criação de perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body card-fundo-body">
                    <form action="../ferramentas/cadastrarPerfil.php" method="POST">
                      <div class="row">
                          <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="nome_perfil_novo" id="caixa-nome_perfil_novo" class="form-control" placeholder="Perfil" autocomplete="off" required>
                            <label for="nome">Nome do Perfil</label>
                          </div>  
                        </div>
                      </div>
                      <div class="modal-footer card-fundo-body p-0 border-0">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-plus"></i> Criar Perfil</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!--fim conteudo da tela aqui!-->
          
        </main>
        <?php include_once "../ferramentas/rodape.php"; ?>
      </div>
    </div>
    <script>
        $('.pesquisa-select').select2({
            theme: 'bootstrap-5';
        });

    </script>  
    <script src="../js/toast.js"></script>
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
