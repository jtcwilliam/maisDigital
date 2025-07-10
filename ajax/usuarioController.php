<?php

include_once '../classes/Pessoa.php';

$objPessoaMovimentar = new Pessoa();

$validadorSenha = $_POST['atualizarUsuario'];



if (isset($_POST['atualizarUsuario'])) {

    $objPessoaMovimentar->setNomePessoa($_POST['nomeUsuario']);
    $objPessoaMovimentar->setEmailUsuario($_POST['emailUsuario']);
    $objPessoaMovimentar->setIdPessoas($_POST['idUsuario']);




    if ($validadorSenha == 1) {



        $objPessoaMovimentar->setSenha(md5($_POST['senhaUsuario']));

        if ($objPessoaMovimentar->alterarDados() == true &&  $objPessoaMovimentar->alterarSenha() == true) {

            echo json_encode(array('retorno' => true));
        }
    } else {
        if ($objPessoaMovimentar->alterarDados() == true) {
            echo json_encode(array('retorno' => true));
        }
    }
}
