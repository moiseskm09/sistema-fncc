<?php
include_once '../config/conexao.php';

$usuario = $_GET['id'];

if(isset($usuario)){
    mysqli_query($conexao, "UPDATE usuarios SET u_status = '0' WHERE id_usuario = '$usuario'");
    header("location: ../sistema/cad-usuarios.php?sucesso=2");
}