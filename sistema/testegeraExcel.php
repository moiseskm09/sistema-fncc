<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();


$spreadsheet->getActiveSheet()->getHeaderFooter()
    ->setOddHeader('RELATÓRIO DE ATENDIMENTOS');
$spreadsheet->getActiveSheet()->getHeaderFooter()
    ->setOddFooter('&L&B' . $spreadsheet->getProperties()->getTitle() . '&RPage &P of &N');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'RELATÓRIO DE ATENDIMENTOS');
	$spreadsheet->getActiveSheet()->mergeCells('A1:F1');
        $spreadsheet->getActiveSheet()->mergeCells('A3:F3');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'FILTRO APLICADO');
        
        $spreadsheet->getActiveSheet()->getStyle('A1')
    ->getFill()->getStartColor()->setARGB('ffda0b0b');
        
        $spreadsheet->getActiveSheet()->setCellValue('A4', 'COOPERATIVA: TODAS');
        $spreadsheet->getActiveSheet()->mergeCells('A4:A5');
        $spreadsheet->getActiveSheet()->getStyle('A4:A5')->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->setCellValue('B4', 'ÁREA DE ATENDIMENTO: TODAS');
        $spreadsheet->getActiveSheet()->mergeCells('B4:B5');
        $spreadsheet->getActiveSheet()->setCellValue('C4', 'DATA INICIAL: 04/02/2023');
        $spreadsheet->getActiveSheet()->mergeCells('C4:C5');
        $spreadsheet->getActiveSheet()->setCellValue('D4', 'DATA FINAL: 04/02/2023');
        $spreadsheet->getActiveSheet()->mergeCells('D4:D5');
        $spreadsheet->getActiveSheet()->setCellValue('E4', '#######');
        $spreadsheet->getActiveSheet()->mergeCells('E4:F5');
        
        $spreadsheet->getActiveSheet()->mergeCells('A7:F7');
        $spreadsheet->getActiveSheet()->setCellValue('A7', 'RESULTADO');


$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

