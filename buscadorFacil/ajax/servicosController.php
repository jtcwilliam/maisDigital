<?php

include_once '../classe/servicos.php';

$objServicos = new servicosFacil();



$dados = $objServicos->consultarDadosServicos($_POST['comboProcessos']);




?>

<div class="grid-x grid-padding-x">
    <div class="large-12 cell">

        <fieldset class="fieldset">
            <legend>Pesquisa de Serviços</legend>

            <div class="grid-x grid-padding-x">
                <div class="large-12 cell">
                    <label class="tituloTabela">O que é</label>
                    <p>
                        <?= $dados[0]['oQueE'] ?>

                    </p>
                </div>

                <div class="large-12 cell">
                    <label class="tituloTabela">Quando é necessário?</label>
                    <p>

                        <?= $dados[0]['quandoNecessario'] ?>
                    </p>
                </div>




                <div class="large-6 cell">
                    <label class="tituloTabela">Forma de Atendimento</label>
                    <p>

                        <?= $dados[0]['formaAtendimento'] ?>

                    </p>
                </div>

                <div class="large-6 cell">
                    <label class="tituloTabela">Prazo de Execução</label>
                    <p>

                        <?= $dados[0]['prazoExecucao'] ?>

                    </p>
                </div>

                <div class="large-12 cell">
                    <label class="tituloTabela">Legislação</label>
                    <table>
                        <thead>
                            <tr>
                                <th width="80%">Descrição</th>
                                <th width="20%">Ação</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            foreach ($dados as $key => $value) {
                            ?>

                                <tr>
                                    <td><?= $value['textoCompletoLei'] ?></td>
                                    <td><a  target="_blank"  href="<?= $value['caminhoLegislacao'] ?>">  Abrir</a></td>
                                </tr>


                            <?php
                            }


                            ?>



                        </tbody>
                    </table>
                </div>

                <div class="large-12 cell" style="display: none;">
                    <label class="tituloTabela">Documentos Necessários</label>
                    <table>
                        <thead>
                            <tr>
                                <th width="80%">Descrição</th>
                                <th width="20%">Ação</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Content Goes Here</td>
                                <td>Abrir</td>

                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="large-12 cell">
                    <label class="tituloTabela">Taxas Cobradas</label>
                    <table>
                        <thead>
                            <tr>
                                <th width="40%">Descrição</th>
                                <th width="10%">Unidade</th>
                                <th width="25%">UFG</th>
                                <th width="25%">R$</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>   <?= $dados[0]['descricaoTaxa'] ?></td>
                                <td>  <?= $dados[0]['unidade'] ?></td> </td>
                                <td><?= $dados[0]['ufg'] ?></td>
                                <td><?= $dados[0]['valorReais'] ?></td>

                            </tr>

                        </tbody>
                    </table>
                </div>










            </div>





        </fieldset>






    </div>
</div>












 