<?php
include_once '../config/conexao.php';

if (isset($_GET['cod_categoria'], $_GET['nome_doc'], $_GET['cod_user'], $_GET['cod_doc'])) {
    $cod_categoria = $_GET['cod_categoria'];
    $nome_doc = $_GET['nome_doc'];
    $cod_user = $_GET['cod_user'];
    $cod_doc = $_GET['cod_doc'];
    
    $termoAceito = mysqli_query($conexao, "INSERT INTO download_termo_aceito (dta_user, dta_arquivo, dta_cod_arquivo, dta_data) VALUES ('$cod_user', '$nome_doc', '$cod_doc', NOW())");
    if($termoAceito == 1){
    $local_file = "../arquivos/modelos_documentos/categoria_$cod_categoria/$nome_doc";

//set the download rate limit (=> 20,5 kb/s)
    $download_rate = 5000;
    if (file_exists($local_file) && is_file($local_file)) {
        header('Cache-control: private');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($local_file));
        header('Content-Disposition: filename=' . $local_file);

        flush();
        $file = fopen($local_file, "r");
        while (!feof($file)) {
            // send the current file part to the browser
            print fread($file, round($download_rate * 1024));
            // flush the content to the browser
            flush();
            // sleep one second
            sleep(1);
        }
        fclose($file);
    } else {
        die('Erro: O arquivo ' . $local_file . ' não existe!');
    }
}
}else{
    die('Erro: O arquivo ' . $local_file . ' não existe!');
}