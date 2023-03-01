<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST["cooperativaCDD"], $_POST["periodo"], $_FILES["arquivoCDD"])) {
    $cooperativaCDD = $_POST["cooperativaCDD"];
    $periodo = $_POST["periodo"];
    $arquivoCDD = $_FILES["arquivoCDD"];
    $dir = "../arquivos/canal-de-denuncias/denuncias_coop_$cooperativaCDD";
    mkdir($dir, 0777, true);
    $horaInclusao = date("His");
    $dataInclusao = date("Ymd");
    $tituloCDD = str_replace('/', '_', $periodo."_".$dataInclusao."_".$cooperativaCDD."_".$horaInclusao);  
    $path = $_FILES['arquivoCDD']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloCDD) . "." . $ext;  
    
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($arquivoCDD["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryExtC = "INSERT INTO canal_de_denuncias (cdd_periodo, cdd_coop, cdd_arquivo) VALUES ('$periodo', '$cooperativaCDD', '$nomeFinal')";
        $executaQuery = mysqli_query($conexao, $queryExtC);
        $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('$cooperativaCDD', 'Novo Rel. Denúncia', NOW(), 'rel-canaldenuncias.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso);
        header("location: ../sistema/incluir-rel-denuncias.php?sucesso=2");
    } else {
        header("location: ../sistema/incluir-rel-denuncias.php?erro=2");
    }
}         