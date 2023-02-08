<?php
include_once '../config/conexao.php';

if(isset($_GET['cod_categoria'] , $_GET['cod_subcategoria'], $_GET['nome_doc'], $_GET['cod_doc'])){
    $cod_categoria = $_GET['cod_categoria'];
    $cod_subcategoria = $_GET['cod_subcategoria'];
    $cod_doc = $_GET['cod_doc'];
    $nome_doc = $_GET['nome_doc'];
    $local_file = "../arquivos/circulares/categoria_$cod_categoria/subcategoria_$cod_subcategoria/$nome_doc";
    unlink($local_file);
    $query = "DELETE FROM documentos_circulares WHERE cod_docc = $cod_doc";
    $executaQuery = mysqli_query($conexao, $query);
    if($executaQuery == 1){
        header("location: ../sistema/incluir-circular-documento.php?sucesso=2");
    }else{
        header("location: ../sistema/incluir-circular-documento.php?erro=1");
    }
}else{
    header("location: ../sistema/incluir-circular-documento.php?erro=1");
}