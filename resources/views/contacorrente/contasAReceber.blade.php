<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apicontasareceber";
    $titulo  = "Contas a Receber";
    $campodata = 'datapagamentoreceita';
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

<hr>

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
                            valorreceita: { type: "number" },
                            razaosocialCliente: { type: "string" },
                            datapagamentoreceita: { type: "date" },
                        }
                    },
                },

                group: {
                    field: "razaosocialCliente", aggregates: [
                        { field: "razaosocialCliente", aggregate: "count" },
                        { field: "valorreceita", aggregate: "sum" },
                    ]
                },
                aggregate: [{ field: "razaosocialCliente", aggregate: "count" },
                { field: "valorreceita", aggregate: "sum" }],
            },

            columns: [
                { field: "idOS", title: "OS", filterable: true, width: 100 },
                // { field: "idOS", title: "ID", filterable: true, width: 50 },
                { field: "datapagamentoreceita", title: "Data", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" , filterable: { cell: { template: betweenFilter}} },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 100 },
                // { field: "nomeBensPatrimoniais", title: "Bens Patrimoniais", filterable: true, width: 100 },
                { field: "valorreceita", title: "Valor a Receber", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Subtotal: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "conta", title: "Conta", filterable: true, width: 100 },
                { field: "nfreceita", title: "Nota Fiscal", filterable: true, width: 100 }
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')

</script>

@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection