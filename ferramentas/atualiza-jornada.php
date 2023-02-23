<?php

require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if(isset($_POST["cod_dia"], $_POST["dia_semana"], $_POST["dia_abreviado"], $_POST["entrada"], $_POST["intervalo"], $_POST["fim_intervalo"], $_POST["saida"], $_POST["tolerancia"])){
    $cod_dia = $_POST["cod_dia"];
    $dia_semana = $_POST["dia_semana"];
    $entrada = $_POST["entrada"];
    $intervalo = $_POST["intervalo"];
    $fim_intervalo = $_POST["fim_intervalo"];
    $saida = $_POST["saida"];
    $tolerancia = $_POST["tolerancia"];
    $dia_abreviado = $_POST["dia_abreviado"];
    
    
    function jornada($cod_dia, $dia_semana, $dia_abreviado, $entrada, $intervalo, $fim_intervalo, $saida, $tolerancia) {
            return "('{$cod_dia}', '{$dia_semana}','{$dia_abreviado}','{$entrada}','{$intervalo}', '{$fim_intervalo}', '{$saida}', '{$tolerancia}')";
        }

        $dados = array_map("jornada", $cod_dia, $dia_semana, $dia_abreviado, $entrada, $intervalo, $fim_intervalo, $saida, $tolerancia);
        $queryJornada = sprintf("REPLACE INTO jornada (cod_jornada, dia, dia_abreviado, jor_entrada, jor_intervalo, jor_fim_intervalo, jor_saida, jor_tolerancia) VALUES %s", join(', ', $dados));
       echo $queryJornada."<br>";
        $executaJornada = mysqli_query($conexao, $queryJornada);
        
         if($executaJornada == 1){
             header("location: ../sistema/jornada-de-trabalho.php?sucesso=1");
         }else{
             header("location: ../sistema/jornada-de-trabalho.php?erro=1");
         }
}else{
    header("location: ../sistema/jornada-de-trabalho.php?erro=1");
}