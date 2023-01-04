<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidadosfechamentofinal";
    $titulo  = "Fechamento Final";
    $campodata = 'dataCriacaoOrdemdeServico';
    $relatorioKendoGrid = true;
?>


<head>
    <meta charset="utf-8">
    <title>{{$titulo}}</title>
</head>

@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Relatório de {{$titulo}}</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>

<script>

    @include('layouts/helpersview/iniciotabela')
@can('visualiza-relatoriogeral')

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            valorOrdemdeServico: { type: "number" },
                            custo: { type: "number" },
                            lucro: { type: "number" },
                            porcentagem: { type: "number" },
                            dataCriacaoOrdemdeServico: { type: "date" },

                            // datapagamentoreceita: { type: "date" },
                        }
                    },
                },
                // group: {field: "status", aggregate: "count"},
                aggregate: [
                    { field: "idOS", aggregate: "count" },
                    { field: "valorOrdemdeServico", aggregate: "sum" },
                    { field: "custo", aggregate: "sum" },
                    { field: "lucro", aggregate: "sum" },
                    { field: "porcentagem", aggregate: "average" },
                    ]
            },

            columns: [
                { field: "idOS", title: "OS", aggregates: ["count"], footerTemplate: "Total de OS: #=count#",  filterable: true, width: 100  },
                { field: "dataCriacaoOrdemdeServico", title: "Data OS", filterable: true, width: 150, format: "{0:dd/MM/yyyy}",filterable: { cell: { template: betweenFilter}} },
                // { field: "datapagamentoreceita", title: "Data do Pagamento", filterable: true, width: 300, format: "{0:dd/MM/yyyy}" },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 100 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 150 },
                { field: "valorOrdemdeServico", title: "Valor do<br>Projeto", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "custo", title: "Total de<br>Custos", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "lucro", title: "Lucro ou<br>Prejuízo", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "porcentagem", title: "Perc(%)", filterable: true, width: 100, decimals: 2, aggregates: ["average"], footerTemplate: calculaPorcentagem, format: '{0:0.00} %' },            
                { field: "status", title: "Pago", filterable: true, width: 80},            
                ],
                @include('layouts/helpersview/finaltabela')
                @include('layouts/filtradata')


                function calculaPorcentagem(data){
                    var tabela = $('#grid').data('kendoGrid');
                    
                    // var valorPorcentagem = 100*(+data.porcentagemOS)/grid.dataSource.aggregates().porcentagemOS.sum + ' %';
                    var valorPorcentagem = (100 * (+tabela.dataSource.aggregates().lucro.sum)) / tabela.dataSource.aggregates().valorOrdemdeServico.sum;
                    valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2)+"%";
                    return  valorPorcentagem;
                }
</script>   

@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection