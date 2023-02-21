<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
//require_once '../config/config_geral.php';

if(isset($_POST["data"], $_POST["feriado"], $_POST["feriadoTipo"])){
    $dataFeriado = $_POST["data"];
    $nomeFeriado = $_POST["feriado"];
    $tipoFeriado = $_POST["feriadoTipo"];
    if($_POST["feriadoTipo"] == "Feriado Facultativo"){ $facultativo = 1; }else{ $facultativo = 0; }
    
    $buscaFeriado = mysqli_query($conexao, "SELECT cod_feriado FROM feriados WHERE data = '$dataFeriado'");
    if(mysqli_num_rows($buscaFeriado) > 0 ){
        header("location: ../sistema/feriados.php?erro=3");
    }else{
      $insereFeriado = mysqli_query($conexao, "INSERT INTO feriados (data, feriado, tipo_feriado, facultativo) VALUES ('$dataFeriado', '$nomeFeriado', '$tipoFeriado', '$facultativo')");  
      if($insereFeriado == 1){
        header("location: ../sistema/feriados.php?sucesso=2");
    }else{
        header("location: ../sistema/feriados.php?erro=2");
    }   
    }
}else{
    header("location: ../sistema/feriados.php?erro=2");
}
