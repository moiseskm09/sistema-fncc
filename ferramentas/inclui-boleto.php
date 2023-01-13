<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';
if (isset($_POST["cooperativaBolN"], $_POST["competenciaBolN"], $_POST["dataVencimentoBolN"], $_FILES["bolN"])) {
    $cooperativaBolN = $_POST["cooperativaBolN"];
    $competenciaBolN = $_POST["competenciaBolN"];
    $dataVencimentoBolN = $_POST["dataVencimentoBolN"];
    $bolN = $_FILES["bolN"];
    $dir = "../arquivos/boletos/boletos_coop_$cooperativaBolN";
    mkdir($dir, 0777, true);
    $horaInclusao = date("His");
    $tituloBol = str_replace('/', '_', $dataVencimentoBolN."_".$competenciaBolN."_".$cooperativaBolN."_".$horaInclusao);  
    $path = $_FILES['bolN']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloBol) . "." . $ext;  
    
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($bolN["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryDoc = "INSERT INTO boletos (bol_competencia, bol_vencimento, arquivo, bol_situacao, bol_coop) VALUES ('$competenciaBolN', '$dataVencimentoBolN', '$nomeFinal', '3', '$cooperativaBolN')";
        $executaQuery = mysqli_query($conexao, $queryDoc);
        header("location: ../sistema/incluir-boleto.php?sucesso=2");
    } else {
        header("location: ../sistema/incluir-boleto.php?erro=2");
    }
}         