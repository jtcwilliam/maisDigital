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



if ($_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] != 4) {
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
                    <legend> <label>Criar Horários para ---Atendimento</label></legend>

                    <form action="#">
                        <div class="grid-x grid-padding-x">

                            <div class="small-12 large-3 cell">
                                <label for="selectUnidade"> Unidade</label>
                                <select id="selectUnidade" style="height: 2.8em;"> </select>

                            </div>


                            <div class="small-12 large-3 cell">
                                <label for="dataAgendamento"> Data Inicial
                                    <input type="text" class="datepicker" id="dataAgendamento"  min="2025-04-22" style="height: 2.8em;" required />
                                </label>
                            </div>

                            <div class="small-12 large-3 cell">
                                <label for="dataAgendamento"> Data Final
                                    <input type="text" class="datepicker" id="dataFinal" style="height: 2.8em;" required />
                                </label>
                            </div>

                        </div>

                        <div class="grid-x grid-padding-x">

                            <div class="small-12 large-3 cell">
                                <label for="primeiroHorario"> Primeiro Horário
                                    <input type="number" class="" id="primeiroHorario" min="8" max="17" style="height: 2.8em;"  placeholder="Entre 8h e 17h "  required />
                                </label>
                            </div>

                            <div class="small-12 large-3 cell">
                                <label for="ultimoHorario">Ultimo Horário
                                    <input type="number" class="" id="ultimoHorario" min="8" max="17" style="height: 2.8em;" placeholder="Entre 8h e 17h " required />
                                </label>
                            </div>

                            <div class="small-12 large-3 cell">
                                <label for="qtdeMesas">Quantas Mesas
                                    <input type="number" id="qtdeMesas" style="height: 2.8em;" />
                                </label>
                            </div>

                            <div class="small-12 large-3 cell">
                                <label for="qtdeMesas">&nbsp;<br>
                                    <input type="submit" class="button fundoBotoesTopo "
                                        style="height: 3em; width: 100%; color: white; font-weight: bold;" id="enviarHorarios" onclick="preencherHorarios()" value="Cadastrar" />
                                </label>
                            </div>

                        </div>
                    </form>
                </fieldset>




                <!-- todas as datas do agendamento disponível -->
                <fieldset class="fieldset">
                    <legend> <label>Clique no link do dia que deseja analisar! </label></legend>

                    <form action="#">
                        <div class="grid-x grid-padding-x" id="analiseAgendas">





                        </div>
                    </form>
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

            
            listasDataUnidadeADM(<?= $_SESSION['usuarioLogado']['dados']['0']['idUnidade']   ?>)
        })



        //parte para preencher os horários
        function preencherHorarios() {

            $('#enviarHorarios').prop('disabled', true);

            var horario = $('#ultimoHorario').val();

            //dataFinal

            var dataAgendamento = $('#dataAgendamento').val();

            var dataFinal = $('#dataFinal').val();

            var primeiroHorario = $('#primeiroHorario').val();

            var qtdeMesas = $('#qtdeMesas').val();

            if (dataFinal.length == 0 ||    horario.length == 0 || dataAgendamento.length == 0 || primeiroHorario.length == 0 || qtdeMesas.length == 0) {

                alert("Por Favor, preencha todos os dados");

                return false;
            }

            var formData = {
                inserirHorarios: 1,
                dataAgendamento: $('#dataAgendamento').val(),
                dataFinal:dataFinal,
                primeiroHorario: $('#primeiroHorario').val(),
                ultimoHorario: $('#ultimoHorario').val(),
                qtdeMesas: $('#qtdeMesas').val(),
                selectUnidade: $('#selectUnidade').val(),
                selectTipoAgendamento: '1'
            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/horarioController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {
                     
                    if (data.retorno == true) {


                         
                        

                        $('#ultimoHorario').val('');

                        $('#dataAgendamento').val('');

                        $('#primeiroHorario').val('');

                        $('#qtdeMesas').val('');


                        alert('Agendamentos Liberados para a data mencionada. Vamos Atualzar a Tela');

                        window.setTimeout(() => {
                            window.location = 'areaUnidadeAdm.php';
                        }, 600);


                    } else {
                        alert('Tente novamente em poucos minutos');
                    }
                    setTimeout(() => {
                         $('#enviarHorarios').attr("disabled", false);
                    }, 3600);



                });


            event.preventDefault();

        }


        //carregar combo das unidades
        function comboUnidades() {

            var formData = {
                unidadesComum: 1,
                idUnidade: <?= $_SESSION['usuarioLogado']['dados']['0']['idUnidade']   ?>
            };

            $.ajax({
                    type: 'POST',
                    url: 'ajax/unidadeController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {
                     


                    $('#selectUnidade').html(data);

                });

        }
    </script>



</body>

</html>