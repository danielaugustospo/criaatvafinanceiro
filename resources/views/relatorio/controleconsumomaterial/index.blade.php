<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "api/apidespesas";
    $titulo  = "Controle de consumo de materiais";
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

<a onclick="abreModalDespesas(param = 'controleconsumomaterial');" class="d-flex justify-content-center" href="#"> <i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<div id="filter-menu"></div>
<br /><br />
 <div id="chart"></div>
    <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
        @include('layouts/helpersview/infofiltrosdepesa')
    </div>

<script>

function createChart() {
            $("#chart").kendoChart({
                title: {
                    position: "bottom",
                    text: "Dados referente ao período XPTO"
                },
                legend: {
                    visible: false
                },
                chartArea: {
                    background: ""
                },
                seriesDefaults: {
                    labels: {
                        visible: true,
                        background: "transparent",
                        template: "#= category #: \n #= value#%"
                    }
                },
                series: [{
                    type: "pie",
                    startAngle: 150,
                    data: [{
                        category: "Madeira",
                        value: 53.8,
                        color: "#9de219"
                    },{
                        category: "Ferramenta",
                        value: 16.1,
                        color: "#90cc38"
                    },{
                        category: "Cola",
                        value: 11.3,
                        color: "#068c35"
                    },{
                        category: "Ferro",
                        value: 9.6,
                        color: "#006634"
                    },{
                        category: "Alumínio",
                        value: 5.2,
                        color: "#004d38"
                    },{
                        category: "Plástico",
                        value: 3.6,
                        color: "#033939"
                    }]
                }],
                tooltip: {
                    visible: true,
                    format: "{0}%"
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
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
                            // vencimento: { type: "date" },
                            valorUnitario: { type: "number" },
                            precoReal: { type: "number" },
                        }
                    },
                },

                group: [{
                    field: "razaosocialFornecedor"
                }],
                aggregate: [
                    { field: "material", aggregate: "count" },
                    // { field: "apelidoConta", aggregate: "count" },
                    { field: "valorUnitario", aggregate: "sum" },
                    { field: "precoReal", aggregate: "sum" },
                    // { field: "porcentagemOS", aggregate: "sum" }
                ]

            },

            columns: [
                { field: "material", title: "Material", filterable: true, width: 200 },
                { field: "tipo", title: "Tipo", filterable: true, width: 150 },
                { field: "unidade", title: "Unidade", filterable: true, width: 150 },
                { field: "qtde", title: "Qtde", filterable: true, width: 100 },
                { field: "valorUnitario", title: "Preço Unitario", filterable: true, width: 150, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "precoReal", title: "Valor Total", filterable: true, width: 150, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' }
                // { field: "descricaoDespesa", title: "Material", filterable: true, width: 200 },
                // { field: "vencimento", title: "Data", filterable: true, width: 150, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
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


@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection