<?php
include_once 'classes/arquivo.php';
include_once 'classes/Solicitacao.php';


include 'classes/relatorioFPDF.php';
require_once('classes/FPDI/src/autoload.php');

$objArquivo = new Arquivo();
$objSolicitacao = new Solicitacao();

$arquivos = $objArquivo->solicitarArquivoRelatorio(148);


use setasign\Fpdi\Fpdi;

$pdfs = new Fpdi();


$pdfs = new PDFS();
$pdfs->AddPage();
$pdfs->SetFont('Arial', '', 12);

// Texto com negrito e normal + alinhamento justificado
$pdfs->SetX(10);
$pdf->MultiCell(0, 6, '', 0, 'J'); // Reservar área
$pdf->SetXY(10, $pdf->GetY());
$pdf->WriteHTML('Este é um texto <B>em negrito</B> e aqui volta ao normal. Outro <B>negrito</B> no meio.');


$tempPdfFile = array();
$tempIMGFile = array();

$w = 0;
foreach ($arquivos as $key => $value) {

    switch ($value['tipoArquivo']) {
        case 'application/pdf':




            //colocar o registro do banco em uma variavel
            $pdfData[$w] = $value['arquivo'];

            //cria um arquivo temporário para rechear com o pdf
            $tempPdf[$w] = 'temp_pdf' . $w . '.pdf';

            array_push($tempPdfFile, $tempPdf[$w]);

            //coloca os dados nesse arquivo temporário
            file_put_contents($tempPdf[$w], $pdfData[$w]);


            $pageCount = $pdfs->setSourceFile($tempPdf[$w]);
            for ($i = 1; $i <= $pageCount; $i++) {
                $templateId = $pdfs->importPage($i);
                $pdfs->AddPage();
                $pdfs->useTemplate($templateId, 10, 10, 190);
            }




            break;

        case 'image/png':

            /*
            //insere a imagem nessa variavel
            $imgData[$w] = $value['arquivo'];

            //criação de um arquivo temporário
            $tempImg[$w] = 'temp_img' . $w . '.png';

            array_push($tempIMGFile, $tempImg[$w]);

            //recheando o pdf com esse arquivo
            file_put_contents($tempImg[$w], $imgData[$w]);

            //adicionando nova página





            //adicionando nova página
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 12);

            // Texto a ser centralizado
            $texto = "Este texto será centralizado na página.";

            $texto = iconv('utf-8', 'cp1252', $texto);
            $mid_x = 135; // the middle of the "PDF screen", fixed by now.

            $pdf->Text(10, 20, $texto);


            //criando uma nova imagem
            $pdf->Image($tempImg[$w], 10, 30, 180); // Ajuste posição/tamanho


            */

            break;

        case 'image/jpg':
            //   echo 'saiu jpg';
            break;

        default:
            # code...
            break;
    }


    $w++;
}

// Output
$pdf->Output();
