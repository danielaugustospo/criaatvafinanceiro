<script>
    $(function() {
        $("#comprou").click(function() {
            if ($(this).is(":checked")) {

                $("#divComprou").show();
                $("#despesaCompra").show();
                $("#telaCadastrarMateriais").show();
                alteraIdComprador();
                $("#telaFornecedor").show();
                $("#tabelaDespesas").show();
                $("#telaQuantidade").show();
                $("#telaDataCompra").show();
                $("#telaCompraParcelada").show();
                // pegaIdFornecedor();


                $("#telaFuncionario").hide();
                $("#despesaNaoCompra").hide();
                $("#telaDataTrabalho").hide();
                $("#telaPrestador").hide();


            } else {
                $("#divComprou").hide();

                $("#despesaCompra").hide();
                $("#despesaNaoCompra").show();

                $("#telaCadastrarMateriais").hide();
                resetaIdComprador();
                // comboDescricaoNaoComprou();

                $("#telaFornecedor").show();
                $("#telaFuncionario").hide();
                // pegaIdFuncionario();
                $("#telaQuantidade").hide();
                $("#telaCompraParcelada").hide();


                $("#telaDataCompra").hide();
                $("#telaDataTrabalho").show();
                $("#telaPrestador").show();

            }
        });
        $("#naocomprou").click(function() {
            if ($(this).is(":checked")) {
                $("#divComprou").hide();

                $("#despesaNaoCompra").show();

                $("#telaCadastrarMateriais").hide();

                resetaIdComprador();
                // comboDescricaoNaoComprou();

                $("#telaFornecedor").show();
                $("#telaFuncionario").hide();
                $("#telaCompraParcelada").hide();
                
                // pegaIdFuncionario();

                $("#telaDataCompra").hide();
                $("#telaDataTrabalho").show();
                $("#telaPrestador").show();

                $("#tabelaDespesas").hide();

                $("#tabelaDespesas").hide();
                $("#telaOS").show();
                $("#telaDescricao").show();
                $("#telaValor").show();
                $("#telaQuantidade").hide();
                $("#telaDataPagamento").show();
                $("#telaNF").show();
                $("#telaPago").show();
                $('#naocomprou').prop('checked', true);
                $('#naoparcelada').prop('checked', true);
                $("#despesaCompra").hide();

            } else {
                $("#divComprou").show();

                $("#despesaCompra").show();
                $("#despesaNaoCompra").hide();

                $("#telaCadastrarMateriais").show();

                alteraIdComprador();

                $("#telaFornecedor").show();
                $("#telaCompraParcelada").show();
                $("#telaFuncionario").hide();
                $("#telaQuantidade").hide();
                pegaIdFornecedor();

                $("#telaDataTrabalho").hide();
                $("#telaDataCompra").show();
                $("#telaPrestador").hide();

                $("#tabelaDespesas").show();
            }
        });
        $("#parcelada").click(function() {
            if ($(this).is(":checked")) {
                $("#tabelaDespesas").show();
                $("#telaOS").hide();
                $("#telaDescricao").hide();
                $("#telaValor").hide();
                $("#telaQuantidade").hide();
                $("#telaDataPagamento").hide();
                $("#telaNF").hide();
                $("#telaPago").show();

            } else {
                $("#tabelaDespesas").hide();
                $("#telaOS").show();
                $("#telaDescricao").show();
                $("#telaValor").show();
                $("#telaQuantidade").show();
                $("#telaDataPagamento").show();
                $("#telaNF").show();
                $("#telaPago").show();
                $("#tabelaDespesas").hide();

            }
        });
        $("#naoparcelada").click(function() {
            if ($(this).is(":checked")) {
                $("#tabelaDespesas").hide();
                $("#telaOS").show();
                $("#telaDescricao").show();
                $("#telaValor").show();
                $("#telaQuantidade").show();
                $("#telaDataPagamento").show();
                $("#telaNF").show();
                $("#telaPago").show();

            } else {
                $("#tabelaDespesas").show();
                $("#telaOS").hide();
                $("#telaDescricao").hide();
                $("#telaValor").hide();
                $("#telaQuantidade").hide();
                $("#telaDataPagamento").hide();
                $("#telaNF").hide();
                $("#telaPago").show();

            }
        });

        checaCompra = document.getElementById('comprou');
        checaNaoCompra = document.getElementById('naocomprou');
        if (checaCompra.checked) {
            $("#despesaCompra").show();
            $("#telaQuantidade").show();
            $("#divComprou").show();
            $("#telaCadastrarMateriais").show();
            alteraIdComprador();
            $("#telaFornecedor").show();
            $("#tabelaDespesas").show();
            $("#telaQuantidade").show();
            $("#telaDataCompra").show();
            $("#telaCompraParcelada").show();
            
            $("#telaFuncionario").hide();
            $("#despesaNaoCompra").hide();
            $("#telaDataTrabalho").hide();
            $("#telaPrestador").hide();

        } else if (checaNaoCompra.checked) {
            $("#despesaCompra").hide();
            $("#telaQuantidade").hide();
            $("#divComprou").hide();
            $("#telaCadastrarMateriais").hide();
            resetaIdComprador();
            $("#telaFornecedor").hide();
            $("#tabelaDespesas").hide();
            $("#telaQuantidade").hide();
            $("#telaDataCompra").hide();
            $("#telaCompraParcelada").hide();
            $("#tabelalistadespesa").hide();
            
            $("#telaFuncionario").show();
            $("#despesaNaoCompra").show();
            $("#telaDataTrabalho").show();
            $("#telaPrestador").show();
            


        }


    });


    function pegaIdFornecedor() {
        var selecionado = $('.selecionaFornecedor').find(':selected').val();
        // console.log(selecionado);
        document.getElementById("idFornecedor").value = selecionado;
    }

    function pegaIdFuncionario() {
        var selecionado = $('.selecionaFuncionario').find(':selected').val();
        // console.log(selecionado);
        document.getElementById("idFornecedor").value = selecionado;
    }

    function alteraIdComprador() {
        var idComprador = $('.quemComprouSelect').find(':selected').val();
        // console.log(idComprador);
        document.getElementById("quemcomprou").value = idComprador;
    }

    function resetaIdComprador() {
        document.getElementById("quemcomprou").value = "";
    }


    $('body').on('click', '.recarregaMateriais', function() {
        // var row = $("#tabelalistadespesa tr:first");
        var row = $(this).closest('tr');
        row.find("#descricaoDespesa").each(function(index) {
            $(this).select2('destroy');

        });

        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE A DESCRIÇÃO...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaMateriais') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(
                    dadosjson.nomeBensPatrimoniais));
            })
        });
        $('#descricaoDespesa').select2();
    });

    $('body').on('click', '.duplicar', function() {
        // var row = $("#tabelalistadespesa tr:first");
        var row = $(this).closest('tr');
        row.find(".selecionaComInput").each(function(index) {
            // var coluna = $(this).closest('td');

            // var coluna = $('#idOSTabela').find(':selected');
            // console.log(coluna);
            
            console.log(coluna);
            $(this).select2('destroy');
        });
        row.find(".campo-moeda").each(function(index) {
            $(this).maskMoney('destroy');
        });
        var newrow = row.clone();
        $("#tabelalistadespesa").append(newrow);
        $("select.selecionaComInput").select2();
        // $("input.campo-moeda").maskMoney();
        $('input.campo-moeda')
            .maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
    });


    $('body').on('click', '.delete', function() {
        var $tr = $(this).closest('tr');
        if ($tr.attr('class') == 'linhaTabela1') {
            $tr.nextUntil('tr[class=linhaTabela1]').andSelf().remove();
        } else {
            $tr.remove();
        }
    });

    function invertePontosMoeda() {
        $('table input').on('input', function() {
            var $linha = $(this).closest('tr');
            var tot = 0
            var anterior = 1
            $linha.find('input.valoresoperacao:not("button")').each(function() {
                tot = $(this).val();
                console.log('tot ' + tot)

                tot = tot.toString($(this).val()).replace(/\D/g, "");
                tot = tot.toString($(this).val()).replace(/(\d)(\d{8})$/, "$1$2");
                tot = tot.toString($(this).val()).replace(/(\d)(\d{5})$/, "$1$2");
                tot = tot.toString($(this).val()).replace(/(\d)(\d{2})$/, "$1.$2");
                tot = parseFloat(tot);

                tot = (isNaN(tot) ? 0 : tot) * anterior;
                anterior = tot;
                console.log('anterior ' + anterior);

            });
        }).trigger("input");
    }


    function idSemValor() {
        $('input.idReceita').val('000000');
    }

    function recarregaCodigoDespesa() {
        $('#despesaCodigoDespesas').select2('destroy');

        let dropdown = $('#despesaCodigoDespesas');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE UM CÓDIGO DE DESPESA...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaCodigoDespesa') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(dadosjson
                    .despesaCodigoDespesa + ' | ' + dadosjson.grupoDespesa));
            })
        });
        $('#despesaCodigoDespesas').select2();
    }

    function recarregaDescricaoDespesa() {

        $('#descricaoDespesa').select2('destroy');
        let dropdown = $('#descricaoDespesa');

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
        $('#descricaoDespesa').select2();
        recarregaDescricaoDespesaTabela();
    }

    function recarregaDescricaoDespesaTabela() {

        $('#descricaoDespesaTabela').select2('destroy');
        let dropdown = $('#descricaoDespesaTabela');

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
        $('#descricaoDespesaTabela').select2();
    }

    function recarregaFornecedorDespesa() {
        $('#selecionaFornecedor').select2('destroy');

        let dropdown = $('#selecionaFornecedor');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE O FORNECEDOR...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaFornecedores') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(dadosjson
                    .razaosocialFornecedor));
            })
        });
        $('#selecionaFornecedor').select2();
        recarregaReembolsadoDespesa();
        recarregaQuemComprouDespesa();
    }

    function recarregaPrestadorServicoDespesa() {
        $('#selecionaPrestadorServico').select2('destroy');

        let dropdown = $('#selecionaPrestadorServico');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE O PRESTADOR DE SERVIÇO...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaFornecedores') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(dadosjson
                    .razaosocialFornecedor));
            })
        });
        $('#selecionaPrestadorServico').select2();
    }

    function recarregaQuemComprouDespesa() {
        $('#selecionaComprador').select2('destroy');

        let dropdown = $('#selecionaComprador');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE QUEM COMPROU...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaFornecedores') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(dadosjson
                    .razaosocialFornecedor));
            })
        });
        $('#selecionaComprador').select2();
    }

    function recarregaReembolsadoDespesa() {
        $('#reembolsado').select2('destroy');

        let dropdown = $('#reembolsado');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE O REEMBOLSADO...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaFornecedores') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(dadosjson
                    .razaosocialFornecedor));
            })
        });
        $('#reembolsado').select2();
    }
</script>

{{-- @isset($despesa)
    @if ($despesa->ehcompra == 1)
        <script>
            setInterval(clicaCompra, 10000);

            function clicaCompra() {
                $("input").first().trigger("#comprou");
            }
        </script>
    @else
        <script>
            setInterval(clicaNaoCompra, 10000);

            function clicaNaoCompra() {
                $("input").first().trigger("#naocomprou");
            }
        </script>
    @endif
@endisset --}}
