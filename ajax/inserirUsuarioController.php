<?php


$nome = $_POST['nomeUsuario'];
$nome = str_replace(' ', '', $nome);
if (strlen($nome) <= 2) {
    echo json_encode(array('retorno' => 'nomeErrado'));
} else {





    include_once '../classes/Pessoa.php';

    $objPessoaMovimentar = new Pessoa();

    //esse script apenas grava a pessoa


    $prefixo = $_POST['cpf'];

    $prefixo = substr($prefixo, 0, 3);




    
    if ($_POST['validaTipoCadastro'] == '0') {


        $objPessoaMovimentar->setEmailUsuario(null);
        $objPessoaMovimentar->setSenha(null);
    } else {
        
        $objPessoaMovimentar->setEmailUsuario($_POST['emailAgendamento']);
        $objPessoaMovimentar->setSenha(md5($_POST['senhaAgendamento']));
    }

    



    $objPessoaMovimentar->setNomePessoa($_POST['nomeUsuario']);
    $objPessoaMovimentar->setTipoPessoa('1');
    $objPessoaMovimentar->setStatusPessoa('1');
    $objPessoaMovimentar->setDocumentoPessoa($_POST['cpf']);
    $objPessoaMovimentar->setPrefixoDoc($prefixo);
    $objPessoaMovimentar->setValidaTipoCadastro($_POST['validaTipoCadastro']);

    $objPessoaMovimentar->setConfirmaTermo($_POST['confirmaTermo']);



 
    if ($objPessoaMovimentar->inserirPessoasAgendamento()) {
        echo json_encode(array('retorno' => true));
    }

   
 
}
