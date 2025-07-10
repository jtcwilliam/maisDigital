<?php



include_once '../classes/servicos.php';

$objservico = new servicosFacil();



if (isset($_POST['consultarServico'])) {

    $idLink = $_POST['campoBusca'];

    $dados = $objservico->consultarDadosServicos($idLink);

    $linkSolicitacao =    $dados[0]['linkAcesso'];


    switch ($linkSolicitacao) {
        case '#':
            $infoSolicitacal =  ' <a  class="button" href="#" style="width: 100%; background-color:#212C4A">Não é possível solicitar pela Internet</a>';
            break;

        default:
            $infoSolicitacal =  ' <a  class="button"  href=' . $dados[0]['linkAcesso'] . '  style="width: 100%;  background-color:#212C4A">Clique aqui para solicitar</a>';
            break;
    }

?>
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <fieldset class="fieldset">
                <legend>

                </legend>
                <div class="grid-x grid-padding-x">

                    <div class=" large-12 cell">
                        <h5><?= $dados[0]['nomeDoLink'] ?></h5>
                        <br>
                    </div>

                    <div class="large-6 cell">
                        <a href="<?= $dados[0]['linkDescricao'] ?>" class="button" style="width: 100%;  background-color:#212C4A">Informações</a>
                    </div>
                    <div class="large-6 cell">
                        <?php

                        echo  $infoSolicitacal;


                        ?>



                    </div>

                    <div class="large-6 cell">
                    </div>
                </div>


            </fieldset>
        </div>
    </div>
    <?php
}




//

if (isset($_POST['pesquisaServicosTexto'])) {

    $idLink = $_POST['campoBusca'];

    $dados = $objservico->consultarDadosServicosTextos($idLink);




    if ($dados == false) { ?>
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <center>
                    <h3>
                        Não há resultados para esta pesquisa!
                    </h3>
                </center>
            </div>
        </div>





        <?php
    } else {

 

           
        foreach ($dados as $key =>  $value) {



         
            $linkSolicitacao =   $value['linkAcesso'];


            switch ($linkSolicitacao) {
                case '#':
                    $infoSolicitacal =  ' <a   href="#" style="width: 100%; color:#999  ">Não é possível solicitar pela Internet</a>';
                    break;

                default:
                    $infoSolicitacal =  ' <a   href=' . $dados[$key]['linkAcesso'] . '  style="width: 100%;  ">Clique aqui para solicitar</a>';
                    break;
            }


        ?>
            <div class="grid-x grid-padding-x">
                <div class="large-12 cell">

                    <div class="grid-x grid-padding-x">

                        <div class=" large-12 cell">
                            <b><?= $value['nomeDoLink'] ?></b><br>



                            <a href="<?= $value['linkDescricao'] ?>" style="width: 100%;   margin-right: 20px;">Informações</a>
                            <?php echo  $infoSolicitacal; ?>
                        </div>

                    </div>

                    <hr>
                </div>
            </div>
<?php


        }
    }
}
