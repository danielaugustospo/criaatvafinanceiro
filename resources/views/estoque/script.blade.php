<script>
    function recarregaDescricaoMaterial() {

        $('#descricaoMaterial').select2('destroy');
        let dropdown = $('#descricaoMaterial');

        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE A DESCRIÇÃO...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaMateriais') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(dadosjson
                    .nomeBensPatrimoniais));
            })
        });
        $('#descricaoMaterial').select2();
    }

    function alteraRetornoCadastro(retorno) {

        validador = validaFormulario();
        if (validador == 0) {
            document.getElementById("tpRetorno").value = retorno;
            $('#btnSalvareVisualizar').attr('disabled', 'disabled');
            $('#btnSalvareNovo').attr('disabled', 'disabled');
            $("#formEstoqueCoringa").submit();
        }

    }

    function validaFormulario() {
        contadorErros = 0;
        codbarras = $('#codbarras').val();
        texto = '';

        //Verifica se o código de barras foi informado
        if ((codbarras == "") || (codbarras == null)) {
            texto ='<span class="badge badge-warning">Selecionar</span><label class="fontenormal pl-2">Informe o código de barras</label></br>';
            contadorErros++;
        }

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
</script>
