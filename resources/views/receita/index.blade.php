<?php
$intervaloCelulas = 'A1:F1';
$rotaapi = 'api/apireceita';
$titulo = 'Consulta de Receitas';
$campodata = 'datapagamentoreceita';
if (isset($receita)) {
    $receita = $receita;
} else {
    $receita = '';
}
$numberFormatter = new \NumberFormatter('pt-BR', \NumberFormatter::CURRENCY);

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
                <h2 class="text-center"> {{ $titulo }}</h2>
                <div class="form-row d-flex justify-content-center">

                    @can('receita-create')
                        <a class="btn btn-dark d-flex justify-content-center" href="{{ route('receita.create') }}">Cadastrar
                            Receita</a>
                    @endcan
                    <a class="btn btn-primary d-flex justify-content-center" data-toggle="modal" data-target=".modalreceita"
                        style="cursor: pointer; color: white;"><i class="fas fa-sync"></i>Nova Consulta</a>
                </div>
            </div>
        </div>
    </div>

    @include('layouts/helpersview/mensagemRetorno')


    <div id="filter-menu"></div>
    <br /><br />
    <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
        @include('layouts/helpersview/infofiltrosreceita')
    </div>

    <script>
        $.LoadingOverlay("show", {
            image: "",
            progress: true
        });

        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    @if (isset($receita))
                        url: "{{ $rotaapi }}?receita={{ $receita }}&valorreceita={{ $valorreceita }}&dtinicio={{ $dtinicio }}&dtfim={{ $dtfim }}&ordemservico={{ $ordemservico }}&contareceita={{ $contareceita }}&nfreceita={{ $nfreceita }}&cliente={{ $cliente }}&pagoreceita={{ $pagoreceita }}",
                    @else
                        url: "{{ $rotaapi }}",
                    @endif
                    dataType: "json"
                },
            },
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
                        for (var rowIndex = 1; rowIndex < sheet.rows.length; rowIndex++) {
                            if (rowIndex < (sheet.rows.length - 1)) {
                                var row = sheet.rows[rowIndex];
                                for (var cellIndex = 4; cellIndex < row.cells.length; cellIndex++) {
                                    row.cells[cellIndex].format =
                                        "[Blue]#,##0.00_);[Red]-#,##0.00_);0.0;"
                                    {{-- console.log(cellIndex); --}}
                                }
                            }
                        }
                    @endif

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
                            datapagamentoreceita: {
                                type: "date"
                            },
                            valorreceita: {
                                type: "number"
                            },
                        }
                    },
                },
                // group: [{field: "datapagamentoreceita", aggregate: "count"},
                // //{field: "razaosocialCliente", aggregate: "count"}
                // ],
                aggregate: [{
                    field: "valorreceita",
                    aggregate: "sum"
                }]
            },

            columns: [{
                    field: "id",
                    title: "Id",
                    filterable: true,
                    width: 50
                },
                {
                    field: "razaosocialCliente",
                    title: "Cliente",
                    filterable: true,
                    width: 80
                },
                {
                    field: "descricaoreceita",
                    title: "Descrição",
                    filterable: true,
                    width: 130
                },
                {
                    field: "nomeFormaPagamento",
                    title: "Forma de Pagamento",
                    filterable: true,
                    width: 80
                },
                {
                    field: "apelidoConta",
                    title: "Conta",
                    filterable: true,
                    width: 80
                },
                {
                    field: "valorreceita",
                    title: "Valor",
                    filterable: true,
                    width: 80,
                    decimals: 2,
                    aggregates: ["sum"],
                    groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #",
                    footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #",
                    format: '{0:0.00}'
                },
                // { field: "datapagamentoreceita", title: "Data PG", filterable: true, width: 60 },            
                {
                    field: "datapagamentoreceita",
                    title: "Data",
                    filterable: true,
                    width: 100,
                    format: "{0:dd/MM/yyyy}",
                    filterable: {
                        cell: {
                            template: betweenFilter
                        }
                    }
                },
                {
                    field: "pagoreceita",
                    title: "Pago",
                    filterable: true,
                    width: 80
                },
                {
                        command: [{
                            name: "Ver",
                            iconClass:"k-icon k-i-eye",
                            click: function(e) {
                                e.preventDefault();
                                var tr = $(e.target).closest(
                                    "tr"); // get the current table row (tr)
                                var data = this.dataItem(tr);
                                window.location.href = "@php echo env('APP_URL'); @endphp" + "/receita/" +
                                    data.id;
                            }
                        }],
                        width: 80,
                        exportable: false,
                    },
                    {
                        command: [{
                            name: "Editar",
                            iconClass:"k-icon k-i-pencil",
                            click: function(e) {
                                e.preventDefault();
                                var tr = $(e.target).closest(
                                    "tr"); // get the current table row (tr)
                                var data = this.dataItem(tr);
                                window.location.href = "@php echo env('APP_URL'); @endphp" + "/receita/" +
                                    data.id + '/edit';
                            }
                        }],
                        width: 80,
                        exportable: false,
                    },
                ],
                groupExpand: function(e) {
                    for (let i = 0; i < e.group.items.length; i++) {
                        var expanded = e.group.items[i].value
                        e.sender.expandGroup(".k-grouping-row:contains(" + expanded + ")");
                    }
                },
                columnMenu: true,
                dataBound: function(e) {
                    var grid = this;
                    var columns = grid.columns;
                    // populate initial columns list if the detailColsVisibility object is empty
                    if (Object.getOwnPropertyNames(detailColsVisibility).length == 0) {
                        for (var i = 0; i < columns.length; i++) {
                            detailColsVisibility[columns[i].field] = !columns[i].hidden;
                        }
                    } else {
                        // restore columns visibility state using the stored values
                        for (var i = 0; i < columns.length; i++) {
                            var column = columns[i];
                            if (detailColsVisibility[column.field]) {
                                grid.showColumn(column);
                            } else {
                                grid.hideColumn(column);
                            }
                        }
                    }
                },
                columnHide: function(e) {
                    // hide column in all other detail Grids
                    showHideAll(false, e.column.field, e.sender.element);
                    // store new visibility state of column
                    detailColsVisibility[e.column.field] = false;
                },
                columnShow: function(e) {
                    // show column in all other detail Grids
                    showHideAll(true, e.column.field, e.sender.element);
                    // store new visibility state of column
                    detailColsVisibility[e.column.field] = true;
                }
            });


            function showHideAll(show, field, element) {
                // find the master Grid element
                var parentGridElement = element.parents(".k-grid");
                // find all Grid widgets inside the mater Grid element
                var detailGrids = parentGridElement.find(".k-grid");
                //traverse detail Grids and show/hide the column with the given field name
                for (var i = 0; i < detailGrids.length; i++) {
                    var grid = $(detailGrids[i]).data("kendoGrid");
                    if (show) {
                        grid.showColumn(field);
                    } else {
                        grid.hideColumn(field);
                    }
                }
            }

        });

        $(window).on('load', function() {

                    var $myDiv = $('#grid');

                    if ($myDiv.length === 1) {

                        var count = 0;
                        var interval = setInterval(function() {
                                @if (isset($receita))
                                    if (count >= 100) {
                                    @else
                                        if (count >= 800) {
                                        @endif
                                        clearInterval(interval);
                                        $('.k-link')[0].click();
                                        console.log('Ordenação Por Grupo Clicado Inicialmente');
                                        $.LoadingOverlay("hide");
                                        return;
                                    }
                                    count += 10;
                                    $.LoadingOverlay("progress", count);
                                }, 300);

                        }

                    });
        @include('layouts/filtradata')
    </script>
@endsection
