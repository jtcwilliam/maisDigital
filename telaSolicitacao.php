<?php

/*echo '<pre>';
print_r($_SESSION['usuariosLogados']['cpfDoUsuario']);
echo '</pre>';
*/


?>

<div class="small-12 large-12 cell" style="padding: 30px;">

    <div class=" grid-x grid-padding-x">
        <div class="small-12 large-12 cell">



            <!-- combo com a carta de serviço.. inicial  . -->
            <fieldset class="fieldset" id="iniciosSolicitacao">
                <legend>
                    <h3>Olá. Vamos fazer sua solicitação no +Digital</h3>
                </legend>
                <label>No que podemos te ajudar? Digite abaixo alguma palavra do que deseja e vamos encontrar o serviço mais adequado
                    <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">
                        <div class="small-12 large-12 cell">
                            <script>
                                criaCombo('comboServicos');
                            </script>
                            <select class="js-example-basic-single  responsive-combobox" id="comboServicos"
                                onchange="$('a#linkHelpServico').attr('href', $('#comboServicos').val());
                                 $('#modalDuvidasCartas').foundation('open'); 
                                 


                                 $('#codigoSolicitacao').html( $('#comboServicos option:selected').text()) ;
                                 $('#assuntoSolicitacao').val( $('#comboServicos option:selected').text()) ;" name="state" style="width: 100%;">

                            </select>

                        </div>
                </label>
                <div class="small-12 large-12 cell">
                    <br>
                    <a class="button " target="_blank" id="linkHelpServico" style="font-weight: 300; width: 100%;">
                        Se você tem alguma dúvida sobre procedimentos ou documentação desta solicitação, <b>clique aqui</b>.
                        Você será redirecionado para o portal da prefeitura para saber tudo o que precisa. Após isto, feche o Site da Prefeitura e continue sua solicitação aqui! </a>
                </div>


                <div class="small-12 large-12 cell">
                    <br>
                    <center>
                        <a class="button " target="_blank" style="font-weight: 300; width: 50%;" onclick="$('#iniciosSolicitacao').hide(); 
                         $('#fieldSolicitacao').show();   
                           $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)');  
                           $('#complemento').css('color', 'rgba(0, 0, 0, 1)');  
                         
                           
                           
                           
                           ">
                            Tudo Certo! Quero continuar!
                        </a>
                    </center>
                </div>


            </fieldset>



            <!-- area para fazer a solicitacao-->
            <fieldset class="fieldset" id="fieldSolicitacao">
                <legend>
                    <h4 id=""> </h4>
                </legend>

                <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">

                    <div class="small-12 large-3 cell">
                        <label>Nome do Solicitante
                            <input type="text" readonly style="width: 100%;" id="nomeSolicitante" value="<?= $_SESSION['usuariosLogados'][0]['nomePessoa'] ?>" />
                        </label>
                    </div>
                    <div class="small-12 large-3 cell">
                        <label>CPF do Solicitante
                            <input type="text" readonly style="width: 100%;" id="cpfSolicitante" value="<?= $_SESSION['usuariosLogados']['cpfDoUsuario'] ?>" />
                        </label>
                    </div>

                    <div class="small-12 large-4 cell">
                        <label>Email do Solicitante
                            <input type="text" readonly style="width: 100%;" id="emailSolicitante" value="<?= $_SESSION['usuariosLogados'][0]['emailUsuario'] ?>" />
                        </label>
                    </div>

                    <div class="small-12 large-2 cell">
                        <label>Dia da Solicitação
                            <input type="text" readonly style="width: 100%;" value="<?php echo date('d/m/Y'); ?>" />
                        </label>

                    </div>






                    <div class="small-12 large-12 cell">
                        <label>Assunto da Solicitação
                            <input type="text" readonly style="width: 100%;" id="assuntoSolicitacao" />
                        </label>
                    </div>



                    <div class="small-12 large-12 cell">
                        <label>Descrição da Sua Solicitação <i>(Campo Obrigatório)</i>
                            <textarea id='txtDescricao' rows="5" style="width: 100%;"></textarea>
                        </label>
                    </div>

                    <div class="small-12 large-3 cell">
                        <label>Escolha qual tipo de Inscrição

                            <script>
                                criaCombo('comboTipoInscricao');
                            </script>
                            <select id="comboTipoInscricao"
                                onchange="trocaCampo($(this).val())" name="state" style="width: 100%; ">

                            </select>
                        </label>
                    </div>

                    <div class="small-12 large-2 cell" id="boxInsc">
                        <label id="tipoInscricaoLbl">Inscrição Mobiliária </label>
                        <input id="inscDocu" type="text" style="width: 100%;" />

                    </div>

                    <div class="small-12 large-2 cell">
                        <label>Status da Solicitação
                            <input type="text" readonly style="width: 100%;" value="Abertura" />
                        </label>

                    </div>

                    <div class="small-12 large-5 cell">
                        <label><br>
                            <center><a class="button success" style="width: 100%;"
                                    onclick=" inserirSolicitacao('<?= $_SESSION['usuariosLogados'][0]['idPessoas'] ?>');">Avançar para a documentação </a>
                            </center>
                        </label>
                    </div>
            </fieldset>

            <fieldset class="fieldset" id="documentacao">
                <input type="hidden" id='idSolicitacaoHidden' />

                <legend>
                    <h4 id="">Documentação Necessária para Solicitação</h4>
                </legend>
                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-12 cell" id="arquivosInseriveis" style="width: 100%;">


                    </div>
                </div>

                <div class=" grid-x grid-padding-x" id="arquivosAnexosSucesso">
                    <div class="small-12 large-12 cell" style="width: 100%; padding-top: 30px;">
                        <center><a class="button success " onclick=" $('#envioAssinatura').show();   verificarAssinatura($('#idSolicitacaoHidden').val())  ;qrCodeAssinatura('https:\/\/wmhtecnologia.com.br\/maisDigital\/assinatura.php?idSolicitacao='+$('#idSolicitacaoHidden').val()); $('#documentacao').hide(); $('#fieldSolicitacao').hide(); $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)' ); $('#complemento').css('color', 'rgba(8, 124, 4, 0.66)' ); $('#docsEstagio').css('color', 'rgba(8, 124, 4, 0.66)' );" style="  width: 100%; font-size: 1.3em; border-radius: 10px; ">Todos os arquivos foram anexados com sucesso! Clique aqui para assinatura da Solicitação</a></center>

                    </div>
                </div>
            </fieldset>


            <fieldset class="fieldset" id="envioAssinatura">


                <legend>
                    <h4 id="">Deite o Celular e escaneie o QRCode abaixo. Você irá assinar esta solicitação</h4>
                </legend>
                <br>

                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-12 cell" style="width: 100%;  ">



                        <div id="img" style="padding-top: 30px;"></div>
                        <br>
                        <center> <a class="button" onclick="finalizarSolicitacao($('#idSolicitacaoHidden').val())" style="width: 60%;">Se você ja assinou, clique aqui!</a></center>




                    </div>
                </div>


            </fieldset>

            <fieldset class="fieldset" id="finalizacaoSolicitacao">


                <legend>
                    <h4 id="">Aqui está sua solicitacao</h4>
                </legend>
                <br>

                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-12 cell" style="width: 100%;  " id="solicitacaoFinalizada">




                    </div>
                </div>


            </fieldset>



            <fieldset class="fieldset" id="estagios">

                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-3 cell">


                    </div>


                    <center>
                        <div class="small-12 large-6 cell">

                            <div class=" grid-x grid-padding-x">
                                <div class="small-12 large-3 cell" id="escolha"> <b>1</b><br>
                                    <i>Escolha da Solicitação</i>
                                </div>

                                <div class="small-12 large-3 cell" id="complemento" style="color: #999;"> <b>2</b><br>
                                    <i>Complemento da Solicitação</i>
                                </div>

                                <div class="small-12 large-3 cell" id="docsEstagio" style="color: #999;"> <b>3</b><br>
                                    <i id="docsEstagio">Documentação Necessária</i>
                                </div>

                                <div class="small-12 large-3 cell" id="finalizacao" style="color: #999;"> <b>3</b><br>
                                    <i>Finalização da Solicitação</i>
                                </div>




                            </div>
                    </center>
                </div>

                <div class="small-12 large-3 cell">


                </div>
        </div>






        </fieldset>








    </div>




