<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if(isset($_GET["cod_feriado"])){
    $codFeriado = $_GET["cod_feriado"];
    $ExcluiFeriado = mysqli_query($conexao, "DELETE FROM feriados WHERE cod_feriado = '$codFeriado'");
    if($ExcluiFeriado == 1){
        header("location: ../sistema/feriados.php?sucesso=3");
    }else{
        header("location: ../sistema/feriados.php?erro=4");
    }
}else{
    header("location: ../sistema/feriados.php?erro=4");
}
