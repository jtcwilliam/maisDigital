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
                    <button type="button" id="uploadButton<?= $i ?>" class="button " style="width: 100%; text-align: justify;  height: 3em;"
                        onclick="subirArquivo('file<?= $i ?>','fileInput<?= $i ?>', 'mensagem<?= $i ?>',   ' <?= $value['descricaoDoc'] ?> ', 'uploadButton<?= $i ?>', 'caixa<?= $i ?>', $('#idQuantidadeArquivoDoServico').val() )  ">
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







$tipo = $_FILES['file']['type'];

$nomeArquivo = $_POST['nomeArquivo'];

include_once '../classes/Sanitizar.php';

$nomeArquivoSize =  $_POST['nomeArquivo'];
if (strlen($nomeArquivoSize) >= 180) {
    $nomeArquivo = substr($nomeArquivoSize, 0, 180);
}

$nomeArquivo =  $nomeArquivo;



$file = file_get_contents($_FILES['file']['tmp_name']);

$arquivoTipo =  $_FILES['file']['type'];


$objArquivo->setTipoArquivo($arquivoTipo);

$objArquivo->setNomeArquivo($nomeArquivo);

$objArquivo->setIdSolicitacao($_POST['idSolicitacao']);

$objArquivo->setStatusArquivo('1');

$objArquivo->setArquivo($file);


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
