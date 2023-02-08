<?php
include_once '../config/conexao.php';
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$cooperativa = $_POST['cooperativa'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$nivel = $_POST['nivel'];
$grupo = $_POST['grupo'];
$dataCadastro = date("Y-m-d");
$senha = "FNCC@FNCC#123";
$senhaCrip = md5("FNCC@FNCC#123");

if(isset ($nome, $sobrenome, $cooperativa, $email, $usuario, $nivel, $grupo)){
    $buscaUser = mysqli_query($conexao, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if(mysqli_num_rows($buscaUser) > 0 ){
        header("location: ../sistema/cad-usuarios.php?erro=2");
    }else{
    $query = "INSERT INTO usuarios(nome, sobrenome, email, usuario, senha, user_coop, user_nivel, user_grupo, u_status, data_cadastro) VALUES ('$nome', '$sobrenome', '$email', '$usuario', '$senhaCrip', '$cooperativa', '$nivel', '$grupo' ,'1', '$dataCadastro')";
    $insereUsuario = mysqli_query($conexao, $query);
if($insereUsuario == 1){
     /* Envia email para os responsaveis da area depois da abertura da consulta */
    include_once 'email/config_geral_email.php';
    include_once 'email/template/cad_usuarios.php';
    $mail->AddAddress($email, $nome);
    $enviado = $mail->Send();
    /* Fim Envia email para os responsaveis da area depois da abertura da consulta */
    header("location: ../sistema/cad-usuarios.php?sucesso=1");
}else{
    header("location: ../sistema/cad-usuarios.php?erro=3");
}
    }
}else {
    header("location: ../sistema/cad-usuarios.php?erro=1");
}