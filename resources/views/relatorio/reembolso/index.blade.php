<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apiconsultareembolso";
    $titulo  = "Reembolso";
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
            <h2 class="text-center">Relatório de {{ $titulo }}</h2>
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
                            dataDoPagamento: { type: "date" },
                            // idOS: { type: "string" },
                            // razaosocialFornecedor: { type: "string" },
                            // descricaoBensPatrimoniais: { type: "string" },
                            razaosocialFornecedor: { type: "string" },
                            precoReal: { type: "number" }
                        }
                    },
                },

                group: { field: "razaosocialFornecedor" },
                aggregate: [{ field: "precoReal", aggregate: "sum" }],
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
                { field: "dataDoPagamento", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}" },
                { field: "descricaoBensPatrimoniais", title: "Descrição", filterable: true, width: 90 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 90 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 70 },
                { field: "idOS", title: "N° da OS", filterable: true, width: 60 },
                // { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], format: '{0:0.00}' },
                { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Grupo: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "razaosocialFornecedor", title: "Para Quem", filterable: true, width: 60 }            
                ],
        
        @include('layouts/helpersview/finaltabela')

</script>

@endsection
