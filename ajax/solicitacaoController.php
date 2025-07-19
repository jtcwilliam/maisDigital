<?php

include '../classes/Solicitacao.php';

$objSolicitacao = new Solicitacao();

if (isset($_POST['inserirSolicitacao'])) {

    $ran = rand();
    $randomico = $ran  . '/' . date('Y');
    $objSolicitacao->setAssuntoSolicitacao($_POST['assuntoSolicitacao']);
    $objSolicitacao->setDescricaoSolicitacao($_POST['descricao']);
    $objSolicitacao->setDocumentoPublico($_POST['documentoPublico']);
    $objSolicitacao->setDocumentoSolicitante($_POST['cpfSolicitante']);

    $objSolicitacao->setDataSolicitacao(date('Y-m-d H:i:s'));
    $objSolicitacao->setStatusSolicitacao($_POST['statusSolicitacao']);
    $objSolicitacao->setsolicitante($_POST['idUsuario']);
    $objSolicitacao->setTipoDocumento($_POST['comboTipoInscricao']);
    $objSolicitacao->setProtocolo($randomico);



    $objSolicitacao->setCepSolicitacao($_POST['txtCEP']);

    $objSolicitacao->setLogradouroSol($_POST['txtRua']);

    $objSolicitacao->setNumeroSol($_POST['txtNUmero']);

    $objSolicitacao->setComplemento($_POST['txtComplemento']);

    $objSolicitacao->setBairro($_POST['txtBairro']);
    //            \\


    if ($objSolicitacao->gravarSolicitacao() == true) {
        $protocolo =  $objSolicitacao->trazerSolicitacao($randomico);
        echo json_encode(array('retorno' => true, 'idSolicitacaoHidden' => $protocolo[0]['idsolicitacao']));
    }
}
