<?php
date_default_timezone_set('America/Sao_Paulo');
require_once '../config/conexao.php';

if(isset($_POST['usuario'], $_POST['senha'])){   
$emailLogin = $_POST['usuario'];
$senhaLogin = md5($_POST['senha']);   

    $sqlUsuario = mysqli_query($conexao, "SELECT id_usuario, email, senha, nome, sobrenome, user_nivel, logo_coop FROM usuarios INNER JOIN cooperativas on user_coop = cod_coop WHERE usuario = '$emailLogin' and senha = '$senhaLogin' and u_status = '1' LIMIT 1");
    
    //$sqlCredenciado = mysqli_query($conexao, "SELECT cred_id, cred_email, cred_senha, cred_nome, cred_sobrenome, cred_status, cred_nivel FROM credenciados WHERE cred_email = '$emailLogin' and cred_senha = '$senhaLogin' LIMIT 1");
    
   // $sqlFuncionario = mysqli_query($conexao, "SELECT func_cod ,func_email, func_senha, func_nome, func_status, func_credenciado, func_nivel FROM funcionarios WHERE func_email = '$emailLogin' and func_senha = '$senhaLogin' and func_status = '1' LIMIT 1");

    $num_linhasUsuario = mysqli_num_rows($sqlUsuario);
    //$num_linhasCredenciado = mysqli_num_rows($sqlCredenciado);
    //$num_linhasFuncionario = mysqli_num_rows($sqlFuncionario);
    
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
	header("Location: ../sistema/home.php");
        //fim usuario
    }else if($num_linhasCredenciado == 1){
        //echo "credenciado";
        //Bloco credenciado aprovado
        $resultadoCredenciado = mysqli_fetch_assoc($sqlCredenciado);
        $cred_status = $resultadoCredenciado['cred_status'];
        if($cred_status == 1){
        session_start();
	$_SESSION['email']=$resultadoCredenciado['cred_email'];
	$_SESSION['senha']=$resultadoCredenciado['cred_senha'];
	$_SESSION['nome']=$resultadoCredenciado['cred_nome'];
        $_SESSION['user_nivel']=$resultadoCredenciado['cred_nivel'];
        $_SESSION['cred_id']=$resultadoCredenciado['cred_id'];
        $_SESSION['CodUser']=$resultadoCredenciado['cred_id'];
        
       
        //bloco primeiro acesso
        if($_POST['senha'] == "Mudar@123"){
            header("Location: primeiroLogin.php?cred_id=".$_SESSION['cred_id']);
        }else{
	header("Location: ../sistema/home_credenciado.php");
        }
    }else{
        //credenciado ainda não aprovado
        header("location: ../index.php?erro=4");
    }
        //fim bloco credenciado aprovado
        //fim credenciado
        }else if($num_linhasFuncionario == 1){
            //echo "funcionario";
        $resultadoFuncionario = mysqli_fetch_assoc($sqlFuncionario);
        session_start();
        $_SESSION['email']=$resultadoFuncionario['func_email'];
	$_SESSION['senha']=$resultadoFuncionario['func_senha'];
	$_SESSION['nome']=$resultadoFuncionario['func_nome'];
        $_SESSION['user_nivel']=$resultadoFuncionario['func_nivel'];
        $_SESSION['cred_id']=$resultadoFuncionario['func_credenciado'];
        $_SESSION['func_cod']=$resultadoFuncionario['func_cod'];
        $_SESSION['CodUser']=$resultadoFuncionario['func_cod'];
        //bloco primeiro acesso
        if($_POST['senha'] == "Mudar@123"){
            header("Location: primeiroLogin.php?func_cod=".$_SESSION['func_cod']);
        }else{
            // Aqui vai o ponto eletronico
            $HOJE = date("Y-m-d");
            $sqlPonto = mysqli_query($conexao, "SELECT * FROM ponto_eletronico WHERE pe_data = '$HOJE' and pe_evento = 'Entrada' LIMIT 1");
            if(mysqli_num_rows($sqlPonto) > 0){
                header("Location: ../sistema/home_credenciado.php");
            }else{
                header("Location: ../sistema/ponto_eletronico.php?func_cod=".$_SESSION['func_cod']);
            }
            //fim ponto eletronico
        }
	
            //fim funcionário
        }else{
            //echo "não encontrado";
            header("location: ../index.php?erro=1");
        }
}else{
    //echo "nao preenchido";
    header("location: ../index.php?erro=1");
}

//fim