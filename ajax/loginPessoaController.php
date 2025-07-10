<?php

include_once '../classes/Pessoa.php';

require_once '../classes/LDAP.class.php';

$objPessoaMovimentar = new Pessoa();
$ldap = new LDAP();

//esse script apenas grava a pessoa

$emailUsuario = $_POST['usuario'];
$senha = $_POST['pwd'];

 

$usuario = $ldap->logar($emailUsuario, $senha);

 


//tirar o comentario daqui
// 
 if (isset($usuario['count'])  && $usuario['count'] == 1) {


    $objPessoaMovimentar->setEmailUsuario($emailUsuario);

    if ($dadosPessoa = $objPessoaMovimentar->logarPessoa()) {

        //se condição true, pode logar
        if ($dadosPessoa['condicao']) {
            session_start();
            $_SESSION['usuarioLogado'] = $dadosPessoa;
            echo json_encode(array('retorno' => true, 'dadosUsuario' => $dadosPessoa));
        } else {
             
            echo json_encode(array('retorno' => false, 'dadosUsuario' => '0'));
        }
    }

    
   
}else
{
     
    echo json_encode(array('retorno' => false , 'dadosUsuario' => '0'));
} 