</div>
</div>

<script>
    $('#linkHelpServico').hide();
    $('#fieldSolicitacao').hide();
    $('#documentacao').hide();
    $('.mensagemB').hide();
    $('#arquivosAnexosSucesso').hide();
    $('#envioAssinatura').hide();
    $('#finalizacaoSolicitacao').hide();






    //aqui que traz os arquivos pertinentes a esse servico;
    criarCaixaArquivo(1288);



    function trocaCampo(valor) {

        if (valor === '35') {
            $('#boxInsc').show();

            $('#tipoInscricaoLbl').html('IPTU');

            $('#inscDocu').mask("00.0000.0000.0000");

        } else if (valor === '36') {

            $('#boxInsc').show();
            $('#tipoInscricaoLbl').html('Inscrição Mobiliária');


            $('#inscDocu').mask("000.000.000.000");

        } else {
            $('#tipoInscricaoLbl').html('Cadastro');


            $('#inscDocu').mask("0000000000000000");

        }

        return true;

    }

    function inserirSolicitacao(solicitante) {

        var formData = {
            assuntoSolicitacao: $('#comboServicos').find(':selected').attr('codigo'),
            descricao: $('#txtDescricao').val(),
            documentoPublico: $('#inscDocu').val(),
            comboTipoInscricao: $('#comboTipoInscricao').val(),
            idUsuario: solicitante,
            statusSolicitacao: 9,
            inserirSolicitacao: 0,
            cpfSolicitante: $('#cpfSolicitante').val()
        };
        $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoController.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {




                if (data.retorno == true) {

                    $('#idSolicitacaoHidden').val(data.idSolicitacaoHidden);
                    $('#documentacao').show();
                    $('#fieldSolicitacao').hide();
                    $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)');
                    $('#complemento').css('color', 'rgba(8, 124, 4, 0.66)');
                    $('#docsEstagio').css('color', 'rgba(0, 0, 0, 1)');

                }
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


    function verificarAssinatura(idSolicitacao) {

        var formData = {
            idSolicitacao,
            verificarAssinatura: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {

                if (data.retorno == 10) {

                    $('#envioAssinatura').hide();



                }

            });
    }


    function finalizarSolicitacao(idSolicitacao) {

        var formData = {
            idSolicitacao,

            finalizaSolicitacao: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {



                $('#envioAssinatura').hide();

                $('#finalizacaoSolicitacao').show();

                $('#solicitacaoFinalizada').html(data);






            });
    }
</script>