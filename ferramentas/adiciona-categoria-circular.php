<?php
include_once '../config/conexao.php';
if (isset($_POST['nomeCategoriaN'])) {
    $nomeCategoriaN = $_POST['nomeCategoriaN'];
    $query = "INSERT INTO categoria_circulares (categoria) VALUES ('$nomeCategoriaN')";
    $insereCategoria = mysqli_query($conexao, $query);
    if($insereCategoria == 1){
     $buscaCodCategoria = mysqli_query($conexao,"SELECT cod_categoria FROM categoria_circulares WHERE categoria = '$nomeCategoriaN' LIMIT 1");
    $resultado = mysqli_fetch_assoc($buscaCodCategoria);
    $codCategoria = $resultado["cod_categoria"];    
    mkdir("../arquivos/circulares/categoria_$codCategoria", 0777, true);
    header("location: ../sistema/incluir-circular-documento.php?sucesso=3");
    }else{
        header("location: ../sistema/incluir-circular-documento.php?erro=1");
    }  
} else {
    header("location: ../sistema/incluir-circular-documento.php?erro=1");
}