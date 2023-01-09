<?php
include_once '../config/conexao.php';
if(isset($_GET['cod_categoria'] , $_GET['nome_doc'], $_GET['cod_doc'])){
    $cod_categoria = $_GET['cod_categoria'];
    $cod_doc = $_GET['cod_doc'];
    $nome_doc = $_GET['nome_doc'];
    $local_file = "../arquivos/modelos_documentos/categoria_$cod_categoria/$nome_doc";
    unlink($local_file);
    $query = "DELETE FROM modelos_de_documentos WHERE cod_documento = $cod_doc";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/incluir-doc.php?sucesso=2");
    }else{
        header("location: ../sistema/incluir-doc.php?erro=1");
    }
}else{
    header("location: ../sistema/incluir-doc.php?erro=1");
}