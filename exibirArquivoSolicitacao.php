<?php

include_once './classes/arquivo.php';

$objArquivo = new Arquivo();

$arquivos =  $objArquivo->gerarArquivo($_GET['idArquivo']);



$tipoArquivo = $arquivos[0]['tipoArquivo'];


switch ($tipoArquivo) {
    case 'image/png':

        header('Content-Type: image/png');

        $imagem = imagecreatefromstring($arquivos[0]['arquivo']);

        // Exibe a imagem
        imagepng($imagem);

        // Libera a memória usada pela imagem
        imagedestroy($imagem);

        break;


    case 'image/jpeg':

        header('Content-Type: image/jpeg');

        $imagem = imagecreatefromstring($arquivos[0]['arquivo']);

        // Exibe a imagem
        imagejpeg($imagem);

        // Libera a memória usada pela imagem
        imagedestroy($imagem);

        break;



    case 'application/pdf':

        //$decoded_pdf_data = base64_decode($arquivos[0]['arquivo']);

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="teste.pdf"'); // 'inline' to display in browser, 'attachment' to force download

        echo   $arquivos[0]['arquivo'];

        unlink('teste.pdf');






        break;

    default:
        # code...
        break;
}
