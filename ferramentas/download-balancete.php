<?php
if (isset($_GET['cod_coop'], $_GET['nome_bal'])) {
    $cod_cooperativa = $_GET['cod_coop'];
    $nome_balancete = $_GET['nome_bal'];
    $local_file = "../arquivos/balancete/balancete_coop_$cod_cooperativa/$nome_balancete";

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
        header("location: ../sistema/balancete.php?erro=1");
    }
}