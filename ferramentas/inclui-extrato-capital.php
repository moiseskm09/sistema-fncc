<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST["cooperativaExtCN"], $_POST["acumuladoExtCN"], $_POST["jurosCapitalExtCN"], $_FILES["arquivoExtCN"])) {
    $cooperativaExtCN = $_POST["cooperativaExtCN"];
    $acumuladoExtCN = $_POST["acumuladoExtCN"];
    $jurosCapitalExtCN = $_POST["jurosCapitalExtCN"];
    $obsExtCN = $_POST["obsExtCN"];
    $arquivoExtCN = $_FILES["arquivoExtCN"];
    $dir = "../arquivos/extrato_capital/extrato_coop_$cooperativaExtCN";
    mkdir($dir, 0777, true);
    $horaInclusao = date("His");
    $tituloExtCN = str_replace('/', '_', $acumuladoExtCN."_".$jurosCapitalExtCN."_".$cooperativaExtCN."_".$horaInclusao);  
    $path = $_FILES['arquivoExtCN']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinal = str_replace(' ', '_', $tituloExtCN) . "." . $ext;  
    
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($arquivoExtCN["tmp_name"], "$dir/" . $nomeFinal)) {
        $queryExtC = "INSERT INTO extrato_de_capital (ext_acumulado, ext_remuneracao_juros, ext_coop, ext_arquivo, ext_obs) VALUES ('$acumuladoExtCN', '$jurosCapitalExtCN', '$cooperativaExtCN', '$nomeFinal', '$obsExtCN')";
        $executaQuery = mysqli_query($conexao, $queryExtC);
        $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('$cooperativaExtCN', 'Novo Ext. Capital', NOW(), 'extrato-capital.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso);
        header("location: ../sistema/incluir-extrato-capital.php?sucesso=2");
    } else {
        header("location: ../sistema/incluir-extrato-capital.php?erro=2");
    }
}         