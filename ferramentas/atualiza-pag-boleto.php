<?php
include_once '../config/conexao.php';

if(isset($_GET['cod_coop'] , $_GET['cod_boleto'])){
    $cooperativa = $_GET['cod_coop'];
    $cod_boleto = $_GET['cod_boleto'];
    $query = "UPDATE boletos SET bol_situacao = 2 WHERE cod_boleto = '$cod_boleto' and bol_coop = '$cooperativa'";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/meus-boletos.php?sucesso=1");
    }else{
        header("location: ../sistema/meus-boletos.php?erro=1");
    }
}else{
    header("location: ../sistema/meus-boletos.php?erro=1");
}