<?php
require_once '../config/conexao.php';
require_once '../config/sessao.php';
require_once '../config/config_geral.php';

$data = date('Y-m-d H:i');
$hora = date("H:i");
if(!empty($_SESSION['func_cod'])){
    $funcionario = $_SESSION['func_cod'];
    $sql = "SELECT func_horafinal FROM funcionarios WHERE func_cod = '$funcionario' LIMIT 1";
    $buscainfo = mysqli_query($conexao, $sql);
    $resultadoInfo = mysqli_fetch_assoc($buscainfo);
    $horaSaida = date("s:i", $resultadoInfo["func_horafinal"]);
    if($hora >= $horaSaida){
        header ("Location: ../sistema/pe_encerra.php?func_cod=".$funcionario);
    }else{
       session_start ();
       $EMAIL = $_SESSION['email'];
       $NOME = $_SESSION['nome'];
       session_destroy();
       header ("Location: ../index.php");
    }
}else{
session_start ();
$EMAIL = $_SESSION['email'];
$NOME = $_SESSION['nome'];
session_destroy();
header ("Location: ../index.php");
}