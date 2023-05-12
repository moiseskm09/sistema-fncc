<?php
  if(!empty($_GET['id'])){
require('../fpdf/fpdf.php');
require_once '../../config/conexao.php';
require_once '../../config/sessao.php';
require_once '../../config/config_geral.php';

    $cooperativa = $_GET["id"];
    
    $buscaCoop = mysqli_query($conexao, "SELECT * FROM cooperativas WHERE cod_coop = '$cooperativa'");
    if(mysqli_num_rows($buscaCoop) > 0 ){
      $dadosCoop = mysqli_fetch_assoc($buscaCoop);
      $ultimaAtualizacao = strftime('%d/%m/%Y', strtotime($dadosCoop["coop_ultima_atualizacao"]));
      $relgerado = strftime('%d/%m/%Y', strtotime(date("Y-m-d")));
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
    $this->Ln(12);
}


// Page footer
function Footer()
{
    global $ultimaAtualizacao;
    global $relgerado;
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->SetTextColor(255,255,255);
    
    $this->Image('../../img/timbrado.jpg',0,283,210);
    $this->Cell(95,10,utf8_decode("DADOS ATUALIZADOS EM: ".$ultimaAtualizacao),0,0,'L');
    $this->Cell(95,10,utf8_decode("RELATÓRIO GERADO EM: ".$relgerado),0,0,'R');
    $this->Cell(0,20,utf8_decode("Página ").$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(227, 227, 227);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,utf8_decode("DADOS CADASTRAIS"),1, 1,'C', true);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(135,7,utf8_decode(''),0,0,'L');
$pdf->Cell(25,7,utf8_decode('MATRÍCULA: '),0,0,'L', false);
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,7,utf8_decode($dadosCoop["coop_matricula"]),0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,utf8_decode('INFORMAÇÕES GERAIS'),0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(25,5,utf8_decode('RAZÃO SOCIAL:'),1,0,'L', true);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(165,5,utf8_decode($dadosCoop["coop_razao"]),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(27,5,utf8_decode('NOME FANTASIA:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(163,5,utf8_decode($dadosCoop["cooperativa"]),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20,5,utf8_decode('CNPJ:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(40,5,utf8_decode($dadosCoop["coop_cnpj"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,5,utf8_decode('INSCR. MUNICIPAL:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(40,5,utf8_decode($dadosCoop["coop_im"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20,5,utf8_decode('NIRE:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(40,5,utf8_decode($dadosCoop["coop_nire"]),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20,5,utf8_decode('ENDEREÇO:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(90,5,utf8_decode(strtoupper($dadosCoop["coop_endereco"])),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(8,5,utf8_decode('Nº:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(12,5,utf8_decode($dadosCoop["coop_numero_casa"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(15,5,utf8_decode('COMPL:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(45,5,utf8_decode($dadosCoop["coop_complemento"]),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(15,5,utf8_decode('BAIRRO:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(56,5,utf8_decode(strtoupper($dadosCoop["coop_bairro"])),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(15,5,utf8_decode('CIDADE:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(56,5,utf8_decode(strtoupper($dadosCoop["coop_cidade"])),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(10,5,utf8_decode('CEP:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(20,5,utf8_decode($dadosCoop["coop_cep"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(8,5,utf8_decode('UF:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(10,5,utf8_decode($dadosCoop["coop_estado"]),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(22,5,utf8_decode('CATEGORIA:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(75,5,utf8_decode(strtoupper($dadosCoop["coop_categoria"])),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(18,5,utf8_decode('SISTEMA:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(75,5,utf8_decode(strtoupper($dadosCoop["coop_sistema"])),1,0,'L', true);
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,utf8_decode('CONTATO PRINCIPAL'),0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20,5,utf8_decode('TELEFONE:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(30,5,utf8_decode($dadosCoop["coop_telefone"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20,5,utf8_decode('WHATSAPP:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(30,5,utf8_decode($dadosCoop["coop_whatsapp"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(15,5,utf8_decode('E-MAIL:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(75,5,utf8_decode($dadosCoop["coop_email"]),1,0,'L', true);
    $pdf->Ln(10);
    //INICIO CONSELHO FISCAL
     $buscaDCA = mysqli_query($conexao, "SELECT * FROM diretoria_conselhoadm WHERE dca_coop = '$cooperativa'");
    if(mysqli_num_rows($buscaDCA) > 0 ){
        while ($DCA = mysqli_fetch_assoc($buscaDCA)){
      
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,utf8_decode('DIRETORIA / CONSELHO DE ADMINISTRAÇÃO'),0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(12,5,utf8_decode('NOME:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(78,5,utf8_decode($DCA["dca_nome"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(14,5,utf8_decode('CARGO:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(50,5,utf8_decode($DCA["dca_cargo"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(18,5,utf8_decode('MANDATO:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(18,5,utf8_decode(strftime('%d/%m/%Y', strtotime($DCA["dca_mandato"]))),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(18,5,utf8_decode('TELEFONE:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(50,5,utf8_decode($DCA["dca_telefone"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(13,5,utf8_decode('E-MAIL:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(109,5,utf8_decode($DCA["dca_email"]),1,0,'L', true);
    }
    }
    // FIM DIRETORIA CONSELHO ADM
    $pdf->Ln(10);
    //INICIO CONSELHO FISCAL
     $buscaCF = mysqli_query($conexao, "SELECT * FROM conselho_fiscal WHERE cf_coop = '$cooperativa'");
    if(mysqli_num_rows($buscaCF) > 0 ){
        while ($conselhoFiscal = mysqli_fetch_assoc($buscaCF)){
      
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,utf8_decode('CONSELHO FISCAL'),0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(12,5,utf8_decode('NOME:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(78,5,utf8_decode($conselhoFiscal["cf_nome"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(14,5,utf8_decode('CARGO:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(50,5,utf8_decode($conselhoFiscal["cf_cargo"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(18,5,utf8_decode('MANDATO:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(18,5,utf8_decode(strftime('%d/%m/%Y', strtotime($conselhoFiscal["cf_mandato"]))),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(18,5,utf8_decode('TELEFONE:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(50,5,utf8_decode($conselhoFiscal["cf_telefone"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(13,5,utf8_decode('E-MAIL:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(109,5,utf8_decode($conselhoFiscal["cf_email"]),1,0,'L', true);
    }
        }
    //FIM CONSELHO FISCAL
    $pdf->Ln(10);
    //INICIO COLABORADOR
    $buscaColaborador = mysqli_query($conexao, "SELECT * FROM colaboradores_coop WHERE col_coop = '$cooperativa'");
    if(mysqli_num_rows($buscaColaborador) > 0 ){
        while ($colaboradores = mysqli_fetch_assoc($buscaColaborador)){
            
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,utf8_decode('COLABORADORES'),0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(13,5,utf8_decode('NOME:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(93,5,utf8_decode($colaboradores["col_nome"]),1,0,'L', true);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(14,5,utf8_decode('CARGO:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(70,5,utf8_decode($colaboradores["col_area"]),1,0,'L', true);
    $pdf->Ln(5);
    $pdf->SetFillColor(227, 227, 227);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(13,5,utf8_decode('E-MAIL:'),1,0,'L', true);
    $pdf->SetFont('Arial','',8);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(177,5,utf8_decode($colaboradores["col_email"]),1,0,'L', true);
    }
    }
    // FIM COLABORADOR
$pdf->Output();
  }else{
    echo "não há informações a serem impressas";
}
  }else{
      echo "não há informações a serem impressas";
  }
?>