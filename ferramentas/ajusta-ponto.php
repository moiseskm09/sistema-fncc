<?php

require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_POST["ponto_user"], $_POST["ponto_dia"], $_POST["cod_ponto"], $_POST["entrada"], $_POST["intervalo"], $_POST["fim_intervalo"], $_POST["saida"])) {
    $cod_ponto = $_POST["cod_ponto"];
    $ponto_dia = $_POST["ponto_dia"];
    $ponto_user = $_POST["ponto_user"];
    $entrada = $_POST["entrada"];
    $intervalo = $_POST["intervalo"];
    $fim_intervalo = $_POST["fim_intervalo"];
    $saida = $_POST["saida"];
    
    $atualizado = 0;
    $linha = 0;
    for($i = 0; $i < count($cod_ponto); ++$i) {
        $atualizado = 0;
        echo $atualizado."<br>";
        $codigoPonto = $cod_ponto[$linha]; 
        $diaPonto = $ponto_dia[$linha]; 
        $usuarioPonto = $ponto_user[$linha]; 
        $entradaPonto = $entrada[$linha]; 
        $intervaloPonto = $intervalo[$linha]; 
        $fimIntervaloPonto = $fim_intervalo[$linha]; 
        $saidaPonto = $saida[$linha]; 
        
        //ajusta ponto
        $diaSemana = utf8_encode(strftime("%a", strtotime($diaPonto)));
        $buscaJornada = mysqli_query($conexao, "SELECT * FROM jornada WHERE dia_abreviado = '$diaSemana'");
        if (mysqli_num_rows($buscaJornada) > 0) {
            $resultadoJornada = mysqli_fetch_assoc($buscaJornada);
            $horadeTrabalhoInicial = date($diaPonto . strftime('%H:%M', strtotime($resultadoJornada["jor_entrada"])) . "");
            $horadeTrabalhoFinal = date($diaPonto . strftime('%H:%M', strtotime($resultadoJornada["jor_saida"])) . "");
            $tolerancia = strftime('%H:%M', strtotime($resultadoJornada["jor_tolerancia"]));
            $atrasoInicial = "00:00";
            $ExtraInicial = "00:00";
            
            //verifica se é sabado e domingo e se existe jornada de trabalho definida, se não tiver jornada, aplica hora extra
            if ($diaSemana == "sab" && $horadeTrabalhoInicial == date($diaPonto . strftime('%H:%M', strtotime("00:00")) . "") || $diaSemana == "dom" && $horadeTrabalhoInicial == date($diaPonto . strftime('%H:%M', strtotime("00:00")) . "")) {
                $datatime1 = new DateTime($diaPonto . " " . $entradaPonto);
                //echo $diaPonto . " " . $entradaPonto."<br>";
                $datatime2 = new DateTime($diaPonto . " " . $entradaPonto);
                $datatime3 = new DateTime($diaPonto . " " . $saidaPonto);
                $datatime4 = new DateTime($diaPonto . " " . $entradaPonto);
            }else{
                $datatime1 = new DateTime($horadeTrabalhoInicial);
                $datatime2 = new DateTime($diaPonto . " " . $entradaPonto);
                $datatime3 = new DateTime($horadeTrabalhoFinal);
                $datatime4 = new DateTime($diaPonto . " " . $saidaPonto);
            }
            // fim verifica sabado e domingo
            $data1 = $datatime1->format('Y-m-d H:i');
            $data2 = $datatime2->format('Y-m-d H:i');
            $data3 = $datatime1->format('Y-m-d H:i');
            $data4 = $datatime2->format('Y-m-d H:i');
            
            //adiciona atraso ou extra inicial
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
                $ExtraInicial = strftime('%H:%M', strtotime($horasExtra . ":" . $MinutosExtra));
                
            }
            //fim adiciona atraso ou extra inicial 
            
            //adiciona atraso ou extra final
            if ($data4 > $data3) {
                    $diff = $datatime3->diff($datatime4);
                }else{
                    $diff = $datatime4->diff($datatime3);
                }
                $horasExtraFinal = $diff->h;
                $MinutosExtraFinal = $diff->i;
                $HoraExtraFinal = strftime('%H:%M', strtotime($horasExtraFinal . ":" . $MinutosExtraFinal));
            // fim adiciona atraso ou falta final
                
                
                //horas tralhadas
                    $datatime5 = new DateTime($diaPonto . " " . $saidaPonto);
                    $datatime6 = new DateTime($diaPonto . " " . $entradaPonto);
                    $data5 = $datatime5->format('Y-m-d H:i');
                    $data6 = $datatime6->format('Y-m-d H:i');
                    if ($data5 > $data6) {
                        $diff = $datatime5->diff($datatime6);
                    }
                    $horasTrabalhadas = $diff->h;
                    $MinutosTrabalhados = $diff->i;
                    $totalHorasTrabalhadas = $horasTrabalhadas . ":" . $MinutosTrabalhados;
                    
                    //fixo diminuir hora do almoço depois do 12:00
                    if ($saidaPonto > "12:00" && $diaSemana != "sab" && $diaSemana != "dom") {
                        $HorasTrabalhadasTotal = $time = date('H:i', strtotime($totalHorasTrabalhadas . '-1 hour'));
                    } else {
                        $HorasTrabalhadasTotal = $totalHorasTrabalhadas;
                    }
                    //fim fixo diminuir hora do almoço depois do 12:00
                    //
                // fim horas trabalhadas
                   $queryAtualizaPonto = "UPDATE controle_de_ponto SET ponto_entrada = '$entradaPonto', ponto_intervalo_um = '$intervaloPonto', ponto_intervalo_dois = '$fimIntervaloPonto', ponto_saida = '$saidaPonto', ponto_hora_executada = '$HorasTrabalhadasTotal', ponto_hora_atraso = '$atrasoInicial', ponto_hora_extra = ADDTIME('$ExtraInicial','$HoraExtraFinal'), ponto_situacao = '1' WHERE cod_ponto = '$codigoPonto' and ponto_dia = '$diaPonto' and ponto_user = '$usuarioPonto'";
                   //echo $queryAtualizaPonto."<br>";
                   $atualizaPonto = mysqli_query($conexao, $queryAtualizaPonto);
                   if($atualizaPonto == 1){
                       $atualizado = 1;
                      // echo $atualizado;
                       if($ExtraInicial != "00:00"  || $HoraExtraFinal != "00:00"){
                           $buscaExtra = mysqli_query($conexao, "SELECT * FROM banco_de_horas WHERE bh_dia = '$diaPonto' and bh_user = '$usuarioPonto'");
                           if(mysqli_num_rows($buscaExtra) > 0){
                               $queryAtualizaExtra = "UPDATE banco_de_horas SET bh_horas = ADDTIME('$ExtraInicial','$HoraExtraFinal') WHERE bh_dia = '$diaPonto' and bh_user = '$usuarioPonto'";
                           $AtualizaExtra = mysqli_query($conexao, $queryAtualizaExtra);
                           //echo $queryAtualizaExtra."<br>";
                           $atualizadoExtra  = 1;
                           }else{
                               $queryAtualizaExtra = "INSERT INTO banco_de_horas (bh_dia, bh_horas, bh_user) VALUES ('$diaPonto', ADDTIME('$ExtraInicial','$HoraExtraFinal'), '$usuarioPonto')";
                               $AtualizaExtra = mysqli_query($conexao, $queryAtualizaExtra);
                               //echo $queryAtualizaExtra."<br>";
                               $atualizadoExtra  = 1;
                               
                           }
                       }else{
                           $atualizadoExtra  = 1;
                       }
                   }
                
        }
        //ajusta ponto
        $linha ++;     
}
if($atualizado == 1 && $AtualizaExtra == 1){
    header("location: ../sistema/ajuste-de-ponto.php?sucesso=1");
}else{
    header("location: ../sistema/ajuste-de-ponto.php?erro=1");
}
}else{
    header("location: ../sistema/ajuste-de-ponto.php?erro=1");
}

