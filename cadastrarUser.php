<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php


include_once 'includes/head.php';

?>

<body>


    <div class="full reveal" id="modalSucesso" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh; padding-top: 0px;">
            <center style="color: white;">
                <h2>Ótimas Notícias!<br> Seu Agendamento foi registrado com Sucesso</h2>
                <h1 class="protocoloAgendamento"></h1>
                <p class="lead"></p>
                <h4 style="font-style: italic;"><b>Dica: </b>Anote o Número <span class='protocoloAgendamento'></span>,
                    ou tire um print dessa tela e leve no dia do agendamento! Ela Serve de protocolo para o atendimento!
                </h4>
                <h4 style="font-style: italic;"><b> Não esqueça de levar seu documento com foto para identificação!</h4>
                <img src="imgs/logoGoverno-1024x240.jpg" style="width: 60%; padding-top: 10em;" :) />
            </center>

        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>




    <div class="grid-container">


        <div class="grid-x grid-padding-x">
            <div class="auto cell"></div>
            <div class="small-4 cell large-2">
                <img src="imgs/logoFacilTransparente.png" style="width: 70%; margin-top: 30px;" />


            </div>
            <div class="auto cell"></div>
        </div>


        <div class="grid-x grid-padding-x">
            <div class="auto cell">

            </div>



            <div class="small-12 large-6 cell" id="exibiAgendamento">
                <br>

                <div id="todosContainers">

                    <!-- primeiro formulario, consulta cpf -->
                    <div class="grid-x grid-padding-x" id="loginCPF">

                        <div class="small-12 large-12 cell">
                            <form action="#">
                                <label style="font-weight: bold;"> Digite o CPF!
                                    <input type="text" placeholder="Digite aqui seu CPF" class="cpf" id="cpf" value=""
                                        onkeydown="mudarMascara(this.value)" required />
                                </label>

                                <label style="font-weight: bold;"> Digite seu nome por favor
                                    <input type="text" placeholder="Digite aqui seu Aqui" class="nomeAgendamento"
                                        value="" id="nomeAgendamento" />
                                </label>

                                <label> Em qual Unidade você trabalha?

                                    <select id="selectUnidade"
                                        onchange="$('.comboHorarios').html('<option value=\'0\'>Selecione o dia acima para ver os horários</option>')   ;datasNaUnidade(0,0)">

                                    </select>
                                </label>

                                <label style="font-weight: bold;"> Digite seu Usuário (O mesmo do seu email e do acesso
                                    a rede)
                                    <input type="text" placeholder="Digite aqui seu Aqui" class="usuario" id="usuario"
                                        value="" />
                                </label>

                                <label style="font-weight: bold;"> Digite sua Senha (a mesma do acesso a rede)
                                    <input type="password" placeholder="Digite aqui seu Aqui" class="senha" id="senha"
                                        value="" />
                                </label>




                                <a class="button succes" href="#" onclick="inserirUsuario()" style="width: 100%;">Seguir
                                    para Agendamento</a>
                                <br>
                            </form>
                        </div>

                    </div>













                </div>





            </div>

            <div class="auto cell">

            </div>
            <?php

            include_once 'includes/footer.php';

            ?>
        </div>









    </div>

    <script>
        $(document).ready(function() {


            comboUnidadesComum();

        })

 
     

        function inserirUsuario() {


            var nomeUsuario = $('#nomeAgendamento').val();
            var usuario = $('#usuario').val();
            var senha = $('#senha').val();
            var selectUnidade = $('#selectUnidade').val()

            
            if (nomeUsuario.length < 3) {
                alert('Por Favor, insira um nome Válido!');
            } else {
                var formData = {
                    cpf: $('#cpf').val(),
                    nomeUsuario: nomeUsuario,
                    usuario: usuario,
                    senha: senha,
                    selectUnidade:selectUnidade
                };
                var condicao;
                $.ajax({
                        type: 'POST',
                        url: 'ajax/inserirFuncionarioController.php',
                        data: formData,
                        dataType: 'json',
                        encode: true
                    })
                    .done(function(data) {

                        console.log(data);

                        if (data.retorno == true) {
                            alert('Servidor Cadastrado com Sucesso');
                            location.href = 'logar.php';
                        } else {
                            alert('Verifique se o Usuario e Senha, são os mesmos do seu acesso a rede da Prefeitura');
                        }

                    });
            }
            event.preventDefault();
        }


  
    </script>
</body>

</html>