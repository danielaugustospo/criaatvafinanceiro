<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi    = "apidadosreceitaos";
    $titulo     = "Notas Emitidas - FORNECEDOR";
    $campodata  = 'dataemissaoreceita';
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
@can('visualiza-relatoriogeral')

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            valorreceita: { type: "number" },
                            dataemissaoreceita: { type: "date" },
                            datapagamentoreceita: { type: "date" },
                        }
                    },
                },
                group: {field: "dados", aggregate: "count"},
                aggregate: [
                    { field: "valorreceita", aggregate: "sum" },
                    { field: "idOS", aggregate: "count" },
                    ]
            },



            columns: [
                { field: "idOS", title: "N° OS", aggregates: ["count"], footerTemplate: "Total de Notas: #=count#",  filterable: true, width: 30  },
                { field: "dataemissaoreceita", title: "Data Emissão", filterable: true, width: 30, format: "{0:dd/MM/yyyy}" , filterable: { cell: { template: betweenFilter}} },
                //{ field: "datapagamentoreceita", title: "Data do Pagamento", filterable: true, width: 30, format: "{0:dd/MM/yyyy}" , filterable: { cell: { template: segundoFiltroPeriodo}} },
                { field: "nomeFormaPagamento", title: "Forma de Pag.", filterable: true, width: 60 },
                { field: "valorreceita", title: "Valor", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "pagoreceita", title: "Pago", filterable: true, width: 60 },            
                { field: "nfreceita", title: "Nota Fiscal", filterable: true, width: 120 },            
                { field: "apelidoConta", title: "Conta", filterable: true, width: 100 },            
                ],
                @include('layouts/helpersview/finaltabela')
                @include('layouts/filtradata')

</script>

@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection