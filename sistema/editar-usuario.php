<?php
require_once '../config/conexao.php';
require_once '../config/sessao.php';
require_once '../config/config_geral.php';

$usuario = $_GET['id'];

$sqlBuscaInfo = mysqli_query($conexao, "SELECT * FROM usuarios INNER JOIN cooperativas ON user_coop = cod_coop INNER JOIN perfis_usuarios ON user_nivel = p_cod INNER JOIN grupos_usuarios ON user_grupo = cod_grupo WHERE id_usuario = '$usuario'");
$resultadoBuscaInfo = mysqli_fetch_assoc($sqlBuscaInfo);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Edição Usuários</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
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
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="../js/mask.js"></script>
        <script src="../js/busca-cep.js"></script>
        <script src="../js/loading.js"></script>
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
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h4 class="titulo">Editando <span class="destaque"><?php echo $resultadoBuscaInfo['nome']; ?></span></h4>
                        <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" href="cad-usuarios.php"><i class="uil uil-angle-left"></i> Voltar</a>
                                </div>
                            </div>
                        </div>
                        <form id="formulario" method="POST" action="">
                            <!-- info obrigatoria -->
                            <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <span class="fw-bold">Informações Obrigatórias</span>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="row">
          <input type="hidden" value="<?php echo $usuario; ?>" name="idUsuario">
                <div class="col-lg-6 col-md-6 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $resultadoBuscaInfo['nome']; ?>" placeholder="Nome" autocomplete="off" required>
                            <label for="nome">Nome</label>
                          </div>  
                        </div>
          <div class="col-lg-6 col-md-6 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="<?php echo $resultadoBuscaInfo['sobrenome']; ?>" placeholder="Sobrenome" autocomplete="off" required>
                            <label for="sobrenome">Sobrenome</label>
                          </div>  
                        </div>
          <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email"  value="<?php echo $resultadoBuscaInfo['email']; ?>"placeholder="E-mail" autocomplete="off" required>
                                <label for="email">E-mail</label>
                              </div>  
                            </div>
          <div class="col-lg-4 col-md-4 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="cooperativa" name="cooperativa" required>
        <option value="<?php echo $resultadoBuscaInfo['cod_coop']; ?>"><?php echo $resultadoBuscaInfo['cooperativa']; ?></option>
                                                                <?php
                                                                $buscaCoop = mysqli_query($conexao, "SELECT * FROM cooperativas where cod_coop !=" . $resultadoBuscaInfo['cod_coop'] . "");
                                                                while ($resultadoCoop = mysqli_fetch_assoc($buscaCoop)) {
                                                                    ?>
                                                                    <option value="<?php echo $resultadoCoop['cod_coop'] ?>"><?php echo $resultadoCoop['cooperativa'] ?></option>
                                                                    <?php
                                                                }
                                                                ?> 
      </select>
      <label for="cooperativa">Cooperativa</label>
    </div>
  </div>
          <div class="col-lg-4 col-md-4 col-12">
    <div class="form-floating mb-3">
      <input type="text" name="usuario" class="form-control" id="usuario" value="<?php echo $resultadoBuscaInfo['usuario']; ?>" placeholder="Usuário" autocomplete="off" required>
      <label for="usuario">Usuário</label>
    </div>  
  </div>
          <div class="col-lg-4 col-md-4 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="nivel" name="nivel" required>
        <option value="<?php echo $resultadoBuscaInfo['p_cod']; ?>"><?php echo $resultadoBuscaInfo['perfil']; ?></option>
                                                                <?php
                                                                $buscaNivel = mysqli_query($conexao, "SELECT * FROM perfis_usuarios where p_cod !=" . $resultadoBuscaInfo['user_nivel'] . "");
                                                                while ($resultadoNivel = mysqli_fetch_assoc($buscaNivel)) {
                                                                    ?>
                                                                    <option value="<?php echo $resultadoNivel['p_cod'] ?>"><?php echo $resultadoNivel['perfil'] ?></option>
                                                                    <?php
                                                                }
                                                                ?>
      </select>
      <label for="floatingSelect">Nível de Acesso</label>
    </div>
  </div>
          <div class="col-lg-4 col-md-4 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="grupo" name="grupo" required>
          <option value="<?php echo $resultadoBuscaInfo['cod_grupo']; ?>"><?php echo $resultadoBuscaInfo['grupo']; ?></option>
        <?php
        $buscaGrupo = mysqli_query($conexao, "SELECT * FROM grupos_usuarios WHERE cod_grupo !=".$resultadoBuscaInfo['cod_grupo']."");
        while ($resultadoGrupo = mysqli_fetch_assoc($buscaGrupo)) {
            ?>
            <option value="<?php echo $resultadoGrupo['cod_grupo'] ?>"><?php echo $resultadoGrupo['grupo'] ?></option>
            <?php
        }
        ?> 
      </select>
      <label for="grupo">Grupo</label>
    </div>
  </div>
          <div class="col-lg-4 col-md-4 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="status" name="status" required>
        <?php
                                                                if ($resultadoBuscaInfo['u_status'] == 1) {
                                                                    echo "<option selected value='" . $resultadoBuscaInfo['u_status'] . "'>Ativo</option>";
                                                                    echo "<option value='0'>Inativo</option>";
                                                                } else {
                                                                    echo "<option selected value='" . $resultadoBuscaInfo['u_status'] . "'>Inativo</option>";
                                                                    echo "<option value='1'>Ativo</option>";
                                                                }
                                                                ?>
      </select>
      <label for="status">Status</label>
    </div>
  </div>
          <div class="col-12 text-left">
                          <button type="submit" class="btn btn-success btn-md"><i class="uil uil-sync"></i> Atualizar Dados</button>
                        </div>
            </div>
        
        
      </div>
    </div>
  </div>
</div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                                                     
                            <!-- info obrigatoria -->
                        </form>
                        <?php include_once "../ferramentas/modal_loading.php"; ?> 
                        <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php"; ?>
            </div>
        </div>

        <?php
        $idUsuario = $usuario;
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $nivel = $_POST['nivel'];
        $grupo = $_POST['grupo'];
        $cooperativa = $_POST['cooperativa'];
        $usuario = $_POST['usuario'];
        $status = $_POST['status'];
        if (isset($nome, $sobrenome, $email, $nivel, $cooperativa, $usuario, $grupo)) {
            $sqlAtualizaInformacoes = mysqli_query($conexao, "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', user_nivel = '$nivel', user_grupo = '$grupo', user_coop = '$cooperativa', usuario = '$usuario', u_status = '$status' WHERE id_usuario = '$idUsuario'");

            echo "<meta http-equiv='refresh' content='0;url=editar-usuario.php?id=$idUsuario&sucesso=1' />";
        }

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
                    <span>Dados Atualizados com Sucesso!</span>
                </div>
            </div>
        </div>';
        }
        ?>
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
        <script>
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".menu-ativo").removeClass("menu-ativo");
   $(this).addClass("menu-ativo");
});
</script>

    </body>
</html>
