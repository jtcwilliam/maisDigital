<?php





?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foundation for Sites</title>
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/app.css">
  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/what-input.js"></script>
  <script src="js/vendor/foundation.js"></script>
  <script src="js/app.js"></script>
  <script>

  </script>
  <style>
    label {
      font-weight: 800;
      font-size: 1.1em;

    }

    .tituloTabela {
      font-weight: 800;
      font-size: 1.1em;
      background-color: #e0e0e0;
    }

    .select2-selection__rendered {
      line-height: 40px !important;
    }

    .select2-container .select2-selection--single {
      height: 40px !important;
    }

    .select2-selection__arrow {
      height: 40px !important;
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>





  <div class="grid-container">

    <div class="grid-x grid-padding-x">
      <div class="auto cell"></div>


      <div class="large-3 cell">
    <!--    <img src="imgs/logoFacil.jpg" style="width: 100%;" />  -->
      </div>

      <div class="auto cell"></div>
    </div>
    <div class="grid-x grid-padding-x">
      <div class="large-12 cell">





        <div class="grid-x grid-padding-x">
          <div class="large-12 cell">



            <select class="mySelect" style="width: 100%; height: 3em; " name="campoBusca" id="campoBusca" required>






            </select>

          </div>
        </div>
        <div class="grid-x grid-padding-x">
          <div class="auto cell"></div>


          <div class="large-6 cell">
            <label> &nbsp;<br> </label>
            <a class="button " style="width: 100%; border-radius: 7px; background-color: #212C4A;" href="#" onclick="consultarServicos($('#campoBusca').val())"> Pesquisar</a>
            </a>

          </div>
          <div class="auto cell"></div>



          <div class="grid-x grid-padding-x">
            <div class="large-12 cell">

            </div>
          </div>
        </div>



        <div id="infor">

        

        </div>



      </div>
    </div>
  </div>







  <script>
    $(document).ready(function() {


      $('.mySelect').select2();

    });
  </script>

  <script>
    function trazerServicos() {


      var formData = {


        consultarServico: '1'
      };
      $.ajax({
          type: 'POST',
          url: 'ajax/buscaController.php',
          data: formData,
          dataType: 'html',
          encode: true

        })

        .done(function(data) {


          $('#campoBusca').html(data);
        });

      event.preventDefault();


    }



    function consultarServicos(campoBusca) {


 

      var formData = {
        campoBusca: campoBusca,

        consultarServico: '1'
      };
      $.ajax({
          type: 'POST',
          url: 'ajax/buscadorServicosController.php',
          data: formData,
          dataType: 'html',
          encode: true

        })

        .done(function(data) {

          console.log(data);


          $('#infor').html(data);
        });

      event.preventDefault();
      

    }

    trazerServicos();
  </script>


</body>


</html>