<script>
    $(function() {
        @if (Request::path() == 'pedidocompra/create')
            $("#telaOS").hide();
        @endif

        $("#compraOS").click(function() {
            if ($(this).is(":checked")) {
                $("#telaOS").show();

            } else {
                $("#telaOS").hide();
            }
        });
        $("#compraCRIAATVA").click(function() {
            if ($(this).is(":checked")) {
                $("#telaOS").hide();
            } else {
                $("#telaOS").show();
            }
        });

        if(document.getElementById('comcartao').checked) {
            $("#divDadosCartao").show();
            $("#divDadosBancarios").hide();
            $("#divFaturado").hide();
            $("#telaReembolsado").hide();
            // resetaParcelamento();
            resetaFaturado();
            resetaDadosBancarios();
            resetaReembolsado();
        } 
        else if(document.getElementById('avista').checked) {
            $("#divDadosCartao").hide();
            $("#divDadosBancarios").show();
            $("#divFaturado").hide();
            $("#telaReembolsado").hide();
            resetaParcelamento();
            resetaFaturado();
            resetaReembolsado();

            // resetaDadosBancarios();
        } 
        else if(document.getElementById('faturado').checked) {
            $("#divDadosCartao").hide();
            $("#divDadosBancarios").show();
            $("#divFaturado").show();
            $("#telaReembolsado").hide();
            resetaParcelamento();
            resetaReembolsado();
            // resetaFaturado();
            resetaDadosBancarios();
        } 
        else if(document.getElementById('ped_reembolsado').checked) {
            $("#divDadosCartao").hide();
            $("#divDadosBancarios").hide();
            $("#divFaturado").hide();
            $("#telaReembolsado").show();
            resetaParcelamento();
             resetaFaturado();
            resetaDadosBancarios();
            // resetaReembolsado();
        } 
    });

    function recarregaFornecedor() {
        $('#selecionaFornecedor').select2('destroy');

        let dropdown = $('#selecionaFornecedor');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>SELECIONE O FORNECEDOR...</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "{{ route('listaFornecedores') }}";

        $.getJSON(url, function(data) {
            $.each(data, function(key, dadosjson) {
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(
                    dadosjson
                    .razaosocialFornecedor));
            })
        });
        $('#selecionaFornecedor').select2();
        // recarregaReembolsadoDespesa();
        // recarregaQuemComprouDespesa();
    }


    $(function() {
        $("#comcartao").click(function() {
            if ($(this).is(":checked")) {
                $("#divDadosCartao").show();
                $("#divDadosBancarios").hide();
                $("#divFaturado").hide();
                $("#telaReembolsado").hide();

                // resetaParcelamento();
                resetaFaturado();
                resetaDadosBancarios();
                resetaReembolsado();

            } else {
                $("#divDadosCartao").hide();
                $("#divDadosBancarios").show();
                $("#divFaturado").show();
                $("#telaReembolsado").hide();

                resetaParcelamento();
                resetaFaturado();
                resetaDadosBancarios();
                resetaReembolsado();

            }
        });
        $("#avista").click(function() {
            if ($(this).is(":checked")) {
                $("#divDadosCartao").hide();
                $("#divDadosBancarios").show();
                $("#divFaturado").hide();
                $("#telaReembolsado").hide();

                resetaParcelamento();
                resetaFaturado();
                resetaDadosBancarios();
                resetaReembolsado();


            } else {
                $("#divDadosCartao").show();
                $("#divDadosBancarios").hide();
                $("#divFaturado").show();
                $("#telaReembolsado").hide();

                resetaParcelamento();
                resetaFaturado();
                resetaDadosBancarios();
                resetaReembolsado();

            }
        });
        $("#faturado").click(function() {
            if ($(this).is(":checked")) {
                $("#divDadosCartao").hide();
                $("#divDadosBancarios").show();
                $("#divFaturado").show();
                $("#telaReembolsado").hide();

                resetaParcelamento();
                resetaFaturado();
                // resetaDadosBancarios();
                resetaReembolsado();

            } else {
                $("#divDadosCartao").show();
                $("#divDadosBancarios").show();
                $("#divFaturado").hide();
                $("#telaReembolsado").show();

                resetaParcelamento();
                resetaFaturado();
                resetaDadosBancarios();
                resetaReembolsado();

            }
        });
        $("#reembolsado").click(function() {
            if ($(this).is(":checked")) {
                $("#divDadosCartao").hide();
                $("#divDadosBancarios").show();
                $("#divFaturado").hide();
                $("#telaReembolsado").show();

                resetaParcelamento();
                resetaFaturado();
                // resetaDadosBancarios();
                // resetaReembolsado();

            } else {
                $("#divDadosCartao").show();
                $("#divDadosBancarios").show();
                $("#divFaturado").hide();
                $("#telaReembolsado").show();

                resetaParcelamento();
                resetaFaturado();
                resetaDadosBancarios();
                resetaReembolsado();

            }
        });
    });

    function resetaParcelamento() {
        document.getElementById("ped_vzscartao").value = "";
        document.getElementById("ped_numcartao").value = "";
    }

    function resetaDadosBancarios() {
        document.getElementById("ped_pix").value = "";
        document.getElementById("ped_favorecido").value = "";
        document.getElementById("ped_banco").value = "";
        document.getElementById("ped_agenciaconta").value = "";
        document.getElementById("ped_conta").value = "";
    }

    function resetaFaturado() {
        document.getElementById("ped_periodofaturado").value = "";
        document.getElementById("ped_boleto").value = "";
    }

    function resetaReembolsado() {
        document.getElementById("ped_reembolsado").value = "";
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
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(
                    dadosjson.razaosocialFornecedor));
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
                dropdown.append($('<option></option>').attr('value', dadosjson.id).text(
                    dadosjson.razaosocialFornecedor));
            })
        });
        $('#selecionaPrestadorServico').select2();
    }

    function clicaCheckboxId() {
        document.getElementById("faturado").click(); // Click on the checkbox
    }


    $(document).ready(function() {
            // Função para calcular o valor total
            function calcularValorTotal() {
                var precoUnitario = parseFloat($(".ped_precounit").val().replace(',', '.'));
                var quantidade = parseFloat($(".ped_qtd").val().replace(',', '.'));

                // Verificar se o preço unitário e a quantidade são números válidos
                if (!isNaN(precoUnitario) && !isNaN(quantidade)) {
                    var valorTotal = precoUnitario * quantidade;
                    $(".ped_valortotal").val(valorTotal.toFixed(2).replace('.', ','));
                }
            }

            // Adicionar eventos input para calcular automaticamente
            $(".ped_precounit, .ped_qtd").on('input', calcularValorTotal);

            // Validar os campos "Preço Unitário" e "Quantidade" para aceitar apenas números e vírgula
            $(".ped_precounit, .ped_qtd").on('input', function () {
                var value = $(this).val().replace(/[^0-9,]/g, ''); // Aceita apenas números e vírgula
                $(this).val(value);

                // Após alterar o valor de um dos campos, chame a função de cálculo
                calcularValorTotal();
            });
        });
</script>
