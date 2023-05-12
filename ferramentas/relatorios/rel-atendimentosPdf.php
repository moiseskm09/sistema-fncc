<?php
  if(!empty($_GET['cooperativaAtendimento'] || $_GET['areaAtendimento'] || $_GET['dataRefIncialF'] || $_GET['dataRefFinalF'])){
require('../fpdf/fpdf.php');
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
    
class PDF extends FPDF
{
    
// Page header
function Header()
{
    //$this->Rect(3,3,204,280);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Logo 
    $this->Image('../../img/timbrado.jpg',0,0,210);
    $this->Image('../../img/logofncc.png',90,3,30);
    $this->SetTextColor(255,255,255);
    $this->Ln(3);
    $this->SetFont('Arial','B',13);
    $this->Cell(190, 10, utf8_decode("FEDERAÇÃO NACIONAL DAS COOPERATIVAS DE CRÉDITO"), 0, 0, "C");
    $this->Ln(5);
    $this->SetFont('Arial','B',8);
    $this->Cell(190,10,utf8_decode("RUA: VOLUNTÁRIOS DA PÁTRIA, N°654 - SALA 606 - SANTANA"),0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','B',8);
    $this->Cell(190,10,utf8_decode("CEP: 02010-000 / SÃO PAULO SP"),0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','B',8);
    $this->Cell(190,10,utf8_decode("TELEFONE: (11) 2089-9490 | WHATSAPP: (11) 93730-7909 | EMAIL: FNCC@FNCC.COM.BR"),0,0,'C');
    $this->Ln(15);
}


// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->SetTextColor(255,255,255);
    
    $this->Image('../../img/timbrado.jpg',0,285,210);
    $this->Cell(0,20,utf8_decode("Página ").$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,10,utf8_decode("RELATÓRIO DE ATENDIMENTOS"),1, 1,'C', true);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,utf8_decode('FILTRO APLICADO'),0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(60,5,utf8_decode('COOPERATIVA'),1,0,'C', true);
    $pdf->Cell(60,5,utf8_decode('ÁREA DE ATENDIMENTO'),1,0,'C', true);
    $pdf->Cell(35,5,utf8_decode('DATA INICIAL'),1,0,'C', true);
    $pdf->Cell(35,5,utf8_decode('DATA FINAL'),1,0,'C', true);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(60,5,utf8_decode($coopHeaderExport),1,0,'C');
    $pdf->Cell(60,5,utf8_decode($AreaHeaderExport),1,0,'C');
    $pdf->Cell(35,5,utf8_decode($dataRefInicialExport),1,0,'C');
    $pdf->Cell(35,5,utf8_decode($dataRefFinalExport),1,0,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,utf8_decode('RESULTADO'),0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',10);
    
    $pdf->Cell(64,5,utf8_decode('SITUAÇÃO'),1,0,'C', true);
    $pdf->Cell(64,5,utf8_decode('QUANTIDADE'),1,0,'C', true);
    $pdf->Cell(62,5,utf8_decode('PERCENTUAL'),1,0,'C', true);
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(64,7,utf8_decode('ABERTOS'),1,0,'C');
    $pdf->Cell(64,7,utf8_decode($totaldeConsultasAbertas),1,0,'C');
    $pdf->Cell(62,7,utf8_decode($percentualAbertos)."%",1,0,'C');
    $pdf->Ln(7);
    $pdf->Cell(64,7,utf8_decode('ANDAMENTO'),1,0,'C');
    $pdf->Cell(64,7,utf8_decode($totaldeConsultasEmAndamento),1,0,'C');
    $pdf->Cell(62,7,utf8_decode($percentualEmAndamento)."%",1,0,'C');
    $pdf->Ln(7);
    $pdf->Cell(64,7,utf8_decode('AGUARDANDO'),1,0,'C');
    $pdf->Cell(64,7,utf8_decode($totaldeConsultasAguardando),1,0,'C');
    $pdf->Cell(62,7,utf8_decode($percentualAguardando)."%",1,0,'C');
    $pdf->Ln(7);
    $pdf->Cell(64,7,utf8_decode('PENDENTES'),1,0,'C');
    $pdf->Cell(64,7,utf8_decode($totaldeConsultasPendente),1,0,'C');
    $pdf->Cell(62,7,utf8_decode($percentualPendente)."%",1,0,'C');
    $pdf->Ln(7);
    $pdf->Cell(64,7,utf8_decode('FECHADOS'),1,0,'C');
    $pdf->Cell(64,7,utf8_decode($totaldeConsultasFechado),1,0,'C');
    $pdf->Cell(62,7,utf8_decode($percentualFechado)."%",1,0,'C');
    $pdf->Ln(7);
    $pdf->Cell(64,7,utf8_decode('CONCLUÍDOS'),1,0,'C');
    $pdf->Cell(64,7,utf8_decode($totaldeConsultasConcluido),1,0,'C');
    $pdf->Cell(62,7,utf8_decode($percentualConcluido)."%",1,0,'C');
    $pdf->Ln(7);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(64,10,utf8_decode('TOTAL'),1,0,'C', true);
    $pdf->Cell(64,10,utf8_decode($totaldeConsultas),1,0,'C', true);
    $pdf->Cell(62,10,utf8_decode('100%'),1,0,'C', true);  
    
    
$pdf->Output();
  }else{
    echo "não há informações a serem impressas";
}
?>