<?php

include '../classes/Solicitacao.php';

$objSolicitacao = new Solicitacao();

if (isset($_POST['trazerSolicitacaoStatus'])) {
    $solicitacaoStatus = $objSolicitacao->consultaSolicitacaoPorStatus($_POST['idStatus']); ?>



    <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">
        <div class="small-12 large-12 cell">
            <table>
                <thead>
                    <tr>
                        <th width="15%"> Status</th>
                        <th width="65%">Serviço Solicitado</th>
                        <th width="15%"> Data da Solicitação</th>



                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($solicitacaoStatus as $key => $value) {
                    
                    
                    
                    ?>

                        <tr style="font-weight: 300;">
                            <td> <a onclick="exibirSolicitacao( <?= $value['idsolicitacao'] ?>)"> <?= $value['descricaoStatus'] ?> </a>  </td>
                            <td><?= $value['descricaoCarta'] ?></td>
                            <td><?= $value['dias'] ?></td>



                        </tr>


                    <?php
                    }
                    ?>
                </tbody>
            </table>


        </div>
    </div>



<?php
    exit();
}


if (isset($_POST['inserirSolicitacao'])) {

    $ran = rand();
    $randomico = $ran  . '/' . date('Y');
    $objSolicitacao->setAssuntoSolicitacao($_POST['assuntoSolicitacao']);
    $objSolicitacao->setDescricaoSolicitacao($_POST['descricao']);
    $objSolicitacao->setDocumentoPublico($_POST['documentoPublico']);
    $objSolicitacao->setDocumentoSolicitante($_POST['cpfSolicitante']);

    $objSolicitacao->setDataSolicitacao(date('Y-m-d H:i:s'));
    $objSolicitacao->setStatusSolicitacao($_POST['statusSolicitacao']);
    $objSolicitacao->setsolicitante($_POST['idUsuario']);
    $objSolicitacao->setTipoDocumento($_POST['comboTipoInscricao']);
    $objSolicitacao->setProtocolo($randomico);



    $objSolicitacao->setCepSolicitacao($_POST['txtCEP']);

    $objSolicitacao->setLogradouroSol($_POST['txtRua']);

    $objSolicitacao->setNumeroSol($_POST['txtNUmero']);

    $objSolicitacao->setComplemento($_POST['txtComplemento']);

    $objSolicitacao->setBairro($_POST['txtBairro']);
    //            \\


    if ($objSolicitacao->gravarSolicitacao() == true) {
        $protocolo =  $objSolicitacao->trazerSolicitacao($randomico);
        echo json_encode(array('retorno' => true, 'idSolicitacaoHidden' => $protocolo[0]['idsolicitacao']));
    }
}
