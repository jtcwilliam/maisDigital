<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
include_once 'includes/head.php';

session_start();



$dadoTipoPessoa =     $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'];
$responsavelPessoa =   $_SESSION['usuarioLogado']['dados'][0]['idUnidade'];

if (!isset($_SESSION)) {
    session_start();
}



if (
    $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] == 5    || $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] == 4
    ||  $_SESSION['usuarioLogado']['dados'][0]['idTipoPessoa'] == 3
) {




?>

    <body>



        <div class="reveal" id="openCheckin" data-reveal style="background-color: black; border-color: black;   ">

            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true" style="color: white;">Fechar</span>
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
                        <legend> <label>Gestão de dados do Usuário</label></legend>

                        <form action="#">
                            <div class="grid-x grid-padding-x">





                                <div class="small-12 large-3 cell">
                                    <label for="dadosEntrada">CPF OU CNPJ do Cidadão
                                        <input type="text" class="cpf" onkeydown="mudarMascara(this.value)" style="height: 2.8em;" value="" placeholder="Digite o CPF ou CNPJ" />
                                    </label>
                                </div>

                                <div class="small-12 large-2 cell">
                                    <label for="qtdeMesas">&nbsp;<br>
                                        <a class="button fundoBotoesTopo "
                                            style="height: 3em; width: 100%; color: white; font-weight: bold;"
                                            id="enviarHorarios" onclick="consultarCPF($('.cpf').val(),1 )">Consultar</a>
                                    </label>
                                </div>

                                <div class="small-12 large-7 cell">
                                    <div class="grid-x grid-padding-x" id=" ">

                                    </div>

                                </div>





                            </div>
                        </form>
                    </fieldset>
                    <!-- todas as datas do agendamento disponível -->


                    <fieldset class="fieldset" id="loadDados">
                        <legend> <label>Dados Usuário </span></label></legend>

                        <div class="grid-x grid-padding-x">

                            <div class="small-12 large-5 cell">
                                <label for="dadosEntrada">Nome do Usuário
                                    <input type="text" id='nomeUsuario' />
                                </label>
                            </div>

                            <div class="small-12 large-5 cell">
                                <label for="dadosEntrada">Email do Usuário
                                    <input type="text" id='emailUsuario' />
                                </label>
                            </div>

                            <div class="small-12 large-2 cell" style="display: none;">
                                <label for="dadosEntrada">idUsuario
                                    <input type="text" id='idUsuario' />
                                </label>
                            </div>

                            <div class="small-12 large-5 cell">
                                <label for="dadosEntrada">Senha. Clique 2 (duas) vezes para alterar a senha
                                    <input type="text" id='senhaUsuario' ondblclick="$('#senhaUsuario').removeAttr('readonly');  $('.confirmaSenha').show()" placeholder="Para alterar a senha, clique 2 vezes aqui" />
                                </label>
                            </div>

                            <div class="small-12 large-5 cell confirmaSenha">
                                <label for="dadosEntrada">Confirmar Senha
                                    <input type="text" id='confirmaSenha' placeholder="Para alterar a senha, clique aqui" />
                                </label>
                            </div>

                            <div class="small-12 large-2 cell  ">
                                <label for="dadosEntrada">&nbsp;<br>
                                    <a style="width: 100%;" class="button warning" onclick="alterarDadosUsuario()"> Alterar </a>
                                </label>
                            </div>

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

                $('#senhaUsuario').attr('readonly', 'readonly');

                $('#loadDados').hide();


                $('.confirmaSenha').hide();
                //
                //
            })

            function consultarCPF(cpf, validador) {

                if (cpf.length == 0 || cpf.length == 1) {
                    alert('insira o seu cpf ou cnpj');
                    return false;
                }

                if (cpf.length != 18 && cpf.length != 14) {
                    alert('Seu Documento está com erro! Tente novamente');
                    return false;
                }

                if (cpf.length == 14) {
                    if (validaCPF(cpf) == false) {
                        alert('Seu Documento está com erro! Tente novamente');
                        return false;
                    }


                } else if (cpf.length == 18) {
                    if (validaCNPJ(cpf) == false) {
                        alert('Seu Documento está com erro! Tente novamente');
                        return false;

                    }
                }


                var formData = {
                    cpf: cpf

                };
                var condicao;
                $.ajax({
                        type: 'POST',
                        url: 'ajax/verificadorController.php',
                        data: formData,
                        dataType: 'json',
                        encode: true
                    })
                    .done(function(data) {

                        $('#loadDados').show();

                        console.log(data.retornoCondicao.dados[0]);


                        $('#idUsuario').val(data.retornoCondicao.dados[0]['idPessoas']);

                        $('#nomeUsuario').val(data.retornoCondicao.dados[0]['nomePessoa']);
                        $('#emailUsuario').val(data.retornoCondicao.dados[0]['emailUsuario']);





                    });



                event.preventDefault();
            }


            function alterarDadosUsuario() {

                cpf = $('#cpf').val();

                var atualizarUsuario = 0;

                nomeUsuario = $('#nomeUsuario').val();

                senhaUsuario = $('#senhaUsuario').val();

                emailUsuario = $('#emailUsuario').val();

                confirmaSenha = $('#confirmaSenha').val();

                idUsuario = $('#idUsuario').val();




                if (senhaUsuario.length != 0 && confirmaSenha.length != 0) {

                    atualizarUsuario = 1;

                }



                if (senhaUsuario != confirmaSenha) {
                    alert('As senhas digitadas não são as mesmas!');
                    return false
                } else {


                    var formData = {
                        cpf,
                        nomeUsuario,
                        emailUsuario,
                        senhaUsuario,
                        confirmaSenha,
                        atualizarUsuario,
                        idUsuario
                    };

                    $.ajax({
                            type: 'POST',
                            url: 'ajax/usuarioController.php',
                            data: formData,
                            dataType: 'json',
                            encode: true
                        })
                        .done(function(data) {

                            if (data.retorno == true) {
                                alert('Dados do Usuário Alterados com Sucesso. Informe ao Cidadão que os dados para acesso foram alterados!');
                                
                                $('.cpf').val('');

                                $('#senhaUsuario').val('');

                                $('#confirmaSenha').val('');

                                $('#nomeUsuario').val('');

                                $('#emailUsuario').val('');
                            }
                        });

                }
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