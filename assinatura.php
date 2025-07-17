<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assinatura Digital</title>
  <style>
    body {
      font-family: sans-serif;
      text-align: center;
      margin: 20px;
    }

    canvas {
      border: 2px solid #000;
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
  <script src="https://code.jquery.com/jquery-3.1.1.min.js">

  </script>
</head>

<body style="background-color:rgb(216, 216, 219);">
  <script>
    alert('Vire o celular para a posição paisagem (ou seja, deite o celular)');
  </script>

  <p><b>Assinatura Mais Digital</b></p>


  <div id="infoSucesso">
    <center>
      <h1>Nós Colhemos sua assinatura com sucesso! <br> Volte para o mais digital no seu computador!</h1>
    </center>

  </div>


  <div id="colherAssinatura">

    <canvas id="signatureCanvas" width="700" height="150" style="background-color: white;"></canvas>

    <input type="text" id="idSolicitacao" style="display: none;" value="<?= $_GET['idSolicitacao'] ?>" />

    <div class="buttons">
      <button style="background-color: rgb(30, 32, 37); border-radius: 10px; ; color: white;" onclick="clearCanvas()">Limpar</button>
      <button style="background-color: rgb(30, 32, 37);  border-radius: 10px; color: white;" onclick="saveSignature()">Salvar</button>

    </div>


    <img id="savedImage" style="display: none;" alt="Assinatura aparecerá aqui" />



    <button type="submit" style="display: none;" onclick="inserirAssinaturaDoUsuario()">Enviar Imagem</button>

  </div>


  <script>
    $(document).ready(function() {
      $('#infoSucesso').hide();
    })

    function pegarAss() {

      var assinatura = $("#savedImage").attr("src");




    }


    function inserirAssinaturaDoUsuario() {

      var assinatura = $("#savedImage").attr("src");

      var formData = {
        assinatura,
        idSolicitacao: $('#idSolicitacao').val()
      };
      var condicao;
      $.ajax({
          type: 'POST',
          url: 'ajax/salvaAssinaturaController.php',
          data: formData,
          dataType: 'json',
          encode: true
        })
        .done(function(data) {
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
</body>

</html>