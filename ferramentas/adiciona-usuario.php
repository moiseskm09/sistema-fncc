<?php
include_once '../config/conexao.php';
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$cooperativa = $_POST['cooperativa'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$nivel = $_POST['nivel'];
$dataCadastro = date("Y-m-d");
$senha = "90f80b22f53a5d4d72f7b126ef4b1f44";

if(isset ($nome, $sobrenome, $cooperativa, $email, $usuario, $nivel)){
    $query = "INSERT INTO usuarios(nome, sobrenome, email, usuario, senha, user_coop, user_nivel, u_status, data_cadastro) VALUES ('$nome', '$sobrenome', '$email', '$usuario', '$senha', '$cooperativa', '$nivel', '1', '$dataCadastro')";
    $insereUsuario = mysqli_query($conexao, $query);
    $buscaCod = mysqli_query($conexao, "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario' and nome = '$nome' LIMIT 1");
    $resultado = mysqli_fetch_assoc($buscaCod);
    $codUsuario = $resultado['id_usuario'];
 
header("location: ../sistema/cad-usuarios.php?sucesso=1");
}else {
    header("location: ../sistema/cad-usuarios.php?erro=1");
}