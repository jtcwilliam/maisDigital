<?php


$tipoPessoa = $_SESSION['usuarioLogado']['dados'][0]['tipoPessoa'];


switch ($tipoPessoa) {
    case '5':
        $link = 'areaSuperAdm.php';
        break;

    default:
        $link = 'areaSuperAdm.php';
        break;
}


?>



<div class="grid-x grid-padding-x">

    <div class="expanded button-group">
    <a  style="text-align: justify;   text-align: justify;   " class="button fundoBotoesTopo"><?php echo  '<b><span style="color:#0c1418"> Unidade: </span></b> '. $_SESSION['usuarioLogado']['dados'][0]['nomeUnidade'].  '.       <span style="color:#0c1418"><b>Usuario: </span></b> ' . $_SESSION['usuarioLogado']['dados'][0]['nome']   ?></a>    
    


        <a  style="  display: grid; align-items: center;   " class="button fundoBotoesTopo" href="baixarSenhas.php">Check in Atendimento</a>
        <a style="  display:none; align-items: center;   "  class="button fundoBotoesTopo" href="agendaTelefonico.php">Agendamento por Campanha</a>

    </div>


</div>