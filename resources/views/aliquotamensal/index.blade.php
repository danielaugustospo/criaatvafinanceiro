@extends('layouts.app')

@php
    $intervaloCelulas = 'A1:K1';
    
    $rotaapi = 'api/apiAliquotaMensal?' . $param;
    $titulo = 'Alíquotas Mensais';
    $campodata = 'vencimento';
    $relatorioKendoGrid = true;
    $idUser = Crypt::encrypt(auth()->user()->id);
@endphp

<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
</head>

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Consulta de {{ $titulo }}</h2>
                <div class="form-row d-flex justify-content-center">

                    @can('despesa-create')
                        <a class="btn btn-dark d-flex justify-content-center" href="{{ route('aliquotamensal.create') }}">Cadastrar
                            {{ $titulo }}</a>
                    @endcan
                    @can('despesa-list')
                        <a onclick="$('.modalaliquotas').modal('toggle');" class="btn btn-primary d-flex justify-content-center"
                            href="#" style="cursor:pointer;"><i class="fas fa-sync"></i>Nova Consulta
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
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
        var rota = "{{ $rotaapi }}";
        var rota = rota.replace(/&amp;/g, '&');
        var urlSanitizada = rota.replace(/&amp;/g, '&');

        dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: urlSanitizada,
                    dataType: "json"
                },

                parameterMap: function(options, operation) {
                    if (operation !== "read" && options.models) {
                        return {
                            models: kendo.stringify(options.models)
                        };
                    }
                }
            },
            pageSize: 30,
            batch: true,
            schema: {

                model: {
                    fields: {
                        dasSemFatorR: {
                            type: "number"
                        },
                        issSemFatorR: {
                            type: "number"
                        },
                        reciboSemFatorR: {
                            type: "number"
                        },
                        dasComFatorR: {
                            type: "number"
                        },
                        issComFatorR: {
                            type: "number"
                        },
                        reciboComFatorR: {
                            type: "number"
                        },
                    }
                },
            },

            group: {
                field: "nomeConta",
                aggregates: [{
                        field: "mes",
                        aggregate: "count"
                    },
                    {
                        field: "conta",
                        aggregate: "count"
                    },
                ]
            },
            aggregate: [{
                    field: "mes",
                    aggregate: "count"
                },
                {
                    field: "conta",
                    aggregate: "count"
                },
            ],

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

                    sheet.frozenRows = 1;
                    sheet.mergedCells = ["A1:F1"];
                    sheet.name = "Relatorio_de_" + document.title + " -  CRIAATVA";

                    var myHeaders = [{
                        value: "Relatório de " + document.title,
                        textAlign: "center",
                        background: "black",
                        color: "#ffffff"
                    }];

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
                        top: "2.5cm",
                        left: "0.1cm",
                        right: "0.1cm",
                        bottom: "0.5cm"
                    },

                    @if (isset($orientacao))
                        landscape: true,
                    @else
                        landscape: true,
                    @endif

                    repeatHeaders: false,
                    template: $("#page-template").html(),
                    scale: 0.48
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
                height: 550,
                mobile: true,

                pageable: {
                    pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                    numeric: false,

                },
                dataSource: dataSource,
                columns: [{
                        field: "apelidoConta",
                        title: "Conta",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                        field: "mes",
                        title: "Mês",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                        field: "dasSemFatorR",
                        title: "DAS SEM FATOR",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                        field: "issSemFatorR",
                        title: "ISS SEM FATOR",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                        field: "reciboSemFatorR",
                        title: "RECIBO SEM FATOR",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                        field: "dasComFatorR",
                        title: "DAS COM FATOR",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                        field: "issComFatorR",
                        title: "ISS COM FATOR",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'

                    },
                    {
                        field: "reciboComFatorR",
                        title: "RECIBO COM FATOR",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                            command: [{
                                name: "Ver",
                                iconClass: "k-icon k-i-eye",
                                click: function(e) {
                                    e.preventDefault();
                                    var tr = $(e.target).closest(
                                        "tr"); // get the current table row (tr)
                                    var data = this.dataItem(tr);
                                    window.location.href = "@php echo env('APP_URL'); @endphp" + "/aliquotamensal/" +
                                        data.id;
                                }
                            }],
                            width: 90,
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
                                @if (isset($despesas))
                                    if (count >= 20) {
                                    @else
                                        if (count >= 100) {
                                        @endif
                                        clearInterval(interval);
                                        $('.k-link')[0].click();
                                        console.log('Ordenação Por Grupo Clicado Inicialmente');
                                        $.LoadingOverlay("hide");
                                        return;
                                    }
                                    count += 10;
                                    $.LoadingOverlay("progress", count);
                                }, 50);
                        }
                    });

                @include('layouts/filtradata')
    </script>


    <div class="modal fade bd-example-modal-lg modalaliquotas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {{-- modal content --}}
                <form action="{{ route('aliquotamensal.index') }}" id="formFiltraDespesa" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="modal-header">
                                <label for="">Selecione a Alíquota</label>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row">
                                    <div class="modal-body">
                                        <div class="row ml-2 mr-2">

                                            <label class="col-sm-4" for="">Conta</label>
                                            <select class="col-sm-8 form-control" name="idconta" id="idconta">
                                                <option selected value="">SELECIONE...</option>
                                                @foreach ($listaContas as $key => $contaProvider)
                                                    <option value="{{ $contaProvider->id }}">{{ $contaProvider->apelidoConta }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row ml-2 mr-2">

                                            <label class="col-sm-4" for="">Mês/Ano</label>
                                            <input type="month" class="form-control col-sm-8 campo-aliquota"
                                                name="mes" id="mes" value="">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-4" for="">DAS Sem Fator</label>
                                            <input type="text" class="form-control col-sm-8 campo-aliquota"
                                                name="dasSemFatorR" id="dasSemFatorR" value="">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-4" for="">ISS Sem Fator</label>
                                            <input type="text" class="form-control col-sm-8 campo-aliquota"
                                                name="issSemFatorR" id="issSemFatorR" value="">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-4" for="">Recibo Sem Fator</label>
                                            <input type="text" class="form-control col-sm-8 campo-aliquota"
                                                name="reciboSemFatorR" id="reciboSemFatorR" value="">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-4" for="">DAS Com Fator</label>
                                            <input type="text" class="form-control col-sm-8 campo-aliquota"
                                                name="dasComFatorR" id="dasComFatorR" value="">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-4" for="">ISS Com Fator</label>
                                            <input type="text" class="form-control col-sm-8 campo-aliquota"
                                                name="issComFatorR" id="issComFatorR" value="">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-4" for="">Recibo Com Fator</label>
                                            <input type="text" class="form-control col-sm-8 campo-aliquota"
                                                name="reciboComFatorR" id="reciboComFatorR" value="">
                                        </div>
                                        {{-- footer --}}
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fechar</button>
                                            <button type="submit" id="buscarDespesa"
                                                class="btn btn-primary">Buscar</button>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
