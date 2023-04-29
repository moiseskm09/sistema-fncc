<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if(isset($_GET["id"])){
    $id_usuario = $_GET["id"];
    $AceitaLGPD = mysqli_query($conexao, "UPDATE usuarios SET lgpd = 1 WHERE id_usuario = '$id_usuario'");
    if($AceitaLGPD == 1){
        header("location: ../sistema/home.php");
    }else{
        header("location: ../sistema/home.php");
    }
}else{
    header("location: ../sistema/home.php");
}
