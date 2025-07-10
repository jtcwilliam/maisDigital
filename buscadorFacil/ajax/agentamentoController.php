<?php

include_once '../classe/servicos.php';

$objServicos = new servicosFacil();



$dados = $objServicos->consultarDadosServicos($_POST['comboProcessos']);




?>

<div class="grid-x grid-padding-x">
    <div class="large-12 cell">

        <fieldset class="fieldset">
            <legend>Explicação sobre o Serviço solicitado</legend>

            <div class="grid-x grid-padding-x">
                <div class="large-12 cell">
                    <label class="tituloTabela">O que é</label>
                    <p>
                        <?= $dados[0]['oQueE'] ?>

                    </p>
                </div>

              














            </div>





        </fieldset>


        <fieldset class="fieldset">
            <legend>Realize Seu Agendamnto</legend>
            <div class="grid-x grid-padding-x">

                <div class="large-4 cell">
                    <label class="tituloTabela">Escolha uma data para o Atendimento
                        <input type="date" id="birthday" name="birthday" style="width: 100%;" />
                    </label>
                </div>


                <div class="large-4 cell">
                    <label class="tituloTabela">Escolha um Horario</label>
                    <select>

                        <option>08h00</option>
                        <option>09h00</option>
                        <option>12h00</option>
                        <option>14h00</option>

                        <option>13h00</option>
                        <option>16h00</option>
                        <option>17h00</option>





                    </select>


                </div>

                <div class="large-4 cell">
                    <label class="tituloTabela">Escolha um Horario</label>
                    <select>

                        <option>Facil São João</option>
                        <option>Fácil Bom Clima</option>
                        <option>Fácil Shopping Bonsucesso</option>
                        <option>Fácil Vila Galvão</option>

                        <option>Fácil Marcos Freire</option>






                    </select>


                </div>

                <div class="large-6 cell">
                    <label class="tituloTabela">Nome</label>
                    <input type="text" />
  
                </div>

                <div class="large-3 cell">
                    <label class="tituloTabela">Telefone</label>
                    <input type="text" />
  
                </div>

                <div class="large-3 cell">
                    <label class="tituloTabela">CPF</label>
                    <input type="text" />
  
                </div>

                <div class="large-12 cell">
                    
                <a class="button success expanded"  style="color: white;" href="confirmacaoAgendamento.php" > Confirmar Agendamento</a>
  
                </div>




        </fieldset>





    </div>
</div>