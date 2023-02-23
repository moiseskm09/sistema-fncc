<?php

/*
  Created on : 8 de fev. de 2023, 20:28:32
  Author     : BEMK
 */

require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_POST["opcaoPonto"])) {
    $diaSemana = utf8_encode(strftime("%a", strtotime("d")));
    $buscaJornada = mysqli_query($conexao, "SELECT * FROM jornada WHERE dia_abreviado = '$diaSemana'");
    if (mysqli_num_rows($buscaJornada) > 0) {
        $resultadoJornada = mysqli_fetch_assoc($buscaJornada);
        $opcaoPonto = (int) $_POST["opcaoPonto"];
        $dataAtual = date("Y-m-d");
        $horaAtual = date("H:i");
        //$horaPadrao = date("0000");
        $horadeTrabalhoInicial = date("Y-m-d " . strftime('%H:%M', strtotime($resultadoJornada["jor_entrada"])) . "");
        $horadeTrabalhoFinal = date("Y-m-d " . strftime('%H:%M', strtotime($resultadoJornada["jor_saida"])) . "");
        $tolerancia = strftime('%H:%M', strtotime($resultadoJornada["jor_tolerancia"]));
        $atrasoInicial = "00:00";
        $ExtraInicial = "00:00";
        if ($opcaoPonto === 1) {
            //Se for entrada
            if ($diaSemana == "sab" && $resultadoJornada["jor_entrada"] == null || $diaSemana == "dom" && $resultadoJornada["jor_entrada"] == null) {
                $datatime1 = new DateTime($dataAtual . " " . $horaAtual);
                $datatime2 = new DateTime($dataAtual . " " . $horaAtual);
            } else {
                $datatime1 = new DateTime($horadeTrabalhoInicial);
                $datatime2 = new DateTime($dataAtual . " " . $horaAtual);
            }
            $data1 = $datatime1->format('Y-m-d H:i');
            $data2 = $datatime2->format('Y-m-d H:i');

            if ($data2 > $data1) {
                $diff = $datatime1->diff($datatime2);
                $horasAtraso = $diff->h;
                $MinutosAtraso = $diff->i;
                $atrasoInicialA = strftime('%H:%M', strtotime($horasAtraso . ":" . $MinutosAtraso . ":00"));
                if ($atrasoInicialA == $tolerancia || $atrasoInicialA < $tolerancia) {
                    $atrasoInicial = "00:00:00";
                } else {
                    $atrasoInicial = $atrasoInicialA;
                }
            } elseif ($data2 < $data1) {
                $diff = $datatime1->diff($datatime2);
                $horasExtra = $diff->h;
                $MinutosExtra = $diff->i;
                $ExtraInicial = $horasExtra . ":" . $MinutosExtra;
            }

            $buscaRegistro = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
            if (mysqli_num_rows($buscaRegistro) > 0) {
                header("location: ../sistema/controle-ponto.php?erro=3");
            } else {
                $insereEntrada = mysqli_query($conexao, "INSERT INTO controle_de_ponto (ponto_user, ponto_dia, ponto_entrada, ponto_hora_atraso, ponto_hora_extra) VALUES ('$CODIGOUSUARIO', '$dataAtual', '$horaAtual', '$atrasoInicial', '$ExtraInicial')");
                /* if ($ExtraInicial != "00:00") {
                  $atualizaBancodeHoras = mysqli_query($conexao, "INSERT INTO banco_de_horas (bh_dia, bh_horas, bh_user) VALUES('$dataAtual', '$ExtraInicial', '$CODIGOUSUARIO')");
                  } */
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
                $intervalo1 = $resultado["ponto_intervalo_um"];
                echo $resultado["ponto_intervalo_um"];
                if ($intervalo1 != null) {
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
            //se for intervalo 2
            $buscaRegistro = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
            if (mysqli_num_rows($buscaRegistro) > 0) {
                $resultado = mysqli_fetch_assoc($buscaRegistro);
                $intervalo2 = $resultado["ponto_intervalo_dois"];
                if ($intervalo2 != null) {
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
            $buscaRegistro = mysqli_query($conexao, "SELECT * FROM controle_de_ponto WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
            if (mysqli_num_rows($buscaRegistro) > 0) {
                $resultado = mysqli_fetch_assoc($buscaRegistro);
                $PontoEntrada = $resultado["ponto_entrada"];
                if ($diaSemana == "sab" && $resultadoJornada["jor_saida"] == null || $diaSemana == "dom" && $resultadoJornada["jor_saida"] == null) {
                    $datatime1 = new DateTime($dataAtual . " " . $horaAtual);
                    $datatime2 = new DateTime($dataAtual . " " . $PontoEntrada);
                } else {
                    $datatime1 = new DateTime($horadeTrabalhoFinal);
                    $datatime2 = new DateTime($dataAtual . " " . $horaAtual);
                }

                $data1 = $datatime1->format('Y-m-d H:i');
                $data2 = $datatime2->format('Y-m-d H:i');

                if ($data2 > $data1) {
                    $diff = $datatime1->diff($datatime2);
                    $horasExtra = $diff->h;
                    $MinutosExtra = $diff->i;
                    $HoraExtra = $horasExtra . ":" . $MinutosExtra;
                    $HoraExtraFinal = strftime('%H:%M', strtotime($HoraExtra));
                    if ($HoraExtraFinal == $tolerancia || $HoraExtraFinal < $tolerancia) {
                        $HoraExtra = "00:00";
                    } else {
                        $HoraExtra = $horasExtra . ":" . $MinutosExtra;
                    }
                } else {
                    $diff = $datatime2->diff($datatime1);
                    //aqui depois eu vou adicionar a saida mais cedo como atraso
                    $HoraExtra = "00:00";
                }


                $saida = $resultado["ponto_saida"];
                if ($resultado["ponto_hora_extra"] == null) {
                    $HoraExtraInicial = "00:00";
                } else {
                    $HoraExtraInicial = $resultado["ponto_hora_extra"];
                }

                if ($saida != null) {
                    header("location: ../sistema/controle-ponto.php?erro=3");
                } else {
                    $HoraEntrada = $resultado['ponto_entrada'];
                    $datatime4 = new DateTime($dataAtual . " " . $horaAtual);
                    $datatime5 = new DateTime($HoraEntrada);
                    $data4 = $datatime4->format('Y-m-d H:i');
                    $data5 = $datatime5->format('Y-m-d H:i');
                    if ($data4 > $data5) {
                        $diff = $datatime4->diff($datatime5);
                    }
                    $horasExecutadas = $diff->h;
                    $MinutosExecutados = $diff->i;
                    $HorasExecutadas = $horasExecutadas . ":" . $MinutosExecutados;
                    //fixo diminuir hora do almoço depois do 12:00
                    if ($horaAtual > "12:00" && $diaSemana != "sab" && $diaSemana != "dom") {
                        $HorasExecutadasTotal = $time = date('H:i', strtotime($HorasExecutadas . '-1 hour'));
                    } else {
                        $HorasExecutadasTotal = $HorasExecutadas;
                    }
                    //fim fixo diminuir hora do almoço depois do 12:00


                    $inseresaida = mysqli_query($conexao, "UPDATE controle_de_ponto SET ponto_saida = '$horaAtual', ponto_hora_extra = ADDTIME('$HoraExtraInicial','$HoraExtra'), ponto_hora_executada = '$HorasExecutadasTotal' WHERE ponto_dia = '$dataAtual' and ponto_user = '$CODIGOUSUARIO'");
                    if ($HoraExtra != "00:00" || $HoraExtraInicial != "00:00" && $HoraExtraInicial != null) {
                        $consultaBancoHoras = mysqli_query($conexao, "SELECT * FROM banco_de_horas WHERE bh_user = '$CODIGOUSUARIO' and bh_dia = '$dataAtual'");
                        if (mysqli_num_rows($consultaBancoHoras) > 0) {
                            $atualizaBancodeHoras = mysqli_query($conexao, "UPDATE banco_de_horas SET bh_horas = ADDTIME('$HoraExtraInicial','$HoraExtra') WHERE bh_user = '$CODIGOUSUARIO' and bh_dia = '$dataAtual'");
                        } else {
                            $atualizaBancodeHoras = mysqli_query($conexao, "INSERT INTO banco_de_horas (bh_dia, bh_horas, bh_user) VALUES('$dataAtual',ADDTIME('$HoraExtraInicial','$HoraExtra'), '$CODIGOUSUARIO')");
                        }
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
        //sem jornda de trabalho definida
        header("location: ../sistema/controle-ponto.php?erro=1");
    }
} else {
    //não veio o post
    header("location: ../sistema/controle-ponto.php?erro=1");
}