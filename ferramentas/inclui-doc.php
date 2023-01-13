<?php
include_once '../config/conexao.php';

if (isset($_POST["categoriaDocN"], $_POST["tituloDocN"], $_FILES["arquivoN"])) {
    $categoria = $_POST["categoriaDocN"];
    $tituloDoc = str_replace('/', '_', $_POST["tituloDocN"]);
    $arquivo = $_FILES["arquivoN"];
    $dir = "../arquivos/modelos_documentos/categoria_$categoria";
    $path = $_FILES['arquivoN']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloDoc) . "." . $ext;
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($arquivo["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryDoc = "INSERT INTO modelos_de_documentos (categoria_documento, titulo_documento, nome_documento) VALUES ('$categoria', '$tituloDoc', '$nomeFinal')";
        $executaQuery = mysqli_query($conexao, $queryDoc);
        //echo $queryDoc;
        //echo "Arquivo enviado com sucesso!";
        header("location: ../sistema/incluir-doc.php?sucesso=1");
    } else {
        header("location: ../sistema/incluir-doc.php?erro=1");
    }
}         