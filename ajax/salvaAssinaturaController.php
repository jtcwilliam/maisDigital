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
 

?>

    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block;">
        <legend>
            <h4 id=""> </h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">

             

            <div class="small-12 large-10 cell">
                <label>Assunto da Solicitação
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['descricaoCarta'] ?>" />
                </label>
            </div>
            <div class="small-12 large-2 cell">
                <label>Status
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['descricaoStatus'] ?>" />
                </label>

            </div>




            <div class="small-12 large-12 cell">
                <label>Descrição da Sua Solicitação <i>(Campo Obrigatório)</i>
                    <textarea id='txtDescricao' rows="5" readonly style="width: 100%; background-color: white;">  <?= $assinaturaAtiva[0]['descricaoSolicitacao'] ?> </textarea>
                </label>
            </div>



            <div class="small-12 large-3 cell">
                <label>Nome do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="nomeSolicitante" value="<?= $assinaturaAtiva[0]['nomePessoa'] ?>" />
                </label>
            </div>
            <div class="small-12 large-3 cell">
                <label>CPF do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="cpfSolicitante" value="<?= $assinaturaAtiva[0]['docSolicitacaoPessoal'] ?>" />
                </label>
            </div>

            <div class="small-12 large-4 cell">
                <label>Email do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="emailSolicitante" value="<?= $assinaturaAtiva[0]['emailUsuario'] ?>" />
                </label>
            </div>



            <div class="small-12 large-2 cell">
                <label>Dia da Solicitação
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['diaDaSolicitacao'] ?>" />
                </label>

            </div>

            <div class="small-12 large-1 cell">
                <label>CEP:
                    <input type="text" readonly style="width: 100%; background-color: white;" id="txtCEP" value="<?= $assinaturaAtiva[0]['cepSolicitacao'] ?>" />
                </label>

            </div>

            <div class="small-12 large-4 cell">
                <label>Logradouro
                    <input type="text" id="txtRua" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['logradouroSol'] ?>" />
                </label>

            </div>
            <div class="small-12 large-1 cell">
                <label>Nº
                    <input type="text" id="txtNUmero" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['numeroSol'] ?>" />
                </label>

            </div>
            <div class="small-12 large-2 cell">
                <label>Complemento
                    <input type="text" id="txtComplemento" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['complemento'] ?>" />
                </label>

            </div>

            <div class="small-12 large-2 cell">
                <label>Bairro
                    <input type="text" id="txtBairro" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['bairro'] ?>" />
                </label>

            </div>








            <div class="small-12 large-2 cell" id="boxInsc">
                <label><?= $assinaturaAtiva[0]['descricaoDoc'] ?>

                    <input id="inscDocu" type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['documentoPublico'] ?>" />

            </div>




    </fieldset>





<?php





    echo '<center><img style="" src="' . $assinaturaAtiva[0]['assinaturaSolicitacao']  . '" /><br> <p   style="margin-top: -40px; font-size:1.5em">' . $assinaturaAtiva[0]['nomePessoa']  . ' </p> </center>';





    die();
}





$objSolicitacao->setArquivo($_POST['assinatura']);
$objSolicitacao->setSolicitacao($_POST['idSolicitacao']);


if ($objSolicitacao->inserirAssinaturaSolicitacao() == true) {
    echo json_encode(array('retorno' => true));
}
