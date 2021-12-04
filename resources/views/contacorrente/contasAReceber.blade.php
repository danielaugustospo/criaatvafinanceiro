<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesas";
    $titulo  = "Contas a Receber";
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

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            precoReal: { type: "number" },
                            razaosocialFornecedor: { type: "string" },
                            vencimento: { type: "date" },
                        }
                    },
                },

                group: {
                    field: "razaosocialFornecedor", aggregates: [
                        { field: "razaosocialFornecedor", aggregate: "count" },
                        { field: "precoReal", aggregate: "sum" },
                    ]
                },
                aggregate: [{ field: "razaosocialFornecedor", aggregate: "count" },
                { field: "precoReal", aggregate: "sum" }],
            },
            filterable: true,
            sortable: true,
            resizable: true,
            scrollable: false,
            groupable: true,
            pageable: {
                pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                numeric: false
            },
            columns: [
                { field: "id", title: "ID", filterable: true, width: 50 },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 100 },
                { field: "despesaCodigoDespesa", title: "Despesa", filterable: true, width: 100 },
                { field: "nomeBensPatrimoniais", title: "Bens Patrimoniais", filterable: true, width: 100 },
                { field: "idOS", title: "OS", filterable: true, width: 100 },
                { field: "razaosocialFornecedor", title: "Fornecedor", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                { field: "vencimento", title: "Vencimento", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                { field: "precoReal", title: "Valor", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Subtotal: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "notaFiscal", title: "Nota Fiscal", filterable: true, width: 100 },
            ],
            @include('layouts/helpersview/finaltabela')

</script>

@endsection