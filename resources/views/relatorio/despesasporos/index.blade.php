<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesasporos";
    $titulo  = "Despesas Por OS";
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

                group: [{
                    field: "dados"
                },
                {
                    field: "despesaCodigoDespesa", dir: "asc"
                }],
                aggregate: [
                    { field: "despesaCodigoDespesa", aggregate: "count" },
                    { field: "apelidoConta", aggregate: "count" },
                    { field: "precoReal", aggregate: "sum" },
                    { field: "porcentagemOS", aggregate: "sum" }
                ]

            },

            columns: [
                { field: "vencimento", title: "Data", filterable: true, width: 15, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "despesa", title: "Despesa", filterable: true, width: 20 },
                { field: "precoReal", title: "Valor", filterable: true, width: 15, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 10 },
                { field: "porcentagemOS", title: "Perc(%)",  width: 15, template:template},
                { field: "despesaCodigoDespesa", title: "Grupo",  filterable: true, width: 15 },
                { field: "idOS", title: "N° OS", filterable: true, width: 10 },
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')

            function template(data){
                var grid = $('#grid').data('kendoGrid');
            
                var valorPorcentagem = 100 * (+data.precoReal) / grid.dataSource.aggregates().precoReal.sum;
                valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2)+"%";
                return  valorPorcentagem;
            }

</script>


@endsection