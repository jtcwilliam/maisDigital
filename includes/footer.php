<div class="grid-x grid-padding-x">
    <div class=" auto cell  ">
    </div>
    <div class="small-12 cell large-6">

    </div>
    <div class=" auto cell ">
    </div>

</div>




<script>
    $(function() {
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(".datepicker").datepicker({
            maxDate: 30,
            minDate: 0,
            showOn: "focus",
            dateFormat: "dd/mm/yy",
            dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
        });


        $(".datepickerReport").datepicker({

            showOn: "focus",
            dateFormat: "dd/mm/yy",
            dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
        });
    });


    function criaCombo(containner) {
        var formData = {
            
        };
        $.ajax({
                type: 'POST',
                url: 'ajax/solicitaServicosComboController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                console.log(data);
                $('#comboServicos').html(data);
               
            });
    }




    function mudarMascara(cpf) {


        var tamanho = cpf.length;
        if (tamanho >= 15) {
            $('.cpf').mask('00.000.000/0000-00');
        } else {
            $('.cpf').mask('000.000.000-000');
        }

    }





    function validaCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;




        strCPF = strCPF.replace('.', '');
        strCPF = strCPF.replace('.', '');

        strCPF = strCPF.replace('-', '');




        if (strCPF == "00000000000") return false;

        for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10))) return false;

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11))) return false;
        return true;
    }

    function validaCNPJ(cnpj) {


        if (cnpj.length != 18) {
            return false;
        }

        var b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]
        var c = String(cnpj).replace(/[^\d]/g, '')

        if (c.length !== 14)
            return false

        if (/0{14}/.test(c))
            return false

        for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);
        if (c[12] != (((n %= 11) < 2) ? 0 : 11 - n))
            return false

        for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);
        if (c[13] != (((n %= 11) < 2) ? 0 : 11 - n))
            return false

        return true
    }
</script>


<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>