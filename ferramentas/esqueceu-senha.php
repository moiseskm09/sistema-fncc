<?php
date_default_timezone_set('America/Sao_Paulo');
require_once '../config/conexao.php';

if (isset($_POST["usuario_senha"])) {
    $usuario = $_POST["usuario_senha"];
    $buscaUsuario = mysqli_query($conexao, "SELECT nome, email FROM usuarios WHERE usuario = '$usuario' LIMIT 1");
    if(mysqli_num_rows($buscaUsuario) > 0){
        $resultadoUsuario = mysqli_fetch_assoc($buscaUsuario);
        $nomeSolicitante = $resultadoUsuario["nome"];
        $emailSolicitante = $resultadoUsuario["email"];
        $senha = "FNCC@FNCC#123";
        $novaSenha = md5("FNCC@FNCC#123");
        $atualizaSenha = mysqli_query($conexao, "UPDATE usuarios SET senha = '$novaSenha' WHERE usuario = '$usuario'");
        if($atualizaSenha == 1){
            include_once 'email/config_geral_email.php';
            include_once 'email/template/esqueceu-senha.php';
            $mail->AddAddress($emailSolicitante, $nomeSolicitante);
            $enviado = $mail->Send();
          header("location: ../index.php?sucesso=1");
        }else{
            header("location: ../index.php?erro=2");
        }
    }else{
        header("location: ../index.php?erro=2");
    }
}else{
    header("location: ../index.php?erro=2");
}
            