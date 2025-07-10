<?php


include 'Envio.php';

$objEnvio = new Envio();

$objEnvio->setDestinatario('jtcwilliam@gmail.com');
$objEnvio->setAssunto('Ve ai se recebe');
$objEnvio->setConteudo('vinicius boa noite, compra tadala, vai que precisa');

$objEnvio->envioEmail();