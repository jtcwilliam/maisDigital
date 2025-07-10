<?php

include_once '../classes/Report.php';

$objReport = new Report();


if (isset($_POST['porDias'])) {

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');



    //data inicial
    $dataInicial =  $_POST['diaInicial'];
    $dataInicial = explode('/', $dataInicial);
    $dataInicial = $dataInicial['2'] . '-' . $dataInicial['1'] . '-' . $dataInicial['0'] . ' 00:00:00';

    //data final
    $dataFinal =  $_POST['diaFinal'];
    $dataFinal = explode('/', $dataFinal);
    $dataFinal = $dataFinal['2'] . '-' . $dataFinal['1'] . '-' . $dataFinal['0'] . ' 23:59:59';


    $diasRetornar = $objReport->agendasEmGeral($dataInicial, $dataFinal);



    $nomeUnidade = array();

    foreach ($diasRetornar as $key => $value) {


        array_push($nomeUnidade, $value['nomeUnidade']);
    }

    $nomeUnidade = array_unique($nomeUnidade); ?>




   


        <?php
        foreach ($nomeUnidade as $key => $value) { ?>
 <table>
            <thead>

                <th colspan="5"><?= $value ?></th>

            </thead>
            <tbody>
                <tr>
                    <?php

                    foreach ($diasRetornar as $key => $valueB) {
                        if (in_array($value, $valueB)) {

                            $descricao = $valueB['descricaoStatus'];

                            if($descricao == 'Não Atendido'){
                                $descricao = 'Ausente';
                            }


                    ?>

                            <td><b><?= $descricao?></b> <?= $valueB['qtde'] ?></td>


                <?php
                        }
                    }?>

                       </tr>
            </tbody>
               <?php }
                ?>
             

    </table>




    <?php


  
    ?>



<?php



}
