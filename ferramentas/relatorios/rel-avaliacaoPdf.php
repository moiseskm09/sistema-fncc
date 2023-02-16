<?php
if (!empty($_GET["cooperativaAtendimento"] || $_GET["areaAtendimento"] || $_GET["dataRefIncialF"] || $_GET["dataRefFinalF"] || $_GET["responsavelAtendimento"])) {
    
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    
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
    

  
    $this->SetXY(10,10); // SetXY - DEFINE O X E O Y NA PAGINA
        $this->Rect(10,10,190,280); // CRIA UM RET�?NGULO QUE COME�?A NO X = 10, Y = 10 E 
                                    //TEM 190 DE LARGURA E 280 DE ALTURA. 
                                    //NESTE CASO, �? UMA BORDA DE PÁGINA.
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Logo 
    $this->Image('../../img/logocompleto.png',90,13,30);
    $this->Ln(12);
    $this->SetFont('Arial','B',13);
    $this->Cell(190, 10, utf8_decode("FEDERAÇÃO NACIONAL DAS COOPERATIVAS DE CRÉDITO"), 0, 0, "C");
    $this->Ln(7);
    $this->SetFont('Arial','B',8);
    $this->Cell(190,10,utf8_decode("RUA: VOLUNTÁRIOS DA PÁTRIA, N°654 - SALA 606 - SANTANA"),0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','B',8);
    $this->Cell(190,10,utf8_decode("CEP: 02010-000 / SÃO PAULO SP"),0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','B',8);
    $this->Cell(190,10,utf8_decode("TELEFONE: (11) 2089-9490 , WHATSAPP: (11) 93730-7909 , EMAIL: FNCC@FNCC.COM.BR"),0,0,'C');
    $this->Ln(15);

    
    $this->SetFillColor(227, 227, 227);
    $this->SetFont('Arial','B',12);
    $this->Cell(190,10,utf8_decode("RELATÓRIO DE AVALIAÇÃO DE ATENDIMENTOS"),1, 1,'C', true);
    $this->Ln(5);
    $this->SetFont('Arial','B',10);
    $this->Cell(190,7,utf8_decode('FILTRO APLICADO'),0,0,'C');
    $this->Ln(10);
    $this->SetFont('Arial','B',8);
    $this->Cell(45,5,utf8_decode('COOPERATIVA'),1,0,'C', true);
    $this->Cell(50,5,utf8_decode('ÁREA DE ATENDIMENTO'),1,0,'C', true);
    $this->Cell(35,5,utf8_decode('RESPONSÁVEL'),1,0,'C', true);
    $this->Cell(30,5,utf8_decode('DATA INICIAL'),1,0,'C', true);
    $this->Cell(30,5,utf8_decode('DATA FINAL'),1,0,'C', true);
    $this->Ln(5);
    $this->SetFont('Arial','',8);
    $this->Cell(45,5,utf8_decode($coopHeaderExport),1,0,'C');
    $this->Cell(50,5,utf8_decode($AreaHeaderExport),1,0,'C');
    $this->Cell(35,5,utf8_decode($ResponsavelHeaderExport),1,0,'C');
    $this->Cell(30,5,utf8_decode($dataRefInicialExport),1,0,'C');
    $this->Cell(30,5,utf8_decode($dataRefFinalExport),1,0,'C');
    
    
    $this->Ln(10);
    $this->SetFont('Arial','B',10);
    $this->Cell(190,7,utf8_decode('RESULTADO'),0,0,'C');
    $this->Ln(10);
    $this->SetFillColor(227, 227, 227);
    $this->SetFont('Arial','B',10);
    
    $this->Cell(64,5,utf8_decode('AVALIAÇÃO'),1,0,'C', true);
    $this->Cell(64,5,utf8_decode('QUANTIDADE'),1,0,'C', true);
    $this->Cell(62,5,utf8_decode('PERCENTUAL'),1,0,'C', true);
    $this->Ln(5);
    $this->SetFont('Arial','',10);
    $this->Cell(64,7,utf8_decode('ÓTIMO'),1,0,'C');
    $this->Cell(64,7,utf8_decode($totalAvalOtimo),1,0,'C');
    $this->Cell(62,7,utf8_decode($percentualOtimo)."%",1,0,'C');
    $this->Ln(7);
    $this->Cell(64,7,utf8_decode('BOM'),1,0,'C');
    $this->Cell(64,7,utf8_decode($totalAvalBom),1,0,'C');
    $this->Cell(62,7,utf8_decode($percentualBom)."%",1,0,'C');
    $this->Ln(7);
    $this->Cell(64,7,utf8_decode('REGULAR'),1,0,'C');
    $this->Cell(64,7,utf8_decode($totalAvalRegular),1,0,'C');
    $this->Cell(62,7,utf8_decode($percentualRegular)."%",1,0,'C');
    $this->Ln(7);
    $this->Cell(64,7,utf8_decode('RUIM'),1,0,'C');
    $this->Cell(64,7,utf8_decode($totalAvalRuim),1,0,'C');
    $this->Cell(62,7,utf8_decode($percentualRuim)."%",1,0,'C');
    $this->Ln(7);
    $this->Cell(64,7,utf8_decode('PÉSSIMO'),1,0,'C');
    $this->Cell(64,7,utf8_decode($totalAvalPessimo),1,0,'C');
    $this->Cell(62,7,utf8_decode($percentualPessimo)."%",1,0,'C');
    $this->Ln(7);
    $this->Cell(64,7,utf8_decode('NÃO AVALIADOS'),1,0,'C');
    $this->Cell(64,7,utf8_decode($naoAvaliados),1,0,'C');
    $this->Cell(62,7,utf8_decode($percentualNaoAvaliados)."%",1,0,'C');
    $this->Ln(7);
    
    $this->SetFont('Arial','B',12);
    $this->Cell(64,10,utf8_decode('TOTAL'),1,0,'C', true);
    $this->Cell(64,10,utf8_decode($totaldeConsultasAvaliadas),1,0,'C', true);
    $this->Cell(62,10,utf8_decode('100%'),1,0,'C', true);  

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Output();
}else{
    echo "não há informações a serem impressas";
}
?>