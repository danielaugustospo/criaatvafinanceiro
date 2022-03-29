<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apiconsultacontasapagarporgrupo";
    $titulo  = "Despesas A Pagar";
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

                group: [{field: "grupoDespesa"}],
                aggregate: [{ field: "precoReal", aggregate: "sum" }]

            },
            columns: [
                { field: "vencimento", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "idOS", title: "N° da OS", filterable: true, width: 60 },
                { field: "razaosocialFornecedor", title: "Fornecedor", filterable: true, width: 90 },
                { field: "despesa", title: "Despesa", filterable: true, width: 90 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 70 },
                { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Grupo: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 60 },            
                { field: "notaFiscal", title: "NF", filterable: true, width: 60 },            
                { field: "grupoDespesa", title: "Grupo", filterable: true, width: 60 }            
                ],
                @include('layouts/helpersview/finaltabela')
                @include('layouts/filtradata')

</script>


@endsection