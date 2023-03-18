<script>
    @if (Request::path() == 'entradas/create' || Request::path() == 'saidas/create' || Request::path() == 'benspatrimoniais/create' || Request::path() == 'estoque/create')
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
        function recarregaTipoMaterial() {

            $('#idTipoBensPatrimoniais').select2('destroy');
            let dropdown = $('#idTipoBensPatrimoniais');

            dropdown.empty();
            dropdown.append('<option selected="true" disabled>SELECIONE O TIPO...</option>');
            dropdown.prop('selectedIndex', 0);

            const url = "{{ route('listaTipoMateriais') }}";

            $.getJSON(url, function(data) {
                $.each(data, function(key, dadosjson) {
                    dropdown.append($('<option></option>').attr('value', dadosjson.id).text(dadosjson
                        .name));
                })
            });
            $('#idTipoBensPatrimoniais').select2();
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
    @endif

    function validaFormulario() {
        contadorErros = 0;
        codbarras = $('#codbarras').val();
        texto = '';

        @if (Request::path() == 'entradas/create')

            $.ajax({
                async: false,
                url: "{{ route('duplicidadeestoque') }}",
                method: "GET",
                data: {
                    "codbarras": codbarras,
                },
                success: function(response) {
                    if (response) {
                        contadorErros = 0;
                        texto = '';
                        texto = texto +
                            '<span class="badge badge-warning">Duplicidade</span><label class="fontenormal pl-2">O código de barras informado já existe na nossa base de dados. Favor informar outro.</label></br>';
                        contadorErros++;
                    }
                },
            });
        @endif

        //Verifica se o código de barras foi informado
        if ((codbarras == "") || (codbarras == null)) {
            var texto =
                '<span class="badge badge-warning">Selecionar</span><label class="fontenormal pl-2">Informe o código de barras</label></br>';
            contadorErros++;
        }

        @if (Request::path() == 'saidas/create')
            portadorsaida = $('#portadorsaida').val();
            //Verifica se o portador foi informado
            if ((portadorsaida == "") || (portadorsaida == null)) {
                var texto =
                    '<span class="badge badge-warning">Informar</span><label class="fontenormal pl-2">Informe quem retirou (portador)</label></br>';
                contadorErros++;
            }
        @endif


        if (contadorErros > 0) {
            var span = document.createElement("span");
            span.innerHTML = texto;

            Swal.fire({
                icon: 'error',
                html: span,
                title: 'Validações Necessárias',
                footer: 'Resta(m)  ' + contadorErros + ' pendência(s).'
            })

        }
        return contadorErros;
    }
</script>
