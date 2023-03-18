<script>
    function alteraRetornoCadastroDespesa(retorno) {

        validador = validaFormulario();
        if (validador == 0) {
            // document.getElementById("tpRetorno").value = retorno;
            // $('#btnSalvareVisualizar').attr('disabled', 'disabled');
            $('#btnSalvar').attr('disabled', 'disabled');
            $("#manipulaReceitas").submit();
        }
    }

    function sum(input) {

        if (toString.call(input) !== "[object Array]")
            return false;

        var total = 0;
        for (var i = 0; i < input.length; i++) {
            if (isNaN(input[i])) {
                continue;
            }
            total += Number(input[i]);
        }
        return total;
    }

    function alertaErros(texto, contadorErros) {
        if (contadorErros > 0) {

            var span = document.createElement("span");
            span.innerHTML = texto;

            Swal.fire({
                icon: 'error',
                html: span,
                title: 'Validações Necessárias',
                footer: 'Restam  ' + contadorErros + ' pendentes.'
            })
        }
        return contadorErros;
    }

    function validaFormulario() {
        contadorErros = 0;
        contadorDatasDiferentesAnoAtual = 0;

        texto = '';
        textoData = '';

        /* ---------------------------------------------------
                    VERIFICAÇÃO DE DATA - RECEITA
        ----------------------------------------------------*/
        vencimento = document.getElementsByName("datapagamentoreceita")[0].value;
        anovencimento = new Date(vencimento).getFullYear();

        const dataAtual = new Date();
        const anoAtual = dataAtual.getFullYear();

        @if($modoSandbox->ativo == '0' || $modoSandbox->ativo == 0)
            function addHours(numOfHours, date = new Date()) {
                date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
                return date;
            }
            vencimentoNovo = addHours(26.999, new Date(vencimento));

            if (vencimentoNovo < dataAtual) {
                texto = "Data do vencimento é menor do que a data atual";
                alertaErros(texto, contadorErros++);
            }
        @endif

        if ((vencimento == '') || (vencimento == null) || (vencimento == undefined)) {
            texto = texto +
                '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Vencimento</label></br>';
            contadorErros++;
        }

        if (anovencimento < 2000 || anovencimento > 2099) {
            texto = texto +
                '<span class="badge badge-danger">Alterar</span><label class="fontenormal pl-2">Data de Vencimento Inválida (ano ' +
                anovencimento + ')</label></br>';
            contadorErros++;
        } else if ((anovencimento > 2000) && (anovencimento < 2099) && (anovencimento != anoAtual)) {
            textoData = textoData +
                '<span class="badge badge-warning">Atenção</span><label class="fontenormal pl-2">Data de Vencimento com ano ' +
                anovencimento + '</label></br>';
            contadorDatasDiferentesAnoAtual++;
        }

        if (contadorDatasDiferentesAnoAtual > 0) {
            var areaInformeData = document.createElement("span");
            areaInformeData.innerHTML = textoData;
            Swal.fire({
                title: 'Data informada diferente do ano atual. Confirmar?',
                html: areaInformeData,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, confirmo',
                cancelButtonText: 'Não, irei alterar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#btnSalvar').attr('disabled', 'disabled');
                    $("#manipulaReceitas").submit();
                }
                if (result.isDenied) {
                    swal.close();
                }
            })
        } else {
            if (contadorErros > 0) {
                alertaErros(texto, contadorErros);
            }
        }
        console.log(contadorDatasDiferentesAnoAtual);
        if (contadorDatasDiferentesAnoAtual == 0 && contadorErros == 0) {
            return contadorErros;
        }
    }
</script>
