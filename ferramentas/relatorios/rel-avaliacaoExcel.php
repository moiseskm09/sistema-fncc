<?php
if (!empty($_GET["cooperativaAtendimento"] || $_GET["areaAtendimento"] || $_GET["dataRefIncialF"] || $_GET["dataRefFinalF"] || $_GET["responsavelAtendimento"])) {
    
require_once '../../config/conexao.php';
require_once '../../config/sessao.php';
require_once '../../config/config_geral.php';

    $cooperativaAtendimento = $_GET["cooperativaAtendimento"];
    $areaAtendimento = $_GET["areaAtendimento"];
    $responsavelAtendimento = $_GET['responsavelAtendimento'];
    $dataRefIncialF = $_GET["dataRefIncialF"];
    $dataRefFinalF = $_GET["dataRefFinalF"];
    $horaInicial = " 00:00:01";
    $horaFinal = " 23:59:59";
    
    
$buscaTotais =  mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and user_responsavel like '%$responsavelAtendimento%' and cons_situacao in (5,6)");
    
    $buscaTotaisAvaliados = mysqli_query($conexao, "SELECT count(cod_avaliacao) AS total_atendimentos FROM avaliacao_consulta  INNER JOIN consultas ON aval_consulta = cod_consulta WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and user_responsavel like '%$responsavelAtendimento%' and cons_situacao in (5,6)");


    $buscaOtimo = mysqli_query($conexao, "SELECT count(cod_avaliacao) AS total_atendimentos FROM avaliacao_consulta  INNER JOIN consultas ON aval_consulta = cod_consulta WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and user_responsavel like '%$responsavelAtendimento%' and aval_avaliacao = 'otimo' and cons_situacao in (5,6)");
    
    $buscaBom = mysqli_query($conexao, "SELECT count(cod_avaliacao) AS total_atendimentos FROM avaliacao_consulta  INNER JOIN consultas ON aval_consulta = cod_consulta WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and user_responsavel like '%$responsavelAtendimento%' and aval_avaliacao = 'bom' and cons_situacao in (5,6)");
    
    $buscaRegular = mysqli_query($conexao, "SELECT count(cod_avaliacao) AS total_atendimentos FROM avaliacao_consulta  INNER JOIN consultas ON aval_consulta = cod_consulta WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and user_responsavel like '%$responsavelAtendimento%' and aval_avaliacao = 'regular' and cons_situacao in (5,6)");
    
    $buscaRuim = mysqli_query($conexao, "SELECT count(cod_avaliacao) AS total_atendimentos FROM avaliacao_consulta  INNER JOIN consultas ON aval_consulta = cod_consulta WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and user_responsavel like '%$responsavelAtendimento%' and aval_avaliacao = 'ruim' and cons_situacao in (5,6)");
    
    $buscaPessimo = mysqli_query($conexao, "SELECT count(cod_avaliacao) AS total_atendimentos FROM avaliacao_consulta  INNER JOIN consultas ON aval_consulta = cod_consulta WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and user_responsavel like '%$responsavelAtendimento%' and aval_avaliacao = 'pessimo' and cons_situacao in (5,6)");
    
    
    $resultadoTotalAtendimentos = mysqli_fetch_assoc($buscaTotais);
    $resultadoTotalAvaliados = mysqli_fetch_assoc($buscaTotaisAvaliados);
    if($resultadoTotalAtendimentos["total_atendimentos"] > 0 && $resultadoTotalAvaliados["total_atendimentos"] > 0){
    $resultadoAvalOtimo = mysqli_fetch_assoc($buscaOtimo);
    $resultadoAvalBom = mysqli_fetch_assoc($buscaBom);
    $resultadoAvalRegular = mysqli_fetch_assoc($buscaRegular);
    $resultadoAvalRuim = mysqli_fetch_assoc($buscaRuim);
    $resultadoAvalPessimo = mysqli_fetch_assoc($buscaPessimo);   
    $totaldeConsultas = $resultadoTotalAtendimentos["total_atendimentos"];
    $totaldeConsultasAvaliadas = $resultadoTotalAvaliados["total_atendimentos"];
    $naoAvaliados = $totaldeConsultas - $totaldeConsultasAvaliadas;
    
    $totalAvalOtimo = $resultadoAvalOtimo["total_atendimentos"];
    $totalAvalBom = $resultadoAvalBom["total_atendimentos"];
    $totalAvalRegular = $resultadoAvalRegular["total_atendimentos"];
    $totalAvalRuim = $resultadoAvalRuim["total_atendimentos"];
    $totalAvalPessimo = $resultadoAvalPessimo["total_atendimentos"];
    
    $percentualOtimo = number_format($totalAvalOtimo / $totaldeConsultas * 100, 0, '.', '');
    $percentualBom = number_format($totalAvalBom / $totaldeConsultas * 100, 0, '.', '');
    $percentualRegular = number_format($totalAvalRegular / $totaldeConsultas * 100, 0, '.', '');
    $percentualRuim = number_format($totalAvalRuim / $totaldeConsultas * 100, 0, '.', '');
    $percentualPessimo = number_format($totalAvalPessimo / $totaldeConsultas * 100, 0, '.', '');
    $percentualNaoAvaliados = number_format($naoAvaliados / $totaldeConsultas * 100, 0, '.', '');
    
    }else{
    $totaldeConsultas = 0;
    $totalAvalOtimo = 0;
    $totalAvalBom = 0;
    $totalAvalRegular = 0;
    $totalAvalRuim = 0;
    $totalAvalPessimo = 0;
    $naoAvaliados = 0;
    
    $percentualOtimo = 0;
    $percentualBom = 0;
    $percentualRegular = 0;
    $percentualRuim = 0;
    $percentualPessimo = 0;
    $percentualNaoAvaliados = 0;
}

      if(!empty($cooperativaAtendimento)){
        $buscaNomeCoopExport = mysqli_query($conexao, "SELECT cooperativa FROM cooperativas WHERE cod_coop = '$cooperativaAtendimento'");
        $resultadoCoopExport = mysqli_fetch_assoc($buscaNomeCoopExport);
        $coopHeaderExport = $resultadoCoopExport["cooperativa"];
    }else{
        $coopHeaderExport = "Todas";
    
    }
    if(!empty($responsavelAtendimento)){
        $buscaNomeResponsavel = mysqli_query($conexao, "SELECT nome FROM usuarios WHERE id_usuario = '$responsavelAtendimento'");
        $resultadoResponsavel = mysqli_fetch_assoc($buscaNomeResponsavel);
        $ResponsavelHeaderExport = $resultadoResponsavel["nome"];
    }else{
        $ResponsavelHeaderExport = "Todos";
    }
    
    if(!empty($areaAtendimento)){
        $buscaNomeareaAtendimento = mysqli_query($conexao, "SELECT grupo FROM grupos_usuarios WHERE cod_grupo = '$areaAtendimento'");
        $resultadoareaAtendimento = mysqli_fetch_assoc($buscaNomeareaAtendimento);
        $AreaHeaderExport = $resultadoareaAtendimento["cooperativa"];
    }else{
        $AreaHeaderExport = "Todas";
    }
    
    $dataRefInicialExport = date("d/m/Y", strtotime($dataRefIncialF));
    $dataRefFinalExport = date("d/m/Y", strtotime($dataRefFinalF));
    
// Aceitar csv ou texto 
header('Content-Type: text/csv; charset=utf-8');
// Nome arquivo
header('Content-Disposition: attachment; filename=Relatorio_de_avaliacao_de_atendimentos.csv');
// Gravar no buffer
$resultado = fopen("php://output", 'w');

$cabecalho1 = ['RELATORIO DE AVALIACAO DE ATENDIMENTOS'];
fputcsv($resultado, $cabecalho1, ';');

// Criar o cabeÃ§alho do Excel - Usar a funÃ§Ã£o mb_convert_encoding para converter carateres especiais
$cabecalho = ['COOPERATIVA', 'AREA DE ATENDIMENTO','RESPONSAVEL' ,'AVALIACAO', 'QUANTIDADE', 'PERCENTUAL', 'DATA INICIAL', 'DATA FINAL'];

// Array de dados
$usuarios = [
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'RESPONSAVEL' => $ResponsavelHeaderExport,
        'AVALIACAO' => 'OTIMO',
        'QUANTIDADE' => $totalAvalOtimo,
        'PERCENTUAL' => $percentualOtimo.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'RESPONSAVEL' => $ResponsavelHeaderExport,
        'AVALIACAO' => 'BOM',
        'QUANTIDADE' => $totalAvalBom,
        'PERCENTUAL' => $percentualBom.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'RESPONSAVEL' => $ResponsavelHeaderExport,
        'AVALIACAO' => 'REGULAR',
        'QUANTIDADE' => $totalAvalRegular,
        'PERCENTUAL' => $percentualRegular.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'RESPONSAVEL' => $ResponsavelHeaderExport,
        'AVALIACAO' => 'RUIM',
        'QUANTIDADE' => $totalAvalRuim,
        'PERCENTUAL' => $percentualRuim.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'RESPONSAVEL' => $ResponsavelHeaderExport,
        'AVALIACAO' => 'PESSIMO',
        'QUANTIDADE' => $totalAvalPessimo,
        'PERCENTUAL' => $percentualPessimo.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
    ],
    [
        'COOPERATIVA' => $coopHeaderExport,
        'AREA DE ATENDIMENTO' => $AreaHeaderExport,
        'RESPONSAVEL' => $ResponsavelHeaderExport,
        'AVALIACAO' => 'NAO AVALIADOS',
        'QUANTIDADE' => $naoAvaliados,
        'PERCENTUAL' => $percentualNaoAvaliados.'%',
        'DATA INICIAL' => $dataRefInicialExport,
        'DATA FINAL' => $dataRefFinalExport
        
    ],
    [
        'COOPERATIVA' => 'TOTAL',
        'AREA DE ATENDIMENTO' => 'TOTAL',
        'RESPONSAVEL' => 'TOTAL',
        'AVALIACAO' => 'TOTAL',
        'QUANTIDADE' => $totaldeConsultasAvaliadas,
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
