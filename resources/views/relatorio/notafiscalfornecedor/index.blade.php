<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesasporos";
    $titulo  = "Nota Fiscal - Fornecedor";
    $campodata = 'dataDoPagamento';
    $orientacao = 1;
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
            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            dataDoPagamento: { type: "date" },
                            precoReal: { type: "number" },
                        }
                    },
                },

                group: {
                    field: "notaFiscal", dir: "asc"
                },
                aggregate: [
                    { field: "notaFiscal", aggregate: "count" },
                    { field: "apelidoConta", aggregate: "count" },
                    { field: "precoReal", aggregate: "sum" }]
            },

            columns: [
                { field: "idOS", title: "OS", filterable: true, width: 20 },
                { field: "dataDoPagamento", title: "Data", filterable: true, width: 50, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "razaosocialFornecedor", title: "Fornecedor", filterable: true, width: 40 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 30 },
                { field: "precoReal", title: "Valor", filterable: true, width: 30, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "pago", title: "PG", filterable: true, width: 20 },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 30 },
                { field: "notaFiscal", title: "Nota Fiscal", filterable: true, width: 30 },
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')

</script>


@endsection