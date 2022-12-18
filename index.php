<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link href="css/login.css" rel="stylesheet" />
    </head>
    <body>

        <div class="container">
            <div class="row align-items-center text-center" style="height: 100vh;">
                <div class="col-lg-6 col-md-6 col-12 mx-auto">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="logo-login mb-2" src="img/logocompleto.png" alt="logo fncc" title="Logo FNCC"/>

                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Utilize os campos abaixo para entrar no sistema.</h6>
                            <form action="ferramentas/login.php" method="POST">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="uil uil-user"></i></span>
                                    <input type="text" name="usuario" class="form-control digitacao" placeholder="Seu Usuário" aria-label="email" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="uil uil-key-skeleton-alt"></i></span>
                                    <input type="password" name="senha" class="form-control digitacao" placeholder="Sua Senha" aria-label="senha" aria-describedby="basic-addon1" required>
                                </div>
                                <button type="submit" class="btn btn-entrar">Entrar</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            <button type="button" class="recupera-senha" data-bs-toggle="modal" data-bs-target="#esquecisenha">Esqueci Minha Senha</button>
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
                    <form action="" method="POST">
                        <div class="modal-body">
                            <p>Por favor, informe abaixo o e-mail cadastrado no sistema, para que possamos enviar uma nova senha de acesso!</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="uil uil-envelope-alt"></i></span>
                                <input type="email" name="email_senha" class="form-control digitacao" placeholder="Seu E-mail" aria-label="email" aria-describedby="basic-addon1" required>
                            </div>

                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn-entrar btn btn-sm">Confirmar</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal esqueci senha fim --> 

        <?php
                    ini_set('display_errors', 0);
                    error_reporting(0);
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
    </body>
</html>
