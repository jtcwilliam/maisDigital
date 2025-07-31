<?php


include_once '../classes/arquivo.php';
include_once '../classes/Documentos.php';

$objArquivo = new Arquivo();
$objDOcumento = new Documentos();


if (isset($_POST['criaCampoArquivo'])) {

    $criarCaixaArquivo =  $objDOcumento->trazerDocumentoArquivo($_POST['idServico']);

    $quantidadeArquivos =  count($criarCaixaArquivo);

    //verificar quantos arquivos tem anexos a este serviço;
    echo   "   <input type='hidden' id='idQuantidadeArquivoDoServico'  value='$quantidadeArquivos'/>";
    


    $i = 0;
    foreach ($criarCaixaArquivo as $key => $value) {
?>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   ">
            <div class=" small-12 large-12 cell">
                <p class="button   mensagemB " style="width: 100%; background-color: rgb(23, 121, 186);  " id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>
            </div>

        </div>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   " id="caixa<?= $i ?>">




            <div class=" small-12 large-3 cell" style="display: grid; align-items: center;">
                <input type="file" id="fileInput<?= $i ?>" name="file<?= $i ?>" class="button" style="background-color:brown; height: 3em; " />
                <p class="button success mensagemB " id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>

            </div>
            <div class="small-12 large-9 cell">
                <label>
                    <!-- campo que pega o tipo do documento para ser gravado no arquivo -->
                       <input type='hidden' id='idTipoDocumento<?= $i ?>'  value='<?=$value['idDocumento']  ?>'/>
                    <button type="button" id="uploadButton<?= $i ?>" class="button " style="width: 100%; text-align: justify;  height: 3em;"
                        onclick="subirArquivo('file<?= $i ?>','fileInput<?= $i ?>', 'mensagem<?= $i ?>',   ' <?= $value['descricaoDoc'] ?> ', 'uploadButton<?= $i ?>', 'caixa<?= $i ?>', $('#idQuantidadeArquivoDoServico').val(),  $('#idTipoDocumento<?= $i ?>').val() )  ">
                        Clique para carregar o <b><i>"<?= $value['descricaoDoc'] ?>"</i></b>
                    </button>
                </label>
            </div>



        </div>




    <?php
        $i++;
    }

    ?>

    <script>
        $('.mensagemB').hide();
    </script>

    <?php
    die();
}




//controller que delete o arquivo e informa ao cidadão
if (isset($_POST['apagarArquivoAtendente'])) {

    $objArquivo->setIdArquivo($_POST['idArquivo']);
    if ($objArquivo->apagarArquivo()) {
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
                <h2>Olá <?= $_POST['txtNomePessoaParaEnvioArquivo'] ?> . Somos Equie Mais Digital da Prefeitura de Guarulhos </h2>

                <p style="font-size: 1.2em;">O arquivo <b><?= $_POST['nomeArquivo'] ?> </b> que foi anexo a sua solicitação está errado.
                    <br>Clique no link que enviamos neste email para fazer a
                    alteração adequada e prosseguirmos para a conclusão de sua solicitação<br> <b>Observação:</b> Está solicitação permanecerá
                    sem prosseguimento, até que você faça esta correção.
                </p>




                <a style="color: green; text-decoration: none; font-style: italic;"
                    href="http://localhost:8888/maisDigital/carregarArquivoSolicitacao.php?idArquivo=<?= $_POST['idArquivo'] ?>" target="_blank">
                    <h2>Clique aqui para alterar o Arquivo <?= $_POST['nomeArquivo'] ?> </h2>
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


        //fim do conteudo da mensagem do email

        include_once '../classes/Envio.php';
        $objEnvio = new Envio();

        $objEnvio->setDestinatario($_POST['txtEmailParaEnvioArquivo']);
        $objEnvio->setAssunto('Alteração de Arquivo na sua solicitação');
        $objEnvio->setConteudo($dados);

        if ($objEnvio->envioEmail()) {

            echo json_encode(array('retorno' => true));
        }
    }




    exit();
}


if (isset($_POST['carregarArquivoApagadoPeloAtendenteSolicitante']) && $_POST['validador'] == 'Alterar' ) {


    $tipo = $_FILES['file']['type'];

 


    $file = file_get_contents($_FILES['file']['tmp_name']);
 




    $objArquivo->setTipoArquivo($tipo);

    $objArquivo->setIdArquivo($_POST['idArquivo']);

    $objArquivo->setArquivo($file);







 

    $carregarFinalizaUP = 1;
    if ($objArquivo->atualizarAquivoSolicitacao()) {



        echo json_encode(array('retorno' => true));
    }

    exit();
}


if (isset($_POST['carregarArquivoApagadoPeloAtendenteSolicitante']) && $_POST['validador'] == 'inserirArquivo' ) {


$tipo = $_FILES['file']['type'];

  
 


$nomeArquivo = $objDOcumento->trazerDocumentos(' where idDoc ='. $_POST['idArquivo']);
 



 



$file = file_get_contents($_FILES['file']['tmp_name']);

$arquivoTipo =  $_FILES['file']['type'];

$idTipoDocumento = $_POST['idArquivo'];


$objArquivo->setTipoArquivo($arquivoTipo);

$objArquivo->setNomeArquivo($nomeArquivo[0]['descricaoDoc']);

$objArquivo->setIdSolicitacao($_POST['idSolicitacao']);

$objArquivo->setStatusArquivo('1');

$objArquivo->setArquivo($file);

// codigo do tipo de documento vem 
$objArquivo->setIdTipoDocumento($idTipoDocumento);

$carregarFinalizaUP = 1;
if ($objArquivo->inserirArquivos()) {



    /*
    $objQtdeArquivo = $objArquivo->consultarQuantidadeArquivo($_POST['idSolicitacao']);
    $objArquivo = count($objQtdeArquivo);

    $qtdeArquivosServico =  $_POST['idQuantidadeArquivoDoServico'];

    if ($objArquivo == $qtdeArquivosServico) {
        $carregarFinalizaUP = true;
    }else{
        $carregarFinalizaUP = false;
    }

    echo json_encode(array('retorno' => true, 'carregarBotaoFinaliza' => $carregarFinalizaUP));

  */

    echo json_encode(array('retorno' => true));
}

exit();

}

 