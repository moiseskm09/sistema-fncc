<?php
include_once '../config/conexao.php';
if(isset($_GET['cod_coop'], $_GET['nome_bol'], $_GET['cod_bol'])){
    $nome_bol = $_GET['nome_bol'];
    $cod_cooperativa = $_GET['cod_coop'];
    $cod_bol = $_GET['cod_bol'];
    $local_file = "../arquivos/boletos/boletos_coop_$cod_cooperativa/$nome_bol";
    unlink($local_file);
    $query = "DELETE FROM boletos WHERE cod_boleto = $cod_bol";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/incluir-boleto.php?sucesso=3");
    }else{
        header("location: ../sistema/incluir-boleto.php?erro=3");
    }
}else{
    header("location: ../sistema/incluir-boleto.php?erro=3");
}