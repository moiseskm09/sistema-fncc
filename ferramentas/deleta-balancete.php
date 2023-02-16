<?php
include_once '../config/conexao.php';
if(isset($_GET['cod_coop'], $_GET['nome_bal'], $_GET['cod_bal'])){
    $nome_bal = $_GET['nome_bal'];
    $cod_cooperativa = $_GET['cod_coop'];
    $cod_bal = $_GET['cod_bal'];
    $local_file = "../arquivos/balancete/balancete_coop_$cod_cooperativa/$nome_bal";
    unlink($local_file);
    $query = "DELETE FROM balancete WHERE cod_balancete = $cod_bal";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/balancete.php?sucesso=3");
    }else{
        header("location: ../sistema/balancete.php?erro=3");
    }
}else{
    header("location: ../sistema/balancete.php?erro=3");
}