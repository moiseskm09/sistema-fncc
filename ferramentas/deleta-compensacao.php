<?php

require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET["codUsuarioComp"], $_GET["dataCompensacao"])) {
    $codUsuarioComp = $_GET["codUsuarioComp"];
    $dataCompensacao = $_GET["dataCompensacao"];

    $buscaCompensacao = mysqli_query($conexao, "SELECT * FROM compensacao WHERE comp_dia = '$dataCompensacao' and comp_user = '$codUsuarioComp'");

    if (mysqli_num_rows($buscaCompensacao) > 0) {
        $resultadoCompensacao = mysqli_fetch_assoc($buscaCompensacao);

        if ($resultadoCompensacao["comp_tipo"] == "compensação") {
            $excluiCompensacao = mysqli_query($conexao, "DELETE FROM compensacao WHERE comp_dia = '$dataCompensacao' and comp_user = '$codUsuarioComp'");
            $atualizaPonto = mysqli_query($conexao, "UPDATE controle_de_ponto SET horas_compensadas = '0' WHERE ponto_dia = '$dataCompensacao' and ponto_user = '$codUsuarioComp'");
            if ($excluiCompensacao == 1) {
                header("location: ../sistema/compensacao.php?sucesso=2&cod_user=$codUsuarioComp");
            } else {
                header("location: ../sistema/compensacao.php?erro=2&cod_user=$codUsuarioComp");
            }
        } elseif ($resultadoCompensacao["comp_tipo"] == "folga") {
            $excluiCompensacao = mysqli_query($conexao, "DELETE FROM compensacao WHERE comp_dia = '$dataCompensacao' and comp_user = '$codUsuarioComp'");
            $deletaPonto = mysqli_query($conexao, "DELETE FROM controle_de_ponto WHERE ponto_dia = '$dataCompensacao' and ponto_user = '$codUsuarioComp'");
            if ($excluiCompensacao == 1) {
                header("location: ../sistema/compensacao.php?sucesso=2&cod_user=$codUsuarioComp");
            } else {
                header("location: ../sistema/compensacao.php?erro=2&cod_user=$codUsuarioComp");
            }
        } elseif ($resultadoCompensacao["comp_tipo"] == "pago") {
            $excluiCompensacao = mysqli_query($conexao, "DELETE FROM compensacao WHERE comp_dia = '$dataCompensacao' and comp_user = '$codUsuarioComp'");
            if ($excluiCompensacao == 1) {
                header("location: ../sistema/compensacao.php?sucesso=2&cod_user=$codUsuarioComp");
            } else {
                header("location: ../sistema/compensacao.php?erro=2&cod_user=$codUsuarioComp");
            }
        }
    } else {
        header("location: ../sistema/compensacao.php?erro=2&cod_user=$codUsuarioComp");
    }
} else {
    header("location: ../sistema/compensacao.php?erro=2&cod_user=$codUsuarioComp");
}