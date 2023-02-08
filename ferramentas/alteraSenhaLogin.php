<?php
include_once '../config/sessao.php';
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST["senha"], $_POST["senhaC"], $CODIGOUSUARIO)) {
            $novaSenha = md5($_POST["senha"]);
            $atualizaSenha = mysqli_query($conexao, "UPDATE usuarios SET senha = '$novaSenha' WHERE id_usuario = '$CODIGOUSUARIO'");
            header("Location: ../sistema/home.php");
}else{
    header("Location: ../index.php");
}