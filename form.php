<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="ajax/arquivosController.php" method="post" enctype="multipart/form-data">

        <input type="file" name="arquivo" id="arquivo" value="Enviar arquivo" />
        <input type="submit" value="enviar" />

        <?php

             
              include_once './classes/arquivo.php';

              $objArquivo = new Arquivo();

              $arquivo = $objArquivo->gerarArquivo();

         



    echo '<img  style= "height: 100vh"src="data:image/png;base64,'.base64_encode($arquivo[0]['arquivo']).'"/>';

              
 
        ?>


    </form>
</body>

<script>

 function logarUsuarioAgendamento(cpf, senha) {
            var formData = {
                cpf: cpf,
                senha: senha

            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/logarUsuarioAgendamentoController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {

                     
                });



            event.preventDefault();
        }

</script>

</html>
