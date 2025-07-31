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
        a {
            color: #635d4d;
        }
    </style>


    <?php



    ?>

    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">

            <div class=" large reveal" id="modalComunicaArquivo" data-reveal style="padding: 60px   ;background-color: rgb(231, 228, 220);">

                <h1>Comunicado ao Cidadão</h1>
                <h4>Solicitar Arquivo <b><i><span id='nomeDoArquivoEnvio'></span></i></b></h4>
                <input type="hidden" id="aquivoPraSolicitar" />
                <input type="text" id="nomeTipoArquivoTxt" />

                <textarea rows="5" id="mensagemComuniqueArquivo"></textarea>
                <Br>
                <a class="button" style="width: 100%;" onclick="enviarEmailComuniqueSe()"> Enviar Comunicado ao Cidadão</a>

                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


        </div>
    </div>



    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">
            <div class="full reveal" id="retorno" data-reveal style="background-color:ivory" data-close-on-esc="false">
                <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 0px;">




                    <table class="table" style="width: 1000px">
                        <thead>
                            <tr>


                                <th width="15%">Arquivo Carregado</th>
                                <th width="70%">Nome do Arquivo</th>
                                <th width="10%">
                                    <center>Visualizar Arquivo</center>
                                </th>
                                <th width="10%">
                                    <center>Solicitar Arquivo</center>
                                </th>
                                <th width="10%">
                                    <center>Alterar Arquivo</center>
                                </th>

                            </tr>
                        </thead>
                        <tbody id="tabelaArquivos">


                        </tbody>
                    </table>

                    <div id="tabelaArquivos">

                    </div>


                </div>

            </div>
        </div>

        </span></button>
    </div><?php

            ////
            include_once 'includes/linksAdm.php';


            ?>


    <div class="grid-x grid-padding-x">
        <div class="small-12 large-8 cell" id="containnerSolicitacao">


        </div>


        <div class="small-12 large-4 cell">
            <input type="hidden" id="idSolicitacao" value="<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>" />

            <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em; width: 100%;">
                <legend>
                    <h4 id="" onclick="$('#retorno').foundation('open')" style="color: #56658E; "><b>Ações</b></h4>
                </legend>
                <div class="grid-x  grid-padding-x">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-folder-add large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">


                        <a onclick="exbirArquivosDaSolicitacao($('#idSolicitacao').val())">
                            <h4>Arquivos da Solicitação </h4>
                        </a>
                    </div>
                </div>
                <div class="grid-x  grid-padding-x">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-megaphone large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h4>Comunicar ao Cidadão </h4>
                    </div>
                </div>
                <div class="grid-x  grid-padding-x" style="color: #56658E">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-archive large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify; color: #56658E">
                        <h4>Arquivar Solicitação </h4>
                    </div>
                </div>
                <div class="grid-x  grid-padding-x">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-check large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h4>Aprovar Solicitação </h4>
                    </div>
                </div>

                <div class="grid-x  grid-padding-x">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-page-multiple large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <a target="_blank" href="relatorio.php?idSolicitacao=<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>">
                            <h4>Relatório </h4>
                        </a>
                    </div>
                </div>

                <div class="grid-x  grid-padding-x">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-page-copy large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h4>Encaminhar para Processo SEI </h4>
                    </div>
                </div>
            </fieldset>
        </div>
    </div><?php

            include_once 'includes/footer.php';

            ?><script>
        $(document).ready(function() {

            exibirSolicitacao($('#idSolicitacao').val());


        })

        function exibirSolicitacao(idSolicitacao) {
            var formData = {
                idSolicitacao,
                exibirSolicitacaoAtendente: '1'
            }

            ;

            $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoControllerAtendente.php',
                data: formData,
                dataType: 'html',
                encode: true

            }).done(function(data) {

                $('#containnerSolicitacao').html(data);
            });
        }


        function apagarArquivosSolicitacao(idArquivo, nomeArquivo) {


            var formData = {
                idArquivo,
                nomeArquivo,
                txtEmailParaEnvioArquivo: $('#txtEmailParaEnvioArquivo').val(),

                txtNomePessoaParaEnvioArquivo: $('#txtNomePessoaParaEnvioArquivo').val(),
                apagarArquivoAtendente: '1'
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/arquivosController.php',
                data: formData,
                dataType: 'json',
                encode: true

            }).done(function(data) {

                if (data.retorno == true) {
                    alert('Arquivo deletado e informação enviada ao solicitante');
                }



            });
        }




        function exbirArquivosDaSolicitacao(solicitacao) {

            var formData = {
                solicitacao,
                listarArquivosAtendente: '1'
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoControllerAtendente.php',
                data: formData,
                dataType: 'html',
                encode: true

            }).done(function(data) {
                $('#tabelaArquivos').html(data);
                $('#retorno').foundation('open');
            });
        }

''



        function enviarEmailComuniqueSe() {

            var formData = {
                solicitacao: $('#idSolicitacao').val(),
                nomeTipoArquivoTxt: $('#nomeTipoArquivoTxt').val(),
                           
                idTipoDocumento: $('#aquivoPraSolicitar').val(),
                mensagemComuniqueArquivo: $('#mensagemComuniqueArquivo').val(),
                comuniqueSeSolicitaArquivo: '1'
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/comuniqueSeController.php',
                data: formData,
                dataType: 'html',
                encode: true

            }).done(function(data) {
                console.log(data);
                
            });
        }
    </script>
</body>

</html>