<?php

include_once('../classes/Envio.php');
$objEnvio = new Envio();

$objEnvio->setAssunto('Envio arquivo necessário');
$objEnvio->setConteudo("voce precisa alterar o arquivo");
$objEnvio->setEmail('jtcwilliam@gmail.com');

$objEnvio->envioEmail();
