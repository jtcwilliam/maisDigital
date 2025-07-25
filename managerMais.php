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

    <div class="large reveal" id="retorno" data-reveal style="background-color:ivory">
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



        <div class="small-12 large-12 cell">



            <input type="text" id='txtCategoriaServico' value="<?= $_SESSION['usuarioLogado']['dados'][0]['categoriaPessoas'] ?>" />
            <input type="text" id='txtAtendente' value="<?= $_SESSION['usuarioLogado']['dados'][0]['idPessoas'] ?>" />




            <!-- liberação de datas para agendamento -->
            <fieldset class="fieldset">
                <legend> <label>Solicitações Disponibilizadas para Atendimento</label></legend>


                <div class="grid-x grid-padding-x">
                    <div class="small-12 large-12 cell" id="solicitacoes">



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

            pesquisaSolicitaCategoria($('#txtCategoriaServico').val());


        })
        //ListarUnidades
        function pesquisaSolicitaCategoria(categoria) {

            var formData = {
                categoriaSolicitacaoIndexAtendente: '1',
                categoria

            };

            $.ajax({
                    type: 'POST',
                    url: 'ajax/solicitacaoControllerAtendente.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {

                    $('#solicitacoes').html(data);


                });

        }


        function atribuirAtendente(idSolicitacao, textoSolicitacao) {

            var idAtendente = $('#txtAtendente').val();

            if (window.confirm("Você realmente quer assumir esta solicitação?")) {
                var formData = {
                    idSolicitacao,
                    idAtendente,
                    atribuirSolicitacaoAtendente: '1'
                };
                $.ajax({
                        type: 'POST',
                        url: 'ajax/solicitacaoControllerAtendente.php',
                        data: formData,
                        dataType: 'json',
                        encode: true
                    })
                    .done(function(data) {

                        if (data.retorno) {
                            $('#retorno').foundation('open');
                            $('#idSolicitacaoModal').html(idSolicitacao);
                            $('#textoSolicitacaoModal').html(textoSolicitacao);

                            setTimeout(() => {
                                window.open('solicitacaoAtendente.php?89a2e8ef07b59a9a87135b9e2fe979d4b40a616d=' + idSolicitacao, '_self');

                            }, 5000);


                        }





                    });
            } else {
                return false
            }
        }



        function exibirSolicitacao(idSolicitacao) {

            $('#exibirSolicitacoes').foundation('open');

            var formData = {
                idSolicitacao,
                consultaSolicitacaoAtendente: '1'
            };
            $.ajax({
                    type: 'POST',
                    url: 'ajax/solicitacaoControllerAtendente.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {
                    $('#envioAssinatura').hide();
                    $('#inforDatas').html(data);

                });
        }
    </script>



</body>

</html>