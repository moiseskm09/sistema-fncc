<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if(isset($_GET["cod_just"], $_GET["justificativa"], $_GET["cod_ponto"], $_GET["cod_user"], $_GET["data_inicial"], $_GET["data_final"])){
        $cod_just = $_GET["cod_just"];
        $justificativa = $_GET["justificativa"];
        $cod_ponto = $_GET["cod_ponto"];
        $cod_user = $_GET["cod_user"];
        $dataInicial = $_GET["data_inicial"];
        $dataFinal = $_GET["data_final"];
        if($justificativa == "aprovada"){
            $just_situacao = 2;
            $ponto_justificativa_aprovada = 1;
        }else{
            $just_situacao = 1;
            $ponto_justificativa_aprovada = 0;
        }
        $atualizaJustificativa = mysqli_query($conexao, "UPDATE justificativa_ponto SET just_situacao = '$just_situacao' WHERE cod_just = '$cod_just'");
        $atualizaPonto = mysqli_query($conexao, "UPDATE controle_de_ponto SET ponto_justificativa_aprovada = '$ponto_justificativa_aprovada' WHERE cod_ponto = '$cod_ponto'");
       if($atualizaJustificativa == 1 && $atualizaPonto == 1){
           header("location: ../sistema/justificativa-de-ponto.php?sucesso=1&pessoa=$cod_user&dataRefIncialF=$dataInicial&dataRefFinalF=$dataFinal");
       }else{
           header("location: ../sistema/justificativa-de-ponto.php?erro=1&pessoa=$cod_user&dataRefIncialF=$dataInicial&dataRefFinalF=$dataFinal");
       }
        }else{
          header("location: ../sistema/justificativa-de-ponto.php?erro=1");  
        }