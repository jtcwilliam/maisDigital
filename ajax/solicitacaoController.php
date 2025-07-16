<?php

include '../classes/Solicitacao.php';

$objSolicitacao = new Solicitacao();

if (isset($_POST['inserirSolicitacao'])) {

    $ran = rand();
    $randomico = $ran  . '/' . date('Y');
    $objSolicitacao->setAssuntoSolicitacao($_POST['assuntoSolicitacao']);
    $objSolicitacao->setDescricaoSolicitacao($_POST['descricao']);
    $objSolicitacao->setDocumentoPublico($_POST['documentoPublico']);
    $objSolicitacao->setDataSolicitacao(date('Y-m-d H:i:s'));
    $objSolicitacao->setStatusSolicitacao($_POST['statusSolicitacao']);
    $objSolicitacao->setSolicitacante($_POST['idUsuario']);
    $objSolicitacao->setTipoDocumento($_POST['comboTipoInscricao']);
    $objSolicitacao->setProtocolo($randomico);


    if ($objSolicitacao->gravarSolicitacao() == true) {
        $protocolo =  $objSolicitacao->trazerSolicitacao($randomico);
        echo json_encode(array('retorno' => true, 'idSolicitacaoHidden' => $protocolo[0]['idsolicitacao']));
    }
}
