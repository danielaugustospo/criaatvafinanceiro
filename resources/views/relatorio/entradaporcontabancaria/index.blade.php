<?php 
    $intervaloCelulas = "A1:F1"; 
    // $rotaapi = "apiordemdeservicorecebidas";
    $rotaapi = "apientradaporcontabancaria";
    
    $titulo  = "Entrada Por Conta Bancária/NF";
    $campodata = 'datapagamentoreceita';
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
    @can('visualiza-relatoriogeral')

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            valorreceita: { type: "number" },
                            datapagamentoreceita: { type: "date"},
                            idosreceita: { type: "string"},
                            descricaoreceita: { type: "string"},
                            razaosocialCliente: { type: "string"},
                            nomeFormaPagamento: { type: "string"},
                            conta: { type: "string"},
                        }
                    },
                },

                group: {
                    field: "conta", aggregates: [
                        { field: "conta", aggregate: "count" },
                        { field: "valorreceita", aggregate: "sum" } 
                    ]
                },
                aggregate: [
                { field: "conta", aggregate: "count" },
                { field: "valorreceita", aggregate: "sum" }],

            },
                      
            columns: [
                { field: "datapagamentoreceita", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "idosreceita", title: "N° OS", filterable: true, width: 60 },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 100 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 150 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 100 },
                { field: "valorreceita", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total na conta: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "nfreceita", title: "NF", filterable: true, width: 50},
                { field: "conta", title: "Conta", filterable: true, width: 80 },
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')

</script>


@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection