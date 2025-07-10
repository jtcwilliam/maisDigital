<?php



include_once '../classes/servicos.php';

$objservico = new Servicos();

$dados = $objservico->trazerServicos();



echo  '<option    >     </option>';


foreach ($dados as $key => $value) {

    $descricao = $value['descricaoCarta'];
    if (strlen($descricao) > 200) {

        $descricao = substr($descricao, 0, 200) . '...';
    }


    echo '<option value=' . $value['linkCarta'] . '  >' . $descricao . '</option>';
}
