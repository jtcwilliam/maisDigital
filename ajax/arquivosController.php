<?php


//include_once '../classes/arquivo.php';
include_once '../classes/Documentos.php';

//$objArquivo = new Arquivo();
$objDOcumento = new Documentos();

if (isset($_POST['criaCampoArquivo'])) {



    $criarCaixaArquivo =  $objDOcumento->trazerDocumentoArquivo($_POST['idServico']);




    $i = 0;
    foreach ($criarCaixaArquivo as $key => $value) {
?>
        <div class=" grid-x  grid-padding-x " >

            <div class="small-12 large-3 cell">
                <input type="file" class="  " name="arquivo<?= $i ?>" value="<?= $value['descricaoDoc'] ?>" />
            </div>
            <div class="small-12 large-8 cell">
                <label>
                    <h5><?= $value['descricaoDoc'] ?> </h5>
                </label>
            </div>


        </div>

        <hr>

<?php
        $i++;
    }

    die();
}









//$file = file_get_contents($_FILES['file']['tmp_name']);






/*

$objArquivo->setArquivo($file);


$objArquivo->inserirArquivos();
*/