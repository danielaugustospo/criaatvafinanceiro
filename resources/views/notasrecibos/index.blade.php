@extends('layouts.app')

<?php
$intervaloCelulas = 'A1:K1';

$rotaapi = 'api/apiNotasRecibos?' . $param;
$titulo = 'Notas e Recibos';
$campodata = 'vencimento';
$relatorioKendoGrid = true;
$idUser = Crypt::encrypt(auth()->user()->id);
?>

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
                        <a class="btn btn-dark d-flex justify-content-center" href="{{ route('notasrecibos.create') }}">Cadastrar
                            Notas/Recibos</a>
                    @endcan
                    @can('despesa-list')
                        <a onclick="$('.modalnotas').modal('toggle');" class="btn btn-primary d-flex justify-content-center"
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
                        Valor: {
                            type: "number"
                        },
                        imposto: {
                            type: "number"
                        },
                        aliquota: {
                            type: "number"
                        },
                        Emissao: {
                            type: "date"
                        },
                        datapagamentoreceita: {
                            type: "date"
                        },
                    }
                },
            },

            group: {
                field: "nomeConta",
                aggregates: [{
                        field: "nomeConta",
                        aggregate: "count"
                    },
                    {
                        field: "aliquota",
                        aggregate: "count"
                    },
                    {
                        field: "Valor",
                        aggregate: "sum"
                    },
                    {
                        field: "imposto",
                        aggregate: "sum"
                    },
                ]
            },
            aggregate: [{
                    field: "nomeConta",
                    aggregate: "count"
                },
                {
                    field: "aliquota",
                    aggregate: "count"
                },
                {
                    field: "Valor",
                    aggregate: "sum"
                },
                {
                    field: "imposto",
                    aggregate: "sum"
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
                        field: "Emissao",
                        title: "Data Emissão",
                        filterable: false,
                        autowidth: true,
                        format: "{0:dd/MM/yyyy}"

                    },
                    {
                        field: "nfRecibo",
                        title: "Nota/Recibo",
                        filterable: true,
                        autowidth: true,
                    },
                    {
                        field: "OS",
                        title: "OS",
                        filterable: true,
                        autowidth: true,
                    },
                    {
                        field: "Valor",
                        title: "Valor NF/Recibo",
                        filterable: true,
                        autowidth: true,
                        decimals: 2,
                        aggregates: ["sum"],
                        groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #",
                        footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #",
                        format: '{0:0.00}'
                    },
                    {
                        field: "aliquota",
                        title: "Alíquota",
                        filterable: true,
                        autowidth: true,
                        decimals: 5,
                        format: '{0:0.00000}'
                    },
                    {
                        field: "imposto",
                        title: "Imposto",
                        filterable: true,
                        autowidth: true,
                        decimals: 2,
                        aggregates: ["sum"],
                        groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #",
                        footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #",
                        format: '{0:0.00}'
                    },
                    {
                        field: "datapagamentoreceita",
                        title: "Data Recebimento",
                        filterable: false,
                        autowidth: true,
                        format: "{0:dd/MM/yyyy}",

                    },
                    {
                        field: "nomeConta",
                        title: "Nome Conta",
                        filterable: true,
                        autowidth: true,
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
                                    if (count >= 75) {
                                    @else
                                        if (count >= 450) {
                                        @endif
                                        clearInterval(interval);
                                        $('.k-link')[0].click();
                                        console.log('Ordenação Por Grupo Clicado Inicialmente');
                                        $.LoadingOverlay("hide");
                                        return;
                                    }
                                    count += 10;
                                    $.LoadingOverlay("progress", count);
                                }, 250);

                        }

                    });

                @include('layouts/filtradata')
    </script>


    <div class="modal fade bd-example-modal-lg modalnotas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {{-- modal content --}}
                <form action="{{ route('notasrecibos.index') }}" id="formFiltraDespesa" method="get">
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
                                <div class="col-8 col-sm-6">
                                    <div class="modal-body">

                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-12" for="">Data Emissão</label>
                                            <input class="form-control col-sm-6" type="date" id="dtInicioEmissao"
                                                name="dtInicioEmissao" placeholder="Digite ou selecione...">
                                            <input class="form-control col-sm-6" type="date" id="dtFimEmissao"
                                                name="dtFimEmissao" placeholder="Digite ou selecione...">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-12" for="">Valor NF/Recibo</label>
                                            <input type="text" class='campo-moeda form-control' name="valorNFRecibo"
                                                id="valorNFRecibo" maxlength='100'>
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-12" for="">Nota/Recibo</label>
                                            <input class="form-control" id="notaRecibo" name="notaRecibo"
                                                placeholder="Digite ou selecione...">
                                        </div>
                                        <div class="row ml-2 mr-2">
                                            <label class="col-sm-12" for="">Alíquota</label>
                                            <input type="text" class='campo-aliquota form-control' name="aliquota"
                                                id="aliquota" maxlength='100'>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4 col-sm-6">
                                    {{-- Segunda Coluna --}}
                                    <div class="row mt-2 ml-2 mr-2">
                                        <div class="row ml-2 mr-2"><label class="col-sm-12" for="">Data Recebimento
                                            </label>
                                            <input class="form-control col-sm-6" type="date" id="dtInicioRecebimento"
                                                name="dtInicioRecebimento">
                                            <input class="form-control col-sm-6" type="date" id="dtFimRecebimento"
                                                name="dtFimRecebimento">
                                        </div>
                                        <label class="col-sm-12" for="">OS</label>
                                        <input class="form-control" id="ordemServico" name="ordemServico"
                                            placeholder="Ordem de Serviço">
                                    </div>
                                    <div class="row ml-2 mr-2"><label class="col-sm-12" for="">Valor Imposto
                                        </label>
                                        <input class="campo-moeda form-control" id="valorImposto" name="valorImposto">
                                    </div>
                                    <div class="row ml-2 mr-2"><label class="col-sm-12" for="">Conta </label>
                                        <select name="conta" id="conta" class="selecionaComInput col-sm-12"
                                            style="width:440px;" required>
                                            <option disabled selected>Selecione...</option>
                                            @foreach ($listaContas as $contas)
                                                <option value="{{ $contas->nomeConta }}">{{ $contas->apelidoConta }} -
                                                    {{ $contas->nomeConta }}</option>
                                            @endforeach
                                        </select>


                                        <input type="hidden" name="tpRel" id="tpRel" value="">
                                    </div>
                                    <div class="row ml-2 mr-2"><label class="col-sm-12" for="">Pago </label>
                                        <select name="pago" id="pago" class="selecionaComInput col-sm-12"
                                            style="width:440px;" required>
                                                <option value="S" selected>Sim</option>
                                                <option value="N">Não</option>
                                                <option value="T">Todos</option>
                                        </select>


                                        <input type="hidden" name="tpRel" id="tpRel" value="">
                                    </div>
                                </div>

                                {{-- footer --}}
                                <div class="modal-footer col-sm-12">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" id="buscarDespesa" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
