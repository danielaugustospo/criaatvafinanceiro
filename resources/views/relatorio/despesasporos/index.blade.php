<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesasporos";
    $titulo  = "Despesas Por OS";
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
                            vencimento: { type: "date" },
                            // idOS: { type: "string" },
                            // razaosocialFornecedor: { type: "string" },
                            // descricaoBensPatrimoniais: { type: "string" },
                            // nomeFormaPagamento: { type: "string" },
                            precoReal: { type: "number" },
                            // conta: { type: "string" },
                        }
                    },
                },

                group: [{
                    field: "dados"
                },
                {
                    field: "grupoDespesa", dir: "asc"
                }],
                aggregate: [
                    { field: "grupoDespesa", aggregate: "count" },
                    { field: "apelidoConta", aggregate: "count" },
                    { field: "precoReal", aggregate: "sum" }]

                // { field: "UnitsOnOrder", aggregate: "average" },
                // { field: "UnitsInStock", aggregate: "min" },
                // { field: "UnitsInStock", aggregate: "max" }]

            },
            //height: 550,
            // width: 1280,
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
                { field: "vencimento", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}" },
                // { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 100 },
                { field: "nomeBensPatrimoniais", title: "Despesa", filterable: true, width: 100 },
                // { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 120 },
                { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 60 },
                { field: "percentual", title: "Perc(%)", filterable: true, width: 60 },
                { field: "grupoDespesa", title: "Grupo", filterable: true, width: 120 },
                { field: "idOS", title: "N° OS", filterable: true, width: 60 },
                // { field: "conta", title: "Conta", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" }
            ],
            @include('layouts/helpersview/finaltabela')


</script>


@endsection