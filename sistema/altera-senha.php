<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Alterar senha</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link href="../css/altera_senha.css" rel="stylesheet" />
        <link rel="manifest" href="../manifest.json">
    </head>
    <body>
        <div class="container">
            <div class="row align-items-center text-center" style="height: 100vh;">                   
                <div class="col-lg-8 col-md-8 col-12 mx-auto">
                    <img class="mb-2" src="../img/logofncc.png" alt="logo altera senha" title="Alterar Senha" style="height: 100px;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="row align-items-center text-center">
                                <div class="col-md-6 col-12">
                                    <img class="logo-login mb-2" src="../img/icones/icone_altera_senha.png" alt="logo altera senha" title="Alterar Senha"/></div>
                                    <div class="col-md-6 col-12">
                                        
                                <h6 class="mb-2 text-white">Você precisa alterar sua senha de acesso para continuar.</h6>
                            <form action="../ferramentas/alteraSenhaLogin.php" method="POST" name="FormSenha" id="FormSenha">
                                <div class="form-floating mb-3">
                 <input type="password" name="senha" class="form-control digitacao" id="senha" placeholder="Sua Senha" required minlength="8" maxlength="12" onKeyUp="verificaForcaSenha();" >
                <label for="senha"><i class="bi bi-key"></i> Senha</label>
              </div>
                                
                                <div class="form-floating mb-3">
                <input type="password" name="senhaC" class="form-control digitacao" id="senhaC" placeholder="Confirme a senha" minlength="8" maxlength="12" required>
                <label for="senhaC"><i class="bi bi-key"></i> Confirme a senha</label>
              </div>
                               
                               
                                <button type="submit" class="btn btn-entrar" onClick="validarSenha()">Alterar Senha</button>
                            </form>
                                <div class="mt-1 mb-1">
                                <span id="password-status"></span>
                                </div>
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
            
        
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
            function validarSenha() {
                NovaSenha = document.getElementById('senha').value;
                CNovaSenha = document.getElementById('senhaC').value;
                if (NovaSenha != CNovaSenha) {
                    alert("As senhas digitadas não coincidem!\nPor favor, verifique e tente novamente!");
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

                if ($('#senha').val().length < 8)
                {
                    $('#password-status').html("<span style='color:red'>Fraca, insira no mínimo 8 caracteres</span>");
                } else {
                    if ($('#senha').val().match(numeros) && $('#senha').val().match(alfabeto) && $('#senha').val().match(chEspeciais))
                    {
                        $('#password-status').html("<span style='color:green'><b>Senha Forte</b></span>");
                    } else {
                        $('#password-status').html("<span style='color:orange'>Média, insira um caracter especial</span>");
                    }
                }
            }
        </script>
    </body>
</html>
