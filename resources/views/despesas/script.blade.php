<script>
        // $(function () {
        // $("#chkForn").click(function () {
        //     if ($(this).is(":checked")) {
        //         $("#telaFornecedor").show();
        //         $("#telaFuncionario").hide();
        //         pegaIdFornecedor();
        //     } else {
        //         $("#telaFornecedor").hide();
        //         $("#telaFuncionario").show();
        //         pegaIdFuncionario();
        //     }
        // });
        // $("#chkFunc").click(function () {
        //     if ($(this).is(":checked")) {
        //         $("#telaFornecedor").hide();
        //         $("#telaFuncionario").show();
        //         pegaIdFuncionario();
        //     } else {
        //         $("#telaFornecedor").show();
        //         $("#telaFuncionario").hide();
        //         pegaIdFornecedor();

        //     }
        // });
        $(function () {
        $("#comprou").click(function () {
            if ($(this).is(":checked")) {
                $("#divComprou").show();
                alteraIdComprador();

                $("#telaFornecedor").show();
                $("#telaFuncionario").hide();
                pegaIdFornecedor();

                $("#telaDataTrabalho").hide();
                $("#telaDataCompra").show();
                $("#tabelaDespesas").show();
            } else {
                $("#divComprou").hide();
                resetaIdComprador();

                $("#telaFornecedor").hide();
                $("#telaFuncionario").show();
                pegaIdFuncionario();

                $("#telaDataCompra").hide();
                $("#telaDataTrabalho").show();
                $("#tabelaDespesas").hide();
            }
        });
        $("#naocomprou").click(function () {
            if ($(this).is(":checked")) {
                $("#divComprou").hide();
                resetaIdComprador();

                $("#telaFornecedor").hide();
                $("#telaFuncionario").show();
                pegaIdFuncionario();

                $("#telaDataCompra").hide();
                $("#telaDataTrabalho").show();
                $("#tabelaDespesas").hide();

            } else {
                $("#divComprou").show();
                alteraIdComprador();

                $("#telaFornecedor").show();
                $("#telaFuncionario").hide();
                pegaIdFornecedor();

                $("#telaDataTrabalho").hide();
                $("#telaDataCompra").show();
                $("#tabelaDespesas").show();
            }
        });
    });


function pegaIdFornecedor(){
        var selecionado = $('.selecionaFornecedor').find(':selected').val();
        console.log(selecionado);
        document.getElementById("idFornecedor").value = selecionado;
}

function pegaIdFuncionario(){
        var selecionado = $('.selecionaFuncionario').find(':selected').val();
        console.log(selecionado);
        document.getElementById("idFornecedor").value = selecionado;
}

function alteraIdComprador(){
        var idComprador = $('.quemComprouSelect').find(':selected').val();
        console.log(idComprador);
        document.getElementById("quemcomprou").value = idComprador;
}
function resetaIdComprador(){
        document.getElementById("quemcomprou").value = "";
}

</script>