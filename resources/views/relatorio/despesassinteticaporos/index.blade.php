<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesasporos";
    $titulo  = "Despesas Sintética Por OS";
?>

@extends('layouts.app')
@section('content')
@include('layouts/helpersview/iniciorelatorio')

<script>
        @include('layouts/helpersview/iniciotabela')

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            vencimento: { type: "date" },
                            precoReal: { type: "number" },
                        }
                    },
                },

                group: [{
                    field: "dados"
                }],
                aggregate: [
                    { field: "grupoDespesa", aggregate: "count" },
                    { field: "apelidoConta", aggregate: "count" },
                    { field: "precoReal", aggregate: "sum" }]
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
                { field: "idOS", title: "OS", filterable: true, width: 10 },
                { field: "grupoDespesa", title: "Grupo", filterable: true, width: 120 },
                { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "percentual", title: "Perc(%)", filterable: true, width: 60 }
            ],                
            @include('layouts/helpersview/finaltabela')


</script>
@endsection