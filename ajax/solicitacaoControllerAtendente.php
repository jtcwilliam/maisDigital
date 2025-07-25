<?php




include_once '../classes/Solicitacao.php';





$objSolicitacao = new Solicitacao();



if (isset($_POST['exibirSolicitacaoAtendente'])) {
    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);
?>

    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
        <legend>
            <h4 id=""><b>Solicitação</b></h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



            <div class="small-12 large-10 cell">
                <label>Assunto da Solicitação</label>
                <p><?= $assinaturaAtiva[0]['descricaoCarta'] ?></p>

            </div>


            <div class="small-12 large-12 cell">
                <label>Descrição da Sua Solicitação</label>
                <p><?= $assinaturaAtiva[0]['descricaoSolicitacao'] ?></p>
            </div>

        </div>
    </fieldset>



    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
        <legend>
            <h4 id=""><b>Dados do Solicitante</b></h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



            <div class="small-12 large-4 cell">
                <label>Nome do Solicitante</label>
                <p><?= $assinaturaAtiva[0]['nomePessoa'] ?> </p>
            </div>
            <div class="small-12 large-4 cell">
                <label>CPF do Solicitante</label>
                <p><?= $assinaturaAtiva[0]['docSolicitacaoPessoal'] ?></p>
            </div>

            <div class="small-12 large-4 cell">
                <label>Email do Solicitante</label>
                <p><?= $assinaturaAtiva[0]['emailUsuario'] ?></p>
            </div>



            <div class="small-12 large-2 cell">
                <label>Dia da Solicitação</label>
                <p><?= $assinaturaAtiva[0]['diaDaSolicitacao'] ?></p>

            </div>

            <div class="small-12 large-2 cell">
                <label>CEP: </label>
                <p><?= $assinaturaAtiva[0]['cepSolicitacao'] ?></p>

            </div>

            <div class="small-12 large-5 cell">
                <label>Logradouro</label>
                <p><?= $assinaturaAtiva[0]['logradouroSol'] ?></p>

            </div>
            <div class="small-12 large-1 cell">
                <label>Nº</label>
                <p><?= $assinaturaAtiva[0]['numeroSol'] ?></p>

            </div>
            <div class="small-12 large-2 cell">
                <label>Complemento</label>
                <p><?= $assinaturaAtiva[0]['complemento'] ?></p>


            </div>

            <div class="small-12 large-2 cell">
                <label>Bairro</label>
                <p><?= $assinaturaAtiva[0]['bairro'] ?></p>

            </div>

            <div class="small-12 large-2 cell" id="boxInsc">
                <label><?= $assinaturaAtiva[0]['descricaoDoc'] ?></label>

                <p><?= $assinaturaAtiva[0]['documentoPublico'] ?></p>

            </div>

            <div class="small-12 large-6 cell">
                <?php
                echo '<center><img style="" src="' . $assinaturaAtiva[0]['assinaturaSolicitacao']  . '" /><br> <p   style="margin-top: -50px; font-size:1.5em">' . $assinaturaAtiva[0]['nomePessoa']  . ' </p> </center>';
                ?>
            </div>
    </fieldset>
    <?php
    die();
}




if (isset($_POST['atribuirSolicitacaoAtendente'])) {


    $objSolicitacao->setIdAtendente($_POST['idAtendente']);
    $objSolicitacao->setSolicitacao($_POST['idSolicitacao']);
    $objSolicitacao->setStatusSolicitacao('11');

    if ($objSolicitacao->atribuirSolicitacaoAtendente() == true) {
        echo json_encode(array('retorno' => true));
    }

    exit();
}




if (isset($_POST['categoriaSolicitacaoIndexAtendente'])) {


    $solicitaCategorias = $objSolicitacao->pesquisarSolicitacoesPorCategoria($_POST['categoria']);



    echo '<table class="  hover   table-scroll "  style=" font-size: 0.8em" >    
            <thead>
                <tr>
                <th width="6%">ID Solicitação</th>
                <th width="60%">Assunto da Solicitação</th>
                <th width="10%">Solicitante</th>
                <th width="6%">Dia de Solicitação</th>
                
                <th width="8%">Status</th>
                <th width="15%"><center>Atribuir </center></th>
                
                </tr>
            </thead>
            <tbody>
    ';
    foreach ($solicitaCategorias as $key => $value) { ?>
        <tr>
            <td><?= $value['idSolicitacao'] ?></td>
            <td><?= $value['descricaoCarta']  ?></td>
            <td><?= $value['nomePessoa']  ?></td>
            <td><?= $value['diaDaSolicitacao']  ?></td>
            <td><?= $value['descricaoStatus']  ?></td>
            <td>
                <center> <a onclick="atribuirAtendente(<?= $value['idSolicitacao'] ?>, '<?= $value['descricaoCarta']  ?>')">Atribuir</a></center>
            </td>
        </tr>
    <?php  }

    echo '
            </tbody>
        </table>';

    ?>

<?php
    exit();
}
