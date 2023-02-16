<?php

include_once '../config/sessao.php';
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST["dataJustificativa"], $_POST["motivoJustificativa"])) {

    $dataJustificativa = $_POST["dataJustificativa"];
    $motivoJustificativa = $_POST["motivoJustificativa"];
    $arquivoJustificativa = $_FILES["arquivoJustificativa"];

    if ($_FILES['arquivoJustificativa']['size'] > 0) {
        $dir = "../arquivos/justificativa_ponto";
        $horaInclusao = date("His");
        $tituloJustificativa = str_replace('/', '_', $dataJustificativa . "_" . $motivoJustificativa . "_" . $horaInclusao);
        $path = $_FILES['arquivoJustificativa']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $nomeFinal = str_replace(' ', '_', $tituloJustificativa) . "." . $ext;
        if (move_uploaded_file($arquivoJustificativa["tmp_name"], "$dir/" . $nomeFinal)) {
            $justificativa = mysqli_query($conexao, "INSERT INTO justificativa_ponto (just_dia, just_motivo, just_arquivo, just_user) VALUES ('$dataJustificativa', '$motivoJustificativa', '$nomeFinal', '$CODIGOUSUARIO')");
            $atualizaPonto = mysqli_query($conexao, "UPDATE controle_de_ponto SET ponto_justificado = '1' WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia = '$dataJustificativa'");
            header("location: ../sistema/controle-ponto.php?sucesso=5");
        } else {
            // não consegui salvar o arquivo, não executa salva banco, volta pra tela com erro
            header("location: ../sistema/controle-ponto.php?erro=6");
        }
    } else {
        //quando não tiver anexo só faz a inclusão da justificativa
        $justificativa = mysqli_query($conexao, "INSERT INTO justificativa_ponto (just_dia, just_motivo, just_user) VALUES ('$dataJustificativa', '$motivoJustificativa', '$CODIGOUSUARIO')");
        $atualizaPonto = mysqli_query($conexao, "UPDATE controle_de_ponto SET ponto_justificado = '1' WHERE ponto_user = '$CODIGOUSUARIO' and ponto_dia = '$dataJustificativa'");
        header("location: ../sistema/controle-ponto.php?sucesso=5");
    }
} else {
    //dados não preenchidos
    header("location: ../sistema/controle-ponto.php?erro=1");
}