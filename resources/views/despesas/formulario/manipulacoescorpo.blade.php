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

$('body').on('click', '.duplicarParcelado', function() {
    var row = $(this).closest('tr');
    var idTabela = 'tabelalistadespesa';
    duplicarLinha(row, idTabela);
});
$('body').on('click', '.duplicarNaoParceladoMultiplo', function() {
    var row = $(this).closest('tr');
    var idTabela = 'tabelalistadespesamultipla';

    duplicarLinha(row, idTabela);
});


$('body').on('click', '.deleteParcelado', function() {
    var $tr = $(this).closest('tr');
    excluiLinha($tr);
});
$('body').on('click', '.deleteNaoParceladoMultiplo', function() {
    var $tr = $(this).closest('tr');
    excluiLinha($tr);
});

function duplicarLinha(row, idTabela) {
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

    newrow = row.clone();
    if (idTabela == 'tabelalistadespesamultipla') {       
        $(".tabelalistadespesamultipla").append(newrow);
    }
    if (idTabela == 'tabelalistadespesa') {       
        $(".tabelalistadespesa").append(newrow);
    }
    
    
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
    newrow.find("#quantidadeTabela").each(function(index) {
        $(this).val(''); //Zero o valor porque se for uma compra e para lançar no estoque, lanço uma só vez
        $(this).trigger('change'); // Notify any JS components that the value changed
    });
    newrow.find(".valunitariomultiplo").each(function(index) {
        $(this).val(''); //Zero o valor porque se for uma compra e para lançar no estoque, lanço uma só vez
        $(this).trigger('change'); // Notify any JS components that the value changed
    });
    newrow.find(".valtotalmultiplo").each(function(index) {
        $(this).val(''); //Zero o valor porque se for uma compra e para lançar no estoque, lanço uma só vez
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
}

function excluiLinha($tr) {
    if ($tr.attr('class') == 'linhaTabela1') {
        $tr.nextUntil('tr[class=linhaTabela1]').andSelf().remove();
    } else {
        $tr.remove();
    }
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

    let dropdown = $('.descParcelado');

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
    $('.descParcelado').select2();
}
function recarregaDescricaoDespesaTabelaMultiplo() {

    let dropdown = $('.descMultiplo');

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
    $('.descMultiplo').select2();
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