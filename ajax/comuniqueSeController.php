<?php
include '../classes/Envio.php';
$objEnvio = new Envio();

if (isset($_POST['comuniqueSeSolicitaArquivo'])) {

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
            <h2> Somos Equie Mais Digital da Prefeitura de Guarulhos </h2>

            <h3> Por Favor, envie o arquivo  <b><i><?= $_POST['nomeTipoArquivoTxt']?></i></b> </h3>

            <p style="font-size: 1.2em;"><?= $_POST['mensagemComuniqueArquivo'] ?></p>
            <br>Clique no link que enviamos neste email para fazer a
            alteração adequada e prosseguirmos para a conclusão de sua solicitação<br> <b>Observação:</b> Está solicitação permanecerá
            sem prosseguimento, até que você faça esta correção.
            </p>




            <a style="color: green; text-decoration: none; font-style: italic;"
                href="http://localhost:8888/maisDigital/carregarArquivoSolicitacao.php?idTipoDocumento=<?= $_POST['idTipoDocumento'] ?>&idSolicitacao=<?= $_POST['solicitacao'] ?> " target="_blank">
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
    $objEnvio->setDestinatario('jtcwilliam@gmail.com');

    $objEnvio->envioEmail();
}
