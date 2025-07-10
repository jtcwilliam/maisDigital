<div class="small-12 large-12 cell" style="display: show;" id="camposAgendamentos">
    <label style="font-weight: bold; font-size: 1.3em;"> Vamos continuar seu agendamento! Digite seu nome
        <input type="text" placeholder="Digite aqui seu Aqui" class="nomeAgendamento"
            id="nomeAgendamento" />
    </label>

    <label style="font-weight: bold;  display: none; "> validacao tipo de usuario

        <input type="text" placeholder="Digite aqui seu  validador" class=""
            id="validaTipoCadastro" value='1' />
    </label>

    <label style="font-weight: bold;  font-size: 1.3em; " class="agendaCompleto"> Qual seu email?<br>

        <input type="text" placeholder="Digite aqui seu  Email Aqui"
            id="emailAgendamento" />
    </label>

    <label style="font-weight: bold;  font-size: 1.3em;" class="agendaCompleto"> Crie uma senha!

        <input type="password" placeholder="Crie uma senha "
            class="senhaAgendamento" />
    </label>



    <div class="grid-x grid-padding-x" id="">
        <div class="small-12 cell large-12" style="display: grid; align-items: center; justify-items: center;">



            <a class="button " style="font-size: 1.3em; color: white;  border-radius: 10px;  " onclick=" $('#termoUso').foundation('open');"> Clique aqui pra ler o Termo de uso</a>

            <br>
            <a style="font-size: 1.3em; color: black;">Li e Aceito o Termo de Uso &nbsp;<input id="confirmaTermo" type="checkbox" onclick="$('#confirmarInsercaoUsuario').toggle()"> </a>


        </div>
    </div>

    <br>

    <a class="button succes" id="confirmarInsercaoUsuario" href="#" onclick="inserirUsuario()" style="width: 100%;">Seguir
        para Agendamento</a>
    <br>
</div>