<?php




include_once '../classes/Solicitacao.php';
include_once '../classes/arquivo.php';

$objSolicitacao = new Solicitacao();
$objArquivo = new Arquivo();




if (isset($_POST['listarArquivosAtendente'])) {




    $arquivosNecessarios = $objArquivo->consultarListaAquivosNecessarios($_POST['solicitacao']);






    foreach ($arquivosNecessarios as $key => $value) { ?>




        <?php


        $arquivos = $objArquivo->consultaArquivosParaComuniquese($_POST['solicitacao'], $value['idDocumento']);


        if (!empty($arquivos)) {

            echo '  <tr>
                        <td width="15%" style="color: green" ><b>Enviado</b> </td>
                        <td style="color: green"> <b>' . $arquivos[0]['nomeArquivo'] . '</b></td>
                        <td>  <center><a target="_blank" href="exibirArquivoSolicitacao.php?idArquivo=' . $arquivos[0]['idArquivo'] . '" >   <h4><i style="color: black" class="fi-zoom-in large"></i></h4> </a> </center> </td>
                        <td> <center>-</center>  </td>
                        <td><center> <a href="#"  onclick="apagarArquivosSolicitacao(' . $arquivos[0]['idArquivo'] . ', \'' . $arquivos[0]['nomeArquivo'] . '\')">  <h4><i class="fi-x large"></i></h4></a></center> </td>
                    
                    
                    
                </tr>';
        } else {

            echo '   <tr>


            <td width="15%"> 
            Nulo </td>
                                <td width="70%">' .  $value['descricaoDoc'] . '</td>
                                <td width="10%">
                                    <center> - </center>
                                </td>
                                <td width="10%">
                               
                                    <center><a onclick="  $(\'#nomeDoArquivoEnvio\').html(\'' .  $value['descricaoDoc'] . '\');   $(\'#nomeTipoArquivoTxt\').val(\'' .  $value['descricaoDoc'] . '\');    ; $(\'#aquivoPraSolicitar\').val(' .  $value['idDocumento'] . ');  $(\'#modalComunicaArquivo\').foundation(\'open\');">  <h4><i class="fi-megaphone large"></i></h4></a> </center> 
                                </td>
                                <td width="10%">
                                    <center> - </center>
                                </td>

                            </tr>';
        }





        ?>



    <?php
    }











    exit();
}





if (isset($_POST['exibirSolicitacaoAtendente'])) {
    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);
    ?>

    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
        <legend>
            <h4 id="" style="color: #56658E; "><b>Solicitação</b></h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



            <div class="small-12 large-10 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Assunto da Solicitação</label>
                <p><?= $assinaturaAtiva[0]['descricaoCarta'] ?></p>

            </div>


            <div class="small-12 large-12 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Descrição da Sua Solicitação</label>
                <p><?= $assinaturaAtiva[0]['descricaoSolicitacao'] ?></p>
            </div>

        </div>
    </fieldset>



    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
        <legend>
            <h4 id="" style="color: #56658E; "><b>Dados do Solicitante</b></h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



            <div class="small-12 large-4 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Nome do Solicitante</label>
                <input type="hidden" value="<?= $assinaturaAtiva[0]['nomePessoa'] ?>" id="txtNomePessoaParaEnvioArquivo" />
                <p><?= $assinaturaAtiva[0]['nomePessoa'] ?> </p>
            </div>
            <div class="small-12 large-4 cell">
                <label style="color: #56658E; font-size: 1.1em; ">CPF do Solicitante</label>
                <p><?= $assinaturaAtiva[0]['docSolicitacaoPessoal'] ?></p>
            </div>

            <div class="small-12 large-4 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Email do Solicitante</label>
                <input type="hidden" value="<?= $assinaturaAtiva[0]['emailUsuario'] ?>" id="txtEmailParaEnvioArquivo" />
                <p><?= $assinaturaAtiva[0]['emailUsuario'] ?></p>
            </div>



            <div class="small-12 large-3 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Dia da Solicitação</label>
                <p><?= $assinaturaAtiva[0]['diaDaSolicitacao'] ?></p>

            </div>

            <div class="small-12 large-2 cell">
                <label style="color: #56658E; font-size: 1.1em; ">CEP: </label>
                <p><?= $assinaturaAtiva[0]['cepSolicitacao'] ?></p>

            </div>

            <div class="small-12 large-5 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Logradouro</label>
                <p><?= $assinaturaAtiva[0]['logradouroSol'] . ',' . $assinaturaAtiva[0]['numeroSol'] ?></p>

            </div>

            <div class="small-12 large-2 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Complemento</label>
                <p><?= $assinaturaAtiva[0]['complemento'] ?></p>


            </div>

            <div class="small-12 large-4 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Bairro</label>
                <p><?= $assinaturaAtiva[0]['bairro'] ?></p>

            </div>

            <div class="small-12 large-3 cell" id="boxInsc">
                <label style="color: #56658E; font-size: 1.1em; "><?= $assinaturaAtiva[0]['descricaoDoc'] ?></label>

                <p><?= $assinaturaAtiva[0]['documentoPublico'] ?></p>

            </div>

            <div class="small-12 large-5 cell">
                <?php
                echo '<center><img style="" src="' . $assinaturaAtiva[0]['assinaturaSolicitacao']  . '" /><br> <p   style="margin-top: -30px; font-size:1em"> Assinatura </p> </center>';
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
