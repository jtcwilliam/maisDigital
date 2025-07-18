<?php

require('classes/fpdf186/fpdf.php');
include_once 'classes/arquivo.php';
require_once('classes/FPDI/src/autoload.php');

use setasign\Fpdi\Fpdi;

$objArquivo = new Arquivo();


$arquivos = $objArquivo->solicitarArquivoRelatorio(144);











$imgBlob = $arquivos[1]['arquivo'];
$pdfBlob = $arquivos[0]['arquivo'];

// Extrair BLOBs
$imgData = $arquivos[1]['arquivo'];
$pdfData = $arquivos[0]['arquivo'];

// Salvar arquivos temporários
$tempImg = 'temp_img.png';
$tempPdf = 'temp_pdf.pdf';

file_put_contents($tempImg, $imgData);
file_put_contents($tempPdf, $pdfData);

// Criar PDF com FPDF + FPDI
$pdf = new Fpdi();

// Adicionar página para a imagem
$pdf->AddPage();
$pdf->Image($tempImg, 10, 10, 100); // Ajuste posição/tamanho





// Importar páginas do PDF armazenado
$pageCount = $pdf->setSourceFile($tempPdf);
for ($i = 1; $i <= $pageCount; $i++) {
    $templateId = $pdf->importPage($i);
    $pdf->AddPage();
    $pdf->useTemplate($templateId, 10, 10, 190);
} 

// Output
$pdf->Output('I', 'resultado.pdf');

// Limpar arquivos temporários
unlink($tempImg);
unlink($tempPdf);
