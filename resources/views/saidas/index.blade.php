<?php
$intervaloCelulas = 'A1:H1';
$rotaapi = 'api/apisaida';
$titulo = 'Estoque - HISTÓRICO Saídas (Baixa de Material)';
$campodata  = 'dataretirada';
$campodata2 = 'datapararetorno';

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
                <h2 class="text-center">{{ $titulo }}</h2>
                <div class="form-row d-flex justify-content-center">

                    @can('saidas-create')
                        <a class="btn btn-dark d-flex justify-content-center" href="{{ route('saidas.create') }}">Nova Baixa
                        </a>
                    @endcan
  
                    <a href="#" class="btn btn-primary d-flex justify-content-center"  onclick="$('.modalsaidasestoque').modal('show');"
                        style="color: white;"><i class="fas fa-sync"></i>Nova Consulta</a>
                    
                </div>
            </div>
        </div>
    </div>
    @include('layouts/helpersview/mensagemRetorno')

    <hr>

    <div id="filter-menu"></div>
    <br /><br />
    <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
        @include('layouts/helpersview/infofiltrosestoquesaida')
    </div>
    <script>
        $.LoadingOverlay("show", {
            image: "",
            progress: true
        });

        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: "{{ $rotaapi }}?codbarras={{ $codbarras }}&descricaosaida={{ $descricaosaida }}&nomeBensPatrimoniais={{ $nomeBensPatrimoniais }}&portador={{ $portador }}&ordemdeservico={{ $ordemdeservico }}&dataretiradainicial={{ $dataretiradainicial }}&dataretiradafinal={{ $dataretiradafinal }}&datapararetornoinicial={{ $datapararetornoinicial }}&datapararetornofinal={{ $datapararetornofinal }}",                   
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
                    pageSize: 20,

                    schema: {

                        model: {
                            fields: {
                                id: {
                                    type: "string"
                                },
                                nomeBensPatrimoniais: {
                                    type: "string"
                                },
                                quantidade_saida: {
                                    type: "number"
                                },
                                nomematerial: {
                                    type: "string"
                                },
                                descricao: {
                                    type: "string"
                                },
                                dataretirada: {
                                    type: "date"
                                },
                                datapararetorno: {
                                    type: "date"
                                }
                            }
                        },
                    },

                    group: {
                        field: "nomeBensPatrimoniais", 
                        aggregates: [
                                {
                                    field: "nomeBensPatrimoniais",
                                    aggregate: "count"
                                },
                            ]
                    },
                    aggregate: [                          {
                            field: "nomeBensPatrimoniais",
                            aggregate: "count"
                        },
                    ],

                },

                columns: [{
                        field: "id",
                        title: "ID",
                        filterable: true,
                        width: "5%"
                    },
                    {
                        field: "nomeBensPatrimoniais",
                        title: "Nome Material",
                        filterable: true,
                        width: "10%"
                    },
                    {
                        field: "quantidade_saida",
                        title: "Quantidade",
                        aggregates: ["sum"],
                        groupHeaderColumnTemplate: "QUANTIDADE: #=sum#",
                        filterable: true,
                        width: "10%"
                    },
                    {
                        field: "portador",
                        title: "Quem Pegou",
                        filterable: true,
                        width: "10%"
                    },
                    {
                        field: "descricaosaida",
                        title: "Descrição",
                        filterable: true,
                        width: "10%"
                    },
                    {
                        field: "ordemdeservico",
                        title: "OS",
                        filterable: true,
                        width: "10%"
                    },
                    {
                        field: "dataretirada",
                        title: "Data Retirada",
                        filterable: true,
                        width: "10%",
                        format: "{0:dd/MM/yyyy}",
                        filterable: {
                            cell: {
                                template: betweenFilter
                            }
                        }
                    },
                    {
                        field: "qtddiasemprestado",
                        title: "Dias Emprestados",
                        filterable: true,
                        width: "5%",
                    },
                    {
                        field: "qtddiaspararetorno",
                        title: "Dias Restantes",
                        filterable: true,
                        width: "10%",
                    },
                    {
                        field: "datapararetorno",
                        title: "Data Retorno",
                        filterable: true,
                        width: "10%",
                        format: "{0:dd/MM/yyyy}",
                        filterable: {
                            cell: {
                                template: betweenFilter
                            }
                        }
                    },
                    
                    {
                        command: [{
                            name: "Visualizar",
                            click: function(e) {
                                e.preventDefault();
                                var tr = $(e.target).closest(
                                    "tr"); // get the current table row (tr)
                                var data = this.dataItem(tr);
                                window.location.href = "@php echo env('APP_URL'); @endphp" + "/saidas/" +
                                    data.id;
                            }
                        }],
                        width: "10%",
                        exportable: false,
                    },
                    // {
                    //     command: [{
                    //         name: "Editar",
                    //         click: function(e) {
                    //             e.preventDefault();
                    //             var tr = $(e.target).closest(
                    //                 "tr"); // get the current table row (tr)
                    //             var data = this.dataItem(tr);
                    //             window.location.href = "@php echo env('APP_URL'); @endphp" + "/saidas/" +
                    //                 data.id + '/edit';
                    //         }
                    //     }],
                    //     width: 130,
                    //     exportable: false,
                    // },
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
    </script>
    @include('layouts/modal/estoque/modalsaidaestoque')
@endsection
