<?php
include_once '../config/conexao.php';

if (isset($_POST["categoriaCircularN"], $_POST["subcategoriaCircularN"], $_POST["tituloCircularN"], $_FILES["arquivoCircularN"])) {
    $categoriaCircularN = $_POST["categoriaCircularN"];
    $subcategoriaCircularN = $_POST["subcategoriaCircularN"];
    $tituloCircularN = str_replace('/', '_', $_POST["tituloCircularN"]);
    $arquivoCircularN = $_FILES["arquivoCircularN"];
    
    $dir = "../arquivos/circulares/categoria_$categoriaCircularN/subcategoria_$subcategoriaCircularN/";
    
    $path = $_FILES['arquivoCircularN']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloCircularN) . "." . $ext;
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($arquivoCircularN["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryDoc = "INSERT INTO documentos_circulares (docc_categoria, docc_subcategoria, docc_titulo, docc_arquivo) VALUES ('$categoriaCircularN', '$subcategoriaCircularN', '$tituloCircularN', '$nomeFinal')";
        $executaQuery = mysqli_query($conexao, $queryDoc);
        $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('0', 'Nova Circular', NOW(), 'circulares-documentos.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso);
        header("location: ../sistema/incluir-circular-documento.php?sucesso=1");
    } else {
       header("location: ../sistema/incluir-circular-documento.php?erro=1");
    }
}    