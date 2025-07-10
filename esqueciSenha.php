<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php


include_once 'includes/head.php';

?>

<body style="background-image: url('imgs/fundoAgendamento.jpg') ;         background-size: cover ">

    <!-- modais de informação -->

    <div class="full reveal" id="usuarioInserido" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh; padding-top: 0px;">
            <center style="color: white;">
                <h2>Olá. Seja Bem vindo</h2>
                <h3>Você foi cadastrado com Sucesso <br> Para continuar seu agendamento, digite sua senha!</h3>
                <br>

                <a data-close aria-label="Close modal" style="color:rgb(209, 234, 248); font-weight: bold;">
                    <h3>Clique aqui para fechar</h3>
                </a>



                <h4 style="font-style: italic;"><b> <br>

                        <img src="imgs/logoGoverno-1024x240.jpg" style="width: 60%; padding-top: 10em;" />

            </center>
        </div>
        <button class="close-button" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>




    </div>

    <div class="full reveal" id="modalSucesso" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh; padding-top: 0px;">
            <center style="color: white;">
                <h2>Pronto <span id="nomeRetorno"></span> . Tudo Resolvido! <span class="protocoloAgendamento"></span></h2>
                <p class="lead"></p>
                <h4 style="font-style: italic; font-weight: 400;">Nós enviamos um email com as informações para você alterar sua senha de acesso. </h4>
                <h4 style="font-style: italic;">Se o Email não chegou, dá uma olhada na caixa de Spam ou lixo eletrônico, o email pode estar lá!
                    <h4 style="font-style: italic;">Atenciosamente - Rede Fácil de Atendimento ao Cidadão!<br>
                        <br><a class=" button " style="width: 30%; border-radius: 16px;" href="https://portalfacil.guarulhos.sp.gov.br">Acessar o portal do Fácil</a>
                    </h4>
                    <img src="imgs/logoGoverno-1024x240.jpg" style="width: 60%; padding-top: 10em;" :) />
            </center>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- fim dos modais -->
    <div class="grid-x grid-padding-x" style="height: 100vh;">
        <div class="auto cell">

        </div>



        <div class="small-12 large-6 cell" style="  padding-left: 10px; padding-right: 10px ;height: 150vh; background-color:rgb(248, 254, 227);">

            <div class="grid-container">


                <div class="grid-x grid-padding-x" style="margin-bottom: 30px;">
                    <div class="auto cell">

                    </div>

                    <div class="small-4 cell large-4">
                        <img src="imgs/logoFacilTransparente.png" style="width: 70%; margin-top: 20px;" />




                    </div>
                    <div class="auto cell">

                    </div>
                </div>

                <div class="grid-x grid-padding-x" style="margin-bottom: 30px;">


                    <div class="small-4 cell large-8">





                    </div>
                    <div class="auto cell">

                    </div>
                </div>






                <div class="grid-x grid-padding-x">
                    <div class="auto cell">

                    </div>



                    <div class="small-12 large-12 cell" id="exibiAgendamento">
                        <br>

                        <div id="todosContainers">

                            <!-- primeiro formulario, consulta cpf -->
                            <div class=" grid-x grid-padding-x" id="loginCPF">

                                <div class="small-12 large-12 cell">
                                    <form action="#">
                                        <label style="font-weight: bold; font-size: 1.2em;"> Para recuperar sua senha, digite o cpf abaixo!
                                            <input type="text" placeholder="Digite seu CPF aqui" style="color: black;" class="cpf" id="cpf"
                                                onkeydown="mudarMascara(this.value)" value="" required />
                                        </label>

                                        <input   type="submit" class="button succes" id="consultarSenhas" href="#" onclick="consultarCPF($('#cpf').val(),0 );  
                                         $(this).attr('disabled',true)"
                                            style="width: 100%; font-weight: bold;" value="Clique Aqui para alterar a Senha">
                                        <br>
                                    </form>
                                </div>

                            </div>














                            <!-- segundo formulario, consulta inseere nome-->
                            <div class="grid-x grid-padding-x" id="nomeUsuario">

 


                            </div>






                            <div class="grid-x grid-padding-x" id="agendamentosRealizadosAtivos">
                                <div class="small-12 cell large-12">
                                    <fieldset class="fieldset">
                                        <Legend style="font-weight: 800;">Seus Agendamentos</Legend>

                                        <div class="grid-x grid-padding-x" id="exibirAgendamentosAntigos"></div>



                                </div>
                                </fieldset>
                            </div>




                        </div>





                    </div>

                    <div class="auto cell">

                    </div>
                    <?php

                    include_once 'includes/footer.php';

                    ?>

                    <br>

                    <div class="grid-x grid-padding-x">

                        <div class="auto cell">

                        </div>
                        <div class="small-12 cell large-9">
                            <br>
                            <center><img src="imgs/gestaoPNG.png" style="width: 70%;" /></center>
                        </div>

                        <div class="auto cell">

                        </div>
                    </div>

                </div>









            </div>



        </div>


        <div class="auto cell">

        </div>




    </div>




    <script>
        $(document).ready(function() {
            $('#confirmarInsercaoUsuario').hide();

            $('#nomeUsuario').hide();
            $('#formularioAgendamento').hide();
            $('#campoMensagemAgendamentosAtivos').hide();

            $('#agendamentosRealizadosAtivos').hide();
            $('#horaDIV').hide();
            $('#tipoAgendamentoDiv').hide();
            $('#concluirDIV').hide();
            $('.agendaCompleto').hide();
            $('#logarCompleto').hide();


        })


        function consultarCPF(cpf, validador) {

            

            if (cpf.length == 0 || cpf.length == 1) {
                alert('insira o seu cpf ou cnpj');
                return false;
            }

            if (cpf.length != 18 && cpf.length != 14) {
                alert('Seu Documento está com erro! Tente novamente');
                return false;
            }

            if (cpf.length == 14) {
                if (validaCPF(cpf) == false) {
                    alert('Seu Documento está com erro! Tente novamente');
                    return false;
                }


            } else if (cpf.length == 18) {
                if (validaCNPJ(cpf) == false) {
                    alert('Seu Documento está com erro! Tente novamente');
                    return false;

                }
            }


            var formData = {
                cpf: cpf,
                esqueciSenha: 1

            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/verificadorController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {

                    console.log(data);

                    if (data.retorno == true) {
                        $('#modalSucesso').foundation('open');
                       
                        setTimeout(function() {
                           window.location.href = "http://agendafacil.guarulhos.sp.gov.br";

                            

                        }, 2000);





                    }else{
                        alert('Olá! Houve um problema técnico que vamos resolver em breve! Por favor, volte novamente mais tarde!');
                    }
                });
            event.preventDefault();
        }
    </script>
</body>

</html>