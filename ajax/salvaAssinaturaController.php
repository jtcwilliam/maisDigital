<?php



include_once '../classes/arquivo.php';



echo $_POST['assinatura'];

 

$objArquivo = new Arquivo();

$objArquivo->setArquivo($_POST['assinatura']);


$objArquivo->inserirArquivos();
