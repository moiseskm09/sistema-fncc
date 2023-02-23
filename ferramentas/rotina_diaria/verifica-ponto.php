<?php

include_once '../../config/conexao.php';
include_once '../../config/config_geral.php';

chdir('/home/u596471878/domains/bemktech.com.br/public_html/sistema-fncc/ferramentas/rotina_diaria/');

$sabado = "sábado";
$domingo = "domingo";
$diaSemana = utf8_encode(strftime("%A", strtotime("d")));

if ($sabado == $diaSemana OR $domingo == $diaSemana) {
    
} else {
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

