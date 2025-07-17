<?php



include_once '../classes/Solicitacao.php';





$objSolicitacao = new Solicitacao();



if (isset($_POST['verificarAssinatura'])  &&  $_POST['verificarAssinatura']) {

    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);



    //    print_r($assinaturaAtiva[0]['statusSolicitacao']);

    if ($assinaturaAtiva[0]['statusSolicitacao'] == '10') {

        $retornoAssinatura = '<center><img style="" src="' . $assinaturaAtiva[0]['assinaturaSolicitacao']  . '" /></center>';

        echo json_encode(array('retorno' => true));
    }

    die();
}


if (isset($_POST['finalizaSolicitacao'])  &&  $_POST['finalizaSolicitacao']) {

    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);



    echo '<center><img style="" src="' . $assinaturaAtiva[0]['assinaturaSolicitacao']  . '" /></center>';




    die();
}





$objSolicitacao->setArquivo($_POST['assinatura']);
$objSolicitacao->setSolicitacao($_POST['idSolicitacao']);


if ($objSolicitacao->inserirAssinaturaSolicitacao() == true) {
    echo json_encode(array('retorno' => true));
}
