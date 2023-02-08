<?php
date_default_timezone_set('America/Sao_Paulo');
require_once '../config/conexao.php';

if(isset($_POST['usuario'], $_POST['senha'])){   
$emailLogin = $_POST['usuario'];
$senhaLogin = md5($_POST['senha']);   

    $sqlUsuario = mysqli_query($conexao, "SELECT id_usuario, email, senha, nome, sobrenome, user_nivel, logo_coop, user_coop, user_grupo FROM usuarios INNER JOIN cooperativas on user_coop = cod_coop WHERE usuario = '$emailLogin' and senha = '$senhaLogin' and u_status = '1' LIMIT 1");
    $num_linhasUsuario = mysqli_num_rows($sqlUsuario);
    if($num_linhasUsuario == 1){
   // echo "usuario";
        $resultadoUsuario = mysqli_fetch_assoc($sqlUsuario);
	session_start();
	$_SESSION['email']=$resultadoUsuario['email'];
	$_SESSION['senha']=$resultadoUsuario['senha'];
	$_SESSION['nome']=$resultadoUsuario['nome'];
        $_SESSION['user_nivel']=$resultadoUsuario['user_nivel'];
        $_SESSION['CodUser']=$resultadoUsuario['id_usuario'];
        $_SESSION['logo_coop']=$resultadoUsuario['logo_coop'];
        $_SESSION['user_coop']=$resultadoUsuario['user_coop'];
        $_SESSION['user_grupo']=$resultadoUsuario['user_grupo'];
         
        if($_POST['senha'] == "FNCC@FNCC#123"){
            header("Location: ../sistema/altera-senha.php");
        }else{
            if(isset($_POST["cce"])){
            $cce = $_POST["cce"];
            header("Location: ../sistema/edicao-consulta.php?cod_consulta=$cce");
        }else{
            header("Location: ../sistema/home.php");
        }
        }
        
        //fim usuario
        }else{
            //echo "não encontrado";
            header("location: ../index.php?erro=1");
        }
}else{
    //echo "nao preenchido";
    header("location: ../index.php?erro=1");
}

//fim