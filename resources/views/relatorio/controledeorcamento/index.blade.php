<?php 
    $intervaloCelulas = "A1:I1"; 
    $rotaapi    = "apiControleDeOrcamento";
    $titulo     = "Controle de Orçamento";
    $campodata  = 'dataCriacaoOrdemdeServico';
    $campodata2 = 'datapagamentoreceita';
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

@include('layouts/helpersview/mensagemRetorno')

<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>

<script>


    @include('layouts/helpersview/iniciotabela')
    @can('rel-controleorcamento')

            dataSource: {
                data: data,
                pageSize: 100000, //Se tirar essa trava de valor, o excel vai exportar a coluna status até a quantidade informada
                schema: {
                    model: {
                        fields: {
                            dataCriacaoOrdemdeServico: { type: "date" },
                            valorOrcamento: { type: "number" },
                            valorgasto: { type: "number" },
                            saldo: { type: "number" },
                            percentualPermitido: { type: "number" },
                            percentual: { type: "number" },
                            status: { type: "string" },

                        }
                    },
                },
                // group: [{field: "conta"}, {field: "razaosocialCliente"}],
                aggregate: [{ field: "valorOrcamento", aggregate: "sum" },
                            { field: "valorgasto", aggregate: "sum" },
                            { field: "saldo", aggregate: "sum" }]


            },

            columns: [
                { field: "id", title: "N° OS", filterable: true, width: 80 },
                { field: "vendedor", title: "Vendedor", filterable: true, width: 80 },
                { field: "dataCriacaoOrdemdeServico", title: "Data Abertura", filterable: true, width: 60, format: "{0:dd/MM/yyyy}" , filterable: { cell: { template: betweenFilter}} },
                { field: "valorOrcamento", title: "Valor Orçamento", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                {
                    field: "percentualPermitido",
                    title: "Perc% Permitido",
                    filterable: true,
                    width: 60,
                    decimals: 2, format: '{0:0.00}',
                    template: function(dataItem) {
                        if (dataItem.percentualPermitido !== null && dataItem.percentualPermitido < 40) {
                        return '<span style="color: red;">' + kendo.toString(dataItem.percentualPermitido, "0.00") + '%</span>';
                        } else {
                        return dataItem.percentualPermitido !== null ? kendo.toString(dataItem.percentualPermitido, "0.00") + '%' : '';
                        }
                    }
                },
                { field: "valorgasto", title: "Valor Gastos", filterable: true, width: 70, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "saldo", title: "Saldo", filterable: true, width: 70, decimals: 2, format: '{0:0.00}' },
                {
                    field: "percentual",
                    title: "Perc% Gastos",
                    filterable: true,
                    width: 60,
                    decimals: 2, format: '{0:0.00}',

                    template: function(dataItem) {
                        return dataItem.percentual !== null ? kendo.toString(dataItem.percentual, "0.00") + '%' : '';
                    }
                },
                {
                    field: "status",
                    title: "Status",
                    filterable: true,
                    width: 60,
                    template: function(dataItem) {
                        if (dataItem.percentual !== null && dataItem.percentual > 100) {
                            dataItem.status = 'Estorou';
                            return '<span style="color: #FF0000;">Estorou</span>'; // Vermelho
                        } else {
                            dataItem.status = 'Abaixo';
                            return '<span style="color: #008000;">Abaixo</span>'; // Verde
                        }
                    }
                }

                ],
                @include('layouts/helpersview/finaltabela')
                @include('layouts/filtradata')

</script>


@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection