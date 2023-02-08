<?php 
session_start();
session_regenerate_id();
if (!isset($_SESSION["email"]) || !isset ($_SESSION["nome"]) || !isset ($_SESSION["user_nivel"])) {
} else {
    if(isset($_GET["cce"])){
        $cce = $_GET["cce"];
            header("Location: sistema/edicao-consulta.php?cod_consulta=$cce");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" sizes="512x512" href="img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/fncc-logotipo-colorido.png">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link href="css/login.css" rel="stylesheet" />
        <link rel="manifest" href="manifest.json">
    </head>
    <body>
        <div class="container">
            <div class="row align-items-center text-center" style="height: 100vh;">                   
                <div class="col-lg-8 col-md-8 col-12 mx-auto">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="row align-items-center text-center">
                                <div class="col-md-6 col-12">
                                    <img class="logo-login mb-2" src="img/AVATAR-02.png" alt="logo fncc" title="Logo FNCC"/></div>
                                    <div class="col-md-6 col-12">
                                <h6 class="mb-2 text-white">Utilize os campos abaixo para entrar no sistema.</h6>
                            <form action="ferramentas/login.php" method="POST">
                                <div class="form-floating mb-3">
                <input type="text" name="usuario" class="form-control digitacao" id="usuario" placeholder="Seu Usuário" required>
                <label for="usuario"><i class="uil uil-user"></i> Usuário</label>
              </div>
                                
                                <div class="form-floating mb-3">
                <input type="password" name="senha" class="form-control digitacao" id="senha" placeholder="Sua Senha" required>
                <label for="senha"><i class="bi bi-key"></i> Senha</label>
              </div>
                                <!-- cod-consulta caso tenha-->
                                <?php 
                                if(isset($_GET["cce"])){
                                    ?>
                                <input type="hidden" name="cce" class="form-control digitacao" value="<?php echo $_GET["cce"];?>">
                                <?php
                                }
                                ?>
                                <!-- cod-consulta caso tenha-->
                                <button type="submit" class="btn btn-entrar">Entrar</button>
                            </form>
                                <button type="button" class="recupera-senha mt-2 mb-2 text-white" data-bs-toggle="modal" data-bs-target="#esquecisenha">Esqueceu a senha? Clique aqui!</button>
                            </div>
                                </div>
                            
                            </div>
                    </div>
                </div>
            <footer class="py-1 mt-auto rodape fixed-bottom ">
                <div class="container-fluid">
                    <div class="text-center small">
                        <div class="text-muted">Copyright &copy; <span style="color: #1c1d3c; font-weight: 600;">be<span style="color:#ffd700">M</span>K</span> - <?php echo date("Y"); ?></div>

                    </div>
                </div>
            </footer>
        </div>


        <!-- Modal esquci senha-->
        <div class="modal" id="esquecisenha" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-light">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white">Esqueci minha senha</h5>
                        <a href="" data-dismiss="modal" aria-label="Fechar"><i class="fas fa-times text-white"></i></a>
                        </button>
                    </div>
                    <form action="ferramentas/esqueceu-senha.php" method="POST">
                        <div class="modal-body">
                            <p>Por favor, informe abaixo o usuário cadastrado no sistema, para que possamos enviar uma nova senha de acesso!</p>
                            <div class="form-floating mb-1">
                <input type="text" name="usuario_senha" class="form-control digitacao" id="usuario_senha" placeholder="Seu Usuário" required>
                <label for="usuario_senha"><i class="uil uil-user"></i> Seu Usuário</label>
              </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn-entrar btn btn-sm btnalterasenha">Confirmar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal esqueci senha fim --> 
        
        <?php include_once "ferramentas/modal_loading.php"; ?>
        
        

        <?php
        if(isset($_GET["erro"])){            
        $erro = (int) $_GET["erro"];
                                        if ($erro === 1) {
                        echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span> Usuário ou senha inválidos!</span>
                </div>
            </div>
        </div>'; 
                    }elseif($erro === 2){
                        echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Não foi possível alterar a senha!</span>
                </div>
            </div>
        </div>'; 
                    }
        }
        
        if(isset($_GET["sucesso"])){            
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
                    <span>Senha enviada para o email de cadastro!</span>
                </div>
            </div>
        </div>';
                    }
        }
                    ?>
        
        
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <!-- JavaScript Bundle with Popper -->

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
window.onload = (event) => {
  let myAlert = document.querySelectorAll('.toast')[0];
  if (myAlert) {
    let bsAlert = new bootstrap.Toast(myAlert);
    bsAlert.show();
  }
};
</script>
<script src="js/loading.js"></script>
    </body>
</html>
