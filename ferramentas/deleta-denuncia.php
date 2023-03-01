<?php
include_once '../config/conexao.php';
if(isset($_GET['cod_coop'], $_GET['nome_cdd'], $_GET['cod_denuncia'])){
    $nome_cdd = $_GET['nome_cdd'];
    $cod_cooperativa = $_GET['cod_coop'];
    $cod_denuncia = $_GET['cod_denuncia'];
    $local_file = "../arquivos/canal-de-denuncias/denuncias_coop_$cod_cooperativa/$nome_cdd";
    unlink($local_file);
    $query = "DELETE FROM canal_de_denuncias WHERE cod_denuncia = $cod_denuncia";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/incluir-rel-denuncias.php?sucesso=1");
    }else{
        header("location: ../sistema/incluir-rel-denuncias.php?erro=1");
    }
}else{
    header("location: ../sistema/incluir-rel-denuncias.php?erro=1");
}