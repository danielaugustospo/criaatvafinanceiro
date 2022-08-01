<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apiareceber";
    $titulo  = "A Receber Por OS";
    $campodata = 'dataCriacaoOrdemdeServico';
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

{{-- @include('despesas/filtroindex') --}}

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
                            datapagamentoreceita: { type: "date" },
                            receitanaopaga: { type: "number" },
                            receitapaga: { type: "number" },
                            valorOrdemdeServico: { type: "number" },
                            dataCriacaoOrdemdeServico: { type: "date" },
                        }
                    },
                },
                group: [{field: "idOS", aggregate: "count"}],
                aggregate: [
                    { field: "receitapaga", aggregate: "sum" },
                    { field: "receitanaopaga", aggregate: "sum" },
                    { field: "valorOrdemdeServico", aggregate: "sum" },
                    { field: "idOS", aggregate: "count" },
                    ]
            },
            columns: [
                { field: "idOS", title: "N° OS", aggregates: ["count"], footerTemplate: "Total de Vendas Geral: #=count#",  filterable: true, width: 50  },
                { field: "dataCriacaoOrdemdeServico", title: "Data da OS", filterable: true, width: 65, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "razaosocialCliente", title: "Cliente",  filterable: true, width: 50 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 90 },
                { field: "valorOrdemdeServico", title: "Valor do Projeto", filterable: true, width: 60, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Cliente: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "receitapaga", title: "Valor Recebido", filterable: true, width: 60, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total Recebido: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "receitanaopaga", title: "Valor a Receber", filterable: true, width: 60, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total a Receber: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 60 },            
                ],
                @include('layouts/helpersview/finaltabela')
                @include('layouts/filtradata')
</script>


@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection