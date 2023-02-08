<?php

if($USERGRUPO == 4){
    
    $buscaAtendimentoAbertos = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_coop = '$COOPERATIVA' and cons_user = '$CODIGOUSUARIO' and cons_situacao = '1' OR cons_coop = '$COOPERATIVA' and cons_user != '$CODIGOUSUARIO' and cons_situacao = '1'");
    $resultadoAbertos = mysqli_fetch_assoc($buscaAtendimentoAbertos);
    $totalAbertos = $resultadoAbertos["total_atendimentos"];
    
    $buscaAtendimentoAndamento = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_coop = '$COOPERATIVA' and cons_user = '$CODIGOUSUARIO' and cons_situacao = '2' OR cons_coop = '$COOPERATIVA' and cons_user != '$CODIGOUSUARIO' and cons_situacao = '2'");
    $resultadoAndamento = mysqli_fetch_assoc($buscaAtendimentoAndamento);
    $totalAndamento = $resultadoAndamento["total_atendimentos"];
    
    $buscaAtendimentoAguardando = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_coop = '$COOPERATIVA' and cons_user = '$CODIGOUSUARIO' and cons_situacao = '4' OR cons_coop = '$COOPERATIVA' and cons_user != '$CODIGOUSUARIO' and cons_situacao = '4'");
    $resultadoAguardando = mysqli_fetch_assoc($buscaAtendimentoAguardando);
    $totalAguardando = $resultadoAguardando["total_atendimentos"];
    
    $buscaAtendimentoPendente = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_coop = '$COOPERATIVA' and cons_user = '$CODIGOUSUARIO' and cons_situacao = '3' OR cons_coop = '$COOPERATIVA' and cons_user != '$CODIGOUSUARIO' and cons_situacao = '3'");
    $resultadoPendente = mysqli_fetch_assoc($buscaAtendimentoPendente);
    $totalPendente = $resultadoPendente["total_atendimentos"];
    
}else if($USERGRUPO == 2 || $USERGRUPO == 3 ){
    
    $buscaAtendimentoAbertos = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE user_responsavel = '$CODIGOUSUARIO' and cons_situacao = '1' OR cons_grupo = '$USERGRUPO' and user_responsavel != '$CODIGOUSUARIO' and cons_situacao = '1'");
    $resultadoAbertos = mysqli_fetch_assoc($buscaAtendimentoAbertos);
    $totalAbertos = $resultadoAbertos["total_atendimentos"];
    
    $buscaAtendimentoAndamento = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE user_responsavel = '$CODIGOUSUARIO' and cons_situacao = '2' OR cons_grupo = '$USERGRUPO' and user_responsavel != '$CODIGOUSUARIO' and cons_situacao = '2'");
    $resultadoAndamento = mysqli_fetch_assoc($buscaAtendimentoAndamento);
    $totalAndamento = $resultadoAndamento["total_atendimentos"];
    
    $buscaAtendimentoAguardando = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE user_responsavel = '$CODIGOUSUARIO' and cons_situacao = '4' OR cons_grupo = '$USERGRUPO' and user_responsavel != '$CODIGOUSUARIO' and cons_situacao = '4'");
    $resultadoAguardando = mysqli_fetch_assoc($buscaAtendimentoAguardando);
    $totalAguardando = $resultadoAguardando["total_atendimentos"];
    
    $buscaAtendimentoPendente = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE user_responsavel = '$CODIGOUSUARIO' and cons_situacao = '3' OR cons_grupo = '$USERGRUPO' and user_responsavel != '$CODIGOUSUARIO' and cons_situacao = '3'");
    $resultadoPendente = mysqli_fetch_assoc($buscaAtendimentoPendente);
    $totalPendente = $resultadoPendente["total_atendimentos"];
      
}elseif($USERGRUPO == 1 || $NIVEL == 1){
    
    $buscaAtendimentoAbertos = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_situacao = '1'");
    $resultadoAbertos = mysqli_fetch_assoc($buscaAtendimentoAbertos);
    $totalAbertos = $resultadoAbertos["total_atendimentos"];
    
    $buscaAtendimentoAndamento = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_situacao = '2'");
    $resultadoAndamento = mysqli_fetch_assoc($buscaAtendimentoAndamento);
    $totalAndamento = $resultadoAndamento["total_atendimentos"];
    
    $buscaAtendimentoAguardando = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_situacao = '4'");
    $resultadoAguardando = mysqli_fetch_assoc($buscaAtendimentoAguardando);
    $totalAguardando = $resultadoAguardando["total_atendimentos"];
    
    $buscaAtendimentoPendente = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE cons_situacao = '3'");
    $resultadoPendente = mysqli_fetch_assoc($buscaAtendimentoPendente);
    $totalPendente = $resultadoPendente["total_atendimentos"];
}