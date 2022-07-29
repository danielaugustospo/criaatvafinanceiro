<script>
    $(function() {
        @if (Request::path() == 'despesas/create')
        $("#telaGeral").hide();
        @endif
        
        $("#comprou").click(function() {
            @if (Request::path() == 'despesas/create')
            $("#telaGeral").hide();
            @endif
            if ($(this).is(":checked")) {
                $("#divComprou").show();
                $("#despesaCompra").show();
                $("#despesaCompraSemEstoque").show();
                $("#telaCadastrarMateriais").show();
                alteraIdComprador();
                $("#telaQuantidade").show();
                $("#telaDataCompra").show();
                $("#telaCompraParcelada").show();
                $("#telaInsereEstoque").show();
                // pegaIdFornecedor();
                document.getElementById("dataDoTrabalho").value = "";

                $("#telaFuncionario").hide();
                $("#despesaNaoCompra").hide();
                $("#telaDataTrabalho").hide();
                $("#telaPrestador").hide();
            }
        });
        $("#naocomprou").click(function() {
            if ($(this).is(":checked")) {

                $("#telaGeral").show();
                $("#inserirestoque").prop("checked", false);
                $("#naoinserirestoque").prop("checked", false);

                $("#unicadespesa").prop("checked", false);
                $("#naounicadespesa").prop("checked", false);

                $("#divComprou").hide();

                $("#despesaCompraSemEstoque").hide();
                $("#despesaNaoCompra").show();

                $("#telaCadastrarMateriais").hide();

                resetaIdComprador();
                // comboDescricaoNaoComprou();

                $("#telaFuncionario").hide();
                $("#telaCompraParcelada").hide();
                $("#telaInsereEstoque").hide();
                $("#telaUnicaDespesa").hide();

                // pegaIdFuncionario();

                $("#telaDataCompra").hide();
                $("#telaDataTrabalho").show();
                $("#telaPrestador").show();

                $("#tabelaDespesas").hide();

                $("#tabelaMultiplasDespesas").hide();
                $("#telaOS").show();
                $("#telaDescricao").show();
                $("#telaValor").show();
                $("#telaQuantidade").hide();
                $("#telaDataPagamento").show();
                $("#telaNF").show();
                $("#telaPago").show();
                $('#naocomprou').prop('checked', true);

                $('#parcelada').prop('checked', false);
                $('#naoparcelada').prop('checked', false);
                
                $("#despesaCompra").hide();
                document.getElementById("dataDaCompra").value = "";
            }
        });

        $("#parcelada").click(function() {
            if ($(this).is(":checked")) {

                $("#unicadespesa").prop("checked", false);
                $("#naounicadespesa").prop("checked", false);
                $("#tabelaDespesas").show();
                $("#tabelaMultiplasDespesas").hide();
                $("#telaOS").hide();
                $("#telaDescricao").hide();
                $("#telaValor").hide();
                $("#telaQuantidade").hide();
                $("#telaDataPagamento").hide();
                $("#telaNF").hide();
                $("#telaPago").hide();
                document.getElementById("vencimento").value = "";
                $("#telaUnicaDespesa").hide();

                
                
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
                $("#telaUnicaDespesa").show();

            }
        });

        $("#inserirestoque").click(function() {
            $("#telaGeral").show();

            $("#despesaCompraSemEstoque").hide();
            $("#despesaCompra").show();
            $("#telaCadastrarMateriais").show();
            $("#telaDescricaoTabelaComEstoque").show();
            $("#telaDescricaoTabelaSemEstoque").hide();

            $("#telaDescricaoTabelaComEstoqueMultiplo").show();
            $("#telaDescricaoTabelaSemEstoqueMultiplo").hide();


        })

        $("#naoinserirestoque").click(function() {
            $("#telaGeral").show();

            $("#despesaCompraSemEstoque").show();
            $("#despesaCompra").hide();
            $("#telaCadastrarMateriais").hide();
            $("#telaDescricaoTabelaSemEstoque").show();
            $("#telaDescricaoTabelaComEstoque").hide();
            
            $("#telaDescricaoTabelaSemEstoqueMultiplo").show();
            $("#telaDescricaoTabelaComEstoqueMultiplo").hide();

        })
        $("#unicadespesa").click(function() {
            $("#telaGeral").show();
            $("#tabelaMultiplasDespesas").hide();
            
            $("#telaOS").show();
            $("#telaDescricao").show();
            $("#telaValor").show();
            $("#telaQuantidade").show();
            $("#telaDataPagamento").show();
            $("#telaNF").show();
            $("#telaPago").show();
        })
        
        $("#naounicadespesa").click(function() {
            $("#telaGeral").show();
            $("#tabelaMultiplasDespesas").show();
            
            $("#telaOS").hide();
            $("#telaDescricao").hide();
            $("#telaValor").hide();
            $("#telaQuantidade").hide();
            $("#telaDataPagamento").hide();
            $("#telaNF").hide();
            $("#telaPago").hide();
            document.getElementById("vencimento").value = "";
            

        })


        checaCompra             = document.getElementById('comprou');
        checaNaoCompra          = document.getElementById('naocomprou');
        checaInsereEstoque      = document.getElementById('inserirestoque');
        checaNaoInsereEstoque   = document.getElementById('naoinserirestoque');
        
        checaunicadespesa       = document.getElementById('unicadespesa');
        checaNaounicadespesa    = document.getElementById('naounicadespesa');

        if (checaCompra.checked) {
            $("#despesaCompra").show();
            $("#telaQuantidade").show();
            $("#divComprou").show();
            $("#despesaCompraSemEstoque").show();
            $("#telaCadastrarMateriais").show();
            alteraIdComprador();
            $("#tabelaDespesas").show();
            $("#telaQuantidade").show();
            $("#telaDataCompra").show();
            $("#telaCompraParcelada").show();

            $("#telaFuncionario").hide();
            $("#despesaNaoCompra").hide();
            $("#telaDataTrabalho").hide();
            $("#telaPrestador").hide();

        } else if (checaNaoCompra.checked) {

            $("#inserirestoque").prop("checked", false);
            $("#naoinserirestoque").prop("checked", false);

            $("#despesaCompra").hide();
            $("#telaQuantidade").hide();
            $("#divComprou").hide();
            $("#despesaCompraSemEstoque").hide();
            $("#telaCadastrarMateriais").hide();
            resetaIdComprador();
            $("#tabelaDespesas").hide();
            $("#telaQuantidade").hide();
            $("#telaDataCompra").hide();
            $("#telaCompraParcelada").hide();
            $("#tabelalistadespesa").hide();
            $("#telaUnicaDespesa").hide();


            $("#telaFuncionario").show();
            $("#despesaNaoCompra").show();
            $("#telaDataTrabalho").show();
            $("#telaPrestador").show();

        }
        if (checaInsereEstoque.checked) {

            $("#despesaCompraSemEstoque").hide();
            $("#despesaCompra").show();
            $("#telaCadastrarMateriais").show();

        } else if (checaNaoInsereEstoque.checked) {

            $("#despesaCompraSemEstoque").show();
            $("#despesaCompra").hide();
            $("#telaCadastrarMateriais").hide();

        }
        if (checaNaounicadespesa.checked) {
            $("#tabelaMultiplasDespesas").show();

            $("#telaOS").hide();
            $("#telaDescricao").hide();
            $("#telaValor").hide();
            $("#telaQuantidade").hide();
            $("#telaDataPagamento").hide();
            $("#telaNF").hide();
            $("#telaPago").hide();
            document.getElementById("vencimento").value = "";
        } else if (checaunicadespesa.checked) {
            $("#tabelaMultiplasDespesas").hide();

            $("#telaOS").show();
            $("#telaDescricao").show();
            $("#telaValor").show();
            $("#telaQuantidade").show();
            $("#telaDataPagamento").show();
            $("#telaNF").show();
            $("#telaPago").show();
        }


    });

    @include('despesas/formulario/validador')
    @include('despesas/formulario/manipulacoescorpo')
</script>
