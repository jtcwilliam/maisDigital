<?php





include_once '../classes/Documentos.php.php';

$objservico = new Documentos();

$dados = $objservico->trazerDocumentos();



echo  '<option    >     </option>';


foreach ($dados as $key => $value) {

    $descricao = $value['descricaoDoc'];
    if (strlen($descricao) > 200) {

        $descricao = substr($descricao, 0, 300) . '...';
    }


    echo '<option value=' . $value['idDoc'] . '  >' . $descricao . '</option>';
}
