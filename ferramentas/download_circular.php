<?php
if (isset($_GET['cod_categoria'], $_GET['cod_subcategoria'], $_GET['nome_doc'], $_GET['cod_doc'], $_GET['cod_user'])) {
    $cod_categoria = $_GET['cod_categoria'];
    $cod_subcategoria = $_GET['cod_subcategoria'];
    $cod_doc = $_GET['cod_doc'];
    $cod_user = $_GET['cod_user'];
    $nome_doc = $_GET['nome_doc'];
    $local_file = "../arquivos/circulares/categoria_$cod_categoria/subcategoria_$cod_subcategoria/$nome_doc";

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
        header("location: ../sistema/rel-gerenciamento-de-riscos.php?erro=1");
    }
}