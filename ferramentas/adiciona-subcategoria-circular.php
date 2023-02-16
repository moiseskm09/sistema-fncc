<?php
include_once '../config/conexao.php';
if (isset($_POST['categoriaCircularN'], $_POST['nomeSubCategoriaN'])) {
    $categoriaCircularN = $_POST['categoriaCircularN'];
    $nomeSubCategoriaN = $_POST['nomeSubCategoriaN'];
    $query = "INSERT INTO subcategoria_circulares (subcategoria, id_categoria) VALUES ('$nomeSubCategoriaN', '$categoriaCircularN')";
    $insereCategoria = mysqli_query($conexao, $query);
    if($insereCategoria == 1){
     $buscaCodCategoria = mysqli_query($conexao,"SELECT cod_subcategoria FROM subcategoria_circulares WHERE subcategoria = '$nomeSubCategoriaN' and id_categoria = '$categoriaCircularN' LIMIT 1");
    $resultado = mysqli_fetch_assoc($buscaCodCategoria);
    $codSubCategoria = $resultado["cod_subcategoria"];    
    mkdir("../arquivos/circulares/categoria_$categoriaCircularN/subcategoria_$codSubCategoria", 0777, true);
    header("location: ../sistema/incluir-circular-documento.php?sucesso=3");
    }else{
        header("location: ../sistema/incluir-circular-documento.php?erro=1");
    }  
} else {
    header("location: ../sistema/incluir-circular-documento.php?erro=1");
}