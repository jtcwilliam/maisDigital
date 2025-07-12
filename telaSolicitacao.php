 <div class="small-12 large-12 cell" style="padding: 30px;">

     <div class=" grid-x grid-padding-x">
         <div class="small-12 large-12 cell">


             <!-- combo com a carta de serviço.. inicial -->
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
                         <a class="button " target="_blank" style="font-weight: 300; width: 50%;" onclick="$('#iniciosSolicitacao').hide(); $('#fieldSolicitacao').show();   $('#documentacao').show();  ">
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





                     <div class="small-12 large-10 cell">
                         <label>Assunto da Solicitação
                             <input type="text" readonly style="width: 100%;" id="assuntoSolicitacao" />
                         </label>
                     </div>


                     <div class="small-12 large-2 cell">
                         <label>Status da Solicitação
                             <input type="text" readonly style="width: 100%;" value="Abertura" />
                         </label>

                     </div>

                     <div class="small-12 large-12 cell">
                         <label>Descrição da Sua Solicitação <i>(Campo Obrigatório)</i>
                             <textarea id='txtDescricao' rows="5" style="width: 100%;"></textarea>
                         </label>
                     </div>

                     <div class="small-12 large-3 cell">
                         <label>Inscrição Imobiliária
                             <input type="text" style="width: 100%;" />
                         </label>
                     </div>

                     <div class="small-12 large-3 cell">
                         <label>Inscrição Mobiliária
                             <input type="text" style="width: 100%;" />
                         </label>
                     </div>

                     <div class="small-12 large-3 cell">
                         <label>Cadastro
                             <input type="text" style="width: 100%;">
                         </label>
                     </div>

                     <div class="small-12 large-3 cell">
                         <label>Dia da Solicitação
                             <input type="text" readonly style="width: 100%;" value="<?php echo date('d/m/Y'); ?>" />
                         </label>

                     </div>






             </fieldset>



             <fieldset class="fieldset" id="documentacao">
                 <legend>
                     <h4 id="">Documentação Necessária para Solicitação</h4>
                 </legend>
                 <div class=" grid-x grid-padding-x">
                     <div class="small-12 large-12 cell">

                         <div id="arquivosInseriveis"></div>
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
     criarCaixaArquivo(1288);



     //    alert('s');
 </script>