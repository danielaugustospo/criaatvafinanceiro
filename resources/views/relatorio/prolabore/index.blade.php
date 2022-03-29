<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apiconsultaprolabore";
    $titulo  = "Pró-Labore";
    $campodata = 'dataDoPagamento';
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
            <h2 class="text-center">Relatório de {{ $titulo }}</h2>
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

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            dataDoPagamento: { type: "date" },
                            nomeFuncionario: { type: "string" },
                            precoReal: { type: "number" }
                        }
                    },
                },

                group: { field: "nomeFuncionario" },
                aggregate: [{ field: "precoReal", aggregate: "sum" }],
            },

            columns: [
                { field: "despesa", title: "Despesa", filterable: true, width: 30 },
                { field: "dataDoPagamento", title: "Data", filterable: true, width: 20, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "precoReal", title: "Valor", filterable: true, width: 20, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Grupo: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "pago", title: "Pago", filterable: true, width: 10 },
                { field: "nomeFuncionario", title: "Funcionário", filterable: true, width: 20 }            
                ],
        
        @include('layouts/helpersview/finaltabela')
        @include('layouts/filtradata')
</script>

@endsection
