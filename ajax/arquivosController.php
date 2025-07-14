<?php


include_once '../classes/arquivo.php';
include_once '../classes/Documentos.php';

$objArquivo = new Arquivo();
$objDOcumento = new Documentos();

if (isset($_POST['criaCampoArquivo'])) {



    $criarCaixaArquivo =  $objDOcumento->trazerDocumentoArquivo($_POST['idServico']);




    $i = 0;
    foreach ($criarCaixaArquivo as $key => $value) {
?>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   ">
            <div class=" small-12 large-12 cell">
                <p class="button success mensagemB "  style="width: 100%;" id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>
            </div>

        </div>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   "  id="caixa<?= $i ?>" >




            <div class=" small-12 large-3 cell" style="display: grid; align-items: center;">
                <input type="file" id="fileInput<?= $i ?>" name="file<?= $i ?>" class="button" style="background-color:brown; height: 3em; " />
                <p class="button success mensagemB " id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>

            </div>
            <div class="small-12 large-9 cell">
                <label>
                    <button type="button" id="uploadButton<?= $i ?>" class="button " style="width: 100%; text-align: justify;  height: 3em;"
                        onclick="subirArquivo('file<?= $i ?>','fileInput<?= $i ?>', 'mensagem<?= $i ?>',   ' <?= $value['descricaoDoc'] ?> ', 'uploadButton<?= $i ?>', 'caixa<?= $i ?>')  ">
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















$file = file_get_contents($_FILES['file']['tmp_name']);






$objArquivo->setArquivo($file);


$objArquivo->inserirArquivos();
