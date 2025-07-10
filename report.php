<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

include_once 'includes/head.php';

session_start();

$dadoTipoPessoa =     $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'];
$responsavelPessoa =   $_SESSION['usuarioLogado']['dados'][0]['idUnidade'];



if (!isset($_SESSION)) {
    session_start();
}




if (
    $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] == 5    || $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] == 4
) {





    //include_once 'includes/verificadorADM.php';



?>

    <body>

        <div class="reveal" id="adm_das_datas" data-reveal style="background-color:ivory">
            <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 0px;">


                <div class="grid-x grid-padding-x" id="inforDatas">

                </div>

            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>



        <?php

        ////
        include_once 'includes/linksAdm.php';

        ?>

        <div class="grid-container">
            <div class="grid-x grid-padding-x">



                <div class="small-12 large-12 cell">







                    <!-- liberação de datas para agendamento -->
                    <fieldset class="fieldset">
                        <legend> <label>Parâmetros para Relatório</label></legend>

                        <form action="#">
                            <div class="grid-x grid-padding-x">

                                <div class="small-12 large-3 cell" style="display: none;">
                                    <label for="selectUnidade"> Unidade</label>
                                    <select id="selectUnidade" style="height: 2.8em;">

                                        <option value="0">Todos</option>
                                    </select>

                                </div>


                                <div class="small-12 large-3 cell">
                                    <label for="dataAgendamento"> Data Inicial
                                        <input type="text" class="datepickerReport" id="diaInicial" style="height: 2.8em;" required />
                                    </label>
                                </div>

                                <div class="small-12 large-3 cell">
                                    <label for="dataAgendamento"> Data Final
                                        <input type="text" class="datepickerReport" id="diaFinal" style="height: 2.8em;" required />
                                    </label>
                                </div>





                                <div class="small-12 large-3 cell">
                                    <label for="qtdeMesas">&nbsp;<br>
                                        <input type="submit" class="button fundoBotoesTopo "
                                            style="height: 3em; width: 100%; color: white; font-weight: bold;" id="enviarHorarios" onclick="reportDays()" value="Consultar" />
                                    </label>
                                </div>

                            </div>
                        </form>
                    </fieldset>

                </div>



            </div>
            <div class="grid-x grid-padding-x">



                <div class="small-12 large-12 cell">
                    <fieldset class="fieldset">
                        <legend><h4><b>Panorama de Agendamentos</b> </h4></legend>

                        <div id="retorno">
                        </div>



                    </fieldset>
                </div>

            </div>

        </div>

        <?php

        include_once 'includes/footer.php';

        ?>
        <script>
            $(document).ready(function() {
                comboUnidades();
                comboTipoAgendamento();
                datasNaUnidadeAdm(1, <?= $responsavelPessoa ?>);

                listasDataUnidadeSuperAdm(<?= $_SESSION['usuarioLogado']['dados']['0']['idUnidade']   ?>)
            })



            //carregar combo das unidades
            function reportDays() {

                var formData = {
                    porDias: 1,
                    diaInicial: $('#diaInicial').val(),
                    diaFinal: $('#diaFinal').val()
                };

                $.ajax({
                        type: 'POST',
                        url: 'ajax/relatorioController.php',
                        data: formData,
                        dataType: 'html',
                        encode: true
                    })
                    .done(function(data) {


                        $('#retorno').html(data);



                    });

                event.preventDefault();

            }



            //carregar combo das unidades
            function comboUnidades() {

                var formData = {
                    unidadesComum: 1
                };

                $.ajax({
                        type: 'POST',
                        url: 'ajax/unidadeController.php',
                        data: formData,
                        dataType: 'html',
                        encode: true
                    })
                    .done(function(data) {



                        $('#selectUnidade').html('  <option value="0">Todos</option>' + data);

                    });

            }
        </script>
    <?php

} else {
    echo '<center><h1>Acesso Negado</h1> <h4>Você será redirecionado para a pagina inicial</h4></center>';
    ?>
        <script>
            window.setTimeout(() => {
                window.location =
                    "logar.php";
            }, 4600);
        </script>
    <?php
    exit();
}
    ?>



    </body>


</html>