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

    

    <div class="large reveal" id="retorno" data-reveal style="background-color:ivory"  data-close-on-esc="false">
        <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 0px;">


            <div class="grid-x grid-padding-x">
                <div class="small-12 large-12 cell">
                    <center>
                        <h4>A Solicitação "<b><i><span id='textoSolicitacaoModal'></i></b>" com o id <b><span id='idSolicitacaoModal'></b>
                            estará sob seus cudiados!</h4>
                        <h5>Você será redirecionado para a tela de administração dessa solicitação. Aguarde!!!</h5>
                    </center>
                </div>



            </div>

        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>



    <?php

    ////
    include_once 'includes/linksAdm.php';

    ?>


    <div class="grid-x grid-padding-x">

        <div class="small-12 large-8 cell" id="containnerSolicitacao">
            <input type="hidden" id="idSolicitacao" value="<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>" />
        </div>
        <div class="small-12 large-4 cell">
            <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em; width: 100%;">
                <legend>
                    <h4 id=""><b>Ações</b></h4>
                </legend>

                <div class="grid-x grid-padding-x">
                    <div class="small-1 cell" style=" display: inline; align-content: center; text-align: justify;">
                        <h4><i class="fi-folder-add large"></i></h4>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;">
                        <h5> <a onclick="$('#retorno').foundation('open');"> Arquivos da Solicitação </a></h5>
                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="small-1 cell" style=" display: inline; align-content: center; text-align: justify;">
                        <h4><i class="fi-megaphone large"></i></h4>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;">
                        <h5> Comunicar o cidadão</h5>
                    </div>
                </div>




            </fieldset>
        </div>
    </div>



    <?php

    include_once 'includes/footer.php';

    ?>
    <script>
        $(document).ready(function() {

            exibirSolicitacao($('#idSolicitacao').val());


        })
       
       
        

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