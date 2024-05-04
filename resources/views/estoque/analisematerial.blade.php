<?php
$intervaloCelulas = 'A1:D1';
$rotaapi = 'api/apianaliseMaterial';
$titulo = 'Análise de Material';

$relatorioKendoGrid = true;

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
                <h2 class="text-center">Consulta de {{ $titulo }}</h2>
                <div class="form-row d-flex justify-content-center">
                    <a href="{{ route('entradas.create') }}?metodo=novo" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> ENTRADA</a>
                    <a href="{{ route('entradas.create') }}?metodo=devolucao" class="btn btn-primary"><i class="fa fa-retweet" aria-hidden="true"></i> DEVOLUÇÃO</a>
                    <a href="{{ route('saidas.create') }}" class="btn btn-danger"><i class="fa fa-minus-circle" aria-hidden="true"></i> SAÍDA</a>
                </div>
            </div>
        </div>
    </div>
    @include('estoque/estilo')
    @include('layouts/helpersview/mensagemRetorno')

    <hr>

    <div id="filter-menu"></div>
    <br /><br />
    <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
    </div>
    <script>
        $.LoadingOverlay("show", {
            image: "",
            progress: true
        });

        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    @if (isset($despesas))
                        url: "{{ $rotaapi }}?despesas={{ $despesas }}&valor={{ $valor }}&dtinicio={{ $dtinicio }}&dtfim={{ $dtfim }}&coddespesa={{ $coddespesa }}&fornecedor={{ $fornecedor }}&ordemservico={{ $ordemservico }}&conta={{ $conta }}&notafiscal={{ $notafiscal }}&cliente={{ $cliente }}&fixavariavel={{ $fixavariavel }}&pago={{ $pago }}",
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
                },
                excelExport: function(e) {

                    var sheet = e.workbook.sheets[0];

                    sheet.frozenRows = 1;
                    sheet.mergedCells = ["A1:E1"];
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
                    pageSize: 20,

                    schema: {

                        model: {
                            fields: {
                                created_at: {
                                    type: "date"
                                },
                                quantidade_entrada: {
                                    type: "number"
                                },
                                quantidade_saida: {
                                    type: "number"
                                },

                            }
                        },
                    },

                    group: {
                        field: "nomeBensPatrimoniais",
                        aggregates: [{
                                field: "quantidade_entrada",
                                aggregate: "count"
                            },
                            {
                                field: "quantidade_saida",
                                aggregate: "count"
                            },
                        ]
                    },
                    aggregate: [
                        {
                            field: "quantidade_entrada",
                            aggregate: "count"
                        },
                        {
                            field: "quantidade_saida",
                            aggregate: "count"
                        },
                    ],

                },

                columns: [{
                        field: "nomeBensPatrimoniais",
                        title: "Nome Material",
                        filterable: true,
                        autowidth: true
                    },
                    {
                        field: "created_at",
                        title: "Data",
                        filterable: true,
                        width: 150,
                        format: "{0:dd/MM/yyyy}",
                        filterable: {
                            cell: {
                                    template: betweenFilter
                                }
                            }
                        },
                    {
                        field: "quantidade_entrada",
                        title: "Entrada",
                        filterable: true,
                        autowidth: true,
                        aggregates: ["sum"], 
                        groupHeaderColumnTemplate: "Entradas: #: kendo.toString(sum, 'pt-BR') #", 
                    },
                    {
                        field: "quantidade_saida",
                        title: "Saída",
                        filterable: true,
                        autowidth: true,
                        aggregates: ["sum"], 
                        groupHeaderColumnTemplate: "Saídas: #: kendo.toString(sum, 'pt-BR') #", 
                        groupFooterTemplate: ({ quantidade_entrada, quantidade_saida}) => `Total: ${quantidade_entrada.sum - quantidade_saida.sum}`,
                        attributes: {
                            class: "group-footer"
                        }
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

                    // //Exibe itens agrupados fechados
                    // $(".k-grouping-row").each(function (e) {
                    //     grid.collapseGroup(this);
                    // });
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

                    if (count >= 50) {

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
        function calcularPorcentagem(data, grid) {
                var group = data.aggregates.quantidade_entrada.sum;
                var precoRealSum = group || 0; // Definir como zero se a soma for nula
                
                var grid  = $('#grid').data('kendoGrid');
                var total = grid.dataSource.aggregates().precoReal.sum; 

                if (precoRealSum !== 0) {
                    porcentagem = (precoRealSum  * 100) / total; // Calcula a porcentagem com base no valor de precoReal já somado
                }

            return "Total: R$" + kendo.toString(precoRealSum, "n2") + " (" + kendo.toString(porcentagem, "n2") + "%)";
}
    </script>
 
@endsection
