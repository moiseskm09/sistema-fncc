<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';
if (isset($_POST["cod_coopUser"], $_POST["dataRefIncial"], $_POST["dataRefFinal"], $_FILES["balN"])) {
    $cod_coopUser = $_POST["cod_coopUser"];
    $dataRefIncial = $_POST["dataRefIncial"];
    $dataRefFinal = $_POST["dataRefFinal"];
    $balN = $_FILES["balN"];
    $dir = "../arquivos/balancete/balancete_coop_$cod_coopUser";
    mkdir($dir, 0777, true);
    $horaInclusao = date("His");
    $tituloBal = str_replace('/', '_', $dataRefIncial."_".$dataRefFinal."_".$cod_coopUser."_".$horaInclusao);  
    $path = $_FILES['balN']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloBal) . "." . $ext;  
    
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($balN["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryBal = "INSERT INTO balancete (bal_ref_inicial, bal_ref_final, bal_arquivo, bal_coop) VALUES ('$dataRefIncial', '$dataRefFinal', '$nomeFinal', '$cod_coopUser')";
        $executaQuery = mysqli_query($conexao, $queryBal);
        $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('57', 'Novo Balancete', NOW(), 'listar-balancete.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso);
        header("location: ../sistema/balancete.php?sucesso=2");
    } else {
        header("location: ../sistema/balancete.php?erro=2");
    }
}         