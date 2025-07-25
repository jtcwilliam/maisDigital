<?php



include '../classes/servicos.php';
include '../classes/Documentos.php';

$objServicos = new Servicos();
$objDocumentos = new Documentos();


$documentosInserir = $_POST['comboDocumentos'];

$docs = count($documentosInserir);



$objServicos->setServicoHabilitado(1);
$objServicos->setInfoAtendente($_POST['infoAtendimentos']);
$objServicos->setIdCartaServico($_POST['comboServicos']);
$objServicos->setCategoria($_POST['comboCategoria']);

$i = 0;

if ($objServicos->habilitarServicos()) {

    foreach ($documentosInserir as $key => $value) {

        $objDocumentos->setIdServico($_POST['comboServicos']);

        $objDocumentos->setIdDocumento($value);
        $objDocumentos->setStatus('1');

        if ($objDocumentos->inserirServicoDocumento()) {
            $i++;
        }
    }
}



if ($i == $docs) {
    header("Location: ../habilitarServicos.php?servico=" . $_POST['comboServicos'] . "&retorno=true");
    die();
}
