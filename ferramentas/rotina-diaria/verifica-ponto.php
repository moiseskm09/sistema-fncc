<?php

include_once '../../config/conexao.php';
include_once '../../config/config_geral.php';

chdir('/home/u596471878/domains/bemktech.com.br/public_html/sistema-fncc/ferramentas/rotina-diaria/');

$sabado = "sab";
$domingo = "dom";
$dataAtual = date("Y-m-d");
$diaSemana = utf8_encode(strftime("%a", strtotime("d")));
$buscaFeriado = mysqli_query($conexao, "SELECT * FROM feriados WHERE data = '$dataAtual'");
if(mysqli_num_rows($buscaFeriado) > 0 ){ $feriado = "1"; }else{ $feriado = "0"; }

if ($sabado == $diaSemana || $domingo == $diaSemana || $feriado == "1") { 
    
}else {
    $buscaUsuariosPonto = mysqli_query($conexao, "SELECT id_usuario FROM usuarios WHERE user_controla_ponto = '1'");
    if (mysqli_num_rows($buscaUsuariosPonto) > 0) {
        while ($resultadoUsuarioPonto = mysqli_fetch_assoc($buscaUsuariosPonto)) {
            $id_usuario = $resultadoUsuarioPonto["id_usuario"];
            $data = date("Y-m-d");
            $bucaRegistroPonto = mysqli_query($conexao, "SELECT cod_ponto FROM controle_de_ponto WHERE ponto_user = '$id_usuario' and ponto_dia = '$data'");
            if (mysqli_num_rows($bucaRegistroPonto) > 0) {
                //echo "$id_usuario - Registrou o Ponto hoje"."<br>";
            } else {
                //echo "$id_usuario - NÃO Registrou o Ponto hoje"."<br>";
                $insereFalta = mysqli_query($conexao, "INSERT INTO controle_de_ponto (ponto_user, ponto_dia, ponto_hora_atraso, ponto_situacao) VALUES ('$id_usuario', '$data', '08:00:00', '2')");
            }
        }
    }
}

