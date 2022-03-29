<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesas";
    $titulo  = "Despesas";
    $campodata = 'vencimento';
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
            <h2 class="text-center">Consulta de {{ $titulo }}</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('despesa-create')
            <a class="btn btn-success" href="{{ route('despesas.create') }}">Cadastrar Despesas</a>
            @endcan
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
                            vale: { type: "number" },
                            despesareal: { type: "number" },
                            razaosocialFornecedor: { type: "string" },
                            vencimento: { type: "date" },
                            datavale: { type: "date" },
                        }
                    },
                },

                group: {
                    field: "razaosocialFornecedor", aggregates: [
                        { field: "razaosocialFornecedor", aggregate: "count" },
                        { field: "precoReal", aggregate: "sum" },
                        { field: "vale", aggregate: "sum" },
                        { field: "despesareal", aggregate: "sum" }

                    ]
                },
                aggregate: [{ field: "razaosocialFornecedor", aggregate: "count" },
                { field: "precoReal", aggregate: "sum" },
                { field: "vale", aggregate: "sum" },
                { field: "despesareal", aggregate: "sum" }],

            },

            columns: [
                { field: "id", title: "ID", filterable: true, width: 40 },
                { field: "apelidoConta", title: "C/C", filterable: true, width: 40 },
                { field: "despesaCodigoDespesa", title: "Cód.<br>Despesa", filterable: true, width: 100 },
                { field: "idOS", title: "OS", filterable: true, width: 70 },
                { field: "nomeBensPatrimoniais", title: "Despesa", filterable: true, width: 100 },
                { field: "razaosocialFornecedor", title: "Fornecedor", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                { field: "vencimento", title: "Venc.", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "vale", title: "Vale", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "despesareal", title: "Valor<br>Final", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "datavale", title: "PG<br>Vale", filterable: true, width: 85, format: "{0:dd/MM/yyyy}" },
                { field: "notaFiscal", title: "NF", filterable: true, width: 60 },

                {
                    command: [{
                        name: "Visualizar",
                        click: function (e) {
                            e.preventDefault();
                            var tr = $(e.target).closest("tr"); // get the current table row (tr)
                            var data = this.dataItem(tr);
                            window.location.href = location.href + '/' + data.id;
                        }
                    }],
                    width: 120,
                    exportable: false,
                },
                {
                    command: [{
                        name: "Editar",
                        click: function (e) {
                            e.preventDefault();
                            var tr = $(e.target).closest("tr"); // get the current table row (tr)
                            var data = this.dataItem(tr);
                            window.location.href = location.href + '/' + data.id + '/edit';
                        }
                    }],
                    width: 120,
                    exportable: false,
                },
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')
</script>


@endsection