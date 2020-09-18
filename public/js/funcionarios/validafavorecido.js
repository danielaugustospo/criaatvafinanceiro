$(document).ready(function () {
    $('#esconde').hide();
    $('#div_dados_favorecido').hide();

    $('#escondereceita').hide();
    $('#div_cadastro_receita').hide();

    $('#divcurso').hide();

    $('input[name=nomefavorecidoFuncionario]').val('000000');
    $('input[name=cpffavorecidoFuncionario]').val('000000');
    $('input[name=contacorrentefavorecidoFuncionario]').val('000000');
    $('input[name=bancofavorecidoFuncionario]').val('000000');
    $('input[name=nrcontafavorecidoFuncionario]').val('000000');
    $('input[name=agenciafavorecidoFuncionario]').val('000000');


    $('#divcertprof').hide();
    $('input[name=descformacaoFuncionario]').val('Não Possui');

    $('input[name=uncertificadoraFuncionario]').val('Nenhuma');
    $('input[name=anocertificacaoFuncionario]').val('0000');


})

$('#reveal').on('click', function () {
    $('#ajax-content').show('#div_dados_favorecido');
    $('#reveal').hide();
    $('#esconde').show();
    $('#div_dados_favorecido').show();
    $('input[name=nomefavorecidoFuncionario]').val('Nao possui');
    $('input[name=cpffavorecidoFuncionario]').val('Nao possui');
    $('input[name=contacorrentefavorecidoFuncionario]').val('Nao possui');
    $('input[name=bancofavorecidoFuncionario]').val('Nao possui');
    $('input[name=nrcontafavorecidoFuncionario]').val('Nao possui');
    $('input[name=agenciafavorecidoFuncionario]').val('Nao possui');
})


$('#esconde').on('click', function () {
    $('#ajax-content').hide('#div_dados_favorecido');
    $('#esconde').hide();
    $('#reveal').show();
    $('input[name=nomefavorecidoFuncionario]').val('000000');
    $('input[name=cpffavorecidoFuncionario]').val('000000');
    $('input[name=contacorrentefavorecidoFuncionario]').val('000000');
    $('input[name=bancofavorecidoFuncionario]').val('000000');
    $('input[name=nrcontafavorecidoFuncionario]').val('000000');
    $('input[name=agenciafavorecidoFuncionario]').val('000000');

})

$('#revealreceita').on('click', function () {
    $('#ajax-content-receita').show('#div_cadastro_receita');
    $('#revealreceita').hide();
    $('#escondereceita').show();
    $('#div_cadastro_receita').show();

})


$('#escondereceita').on('click', function () {
    $('#ajax-content-receita').hide('#div_cadastro_receita');
    $('#escondereceita').hide();
    $('#revealreceita').show();
    $('input[name=valorreceita]').val('0,00');

})

$('.fundamental').on('click', function () {
    $('#divcurso').hide();
    $('input[name=descformacaoFuncionario]').val('Não Possui');
})


$('.medio').on('click', function () {
    $('#divcurso').hide();
    $('input[name=descformacaoFuncionario]').val('Não Possui');
})


$('.superior').on('click', function () {
    $('#divcurso').show();
    $('input[name=descformacaoFuncionario]').val('');
})

$('.semcert').on('click', function () {
    $('#divcertprof').hide();
    $('input[name=uncertificadoraFuncionario]').val('Nenhuma');
    $('input[name=anocertificacaoFuncionario]').val('0000');

})

$('.comcert').on('click', function () {
    $('#divcertprof').show();
    $('input[name=uncertificadoraFuncionario]').val('');
    $('input[name=anocertificacaoFuncionario]').val('');

})
