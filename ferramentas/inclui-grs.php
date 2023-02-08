<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST["coop_bal"], $_POST["cod_bal"], $_POST["dataRefIncial"], $_POST["dataRefFinal"], $_FILES["arqGRS"])) {
    $coop_bal = $_POST["coop_bal"];
    $cod_bal = $_POST["cod_bal"];
    $dataRefIncial = $_POST["dataRefIncial"];
    $dataRefFinal = $_POST["dataRefFinal"];
    $arqGRS = $_FILES["arqGRS"];
    
    $dir = "../arquivos/gerenciamento-riscos/grs_coop_$coop_bal";
    mkdir($dir, 0777, true);
    
    $horaInclusao = date("His");
    $tituloGRS = str_replace('/', '_', $dataRefIncial."_".$dataRefFinal."_".$coop_bal."_".$cod_bal."_".$horaInclusao); 
    
    $path = $_FILES['arqGRS']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloGRS) . "." . $ext;  
    
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($arqGRS["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryGRS = "INSERT INTO gerenciamento_riscos (grs_bal, grs_coop, grs_data_inicial, grs_data_final, grs_arquivo) VALUES ('$cod_bal', '$coop_bal', '$dataRefIncial', '$dataRefFinal', '$nomeFinal')";
        $executaQuery = mysqli_query($conexao, $queryGRS);
       $AtualizaBalancete = mysqli_query($conexao, "UPDATE balancete SET bal_situacao = '2' WHERE cod_balancete = '$cod_bal'");
        $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('$coop_bal', 'RELATÓRIO GRS', NOW(), 'rel-gerenciamento-de-riscos.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso);
        header("location: ../sistema/listar-balancete.php?sucesso=1");
    } else {
        header("location: ../sistema/listar-balancete.php?erro=1");
    }
}         