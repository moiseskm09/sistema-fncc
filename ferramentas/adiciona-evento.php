<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_POST["tituloEvento"], $_POST["dataRefIncialF"], $_POST["dataRefFinalF"], $_POST["corEvento"], $_POST["nomeAgendador"])) {
    $tituloEvento = $_POST["tituloEvento"];
    $dataRefIncialF = $_POST["dataRefIncialF"];
    $dataRefFinalF = $_POST["dataRefFinalF"];
    $corEvento = $_POST["corEvento"];
    $nomeAgendador = $_POST["nomeAgendador"];
    
    $insereEvento = mysqli_query($conexao, "INSERT INTO events (title, color, start, end, pessoa) VALUES ('$tituloEvento', '$corEvento', '$dataRefIncialF', '$dataRefFinalF', '$nomeAgendador')");
    if($insereEvento == 1){
        header("location: ../sistema/agenda.php?sucesso=1");
    }else{
        header("location: ../sistema/agenda.php?erro=1");
    }
}else{
    header("location: ../sistema/agenda.php?erro=1");
}
