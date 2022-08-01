<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apiordemdeservicorecebidas";
    $titulo  = "Ordem de Serviço Recebidas (Analítico)";
    $campodata = 'datapagamentoreceita';

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
                            valorreceita: { type: "number" },
                        }
                    },
                },
                group: [{field: "conta"}],
                aggregate: [{ field: "valorreceita", aggregate: "sum" }]


            },

            columns: [
                { field: "idOS", title: "N° OS", filterable: true, width: 90 },
                { field: "datapagamentoreceita", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 90 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 90 },
                { field: "valorreceita", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Conta: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "conta", title: "Conta", filterable: true, width: 60 }            
                ],
                @include('layouts/helpersview/finaltabela')
                @include('layouts/filtradata')
</script>


@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection