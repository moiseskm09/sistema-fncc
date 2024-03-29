<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
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
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Meus Dados</title>
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
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Tela Principal</span>
                      <span class="breadcrumb-item active text-success">Meus Dados</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i>Voltar</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card mb-3" style="border-radius: 15px;">
                                    <div class="card-body text-center">
                                        <img itle="Foto Perfil" src="../img/foto_perfil/cooperativas/<?php echo "logo_fncc.png"; ?>" alt="foto perfil"
                                             class="rounded-circle img-fluid bg-light" style="width: 165px;">
                                        <h5 class="my-3"><?php echo ucfirst($resultadoBuscaInfo["nome"]); ?></h5>
                                        <p class="text-muted mb-1"><?php echo ucfirst($resultadoBuscaInfo["sobrenome"]); ?></p>
                                        <p class="text-muted mb-4"><?php echo $resultadoBuscaInfo["email"]; ?></p>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterasenha">Alterar Senha</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="card" style="border-radius: 15px;">
                                    <form action="" method="POST">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Seu Nome" value="<?php echo ucfirst($resultadoBuscaInfo["nome"]); ?>">
                                                        <label for="nome">Nome</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="sobrenome" class="form-control" id="sobrenome" placeholder="Seu Sobrenome" value="<?php echo ucfirst($resultadoBuscaInfo["sobrenome"]); ?>">
                                                        <label for="sobrenome">Sobrenome</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" name="email" class="form-control" id="email" placeholder="Seu E-mail" value="<?php echo $resultadoBuscaInfo["email"]; ?>">
                                                        <label for="sobrenome">E-mail</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Seu Usuário" value="<?php echo $resultadoBuscaInfo["usuario"]; ?>" disabled>
                                                        <label for="usuario">Usuário</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="cooperativa" class="form-control" id="cooperativa" placeholder="Sua Cooperativa" value="<?php echo ucfirst($resultadoBuscaInfo["cooperativa"]); ?>" disabled>
                                                        <label for="usuario">Cooperativa</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nivel" class="form-control" id="nivel" placeholder="Seu Nível" value="<?php echo ucfirst($resultadoBuscaInfo["perfil"]); ?>" disabled>
                                                        <label for="usuario">Nível de Acesso</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-5">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="status" class="form-control" id="status" placeholder="Seu status" value="<?php if ($resultadoBuscaInfo["u_status"] == 1) {
                echo "Ativo";
            } else {
                echo "Inativo";
            } ?>" disabled>
                                                        <label for="usuario">Status</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-7">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dtcadastro" class="form-control" id="dtcadastro" placeholder="Data de Cadastro" value="<?php echo $resultadoBuscaInfo["data_cadastro"] ?>" disabled>
                                                        <label for="dtcadastro">Data de Cadastro</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12 text-center">
                                                    <button class="btn btn-success" type="submit">Atualizar Dados</button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <?php
                        if (isset($_POST["nome"], $_POST["sobrenome"], $_POST["email"])) {
                            $nomeNovo = $_POST["nome"];
                            $sobrenomeNovo = $_POST["sobrenome"];
                            $emailNovo = $_POST["email"];
                            $atualizaDados = mysqli_query($conexao, "UPDATE usuarios SET nome = '$nomeNovo', sobrenome = '$sobrenomeNovo', email = '$emailNovo' WHERE id_usuario = '$usuario'");
                            echo "<meta http-equiv='refresh' content='0;url=meus-dados.php?id=$usuario&sucesso=1' />";
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
                    <span> Seus dados foram atualizados com sucesso!</span>
                </div>
            </div>
        </div>';
                        }
                        ?>
                        <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
<?php include_once "../ferramentas/rodape.php"; ?>
            </div>


        </div>

        <!-- Modal esquci senha-->
        <div class="modal" id="alterasenha" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content card-fundo-body">
                    <div class="modal-header header-filtro p-2">
                        <h5 class="modal-title">Alterar Senha</h5>
                        <a href="" data-dismiss="modal" aria-label="Fechar"><i class="fas fa-times text-white"></i></a>
                        </button>
                    </div>
                    <form action="" method="POST" id="FormSenha" name="FormSenha">
                        <div class="modal-body card-fundo-body">
                            <div class="row">
                                <div class="col-12">
                            <p>Por favor, informe abaixo a sua nova senha!</p>
                            <p>Lembre-se, ela precisa conter uma letra <span class="destaque fw-bold">MAIÚSCULA</span>, uma letra <span class="destaque fw-bold">MINÚSCULA</span>, um <span class="destaque fw-bold">NÚMERO</span>, um <span class="destaque fw-bold">CARACTER ESPECIAL</span> e pelo menos <span class="destaque fw-bold">8 DIGÍTOS</span>.</p>
                            <p>Exemplo de Senha: <span class="destaque fw-bold">Fncc@2022</span></p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="password" name="senha_nova" id="senha_nova" class="form-control" placeholder="Insira uma senha" autocomplete="off" minlength="8" maxlength="12" onKeyUp="verificaForcaSenha();" required>
                            <label for="senha_nova"><i class="uil uil-key-skeleton-alt"></i> Nova Senha</label>
                          </div>  
                        </div>
                                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="password" name="senha_nova_confirma" id="senha_nova_confirma" class="form-control" placeholder="Confirme a senha" autocomplete="off" minlength="8" maxlength="12" required>
                            <label for="senha_nova_confirma"><i class="uil uil-key-skeleton-alt"></i> Confirme a Nova Senha</label>
                          </div>  
                        </div>
                                <div class="col-12 mb-1 mt-1">
                                    <span id="password-status"></span>
                                </div>
                            
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-0">
                            <div class="row">
                                <div class="col-12">
                                 <button type="button" class="btn-success btn btn-md" onClick="validarSenha()">Confirmar</button>   
                                </div>
                            </div>
                            

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?php
        if (isset($_POST["senha_nova"])) {
            $novaSenha = md5($_POST["senha_nova"]);
            $atualizaSenha = mysqli_query($conexao, "UPDATE usuarios SET senha = '$novaSenha' WHERE id_usuario = '$usuario'");
            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span> Senha alterada com sucesso!</span>
                </div>
            </div>
        </div>';
        }
        ?>
        <!-- Modal esqueci senha fim -->


        <script>
            $('.pesquisa-select').select2({
                theme: 'bootstrap-5'
            });
        </script>  
        <script>
            window.onload = (event) => {
                var toastLiveExample = document.getElementById('liveToast')
                var toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            }
        </script>

        <script>
            function validarSenha() {
                NovaSenha = document.getElementById('senha_nova').value;
                CNovaSenha = document.getElementById('senha_nova_confirma').value;
                if (NovaSenha != CNovaSenha) {
                    alert("As senhas digitadas não coincidem!\nPor favor, verifique e tente novamente!");
                }else if (NovaSenha == "" && CNovaSenha == "" || NovaSenha != "" && CNovaSenha == ""){
                    alert("Você precisa digitar uma senha para continuar!");
                } else {
                    document.FormSenha.submit();
                }
            }
        </script>

        <script>
            function verificaForcaSenha()
            {
                var numeros = /([0-9])/;
                var alfabeto = /([a-zA-Z])/;
                var chEspeciais = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

                if ($('#senha_nova').val().length < 8)
                {
                    $('#password-status').html("<span style='color:red'>Fraca, insira no mínimo 8 caracteres</span>");
                } else {
                    if ($('#senha_nova').val().match(numeros) && $('#senha_nova').val().match(alfabeto) && $('#senha_nova').val().match(chEspeciais))
                    {
                        $('#password-status').html("<span style='color:green'><b>Senha Forte</b></span>");
                    } else {
                        $('#password-status').html("<span style='color:orange'>Média, insira um caracter especial</span>");
                    }
                }
            }
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
