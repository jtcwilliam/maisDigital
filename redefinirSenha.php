<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

include_once 'includes/head.php';


$dataAtual = $_GET['verifyT'];

$dataSistema = md5(date('Y-m-d'));


 



if($dataAtual != $dataSistema){

    echo '<center><h1>Este link está expirado</h1></center>';
    
    exit();

}



?>

<body style="background-image: url('imgs/fundoAgendamento.jpg') ;         background-size: cover ">

    <!-- modais de informação -->
 



    <button class="close-button" type="button">
        <span aria-hidden="true"></span>
    </button>
    </div>

    <div class="full reveal" id="modalSucesso" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh; padding-top: 0px;">
            <center style="color: white;">
                <h2>Olá <span id="nomeNoticia"></span>. <br>
                    Ótimas Notícias! <span class="protocoloAgendamento"></span></h2>
                <p class="lead"></p>
                <h4 style="font-style: italic;"><b>Sua Senha foi redefinida com Sucesso!  </h4>
                
                        <br><a class=" button " style="width: 30%; border-radius: 16px;" href="https://agendafacil.guarulhos.sp.gov.br">Acessar o portal do Fácil</a><br>
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



        <div class="small-12 large-5 cell" style="  padding-left: 10px; padding-right: 10px ;height: 150vh; background-color:rgb(216, 216, 219);">

            <div class="grid-container">


                <div class="grid-x grid-padding-x" style="margin-bottom: 30px;">
                    <div class="auto cell">

                    </div>

                    <div class="small-4 cell large-">
                        <img src="imgs/logoFacilTransparente.png" style="width: 70%; margin-top: 20px;" />




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
                                        <label style="font-weight: bold;"> Digite sua nova Senha
                                            <input type="text" placeholder="Digite aqui sua nova Senha" class="senha" id="senha"
                                                value="" required />
                                        </label>

                                        <label style="font-weight: bold;"> Confirme sua nova Senha
                                            <input type="text" placeholder="Confirme aqui sua nova Senha" class="confirme" id="confirme"
                                                value="" required />
                                        </label>

                                        <input type="submit" class="button succes" href="#" onclick="alterarSenha()"
                                            style="width: 100%;" value="Consultar">


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

                    <br>


                </div>









            </div>



        </div>


        <div class="auto cell">

        </div>




    </div>

    <input type="text" id="dwp" value="<?=$_GET['dwp'] ?>" />

    


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

        function alterarSenha() {

            var senha = $('#senha').val();
            var confirme = $('#confirme').val();

            var dwp = $('#dwp').val();

   
 
            if (senha == confirme) {
                var formData = {
                    senha,                   
                    dwp,
                };

                $.ajax({
                    type: 'POST',
                    url: 'ajax/alterarSenhaController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                }).done(function(data) {
                    console.log(data);
 
                    if (data.retorno == true) {
 
                            $('#modalSucesso').foundation('open');
                       
 
                    }
                    else{
                        alert('Tente novamente Mais tarde!')
                    }

                })
 

            } else(

                alert('As Senhas não conferem')

            )
 
            var condicao;
 
            event.preventDefault();
        }


 





        /*
        window.setTimeout(() => {
        window.location =
        "https://portaleducacao.guarulhos.sp.gov.br/wp_site/facil/paginaInicial/#";
        }, 4600);
        */

        //https://portalfacil.guarulhos.sp.gov.br/paginaInicial/


        //retorno das datas disponiveis da unidade
    </script>
</body>

</html>