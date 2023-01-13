<?php
include_once '../config/conexao.php';
if(isset($_GET['cod_coop'], $_GET['nome_ext'], $_GET['cod_ext_capital'])){
    $nome_ext = $_GET['nome_ext'];
    $cod_cooperativa = $_GET['cod_coop'];
    $cod_ext_capital = $_GET['cod_ext_capital'];
    $local_file = "../arquivos/extrato_capital/extrato_coop_$cod_cooperativa/$nome_ext";
    unlink($local_file);
    $query = "DELETE FROM extrato_de_capital WHERE cod_ext_capital = $cod_ext_capital";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/incluir-extrato-capital.php?sucesso=1");
    }else{
        header("location: ../sistema/incluir-extrato-capital.php?erro=1");
    }
}else{
    header("location: ../sistema/incluir-extrato-capital.php?erro=1");
}