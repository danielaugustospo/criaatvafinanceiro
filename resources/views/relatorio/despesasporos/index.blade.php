<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "api/apidespesas";
    $titulo  = "Despesas Por OS";
    $campodata = 'vencimento';
    $relatorioKendoGrid = true;
    
    if (isset($despesas)) {
        $despesas = $despesas;
    } else {
        $despesas = '';
    }
$idUser = Crypt::encrypt(auth()->user()->id);
?>



<head>
<meta charset="utf-8">
<title>{{ $titulo }}</title>
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

<a onclick="abreModalDespesas(param = 'despesasporos');" class="d-flex justify-content-center" href="#"> <i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a>


@include('layouts/helpersview/mensagemRetorno')



<div id="filter-menu"></div>
<br /><br />
    <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
        @include('layouts/helpersview/infofiltrosdepesa')
    </div>

<script>
$.LoadingOverlay("show", {
    image: "",
    progress: true
});

@can('visualiza-relatoriogeral')
var dataSource = new kendo.data.DataSource({
    @include('layouts/helpersview/transportdespesaskendogrid')

});


//Se não houver essa declaração, ele retorna erro dizendo que não encontrou o metodo e não exporta o pdf
var detailColsVisibility = {};

dataSource.fetch().then(function() {
            var data = dataSource.data();

            // initialize a Kendo Grid with the returned data from the server.
            $("#grid").kendoGrid({
                        toolbar: ["excel", "pdf"],
                        excel: {
                            fileName: "Relatório de " + document.title + ".xlsx",
                            allPages: true
                            // proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
                            // filterable: true
                        },
                        excelExport: function(e) {

                            var sheet = e.workbook.sheets[0];
                            @if (isset($contacorrente))
                                for (var rowIndex = 1; rowIndex < sheet.rows.length; rowIndex++) { if (rowIndex < (sheet.rows.length - 1)) { var
                                    row=sheet.rows[rowIndex]; for (var cellIndex=4; cellIndex < row.cells.length; cellIndex ++) {
                                    row.cells[cellIndex].format="[Blue]#,##0.00_);[Red]-#,##0.00_);0.0;" {{-- console.log(cellIndex); --}} } } } @endif

                            sheet.frozenRows = 1;
                            sheet.mergedCells = ["A1:F1"];
                            sheet.name = "Relatorio_de_" + document.title + " -  CRIAATVA";

                            var myHeaders = [{
                                value: "Relatório de " + document.title,
                                textAlign: "center",
                                background: "black",
                                color: "#ffffff"
                            }];


                            console.log(e.workbook);
                            sheet.rows.splice(0, 0, {
                                cells: myHeaders,
                                type: "header",
                                height: 20
                            });
                        },

                        pdf: {
                            fileName: "Relatório de " + document.title + ".pdf",

                            allPages: true,
                            avoidLinks: true,
                            paperSize: "A4",
                            margin: {
                                top: "3.5cm",
                                left: "1cm",
                                right: "1cm",
                                bottom: "0.5cm"
                            },

                            @if (isset($orientacao))
                                landscape: true,
                            @else
                                landscape: true,
                            @endif

                            repeatHeaders: false,
                            template: $("#page-template").html(),
                            scale: 0.8
                        },
                        filterable: {
                            extra: false,
                            mode: "row"
                        },
                        sortable: true,
                        resizable: true,
                        scrollable: true,
                        groupable: true,
                        columnMenu: true,
                        responsible: true,
                        reorderable: true,
                        width: 'auto',
                        pageable: {
                            pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                            numeric: false
                        },
            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            vencimento: { type: "date" },
                            precoReal: { type: "number" },
                            porcentagemOS: { type: "number" },
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
                { field: "vencimento", title: "Data", filterable: true, width: 150, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "descricaoDespesa", title: "Despesa", filterable: true, width: 200 },
                { field: "precoReal", title: "Valor", filterable: true, width: 150, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 100 },
                { 
                    field: "porcentagemOS", 
                    title: "Perc(%)",  
                    width: 150,  
                    decimals: 2, 
                    aggregates: ["sum"], 
                    groupHeaderColumnTemplate: "#= calcularPorcentagem(data, grid) #", 
                    template: template
                },
                { field: "despesaCodigoDespesa", title: "Grupo",  filterable: true, width: 150 },
                { field: "idOS", title: "N° OS", filterable: true, width: 100 },
            ],
            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')

            function template(data){
                var grid = $('#grid').data('kendoGrid');
                var valorPorcentagem = 100 * (+data.precoReal) / grid.dataSource.aggregates().precoReal.sum;
                valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2);
                return valorPorcentagem;
            }

            function calcularPorcentagem(data, grid) {
                var group = data.aggregates.precoReal.sum;
                var precoRealSum = group || 0; // Definir como zero se a soma for nula
                
                var grid  = $('#grid').data('kendoGrid');
                var total = grid.dataSource.aggregates().precoReal.sum; 

                if (precoRealSum !== 0) {
                    porcentagem = (precoRealSum  * 100) / total; // Calcula a porcentagem com base no valor de precoReal já somado
                }

            return "Total: R$" + kendo.toString(precoRealSum, "n2") + " (" + kendo.toString(porcentagem, "n2") + "%)";
}

</script>


@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection