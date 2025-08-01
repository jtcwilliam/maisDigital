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





    <?php

    ////
    include_once 'includes/linksAdm.php';

    ?>


    <div class="grid-x grid-padding-x">



        <div class="small-12 large-12 cell">



            <input type="hidden" id='txtCategoriaServico' value="<?= $_SESSION['usuarioLogado']['dados'][0]['categoriaPessoas'] ?>" />
            <input type="hidden" id='txtAtendente' value="<?= $_SESSION['usuarioLogado']['dados'][0]['idPessoas'] ?>" />




            <!-- liberação de datas para agendamento -->
            <fieldset class="fieldset">
                <legend> <label></label></legend>


                <div class="grid-x grid-padding-x">
                    <div class="small-12 large-12 cell">

                        <center>
                            <a onclick="criarRequerimento()" class="button">Clique Aqui para Criar Requerimento</a>
                        </center>


                    </div>
                </div>

                <div class="grid-x grid-padding-x">
                    <div class="small-12 large-12 cell">

                        <center>
                            <div id="img"></div>
                        </center>


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




        })
        //ListarUnidades
        function criarRequerimento(categoria) {

            var formData = {
                criarRequerimento: '1'


            };

            $.ajax({
                    type: 'POST',
                    url: 'ajax/preencheReqController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {


                    $('#img').html(data);

                    qrCodeAssinatura('https:\/\/agendafacil.guarulhos.sp.gov.br\/maisDigital\/preencheReq.php?idRequerimento=' + data.codigo);





                });

        }


        function qrCodeAssinatura(link) {

            var formData = {
                link

            };
            $.ajax({
                    type: 'POST',
                    url: 'qrcode.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {

                    console.log(data);


                    $('#img').html(data);


                });
        }
    </script>



</body>

</html>