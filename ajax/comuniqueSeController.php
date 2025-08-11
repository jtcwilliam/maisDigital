<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



include '../classes/Envio.php';
include '../classes/Solicitacao.php';
include '../classes/arquivo.php';


$objEnvio = new Envio();
$objSolicitacao = new Solicitacao();
$objArquivo  = new Arquivo();



//
if (isset($_POST['comunicarSe']) &&  $_POST['comunicarSe'] == 'solicitarArquivo') {





    //codigo para ajudar a identificar o arquivo a ser trocado;
    $codigoArquivoTroca = rand();



    $objArquivo->setNomeArquivo($_POST['nomeTipoArquivoTxt']);
    $objArquivo->setTipoArquivo($codigoArquivoTroca);
    $objArquivo->setIdSolicitacao($_POST['solicitacao']);
    $objArquivo->setStatusArquivo(12);
    $objArquivo->setIdTipoDocumento($_POST['codigoId']);  //




    if ($objArquivo->inserirArquivos()) {

        $objSolicitacao->setIdSolicitacao($_POST['solicitacao']);
        $objSolicitacao->setStatusSolicitacao('12');

        $objSolicitacao->mudarStatusSolicitacao();
    }




    $objEnvio->setAssunto('Envio do arquivo ' . $_POST['nomeTipoArquivoTxt'] . '. ');


    ob_start();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body style="font-family: Arial, Helvetica, sans-serif;">
        <center>
            <h2> Somos Equipe Mais Digital da Prefeitura de Guarulhos </h2>

            <h3> Por Favor, envie o arquivo <b><i><?= $_POST['nomeTipoArquivoTxt'] ?></i></b> </h3>

            <p style="font-size: 1.2em;"><?= $_POST['mensagemComuniqueArquivo'] ?></p>
            <br>Clique no link que enviamos neste email para fazer a
            alteração adequada e prosseguirmos para a conclusão de sua solicitação<br> <b>Observação:</b> Está solicitação permanecerá
            sem prosseguimento, até que você faça esta correção.
            </p>




            <a style="color: green; text-decoration: none; font-style: italic;"
                href="https://agendafacil.guarulhos.sp.gov.br/testeDigitalPlus_agosto/carregarArquivoSolicitacao.php?validador=inserirArquivo&trocaArquivo=<?=$codigoArquivoTroca?>&idTipoDocumento=<?= $_POST['codigoId'] ?>&idSolicitacao=<?= $_POST['solicitacao'] ?> " target="_blank">
                <h2>Clique aqui para enviar o Arquivo Solicitado </h2>
            </a>
            <br>

            <h4> Estamos á Disposição!<br>

                <b>Equipe Mais Digital</b>
                <h2> Prefeitura de Guarulhos</h2>
            </h4>

        </center>
    </body>

    </html>
    <?php
    $dados = ob_get_contents();
    ob_end_clean();



    $objEnvio->setConteudo($dados);
    $objEnvio->setDestinatario($_POST['txtEmailParaEnvioArquivo']);

    if ($objEnvio->envioEmail()) {

        echo json_encode(array('retorno' => true));
    }
}


if (isset($_POST['comunicarSe']) &&  $_POST['comunicarSe'] == 'excluirArquivo') {


    include_once '../classes/arquivo.php';


    $objArquivo = new Arquivo();

    $objArquivo->setIdArquivo($_POST['codigoId']);
    if ($objArquivo->apagarArquivo()) {

        $dadosArquivo = $objArquivo->dadosArquivoSolicitante($_POST['codigoId']);

        ob_start();

    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

        </head>

        <body style="font-family: Arial, Helvetica, sans-serif;">
            <center>
                <h2>Olá <?= $dadosArquivo[0]['nomePessoa'] ?> Somos Equipe Mais Digital da Prefeitura de Guarulhos </h2>

                <p style="font-size: 1.2em;">O arquivo <b><?= $dadosArquivo[0]['nomeArquivo'] ?></b>, anexo a sua solicitação precisa ser substituido!</p>

                <p style="font-size: 1.2em;"><?= $_POST['mensagemComuniqueArquivo'] ?></p>


                <br>Clique no link que enviamos neste email para fazer a
                alteração adequada e prosseguirmos para a conclusão de sua solicitação<br> <b>Observação:</b> Está solicitação permanecerá
                sem prosseguimento, até que você faça esta correção.
                </p>




                <a style="color: green; text-decoration: none; font-style: italic;"
                    href="https://agendafacil.guarulhos.sp.gov.br//testeDigitalPlus_agosto/carregarArquivoSolicitacao.php?validador=Alterar&idTipoDocumento=<?= $_POST['codigoId'] ?>&idSolicitacao=<?= $_POST['solicitacao'] ?> " target="_blank">
                    <h2>Clique aqui para alterar o Arquivo <?= $dadosArquivo[0]['nomeArquivo'] ?> </h2>
                </a>
                <br>

                <h4> Estamos á Disposição!<br>

                    <b>Equipe Mais Digital</b>
                    <h2> Prefeitura de Guarulhos</h2>
                </h4>





            </center>
        </body>

        </html>
<?php
        $dados = ob_get_contents();
        ob_end_clean();




        $objEnvio->setDestinatario($_POST['txtEmailParaEnvioArquivo']);
        $objEnvio->setAssunto('Alteração de Arquivo na sua solicitação');
        $objEnvio->setConteudo($dados);

        if ($objEnvio->envioEmail()) {

            echo json_encode(array('retorno' => true));
        }
    }




    exit();
}
