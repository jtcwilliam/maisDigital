<?php

include_once '../classes/Pessoa.php';

$objPessoaMovimentar = new Pessoa();

//esse script apenas grava a pessoa



require_once '../classes/LDAP.class.php';

$ldap = new LDAP();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$selectUnidade = $_POST['selectUnidade'];






$usuario = $ldap->logar($usuario, $senha);





if (isset($usuario['count'])  && $usuario['count'] == 1) {


$prefixo = $_POST['cpf'];

$prefixo = substr($prefixo, 0, 3);


    $objPessoaMovimentar->setNomePessoa($_POST['nomeUsuario']);
    $objPessoaMovimentar->setTipoPessoa('3');
    $objPessoaMovimentar->setStatusPessoa('1');
    $objPessoaMovimentar->setDocumentoPessoa($_POST['cpf']);
    $objPessoaMovimentar->setEmailUsuario($_POST['usuario']);
    $objPessoaMovimentar->setUnidade($selectUnidade);
    $objPessoaMovimentar->setPrefixoDoc($prefixo);




    if ($objPessoaMovimentar->inserirFuncionarioPrefs()) {
        echo json_encode(array('retorno' => true));
    }
} else {

    echo json_encode(array('retorno' => false));
}

exit();
