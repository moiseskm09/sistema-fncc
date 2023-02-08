<?php
if(!empty($_GET['cooperativaAtendimento'] || $_GET['areaAtendimento'] || $_GET['dataRefIncialF'] || $_GET['dataRefFinalF'])){
require_once '../../config/conexao.php';
require_once '../../config/sessao.php';
require_once '../../config/config_geral.php';

    $cooperativaAtendimento = $_GET["cooperativaAtendimento"];
    $areaAtendimento = $_GET["areaAtendimento"];
    $dataRefIncialF = $_GET["dataRefIncialF"];
    $dataRefFinalF = $_GET["dataRefFinalF"];
    $horaInicial = " 00:00:01";
    $horaFinal = " 23:59:59";

    $buscaTotais =  mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%'");
   
    $buscaAtendimentoAbertos = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '1'");
    
    $buscaAtendimentoEmAndamento = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '2'");
    
    $buscaAtendimentoAguardando = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '4'");
    
    $buscaAtendimentoPendente = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '3'");
    
    $buscaAtendimentoFechado = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '5'");
    
    $buscaAtendimentoConcluido = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '6'");
    
    $resultadoTotalAtendimentos = mysqli_fetch_assoc($buscaTotais);
    if($resultadoTotalAtendimentos["total_atendimentos"] > 0){
    $resultadoAtendimentosAbertos = mysqli_fetch_assoc($buscaAtendimentoAbertos);
    $resultadoAtendimentosEmAndamento = mysqli_fetch_assoc($buscaAtendimentoEmAndamento);
    $resultadoAtendimentosAguardando = mysqli_fetch_assoc($buscaAtendimentoAguardando);
    $resultadoAtendimentosPendente = mysqli_fetch_assoc($buscaAtendimentoPendente);
    $resultadoAtendimentosFechado = mysqli_fetch_assoc($buscaAtendimentoFechado);
    $resultadoAtendimentosConcluido = mysqli_fetch_assoc($buscaAtendimentoConcluido);
    
    $totaldeConsultas = $resultadoTotalAtendimentos["total_atendimentos"];
    $totaldeConsultasAbertas = $resultadoAtendimentosAbertos["total_atendimentos"];
    $totaldeConsultasEmAndamento = $resultadoAtendimentosEmAndamento["total_atendimentos"];
    $totaldeConsultasAguardando = $resultadoAtendimentosAguardando["total_atendimentos"];
    $totaldeConsultasPendente = $resultadoAtendimentosPendente["total_atendimentos"];
    $totaldeConsultasFechado = $resultadoAtendimentosFechado["total_atendimentos"];
    $totaldeConsultasConcluido = $resultadoAtendimentosConcluido["total_atendimentos"];
    
    $percentualAbertos = number_format($totaldeConsultasAbertas / $totaldeConsultas * 100, 0, '.', '');
    $percentualEmAndamento = number_format($totaldeConsultasEmAndamento / $totaldeConsultas * 100, 0, '.', '');
    $percentualAguardando = number_format($totaldeConsultasAguardando / $totaldeConsultas * 100, 0, '.', '');
    $percentualPendente = number_format($totaldeConsultasPendente / $totaldeConsultas * 100, 0, '.', '');
    $percentualFechado = number_format($totaldeConsultasFechado / $totaldeConsultas * 100, 0, '.', '');
    $percentualConcluido = number_format($totaldeConsultasConcluido / $totaldeConsultas * 100, 0, '.', '');
}else{
    $totaldeConsultas = 0;
    $totaldeConsultasAbertas = 0;
    $totaldeConsultasEmAndamento = 0;
    $totaldeConsultasAguardando = 0;
    $totaldeConsultasPendente = 0;
    $totaldeConsultasFechado = 0;
    $totaldeConsultasConcluido = 0;
    
    $percentualAbertos = 0;
    $percentualEmAndamento = 0;
    $percentualAguardando = 0;
    $percentualPendente = 0;
    $percentualFechado = 0;
    $percentualConcluido = 0;
}
      if(!empty($cooperativaAtendimento)){
        $buscaNomeCoopExport = mysqli_query($conexao, "SELECT cooperativa FROM cooperativas WHERE cod_coop = '$cooperativaAtendimento'");
        $resultadoCoopExport = mysqli_fetch_assoc($buscaNomeCoopExport);
        $coopHeaderExport = $resultadoCoopExport["cooperativa"];
    }else{
        $coopHeaderExport = "Todas";
    
    }
    
    if(!empty($areaAtendimento)){
        $buscaNomeareaAtendimento = mysqli_query($conexao, "SELECT grupo FROM grupos_usuarios WHERE cod_grupo = '$areaAtendimento'");
        $resultadoareaAtendimento = mysqli_fetch_assoc($buscaNomeareaAtendimento);
        $AreaHeaderExport = $resultadoareaAtendimento["grupo"];
    }else{
        $AreaHeaderExport = "Todas";
    }
    
    $dataRefInicialExport = date("d/m/Y", strtotime($dataRefIncialF));
    $dataRefFinalExport = date("d/m/Y", strtotime($dataRefFinalF));
    
// Aceitar csv ou texto 
header('Content-Type: text/csv; charset=utf-8');
// Nome arquivo
header('Content-Disposition: attachment; filename=Relatorio_atendimentos.csv');
// Gravar no buffer
$resultado = fopen("php://output", 'w');

$cabecalho1 = ['RELATORIO DE ATENDIMENTOS'];
fputcsv($resultado, $cabecalho1, ';');

// Criar o cabeÃ§alho do Excel - Usar a funÃ§Ã£o mb_convert_encoding para converter carateres especiais
$cabecalho = ['COOPERATIVA', 'AREA DE ATENDIMENTO','SITUACAO', 'QUANTIDADE', 'PERCENTUAL', 'DATA INICIAL', 'DATA FINAL'];

// Array de dados
$usuarios = [
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'SITUACAO' => 'ABERTOS',
        'QUANTIDADE' => $totaldeConsultasAbertas,
        'PERCENTUAL' => $percentualAbertos.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'SITUACAO' => 'EM ANDAMENTO',
        'QUANTIDADE' => $totaldeConsultasEmAndamento,
        'PERCENTUAL' => $percentualEmAndamento.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'SITUACAO' => 'AGUARDANDO',
        'QUANTIDADE' => $totaldeConsultasAguardando,
        'PERCENTUAL' => $percentualAguardando.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'SITUACAO' => 'PENDENTE',
        'QUANTIDADE' => $totaldeConsultasPendente,
        'PERCENTUAL' => $percentualPendente.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'SITUACAO' => 'FECHADO',
        'QUANTIDADE' => $totaldeConsultasFechado,
        'PERCENTUAL' => $percentualFechado.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'SITUACAO' => 'CONCLUIDO',
        'QUANTIDADE' => $totaldeConsultasConcluido,
        'PERCENTUAL' => $percentualConcluido.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
        
    ],
    [
        'COOPERATIVA' => 'TOTAL',
        'AREA DE ATENDIMENTO' => 'TOTAL',
        'SITUACAO' => 'TOTAL',
        'QUANTIDADE' => $totaldeConsultas,
        'PERCENTUAL' => '100%',
        'DATA INICIAL' => 'TOTAL',
        'DATA FINAL' => 'TOTAL'
        
    ]
        
];

// Abrir o arquivo
//$arquivo = fopen('file.csv', 'w');

// Escrever o cabeÃ§alho no arquivo
fputcsv($resultado, $cabecalho, ';');

// Escrever o conteÃºdo no arquivo
foreach($usuarios as $row_usuario){
    fputcsv($resultado, $row_usuario, ';');
}

// Fechar arquivo
fclose($resultado);
}else{
    echo "não há informações a serem impressas";
}
?>
