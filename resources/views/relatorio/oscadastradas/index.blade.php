<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apiconsultaos";
    $titulo  = "OS Cadastradas";
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
@can('ordemdeservico-show')
    

        dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            dataCriacaoOrdemdeServico: { type: "date" },
                            id: {type: "number"},
                            razaosocialCliente: {type: "string"}
                        }
                    },
            },
            // group: [{field: "razaosocialCliente", aggregate: "count"}],

                aggregate: [
                    { field: "id", aggregate: "count" },
                    { field: "razaosocialCliente", aggregate: "count" },
                   
                    ]
                },
            columns: [
                { field: "id", title: "N° OS", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "Total de OS:  #=count#" },
                { field: "dataCriacaoOrdemdeServico", title: "Data", filterable: true, width: 100, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 200 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 200 }
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')

</script>


@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection