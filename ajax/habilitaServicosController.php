<?php

use Dom\Document;

echo '<pre>';
print_r($_POST);



$documentos = $_POST['comboDocumentos'];






/*    $stmt->bindValue(':habilitado',  $this->getServicoHabilitado(), PDO::PARAM_STR);

            $stmt->bindValue(':infoAtendente',  $this->getInfoAtendente(), PDO::PARAM_STR);

            $stmt->bindValue(':idCarta', $this->getIdCartaServico(), PDO::PARAM_STR);
            */

include '../classes/servicos.php';
include '../classes/Documentos.php';

$objServicos = new Servicos();
$objDocumentos = new Documentos();

$objServicos->setServicoHabilitado(1);
$objServicos->setInfoAtendente($_POST['infoAtendimentos']);
$objServicos->setIdCartaServico($_POST['comboServicos']);

if ($objServicos->habilitarServicos()) {

    foreach ($documentos as $key => $value) {

        $objDocumentos->setIdServico($_POST['comboServicos']);
        $objDocumentos->setIdDocumento($value);
        $objDocumentos->setStatus('1');

        $objDocumentos->inserirServicoDocumento();
    }
}
