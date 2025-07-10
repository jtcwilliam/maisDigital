<?php


/* oh dev, se liga. nesse aquivo vamos verificar se a pessoa está ou não cadastrada (para agendamento somente)
dependendo do resultado que vem no json, na chave condição, a pessoa é cadastrada no banco de usuarios (pessoa) 
ou segue para a página de agendamento*/

include_once '../classes/Pessoa.php';

$objConsultar = new Pessoa();

$cpf = md5($_POST['cpf']);

$senha = md5($_POST['senha']);

$dadoUsuario = $objConsultar->logarAgendamento($cpf, $senha);

echo json_encode(array('retornoCondicao' => $dadoUsuario));
