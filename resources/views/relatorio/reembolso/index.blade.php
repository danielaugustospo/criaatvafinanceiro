<?php 
$intervaloCelulas = "A1:F1"; 
$rotaapi = "api/apidespesas";
$titulo  = "Reembolso";
$campodata = 'vencimento';
$reembolso = 'S';
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

<a onclick="abreModalDespesas(param = 'reembolso');" class="d-flex justify-content-center" href="#"> <i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a>


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
        

    @can('rel-reembolso')
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
                            reembolsado: { type: "string" },
                            precoReal: { type: "number" }
                        }
                    },
                },

                group: { field: "reembolsado" },
                aggregate: [{ field: "precoReal", aggregate: "sum" }],
            },

            columns: [
                { field: "vencimento", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "descricaoDespesa", title: "Descrição", filterable: true, width: 90 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 90 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 70 },
                { field: "idOS", title: "N° da OS", filterable: true, width: 60 },
                { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Grupo: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "reembolsado", title: "Para Quem", filterable: true, width: 60 }            
                ],
        
        @include('layouts/helpersview/finaltabela')
        @include('layouts/filtradata')

        @endcan
</script>


@endsection
