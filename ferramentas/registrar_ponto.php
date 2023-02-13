<?php

/*
  Created on : 8 de fev. de 2023, 20:28:32
  Author     : BEMK
 */
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_POST["opcaoPonto"])) {
    $opcaoPonto = (int) $_POST["opcaoPonto"];
    $dataAtual = date("Y-m-d");
    $horaAtual = date("H:i:s");
    $horaPadrao = date("000000");
    $horadeTrabalhoInicial = date("Y-m-d 08:00:00");
    $horadeTrabalhoFinal = date("Y-m-d 17:00:00");

    if ($opcaoPonto === 1) {
        //Se for entrada
        $datatime1 = new DateTime($horadeTrabalhoInicial);
        $datatime2 = new DateTime($dataAtual . " " . $horaAtual);
        $data1 = $datatime1->format('Y-m-d H:i:s');
        $data2 = $datatime2->format('Y-m-d H:i:s');
        if ($data2 > $data1) {
            $diff = $datatime1->diff($datatime2);
        }
        $horasAtraso = $diff->h;
        $MinutosAtraso = $diff->i;
        $atrasoInicial = $horasAtraso . ":" . $MinutosAtraso;

        $buscaRegistro = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
        if (mysqli_num_rows($buscaRegistro) > 0) {
            header("location: ../sistema/controle-ponto.php?erro=3");
        } else {
            if ($horaAtualT > $horadeTrabalhoInicial) {
                $atraso = "";
            } else {
                $atraso = "00:00:00";
            }
            $insereEntrada = mysqli_query($conexao, "INSERT INTO controle_de_ponto (ponto_user, ponto_dia, ponto_entrada, ponto_hora_atraso) VALUES ('$CODIGOUSUARIO', '$dataAtual', '$horaAtual', '$atrasoInicial')");
            echo $atrasoInicial;
            if ($insereEntrada == 1) {
                header("location: ../sistema/controle-ponto.php?sucesso=1");
            } else {
                header("location: ../sistema/controle-ponto.php?erro=4");
            }
        }
    } elseif ($opcaoPonto === 2) {
        //se for intervalo 1
        $buscaRegistro = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
        if (mysqli_num_rows($buscaRegistro) > 0) {
            $resultado = mysqli_fetch_assoc($buscaRegistro);
            $intervalo1 = date("His", strtotime($resultado["ponto_intervalo_um"]));
            if ($intervalo1 > $horaPadrao) {
                header("location: ../sistema/controle-ponto.php?erro=3");
            } else {
                $insereIntervalo = mysqli_query($conexao, "UPDATE controle_de_ponto SET ponto_intervalo_um = '$horaAtual' WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
                if ($insereIntervalo == 1) {
                    header("location: ../sistema/controle-ponto.php?sucesso=2");
                } else {
                    header("location: ../sistema/controle-ponto.php?erro=4");
                }
            }
        } else {
            header("location: ../sistema/controle-ponto.php?erro=5");
        }
    } elseif ($opcaoPonto === 3) {
        //se for intervalo 3
        $buscaRegistro = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
        if (mysqli_num_rows($buscaRegistro) > 0) {
            $resultado = mysqli_fetch_assoc($buscaRegistro);
            $intervalo2 = date("His", strtotime($resultado["ponto_intervalo_dois"]));
            if ($intervalo2 > $horaPadrao) {
                header("location: ../sistema/controle-ponto.php?erro=3");
            } else {
                $insereIntervalo = mysqli_query($conexao, "UPDATE controle_de_ponto SET ponto_intervalo_dois = '$horaAtual' WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
                if ($insereIntervalo == 1) {
                    header("location: ../sistema/controle-ponto.php?sucesso=3");
                } else {
                    header("location: ../sistema/controle-ponto.php?erro=4");
                }
            }
        } else {
            header("location: ../sistema/controle-ponto.php?erro=5");
        }
    } elseif ($opcaoPonto === 4) {
        //se for saida
        $datatime1 = new DateTime($horadeTrabalhoFinal);
        $datatime2 = new DateTime($dataAtual . " " . $horaAtual);
        $data1 = $datatime1->format('Y-m-d H:i:s');
        $data2 = $datatime2->format('Y-m-d H:i:s');
        if ($data2 > $data1) {
            $diff = $datatime1->diff($datatime2);
        }
        $horasExtra = $diff->h;
        $MinutosExtra = $diff->i;
        $HoraExtra = $horasExtra . ":" . $MinutosExtra;

        $buscaRegistro = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
        if (mysqli_num_rows($buscaRegistro) > 0) {
            $resultado = mysqli_fetch_assoc($buscaRegistro);
            $saida = date("His", strtotime($resultado["ponto_saida"]));
            if ($saida > $horaPadrao) {
                header("location: ../sistema/controle-ponto.php?erro=3");
            } else {
                $HoraEntrada = $resultado['ponto_entrada'];
                $datatime4 = new DateTime($dataAtual . " " . $horaAtual);
                $datatime5 = new DateTime($HoraEntrada);
                $data4 = $datatime4->format('Y-m-d H:i:s');
                $data5 = $datatime5->format('Y-m-d H:i:s');
                if ($data4 > $data5) {
                    $diff = $datatime4->diff($datatime5);
                }
                $horasExecutadas = $diff->h;
                $MinutosExecutados = $diff->i;
                $HorasExecutadas = $horasExecutadas . ":" . $MinutosExecutados;
                $inseresaida = mysqli_query($conexao, "UPDATE controle_de_ponto SET ponto_saida = '$horaAtual', ponto_hora_extra = '$HoraExtra', ponto_hora_executada = '$HorasExecutadas' WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
                if($HoraExtra != "00:00:00"){
                $atualizaBancodeHoras = mysqli_query($conexao, "INSERT INTO banco_de_horas (bh_dia, bh_horas, bh_user) VALUES('$dataAtual', '$HoraExtra', '$CODIGOUSUARIO')");
                }
                if ($inseresaida == 1) {
                    header("location: ../sistema/controle-ponto.php?sucesso=4");
                } else {
                    header("location: ../sistema/controle-ponto.php?erro=4");
                }
            }
        } else {
            header("location: ../sistema/controle-ponto.php?erro=5");
        }
    } else {
        header("location: ../sistema/controle-ponto.php?erro=2");
    }
} else {
    //não veio o post
    header("location: ../sistema/controle-ponto.php?erro=1");
}