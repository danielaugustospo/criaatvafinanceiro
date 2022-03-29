<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi    = "apiordemdeservicorecebidas";
    $titulo     = "'OS' Recebidas Por Cliente";
    $campodata  = 'dataCriacaoOrdemdeServico';
    $campodata2 = 'datapagamentoreceita';

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
                            datapagamentoreceita: { type: "date" },
                            dataCriacaoOrdemdeServico: { type: "date" },
                            valorreceita: { type: "number" },
                        }
                    },
                },
                group: [{field: "conta"}, {field: "razaosocialCliente"}],
                aggregate: [{ field: "valorreceita", aggregate: "sum" }]


            },


            columns: [
                { field: "idOS", title: "N° OS", filterable: true, width: 90 },
                { field: "nfreceita", title: "NFS", filterable: true, width: 90 },
                { field: "dataCriacaoOrdemdeServico", title: "Data da OS", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "eventoOrdemdeServico", title: "Descrição da Receita", filterable: true, width: 90 },
                { field: "datapagamentoreceita", title: "Data PG", filterable: true, width: 85, format: "{0:dd/MM/yyyy}" , filterable: { cell: { template: segundoFiltroPeriodo}} },
                { field: "nomeFormaPagamento", title: "Forma de Pag.", filterable: true, width: 90 },
                { field: "valorreceita", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Conta: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 90 },
                { field: "conta", title: "Conta", filterable: true, width: 60 }            
                ],
                @include('layouts/helpersview/finaltabela')
                @include('layouts/filtradata')


                

</script>


@endsection