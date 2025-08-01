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

<body style="background-image: url('imgs/fundoSistema.png') ;         background-size: cover " id="telaMaior">




    <!--container com todos os elementros para login e cadastro -->
    <div class="grid-x grid-padding-x" id="containerCadastro" style="height: 70vh;  ">
        <div class="auto cell">

        </div>



        <div class="small-12 large-6 cell" style="  padding-left: 10px; padding-right: 10px ;height: 150vh; background-color:rgb(216, 216, 219);">

            <div class="grid-container">



                <div class="grid-x grid-padding-x">

                    <div class="small-12 cell large-9">

                    <input type="text"  id="idRequerimento" value="<?=$_GET['idRequerimento'] ?>" />
                        <br>
                        <center><img src="imgs/gestaoPNG.png" style="width: 50%" /></center>
                    </div>
                </div>





                <div id="dadosPessoais">

                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>Nome
                                <input type="text" placeholder="Digite seu nome" id="txtNome" />
                            </label>

                        </div>
                    </div>


                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>CPF / CNPJ
                                <input type="text" class="cpf" id="cpf" onkeydown="mudarMascara(this.value)" placeholder="Digite seu CPF ou CNPJ" />
                            </label>

                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>Telefone
                                <input type="text" onkeydown="mudarMascara(this.value)" placeholder="Digite seu telefone" id="txtTel" />
                            </label>

                        </div>
                    </div>


                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <label>Email
                                <input type="text" placeholder="Digite seu Email" id="txtEmail" />
                            </label>

                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <div class="small-12 cell ">
                            <a class="button " style="width: 100%;" onclick="$('#dadosPessoais').hide();  $('#endereco').show() ">Clique aqui para informar o Endereço</a>
                        </div>
                    </div>

                </div>


                <div id="endereco" style="display: none;">
                    <div class="grid-x grid-padding-x">
                        <div class="small-4   cell">
                            <label>CEP:
                                <input type="text" id="txtCEP" onchange="chamaCEP($('#txtCEP').val())" style="width: 100%;" />
                            </label>

                        </div>

                        <div class="small-8  cell">
                            <label>Bairro
                                <input type="text" id="txtBairro" style="width: 100%;" />
                            </label>

                        </div>

                        <div class="small-12   cell">
                            <label>Logradouro
                                <input type="text" id="txtRua" style="width: 100%;" />
                            </label>

                        </div>
                        <div class="small-4  cell">
                            <label>Nº
                                <input type="text" id="txtNUmero" style="width: 100%;" />
                            </label>

                        </div>
                        <div class="small-8   cell">
                            <label>Complemento
                                <input type="text" id="txtComplemento" style="width: 100%;" />
                            </label>

                        </div>



                        <div class="small-10   cell">
                            <label>Cidade
                                <input type="text" id="txtCidade" style="width: 100%;" />
                            </label>

                        </div>


                        <div class="small-2  cell">
                            <label>UF
                                <input type="text" id="txtEstado" style="width: 100%;" />
                            </label>

                        </div>

                        <div class="small-12 cell ">
                            <a class="button " style="width: 100%;" onclick="$('#dadosPessoais').hide();  $('#endereco').hide(); $('#solicitacao').show()  ">Clique aqui para escrever sua solicitação</a>
                        </div>
                    </div>



                </div>


                <div id="solicitacao">
                    <div class="grid-x grid-padding-x">
                        <div class="small-12   cell">
                            <label>Inscrição Mobiliária / Imobiliária
                                <input type="text" id="txtInscricao" style="width: 100%;" />
                            </label>

                        </div>

                        <div class="small-12   cell">
                            <label>Venho Respeitosamente solicitar o que segue
                                <textarea rows="15" id="txtSolicitacao" style="width: 100%;"></textarea>
                            </label>

                        </div>



                        <div class="small-12 cell ">
                            <a class="button " style="width: 100%;"
                                onclick="   $('#solicitacao').hide()  ;$('#assinatura').show() ">Clique aqui para assinar o Requerimento</a>
                        </div>

                    </div>
                </div>

                <div id="assinatura">
                    <div class="grid-x grid-padding-x">
                        <div class="small-12   cell">
                            <Br>
                            <label>Assinar o Documento


                                <div id="colherAssinatura">

                                    <canvas id="signatureCanvas" height="430" style="background-color: white; width: 100%;"></canvas>

                                    <input type="text" id="idSolicitacao" style="display: none;" />
                                    <br>
                                    <br>

                                    <div class="grid-x grid-padding-x">
                                        <div class="small-6   cell">
                                            <button class="button" style="width:100% ;background-color: rgba(232, 91, 3, 1); border-radius: 10px; ; color: white;" onclick="clearCanvas()">Apagar</button>
                                        </div>

                                        <div class="small-6   cell">

                                            <button class="button" style="width:100% ;background-color: rgba(4, 124, 0, 1);  border-radius: 10px; color: white;" onclick="saveSignature()">Assinar</button>

                                        </div>


                                        <img id="savedImage" style="display: none;" alt="Assinatura aparecerá aqui" />



                                        <button type="submit" style="display: none;" onclick="inserirAssinaturaDoUsuario()">Enviar Imagem</button>

                                    </div>


                            </label>

                        </div>
                    </div>



                    <?php

                    include_once 'includes/footer.php';

                    ?>
                </div>









            </div>



        </div>








        <script>
            $('#dadosPessoais').show();
            $('#endereco').hide();
            $('#solicitacao').hide();
            $('#assinatura').hide();



            function pegarAss() {

                var assinatura = $("#savedImage").attr("src");




            }


            function inserirAssinaturaDoUsuario() {

                var assinatura = $("#savedImage").attr("src");

                var formData = {
                    assinatura,
                    txtNome: $('#txtNome').val(),
                    cpf: $('#cpf').val(),
                    txtTel: $('#txtTel').val(),
                    txtEmail: $('#txtEmail').val(),
                    txtCEP: $('#txtCEP').val(),
                    txtRua: $('#txtRua').val(),
                    txtNUmero: $('#txtNUmero').val(),
                    txtComplemento: $('#txtComplemento').val(),
                    txtCidade: $('#txtCidade').val(),
                    txtSolicitacao: $('#txtSolicitacao').val(),
                    txtBairro: $('#txtBairro').val(),
                    idRequerimento: $('#idRequerimento').val()





                };
                var condicao;
                $.ajax({
                        type: 'POST',
                        url: 'ajax/preencheReqController.php',
                        data: formData,
                        dataType: 'html',
                        encode: true
                    })
                    .done(function(data) {
                        console.log(data);

                        if (data.retorno == true) {
                            $('#colherAssinatura').hide();
                            $('#infoSucesso').show();

                        }
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


                inserirAssinaturaDoUsuario();




            }
        </script>
        </script>
</body>

</html>