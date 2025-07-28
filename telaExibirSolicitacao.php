<?php

/*echo '<pre>';
print_r($_SESSION['usuariosLogados']['cpfDoUsuario']);
echo '</pre>';
*/


?>

<div class="small-12 large-12 cell" style="padding: 30px;">

    <div class=" grid-x grid-padding-x" style="padding: 30px;">
        <div class="small-12 large-12 cell">






            <fieldset class="fieldset" id="finalizacaoSolicitacao" style="display: block; margin-top: 0px;">


                <legend>
                    <h4 id="">Aqui está sua solicitacao</h4>
                </legend>
                <br>

                <div class=" grid-x grid-padding-x" style="display: block; margin-top: -60px;">
                    <div class="small-12 large-12 cell" style="width: 100%;  " id="solicitacaoFinalizada">




                    </div>
                </div>


            </fieldset>



            <fieldset class="fieldset" id="estagios">

                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-3 cell">


                    </div>


                    <center>
                        <div class="small-12 large-8 cell" style="color: green;">

                            <div class=" grid-x grid-padding-x"  style="color: green;">
                                <div class="small-12 large-2 cell" id="escolha"> <b>1</b><br>
                                    <i>Escolha da Solicitação</i>
                                </div>

                                <div class="small-12 large-2 cell" id="complemento" > <b>2</b><br>
                                    <i>Complemento da Solicitação</i>
                                </div>

                                <div class="small-12 large-2 cell" id="docsEstagio"  > <b>3</b><br>
                                    <i id="docsEstagio">Documentação Necessária</i>
                                </div>

                                <div class="small-12 large-2 cell" id="finalizacao"  > <b>3</b><br>
                                    <i>Assinatura</i>
                                </div>

                                <div class="small-12 large-2 cell" id="solicitacaoEnviada" > <b>3</b><br>
                                    <i>Solicitação Enviada</i>
                                </div>






                            </div>

                        </div>
                        
                    </center>

                    <div class="small-12 large-3 cell">


                    </div>
                </div>






            </fieldset>








        </div>




    </div>
</div>

<script>
    finalizarSolicitacao(203);





    //aqui que traz os arquivos pertinentes a esse servico;
    //criarCaixaArquivo($('#comboServicos').find(':selected').attr('codigo'));




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