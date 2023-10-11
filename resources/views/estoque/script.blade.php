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
            
            @if( request()->query('metodo') == 'novo')
                material = $('#descricaoMaterial').val();
                //Verifica se o material foi informado
                if ((material == "") || (material == null)) {
                    var texto =
                        '<span class="badge badge-warning">Informar</span><label class="fontenormal pl-2">Selecione o material</label></br>';
                    contadorErros++;
                }
            @endif
            
            @if( request()->query('metodo') == 'devolucao')
                material = $('#codbarras').val();
                //Verifica se o material foi informado
                if ((material == "") || (material == null)) {
                    var texto =
                        '<span class="badge badge-warning">Informar</span><label class="fontenormal pl-2">Informe o Material</label></br>';
                    contadorErros++;
                }
                quemdevolveu = $('#quemdevolveu').val();
                //Verifica se o quemdevolveu foi informado
                if ((quemdevolveu == "") || (quemdevolveu == null)) {
                    var texto =
                        '<span class="badge badge-warning">Informar</span><label class="fontenormal pl-2">Informe quem devolveu</label></br>';
                    contadorErros++;
                }
            @endif

        @endif


        @if (Request::path() == 'saidas/create')
            portadorsaida = $('#portadorsaida').val();
            //Verifica se o portador foi informado
            if ((portadorsaida == "") || (portadorsaida == null)) {
                var texto =
                    '<span class="badge badge-warning">Informar</span><label class="fontenormal pl-2">Informe quem retirou (portador)</label></br>';
                contadorErros++;
            }
            qtdeSaida   = $('#qtdeSaida').val();
            maxQuantity = $('#codbarras option:selected').data('max-quantity'); // Read data-max-quantity from the selected option
            //Verifica a quantidade de saída
            if (qtdeSaida > maxQuantity) {
                texto = texto +
                    '<span class="badge badge-warning">Verificar</span><label class="fontenormal pl-2">A quantidade de saída informada excede o limite no estoque!</label></br>';
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
