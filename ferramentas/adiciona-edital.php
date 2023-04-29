<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST["cooperativaEdital"], $_FILES["arquivoEdital"])) {
    $cooperativaEdital = $_POST["cooperativaEdital"];
    $arquivoEdital = $_FILES["arquivoEdital"];
    $dir = "../../site-fncc/assets/arquivos/editais";
    mkdir($dir, 0777, true);
    $horaInclusao = date("His");
    $dataInclusao = date("Ymd");
    $tituloEdital = str_replace('/', '_', "Edital_".$dataInclusao."_".$cooperativaEdital."_".$horaInclusao);  
    $path = $_FILES['arquivoEdital']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloEdital) . "." . $ext;  
    
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($arquivoEdital["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryExtC = "INSERT INTO site_editais (edital_arquivo, edital_data, edital_coop) VALUES ('$nomeFinal', NOW(), '$cooperativaEdital')";
        $executaQuery = mysqli_query($conexao, $queryExtC);
        //$queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('$cooperativaCDD', 'Rel. Denúncia', NOW(), 'rel-canaldenuncias.php')";
        //$executaAviso = mysqli_query($conexao, $queryAviso);
        header("location: ../sistema/editais.php?sucesso=1");
    } else {
        header("location: ../sistema/editais.php?erro=1");
    }
}         