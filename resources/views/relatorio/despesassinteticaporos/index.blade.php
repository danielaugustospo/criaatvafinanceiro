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
                    { field: "despesaCodigoDespesa", aggregate: "count" },
                    { field: "apelidoConta", aggregate: "count" },
                    { field: "precoReal", aggregate: "sum" },
                    { field: "percentual", aggregate: "sum" }]
            },
            columns: [
                { field: "idOS", title: "OS", filterable: true, width: 20 },
                { field: "despesaCodigoDespesa", title: "Despesa", filterable: true, width: 30 },
                { field: "precoReal", title: "Valor", filterable: true, width: 30, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "percentual", title: "Perc(%)", filterable: true, width: 20, footerTemplate: "100,00%", template:template }
            ],                
            @include('layouts/helpersview/finaltabela')

            function template(data){
                var grid = $('#grid').data('kendoGrid');
            
                // var valorPorcentagem = 100*(+data.porcentagemOS)/grid.dataSource.aggregates().porcentagemOS.sum + ' %';
                var valorPorcentagem = 100 * (+data.precoReal) / grid.dataSource.aggregates().precoReal.sum;
                valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2)+"%";
                return  valorPorcentagem;
            }

</script>
@endsection