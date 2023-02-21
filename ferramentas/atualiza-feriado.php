<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if(isset($_POST["cod_feriado"], $_POST["dataRefIncial"], $_POST["nomeFeriado"], $_POST["tipoFeriado"])){
    $dataFeriado = $_POST["dataRefIncial"];
    $nomeFeriado = $_POST["nomeFeriado"];
    $tipoFeriado = $_POST["tipoFeriado"];
    $codFeriado = $_POST["cod_feriado"];
    if($_POST["tipoFeriado"] == "Feriado Facultativo"){ $facultativo = 1; }else{ $facultativo = 0; }
    
    $atualizaFeriado = mysqli_query($conexao, "UPDATE feriados SET data = '$dataFeriado', feriado = '$nomeFeriado', tipo_feriado = '$tipoFeriado', facultativo = '$facultativo' WHERE cod_feriado = '$codFeriado'");
    if($atualizaFeriado == 1){
        header("location: ../sistema/feriados.php?sucesso=1");
    }else{
        header("location: ../sistema/feriados.php?erro=1");
    }
}else{
    header("location: ../sistema/feriados.php?erro=1");
}
