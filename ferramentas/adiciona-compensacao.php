<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_POST["codUsuarioComp"], $_POST["dataCompensacao"], $_POST["horasCompensadas"], $_POST["tipoCompensacao"])) {
    $codUsuarioComp = $_POST["codUsuarioComp"];
    $dataCompensacao = $_POST["dataCompensacao"];
    $horasCompensadas = $_POST["horasCompensadas"];
    $tipoCompensacao = $_POST["tipoCompensacao"];
    
    if($tipoCompensacao == "pago"){
        $insereCompensacao = mysqli_query($conexao, "INSERT INTO compensacao (comp_dia, comp_hora, comp_user, comp_tipo) VALUES ('$dataCompensacao', '$horasCompensadas', '$codUsuarioComp', '$tipoCompensacao')");
    if($insereCompensacao == 1){
        header("location: ../sistema/compensacao.php?sucesso=1&cod_user=$codUsuarioComp");
    }else{
        header("location: ../sistema/compensacao.php?erro=1&cod_user=$codUsuarioComp");
    }
        
    }elseif($tipoCompensacao == "compensação"){
     $atualizaPonto = mysqli_query($conexao, "UPDATE controle_de_ponto SET horas_compensadas = '1' WHERE ponto_dia = '$dataCompensacao' and ponto_user = '$codUsuarioComp'");
     $insereCompensacao = mysqli_query($conexao, "INSERT INTO compensacao (comp_dia, comp_hora, comp_user, comp_tipo) VALUES ('$dataCompensacao', '$horasCompensadas', '$codUsuarioComp', '$tipoCompensacao')");   
     if($insereCompensacao == 1){
        header("location: ../sistema/compensacao.php?sucesso=1&cod_user=$codUsuarioComp");
    }else{
        header("location: ../sistema/compensacao.php?erro=1&cod_user=$codUsuarioComp");
    }
     
    }elseif($tipoCompensacao == "folga"){
      $atualizaPonto = mysqli_query($conexao, "INSERT INTO controle_de_ponto (ponto_user, ponto_dia, ponto_hora_executada, horas_compensadas) VALUES ('$codUsuarioComp', '$dataCompensacao', '$horasCompensadas', '1')");
     $insereCompensacao = mysqli_query($conexao, "INSERT INTO compensacao (comp_dia, comp_hora, comp_user, comp_tipo) VALUES ('$dataCompensacao', '$horasCompensadas', '$codUsuarioComp', '$tipoCompensacao')");   
     if($insereCompensacao == 1){
        header("location: ../sistema/compensacao.php?sucesso=1&cod_user=$codUsuarioComp");
    }else{
        header("location: ../sistema/compensacao.php?erro=1&cod_user=$codUsuarioComp");
    }  
    }
}else{
    header("location: ../sistema/compensacao.php?erro=1&cod_user=$codUsuarioComp");
}
    