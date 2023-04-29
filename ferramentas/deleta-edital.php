<?php
include_once '../config/conexao.php';

if(isset($_GET['cod_edital'], $_GET['edital_arquivo'])){
    $edital_arquivo = $_GET['edital_arquivo'];
    $cod_edital = $_GET['cod_edital'];
    $local_file = "../../site-fncc/assets/arquivos/editais/$edital_arquivo";
    unlink($local_file);
    $query = "DELETE FROM site_editais WHERE cod_edital = $cod_edital";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/editais.php?sucesso=2");
    }else{
        header("location: ../sistema/editais.php?erro=2");
    }
}else{
    header("location: ../sistema/editais.php?erro=2");
}