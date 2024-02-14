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
            if(document.getElementById('boleto_faturado').checked) {
                $("#divDadosBancarios").hide();
                $("#divBoleto").show();

                resetaDadosBancarios();
            }
            if(document.getElementById('transferencia_faturado').checked) {
                $("#divDadosBancarios").show();
                $("#divBoleto").hide();

                resetaBoleto();
            }
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
        $("#boleto_faturado").click(function() {
            if ($(this).is(":checked")) {
                $("#divDadosBancarios").hide();
                $("#divBoleto").show();

                resetaDadosBancarios();
            } else {
                $("#divDadosBancarios").show();
                $("#divBoleto").hide();
                resetaBoleto();
            }
        });
        $("#transferencia_faturado").click(function() {
            if ($(this).is(":checked")) {
                $("#divDadosBancarios").show();
                $("#divBoleto").hide();

                resetaBoleto();

            } else {
                $("#divDadosBancarios").hide();
                $("#divBoleto").show();
                resetaDadosBancarios();
            }
        });

            // Função para verificar quando o checkbox é marcado ou desmarcado
        $('#info_financeira').change(function(){
            // Se o checkbox estiver marcado e o campo hidden estiver com valor "false", definir o valor como "true"
            if($(this).is(":checked") && $('#info_financeira_hidden').val() === "false") {
                $('#info_financeira_hidden').val("true");
            }

            // Se o checkbox estiver marcado, ocultar as divs
            if($(this).is(":checked")) {
                $('#telaFormaPagamento, #telaReembolsado, #divFaturado, #divDadosBancarios').hide();
            } else {
                // Se o checkbox estiver desmarcado, exibir as divs
                $('#telaFormaPagamento, #telaReembolsado, #divFaturado, #divDadosBancarios').show();
            }
        });

        // Verificar se $pedido->info_financeira é igual a 'N' ao carregar a página
        @if(isset($pedido) && $pedido->info_financeira === "N" ||  old('info_financeira_hidden') == 'true')
            $('#info_financeira').prop('checked', true).trigger('change');
        @endif
    });

    function resetaParcelamento() {
        document.getElementById("ped_vzscartao").value = "";
        document.getElementById("ped_numcartao").value = "";
    }

    function resetaDadosBancarios() {
        document.getElementById("ped_pix").value = "";
        document.getElementById("ped_favorecido").value = "";
        $('#ped_banco').val(null).trigger('change');
        document.getElementById("ped_agenciaconta").value = "";
        document.getElementById("ped_conta").value = "";
        document.getElementById("ped_cpfcnpj").value = "";
    }

    function resetaFaturado() {
        document.getElementById("ped_periodofaturado").value = "";
        document.getElementById("ped_boleto").value = "";
    }

    function resetaReembolsado() {
        $('#ped_reembolsado').val(null).trigger('change');

    }

    function resetaBoleto() {
        document.getElementById("ped_boleto").value = "";
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

    function removerDocumento(pedidoId, documentoId) {
        // Confirme se o usuário deseja realmente remover o documento
        if (confirm("Tem certeza de que deseja remover este documento?")) {
            // Obtenha o token CSRF
            var token = $('meta[name="csrf-token"]').attr('content');
            
            // Faça a requisição AJAX para o método no controlador
            $.ajax({
                url: '/remover-documento-pedido-compra/' + pedidoId + '/' + documentoId, // URL do método no controlador
                type: 'DELETE', // Método HTTP DELETE para remover o documento
                headers: {
                    'X-CSRF-TOKEN': token // Adicione o token CSRF ao cabeçalho da solicitação
                },
                success: function(response) {
                    // Remova o item de documento da interface após a exclusão bem-sucedida
                    $('#d'+documentoId).remove();
                    alert("Documento removido com sucesso!");
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Erro ao remover o documento. Por favor, tente novamente.");
                }
            });
        }
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

  $(function() {
    $('#ped_cancelado').change(function() {
      if( $(this).prop('checked') == false){
        document.getElementById("ped_aprovado").value = "5" //Pedido Cancelado;
      }else{
        document.getElementById("ped_aprovado").value = null;
      }
    })
  })

</script>
