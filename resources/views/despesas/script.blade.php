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

        @if ((Request::path() == 'despesas/create') || (Request::path() == 'despesas/'.$despesa->id.'/edit' ))

        window.addEventListener("beforeunload", function(event) { 
            event.preventDefault();

            event.returnValue = "Confirme que deseja ser redirecionado"; 
            return "Confirme que deseja ser redirecionado";
        });
        @endif

    });



    function validaFormulario() {
        contadorErros = 0;
        var ehcompra = document.querySelector('input[name=a]:checked')?.value;

        var fornecedor = $('#selecionaFornecedor').val();
        var formapagamento = $('#idFormaPagamento').val();
        var conta = $('.conta').val();
        var precoReal = $('.precoReal').val();
        texto = '';



        //Verifica se não o campo compra foi informado
        if ((ehcompra != "N") && (ehcompra != "S")) {
            texto = '<span class="badge badge-warning">Marcar</span><label class="fontenormal pl-2">Se é compra ou não</label></br>';
            contadorErros++;
        }
        if ((formapagamento == 0) || (formapagamento == '') || (formapagamento == null)) {
            texto = texto + '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Forma de Pagamento</label></br>';
            contadorErros++;
        }
        if ((precoReal == '') || (precoReal == null)) {
            texto = texto + '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Valor da despesa</label></br>';
            contadorErros++;
        }
        if ((conta == '') || (conta == null)) {
            texto = texto + '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Conta</label></br>';
            contadorErros++;
        }
        if ((despesaFixa == '') || (despesaFixa == null)) {
            texto = texto + '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Se é uma despesa fixa</label></br>';
            contadorErros++;
        }

        //Verifica se é compra
        else if ((ehcompra == 1) || (ehcompra == 'S')) {

            //--------------------------------------------------------------
            // Validações se for compra
            //--------------------------------------------------------------
            var descricaoDespesaCompra = $('.descricaoDespesaCompra').val();
            var compraparcelada = document.querySelector('input[name=compraparcelada]:checked')?.value;


            if ((fornecedor == 0) || (fornecedor == '') || (fornecedor == null)) {
                texto = texto + '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Fornecedor</label></br>';
                contadorErros++;
            }
            if ((descricaoDespesaCompra == '') || (descricaoDespesaCompra == null) && compraparcelada != 'S') {
                texto = texto + '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Despesa</label></br>';
                contadorErros++;
            }
            if ((compraparcelada != 'S') && (compraparcelada != 'N')) {
                texto = texto + '<span class="badge badge-warning">Marcar</span><label class="fontenormal pl-2">Se é uma compra parcelada</label></br>';
                contadorErros++;
            }else if(compraparcelada = 'S'){
                //TODO: FAZER AJUSTE PARA PEGAR AS OBRIGATORIEDADES NAS TABELAS

                var tabela = document.getElementById("tabelalistadespesa");
            }

        }
        //Verifica se não é compra
        else if ((ehcompra == 0) || (ehcompra == 'N')) {

            var descricaoDespesaCompra = $('.descricaoDespesa').val();
            var compraparcelada = document.querySelector('input[name="descricaoTabela[]"]:checked')?.value;


            if ((descricaoDespesaCompra == '') || (descricaoDespesaCompra == null)) {
                texto = texto + '<span class="badge badge-danger">Validar</span><label class="fontenormal pl-2">Despesa</label></br>';
                contadorErros++;
            }

        }

        if (contadorErros > 0) {



            var span = document.createElement("span");
            span.innerHTML = texto;


            Swal.fire({
                icon: 'error',
                html: span,
                title: 'Validações Necessárias',
                // text: span ,
                footer: 'Restam  ' + contadorErros + ' pendentes.'
            })

        }
        return contadorErros;
    }

    function pegaIdFornecedor() {
        $('#selecionaFornecedor').val();
    }

    function alteraIdComprador() {
        var idComprador = $('#selecionaComprador').val();
        document.getElementById("quemcomprou").value = idComprador;
    }

    function resetaIdComprador() {
        document.getElementById("quemcomprou").value = "";
    }

    function alteraRetornoCadastroDespesa(retorno) {

        validador = validaFormulario();
        if (validador == 0) {
            document.getElementById("tpRetorno").value = retorno;
            $('#btnSalvareVisualizar').attr('disabled', 'disabled');
            $('#btnSalvareNovo').attr('disabled', 'disabled');
            $("#criaDespesas").submit();
        }

    }

    $('body').on('click', '.recarregaMateriais', function() {
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
            var coluna = $(this).closest('td');
            coluna.find("#idOSTabela").each(function(index) {
                valorIdOS = $(this).select2().val();
            });

            // var colunaDescricao = $(this).closest('td');
            coluna.find("#descricaoDespesaTabela").each(function(index) {
                valorDescricao = $(this).select2().val();
            });
            // var colunapg = $(this).closest('td');
            coluna.find("#pago").each(function(index) {
                valorpg = $(this).select2().val();
            });
            $(this).select2('destroy');
        });
        row.find(".campo-moeda").each(function(index) {
            $(this).maskMoney('destroy');
        });

        var newrow = row.clone();
        $("#tabelalistadespesa").append(newrow);

        newrow.find("#idOSTabela").each(function(index) {
            $(this).val(valorIdOS);
            $(this).trigger('change'); // Notify any JS components that the value changed
        });
        newrow.find("#descricaoDespesaTabela").each(function(index) {
            $(this).val(valorDescricao);
            $(this).trigger('change'); // Notify any JS components that the value changed
        });
        newrow.find("#pago").each(function(index) {
            $(this).val(valorpg);
            $(this).trigger('change'); // Notify any JS components that the value changed
        });

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
