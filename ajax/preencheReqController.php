<?php


include '../classes/Solicitacao.php';

$objSolicitacao = new Solicitacao();


if (isset($_POST['criarRequerimento'])) {

    $nomeRamdomico = rand();

    $objSolicitacao->setNome($nomeRamdomico);
    if ($objSolicitacao->criarRequerimento()) {


        echo json_encode(array('retorno' => true, 'codigo' => $nomeRamdomico));
    }

    exit();
}



$objSolicitacao->setArquivo($_POST['assinatura']);

$objSolicitacao->setsolicitante($_POST['txtNome']);

$objSolicitacao->setDocumentoSolicitante($_POST['cpf']);

$objSolicitacao->setTelefone($_POST['txtTel']);

$objSolicitacao->setEmail($_POST['txtEmail']);

$objSolicitacao->setCepSolicitacao($_POST['txtCEP']);

$objSolicitacao->setLogradouroSol($_POST['txtRua']);

$objSolicitacao->setNumeroSol($_POST['txtNUmero']);

$objSolicitacao->getComplemento($_POST['txtComplemento']);

$objSolicitacao->getCidade($_POST['txtCidade']);

$objSolicitacao->setArquivo($_POST['assinatura']);

$objSolicitacao->setStatusSolicitacao($_POST['txtNome']);

$objSolicitacao->setSolicitacao($_POST['txtSolicitacao']);

$objSolicitacao->setBairro($_POST['txtBairro']);


//

$objSolicitacao->setsolicitante($_POST['idRequerimento']);

$objSolicitacao->gravarRequerimento();
