<?php

require('classes/fpdf186/fpdf.php');
include_once 'classes/Solicitacao.php';

require_once('classes/FPDI/src/autoload.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

use setasign\Fpdi\Fpdi;


$objSolicitacao = new Solicitacao();

//$idSolicitacao = $_GET['idSolicitacao'];

$dadosSolicitacao = $objSolicitacao->consultarRequerimento('');








switch (date('m')) {
    case '1':
        $mes = "Janeiro";
        break;

    case '2':
        $mes = "Fevereiro";
        break;

    case '3':
        $mes = "Março";
        break;

    case '4':
        $mes = "Abril";
        break;

    case '5':
        $mes = "Maio";
        break;

    case '6':
        $mes = "Junho";
        break;



    case '7':
        $mes = "Julho";
        break;

    case '8':
        $mes = "Agosto";
        break;

    case '9':
        $mes = "Setembro";
        break;

    case '10':
        $mes = "Outubro";
        break;

    case '11':
        $mes = "Novembro";
        break;

    case '12':
        $mes = "Dezembro";
        break;

 

    default:
        # code...
        break;
}






setlocale(LC_TIME, 'pt_BR.utf8');





$dataDaSol = 'Guarulhos, ' .  date('d') . ' de ' . $mes . ' de ' .  date('Y');

// Criar PDF com FPDF + FPDI
$pdf = new Fpdi();

$pdf->AddPage();

$pdf->Image('logoPrefeitura.png', 5, 10, 60);
$pdf->SetFont('Arial', 'B', 30);


$pdf->Text(65, 31, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Requerimento Padrão'));

$pdf->SetFont('Arial', '', 13);
$pdf->Text(10, 43, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Ao Excelentíssimo Senhor Prefeito do Município de Guarulhos'));
$pdf->Cell(190, 35, '', 0, 1, 'C');


$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 6, 'Dados Pessoais', 1, 1, 'C');

// Texto com negrito e normal + alinhamento justificado
$pdf->SetFont('Arial', '', 13);
$pdf->SetX(10);
$pdf->MultiCell(0, 6, '', 0, 'J'); // Reservar área
$pdf->SetXY(10, 53, $pdf->GetY());
$pdf->WriteHTML(iconv("UTF-8", "ISO-8859-1//TRANSLIT", "<b>Nome do Solicitante:</b> " . $dadosSolicitacao[0]['nome'] . "<br><br><b>CPF ou CNPJ:</b> " .  $dadosSolicitacao[0]['cpfCnpj']  . " 
<br><br><b>Email:</b> " .  $dadosSolicitacao[0]['email']  . " <br> <br><b>Endereço: </b>" . $dadosSolicitacao[0]['logradouro'] .
    ", " . $dadosSolicitacao[0]['numero'] . ". " . $dadosSolicitacao[0]['complemento'] . "  " . $dadosSolicitacao[0]['bairro'] . " <br><br><b> Inscricao: </b>  12332.232 <b><br><br>Venho, respeitosamente, solicitar</b> <br>" . $dadosSolicitacao[0]['solicitacao'] . " <br>  "));



$pdf->SetXY(10, 230, $pdf->GetY());

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 8, $dataDaSol, 0, 0, 'j');

$base64 =   $dadosSolicitacao[0]['assinatura'];

// Remover o prefixo data:image/png;base64,
$base64 = str_replace('data:image/png;base64,', '', $base64);
$base64 = str_replace(' ', '+', $base64);

// Decodificar base64
$data = base64_decode($base64);

// Criar arquivo temporário
$file = 'temp_image.png';
file_put_contents($file, $data);



// Adicionar imagem no PDF
$pdf->Image($file, 60, 190, 90, 0, 'PNG');

unlink($file);

$pdf->SetXY(10, 260, $pdf->GetY());
//
$pdf->Cell(0, 10,  $dadosSolicitacao[0]['nome'], 0, true, 'C');




$tempPdfFile = array();





// Output
$pdf->Output();


foreach ($tempPdfFile as $key => $value) {
    unlink($value);
}



foreach ($tempIMGFile as $key => $value) {
    unlink($value);
}
