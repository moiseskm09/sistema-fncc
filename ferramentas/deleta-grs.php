<?php
include_once '../config/conexao.php';
if(isset($_GET['cod_coop'], $_GET['nome_GRS'], $_GET['cod_GRS'], $_GET['grs_bal'])){
    $nome_GRS = $_GET['nome_GRS'];
    $cod_cooperativa = $_GET['cod_coop'];
    $cod_GRS = $_GET['cod_GRS'];
    $grs_bal = $_GET['grs_bal'];
    $local_file = "../arquivos/gerenciamento-riscos/grs_coop_$cod_cooperativa/$nome_GRS";
    unlink($local_file);
    $query = "DELETE FROM gerenciamento_riscos WHERE grs_cod = $cod_GRS";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        $StatusBalancete = mysqli_query($conexao, "UPDATE balancete SET bal_situacao = '1' WHERE cod_balancete = '$grs_bal'");
        if($StatusBalancete == 1){
            header("location: ../sistema/rel-gerenciamento-de-riscos.php?sucesso=1");
        }else{
        header("location: ../sistema/rel-gerenciamento-de-riscos.php?erro=2");
        }
    }else{
        header("location: ../sistema/rel-gerenciamento-de-riscos.php?erro=2");
    }
}else{
    header("location: ../sistema/rel-gerenciamento-de-riscos.php?erro=2");
}