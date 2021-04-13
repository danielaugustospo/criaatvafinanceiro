$('.daterange').daterangepicker({
        
    ranges: {
    'Hoje': [moment(), moment()],
    'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Últimos 7 Dias': [moment().subtract(6, 'days'), moment()],
    'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
    'Este Mês': [moment().startOf('month'), moment().endOf('month')],
    'Último Mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
    'Este Ano': [moment().startOf('year'), moment().endOf('year')]

},   
"locale": {
    "format": "DD/MM/YYYY",
    "separator": " - ",
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar / Limpar",
    "fromLabel": "Início",
    "toLabel": "Fim",
    "customRangeLabel": "Customizar",
    "weekLabel": "W",
    "daysOfWeek": [
        "Dom",
        "Seg",
        "Ter",
        "Qua",
        "Qui",
        "Sex",
        "Sab"
    ],
    "monthNames": [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro"
    ],
    "firstDay": 1
},
"startDate": "01/01/2021",
"endDate": "04/04/3000",
"opens": "center"
}, function(start, end, label) {
console.log('Novo período selecionado: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    var dataInicio = start.format('YYYY-MM-DD');
    var dataFim = end.format('YYYY-MM-DD');
    $('input[name=buscaDataInicio]').val(dataInicio);
    $('input[name=buscaDataFim]').val(dataFim);

});

$('#daterange').on('cancel.daterangepicker', function(ev, picker) {
$('#daterange').val('');
$('input[name=buscaDataInicio]').val('');
$('input[name=buscaDataFim]').val('');

});