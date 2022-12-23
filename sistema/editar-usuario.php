<?php
require_once '../config/conexao.php';
require_once '../config/sessao.php';
require_once '../config/config_geral.php';

$usuario = $_GET['id'];

$sqlBuscaInfo = mysqli_query($conexao, "SELECT * FROM usuarios INNER JOIN cooperativas ON user_coop = cod_coop INNER JOIN perfis_usuarios ON user_nivel = p_cod WHERE id_usuario = '$usuario'");
$resultadoBuscaInfo = mysqli_fetch_assoc($sqlBuscaInfo);
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
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
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
    <body class="sb-nav-fixed">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h4 class="titulo">Editando <span class="destaque"><?php echo $resultadoBuscaInfo['nome']; ?></span></h4>
                        </div>
                        <form id="formulario" method="POST" action="">
                            <!-- info obrigatoria -->
                            <input type="hidden" value="<?php echo $usuario; ?>" id="codMoradorPrincipal" name="idUsuario">
                            <div class="form-row mt-3">
                                <div class="col-md-12">
                                    <div class="accordion" id="selecioneperfil">
                                        <div class="card border-0 mb-2" style="border-radius: 10px;">
                                            <a href="#infoobrigatoria" data-toggle="collapse"  aria-expanded="true" aria-controls="informacoesObrigatorias" class="text-center header-filtro p-2 borda">Informações Obrigatórias</a>

                                            <div id="infoobrigatoria" class="collapse show" aria-labelledby="headingOne" data-parent="#infoobrigatoria">
                                                <div class="card-body card-fundo-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="nome">Nome<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control digitacao" id="nome" name="nome" value="<?php echo $resultadoBuscaInfo['nome']; ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sobrenome">Sobrenome<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control digitacao" id="sobrenome" name="sobrenome" value="<?php echo $resultadoBuscaInfo['sobrenome']; ?>">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="cooperativa">Cooperativa</label><br>
                                                            <select id="cooperativa" name="cooperativa" class="form-control digitacao pesquisa-select">
                                                                <option value="<?php echo $resultadoBuscaInfo['cod_coop']; ?>"><?php echo $resultadoBuscaInfo['cooperativa']; ?></option>
                                                                <?php
                                                                $buscaCoop = mysqli_query($conexao, "SELECT * FROM cooperativas where cod_coop !=" . $resultadoBuscaInfo['cod_coop'] . "");
                                                                while ($resultadoCoop = mysqli_fetch_assoc($buscaCoop)) {
                                                                    ?>
                                                                    <option value="<?php echo $resultadoCoop['cod_coop'] ?>"><?php echo $resultadoCoop['cooperativa'] ?></option>
                                                                    <?php
                                                                }
                                                                ?>                                                                </select>
                                                        </div>                                       
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email <span class="text-danger">*</span></label></label>
                                                            <input type="email" class="form-control digitacao" id="email" name="email" value="<?php echo $resultadoBuscaInfo['email']; ?>">
                                                        </div>

                                                        <div class="form-group col-md-4 col-12">
                                                            <label for="usuario">Usuário <span class="text-danger"> *</span></label></label>
                                                            <input type="text" class="form-control digitacao" id="usuario" name="usuario" value="<?php echo $resultadoBuscaInfo['usuario']; ?>">
                                                        </div>
                                                        <div class="form-group col-md-4 col-12">
                                                            <label for="nivel">Nível de Acesso</label><br>
                                                            <select id="nivel" name="nivel" class="form-control digitacao pesquisa-select">
                                                                <option value="<?php echo $resultadoBuscaInfo['p_cod']; ?>"><?php echo $resultadoBuscaInfo['perfil']; ?></option>
                                                                <?php
                                                                $buscaNivel = mysqli_query($conexao, "SELECT * FROM perfis_usuarios where p_cod !=" . $resultadoBuscaInfo['user_nivel'] . "");
                                                                while ($resultadoNivel = mysqli_fetch_assoc($buscaNivel)) {
                                                                    ?>
                                                                    <option value="<?php echo $resultadoNivel['p_cod'] ?>"><?php echo $resultadoNivel['perfil'] ?></option>
                                                                    <?php
                                                                }
                                                                ?>                                                                </select>
                                                        </div>
                                                        <div class="form-group col-md-4 col-12">
                                                            <label for="status">Status</label><br>
                                                            <select id="status" name="status" class="form-control digitacao pesquisa-select">
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
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                            <!-- info obrigatoria -->

                            <button type="submit" class="btn btn-success loading">Atualizar cadastro</button>
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
        $cooperativa = $_POST['cooperativa'];
        $usuario = $_POST['usuario'];
        $status = $_POST['status'];
        if (isset($nome, $sobrenome, $email, $nivel, $cooperativa, $usuario)) {
            $sqlAtualizaInformacoes = mysqli_query($conexao, "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', user_nivel = '$nivel', user_coop = '$cooperativa', usuario = '$usuario', u_status = '$status' WHERE id_usuario = '$idUsuario'");

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
                    <span> Sucesso!</span>
                </div>
            </div>
        </div>';
        }
        ?>
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

    </body>
</html>
