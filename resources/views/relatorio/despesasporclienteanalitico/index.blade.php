<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidespesasporos";
    $titulo  = "Despesas Por Cliente (Analítico)";
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
                }]

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
                { field: "descricaoBensPatrimoniais", title: "Despesa", filterable: true, width: 100 },
                { field: "razaosocialFornecedor", title: "Fornecedor", filterable: true, width: 100 },
                // { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 120 },
                { field: "precoReal", title: "Custo", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total na conta: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 60 },
                { field: "pago", title: "PG", filterable: true, width: 60 },
                { field: "idOS", title: "N° OS", filterable: true, width: 60 }            
                ],
                @include('layouts/helpersview/finaltabela')

</script>


@endsection