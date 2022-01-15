<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesasfixavariavel";
    $titulo  = "Despesas Fixas/Variáveis";
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
                            precoReal: { type: "number" },
                        }
                    },
                },

                group: {
                    field: "despesaFixa", dir: "asc"
                },
                aggregate: [
                    { field: "despesaFixa", aggregate: "count" },
                    { field: "apelidoConta", aggregate: "count" },
                    { field: "precoReal", aggregate: "sum" }]
            },


            columns: [
                { field: "vencimento", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "nomeBensPatrimoniais", title: "Despesa", filterable: true, width: 100 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 120 },
                { field: "precoReal", title: "Custo Real", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 60 },
                { field: "despesaFixa", title: "Tipo", filterable: true, width: 60 },
                { field: "grupoDespesa", title: "Grupo", filterable: true, width: 120 }
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')



</script>


@endsection