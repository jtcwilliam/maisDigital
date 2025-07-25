<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

include_once 'includes/head.php';

session_start();

$dadoTipoPessoa =     $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'];
$responsavelPessoa =   $_SESSION['usuarioLogado']['dados'][0]['idUnidade'];



if (!isset($_SESSION)) {
    session_start();
}



if ($_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] != 4) {
    echo '<center><h1>Acesso Negado</h1> <h4>Você será redirecionado para a pagina inicial</h4></center>';


?>

    <script>
        window.setTimeout(() => {
            window.location =
                "logar.php";
        }, 4600);
    </script>

<?php


    exit();
}



//include_once 'includes/verificadorADM.php';



?>

<body>

    <style>
        label {
            font-size: 1.1em;
        }
    </style>


    <div class="reveal" id="adm_das_datas" data-reveal style="background-color:ivory">
        <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 0px;">
            <div class="grid-x grid-padding-x" id="inforDatas"></div>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    ////
    include_once 'includes/linksAdm.php'; ?>

    <input type="hidden" id="idSolicitacao" value="<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>" />

    <div class="grid-x grid-padding-x">
        <div class="small-12 large-8 cell" id="containnerSolicitacao">



        </div>
        <div class="small-12 large-4 cell">
            <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em; width: 100%;">
                <legend><h4 id=""><b>Arquivos anexos Solicitação</b></h4></legend>
            </fieldset>
        </div>
    </div>

    <?
    include_once 'includes/footer.php';
    ?>

    <script>
        exibirSolicitacao($('#idSolicitacao').val());

        function exibirSolicitacao(idSolicitacao) {
            var formData = {
                idSolicitacao,
                exibirSolicitacaoAtendente: '1'
            };
            $.ajax({
                    type: 'POST',
                    url: 'ajax/solicitacaoControllerAtendente.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {

                    $('#containnerSolicitacao').html(data);
                });
        }
    </script>


</body>

</html>