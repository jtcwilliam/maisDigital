<?php

if (session_start()) {
    /*echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    */
}


?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php


include_once 'includes/head.php';



?>

<body style="background-image: url('imgs/fundoSistema.png') ;         background-size: cover ">

    <!-- modais de informação sucesso cadastrado -->

    <style>
        canvas {
            border: 1px solid #000;
            border-radius: 8px;
            touch-action: none;
            cursor: crosshair;
        }

        .buttons {
            margin-top: 15px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 0 10px;
        }

        img {
            margin-top: 20px;
            max-width: 100%;
        }
    </style>



    <!-- modal confirmação da solicitação -->
    <div class="full reveal" id="modalViraTela" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh; padding-top: 0px;">
            <center style="color: white;">
                <h2>Olá <span id="nomeNoticia"></span>. <br>
                    Ótimas Notícias! <span class="protocoloAgendamento"></span></h2>
                <p class="lead"></p>
                <h4 style="font-style: italic;"><b>Dica: Tire um print dessa tela e leve no dia do agendamento! Ela Serve de protocolo para o atendimento! </h4>
                <h4 style="font-style: italic;"><b> Não esqueça de levar seu documento com foto para identificação! <br>
                        <br><a class=" button " style="width: 30%; border-radius: 16px;" href="https://portalfacil.guarulhos.sp.gov.br">Acessar o portal do Fácil</a></h4>
                <img src="imgs/logoGoverno-1024x240.jpg" style="width: 60%; padding-top: 10em;" :) />
            </center>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- fim dos modais -->




    <!--container com todos os elementros para login e cadastro -->
    <div class="grid-x grid-padding-x" id="containerCadastro" style="height: 70vh;  ">
        <div class="auto cell">

        </div>



        <div class="small-12 large-12 cell" style="  padding-left: 10px; padding-right: 10px ;height: 150vh; background-color:rgb(216, 216, 219);">

            <div class="grid-container">



                <div class="grid-x grid-padding-x" style="margin-bottom: 30px;">
                    <div class="auto cell">

                    </div>

                    <div class="small-4 cell large-5">
                        <img src="imgs/logoPlusDigital.png" style="width: 100%; margin-top: 20px;" />




                    </div>
                    <div class="auto cell">

                    </div>
                </div>


                <div class="grid-x grid-padding-x">
                    <div class="small-12 cell" style="background-color: wheat;">
                        <canvas id="signatureCanvas" width="1000" height="300"></canvas>

                        <div class="buttons">
                            <button onclick="clearCanvas()">Limpar</button>
                            <button onclick="saveSignature()">Salvar</button>
                        </div

                            </div>

                        <img id="savedImage" alt="Assinatura aparecerá aqui" />



                        <button type="submit" onclick="inserirAssinaturaDoUsuario()">Enviar Imagem</button>

                    </div>




                    <div class="grid-x grid-padding-x">
                        <div class="auto cell">

                        </div>

                        <br>

                        <div class="grid-x grid-padding-x">

                            <div class="auto cell">

                            </div>
                            <div class="small-12 cell large-12">
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

                <?php



                if (isset($_SESSION['condicao']) &&  $_SESSION['condicao'] == 1) {
                    echo 'persist(1)';
                } else {
                    echo 'persist(0)';
                }


                ?>




            })


 
            function pegarAss() {

                var assinatura = $("#savedImage").attr("src");




                console.log(assinatura);


            }


            function inserirAssinaturaDoUsuario() {

                var assinatura = $("#savedImage").attr("src");




                var formData = {
                    assinatura
                };
                var condicao;
                $.ajax({
                        type: 'POST',
                        url: 'ajax/salvaAssinaturaController.php',
                        data: formData,
                        dataType: 'html',
                        encode: true
                    })
                    .done(function(data) {

                        console.log(data);



                    });

                event.preventDefault();
            }




            const canvas = document.getElementById('signatureCanvas');
            const ctx = canvas.getContext('2d');

            let drawing = false;

            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';

            function getCoords(e) {
                const rect = canvas.getBoundingClientRect();
                if (e.touches && e.touches.length > 0) {
                    return {
                        x: e.touches[0].clientX - rect.left,
                        y: e.touches[0].clientY - rect.top
                    };
                } else {
                    return {
                        x: e.clientX - rect.left,
                        y: e.clientY - rect.top
                    };
                }
            }

            function startDrawing(e) {
                const {
                    x,
                    y
                } = getCoords(e);
                drawing = true;
                ctx.beginPath();
                ctx.moveTo(x, y);
                e.preventDefault();
            }

            function draw(e) {
                if (!drawing) return;
                const {
                    x,
                    y
                } = getCoords(e);
                ctx.lineTo(x, y);
                ctx.stroke();
                e.preventDefault();
            }

            function stopDrawing() {
                drawing = false;
            }

            // Eventos para mouse
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseleave', stopDrawing);

            // Eventos para toque
            canvas.addEventListener('touchstart', startDrawing);
            canvas.addEventListener('touchmove', draw);
            canvas.addEventListener('touchend', stopDrawing);
            canvas.addEventListener('touchcancel', stopDrawing);

            function clearCanvas() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }

            function saveSignature() {
                const imageData = canvas.toDataURL('image/png');

                document.getElementById('savedImage').src = imageData;
            }
        </script>
</body>

</html>