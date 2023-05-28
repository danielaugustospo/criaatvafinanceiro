<?php
    $intervaloCelulas   = 'A1:K1';
    $rotaapi            = 'api/apidespesas';
    $titulo             = 'Despesas';
    $campodata          = 'vencimento';
    $relatorioKendoGrid = true;
    $idUser             = Crypt::encrypt(auth()->user()->id);
    $despesas           = (isset($despesas)) ? $despesas : '';
    $dtiniciolancamento = (isset($dtiniciolancamento)) ? $dtiniciolancamento : '';
    $formaPagamento     = (isset($formaPagamento)) ? $formaPagamento : '';
    $dtfimlancamento    = (isset($dtfimlancamento)) ? $dtfimlancamento : '';
    $numberFormatter    = new \NumberFormatter('pt-BR', \NumberFormatter::CURRENCY);
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

                    @can('despesa-create')
                        <a class="btn btn-dark d-flex justify-content-center" href="{{ route('despesas.create') }}">Cadastrar
                            Despesas</a>
                    @endcan
                    @can('despesa-list')
                        <a onclick="abreModalDespesas(param = 'pesquisadespesascompleto');"
                            class="btn btn-primary d-flex justify-content-center" href="#" style="cursor:pointer;"><i
                                class="fas fa-sync"></i>Nova Consulta
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @include('layouts/helpersview/mensagemRetorno')

    <hr>
    {{-- @if (!isset($permiteVisualizacaoDespesaCriada))
        @can('despesa-list')
            @php $permiteVisualizacaoDespesaCriada = 1; @endphp
        @endcan
    @endif

    @if (isset($permiteVisualizacaoDespesaCriada)) --}}

        <div id="filter-menu"></div>
        <br /><br />
        {{-- <div id="grid"></div> --}}
        <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
            @include('layouts/helpersview/infofiltrosdepesa')
        </div>
        <button id="update">Update</button>
        <script>
            $.LoadingOverlay("show", {
                image: "",
                progress: true
            });
            dataSource = new kendo.data.DataSource({
                @include('layouts/helpersview/transportdespesaskendogrid')
                pageSize: 30,
                batch: true,
                schema: {

                    model: {
                        fields: {
                            precoReal: {
                                type: "number"
                            },
                            vale: {
                                type: "number"
                            },
                            despesareal: {
                                type: "number"
                            },
                            razaosocialFornecedor: {
                                type: "string"
                            },
                            vencimento: {
                                type: "date"
                            },
                            datavale: {
                                type: "date"
                            },
                            created_at: {
                                    type: "date"
                                },
                        }
                    },
                },

                group: {
                    field: "razaosocialFornecedor",
                    aggregates: [{
                            field: "razaosocialFornecedor",
                            aggregate: "count"
                        },
                        {
                            field: "precoReal",
                            aggregate: "sum"
                        },
                        {
                            field: "vale",
                            aggregate: "sum"
                        },
                        {
                            field: "despesareal",
                            aggregate: "sum"
                        }

                    ]
                },
                aggregate: [{
                        field: "razaosocialFornecedor",
                        aggregate: "count"
                    },
                    {
                        field: "precoReal",
                        aggregate: "sum"
                    },
                    {
                        field: "vale",
                        aggregate: "sum"
                    },
                    {
                        field: "despesareal",
                        aggregate: "sum"
                    }
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

                    pageable: {
                        pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                        numeric: false,

                    },
                    dataSource: dataSource,
                    columns: [{
                            command: [{
                                name: "Ver",
                                iconClass: "k-icon k-i-eye",
                                click: function(e) {
                                    e.preventDefault();
                                    var tr = $(e.target).closest(
                                        "tr"); // get the current table row (tr)
                                    var data = this.dataItem(tr);
                                    window.location.href = "@php echo env('APP_URL'); @endphp" + "/despesas/" +
                                        data.id;
                                }
                            }],
                            width: 90,
                            exportable: false,
                        },
                        {
                            command: [{
                                name: "Editar",
                                iconClass: "k-icon k-i-pencil",
                                click: function(e) {
                                    e.preventDefault();
                                    var tr = $(e.target).closest(
                                        "tr"); // get the current table row (tr)
                                    var data = this.dataItem(tr);
                                    window.location.href = "@php echo env('APP_URL'); @endphp" + "/despesas/" +
                                        data.id + '/edit';
                                }
                            }],
                            width: 90,
                            exportable: false,
                        },{
                            field: "id",
                            title: "ID",
                            filterable: true,
                            autowidth: true,
                            width: 100
                        },
                        {
                            field: "apelidoConta",
                            title: "C/C",
                            filterable: true,
                            autowidth: true,
                            width: 100,
                            editable: isEditable
                        },
                        {
                            field: "despesaCodigoDespesa",
                            title: "Cód.<br>Despesa",
                            filterable: true,
                            autowidth: true,
                            width: 100
                        },
                        {
                            field: "idOS",
                            title: "OS",
                            filterable: true,
                            width: 90
                        },
                        {
                            field: "descricaoDespesa",
                            title: "Despesa",
                            filterable: true,
                            width: 150
                        },
                        {
                            field: "razaosocialFornecedor",
                            title: "Fornecedor",
                            filterable: true,
                            autowidth: true,
                            aggregates: ["count"],
                            footerTemplate: "QTD. Total: #=count#",
                            groupHeaderColumnTemplate: "Qtd.: #=count#",
                            width: 100
                        },

                        {
                            field: "vencimento",
                            title: "Venc.",
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
                            field: "precoReal",
                            title: "Valor",
                            filterable: true,
                            autowidth: true,
                            decimals: 2,
                            aggregates: ["sum"],
                            groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #",
                            footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #",
                            format: '{0:0.00}',
                            width: 150
                        },
                        {
                            field: "notaFiscal",
                            title: "NF",
                            filterable: true,
                            autowidth: true,
                            width: 100
                        },
                        {
                            field: "pago",
                            title: "Pago",
                            filterable: true,
                            width: 90
                        },
                        {
                            field: "nomeFuncionario",
                            title: "Funcionário",
                            filterable: true,
                            width: 150
                        },
                        {
                            field: "created_at",
                            title: "Criado Em",
                            format: "{0:dd/MM/yyyy}",
                            filterable: true,
                            width: 90
                        },
                        { command: "edit" }
                        // { field: "vale", title: "Vale", filterable: true, width: 200, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                        // { field: "despesareal", title: "Valor<br>Final", filterable: true, width: 200, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                        // { field: "datavale", title: "PG<br>Vale", filterable: true, width: 200, format: "{0:dd/MM/yyyy}" },


                        
                    ],
                    editable: {
                        mode: "inline"
                    },
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

                $("#update").click(function() {
                    var grid = $("#grid").data("kendoGrid");
                    var dataItems = grid.dataSource.data();
                
                    var updatedData = [];

                    for (var i = 0; i < dataItems.length; i++) {
                        var item = dataItems[i];
                        item.set('Category.CategoryID', '6');
                        item.set('Category.CategoryName', 'Meat/Poultry');
                        updatedData.push(item.toJSON());
                    
                        var row = grid.tbody.find("tr[data-uid='" + item.uid + "']");
                        var cell = row.find("td:eq(1)");
                        cell.addClass("k-dirty-cell").prepend("<span class='k-dirty' />");
                    }

                    // Enviar a requisição para o backend
                    $.ajax({
                        url: "api/updatedespesas",
                        method: "POST",
                        data: JSON.stringify(updatedData),
                        contentType: "application/json",
                        success: function(response) {
                            // Requisição bem-sucedida
                            alert("Dados atualizados com sucesso!");
                        },
                        error: function(xhr, status, error) {
                            // Ocorreu um erro na requisição
                            alert("Erro ao atualizar os dados: " + error);
                        }
                    });
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

                function isEditable(e){
                    var dataSource = $("#grid").data("kendoGrid").dataSource;
                    // If the id(ProductID) is null, then it is editable.
                    return e.ProductID == null;
                }

            });

            $(window).on('load', function() {

                        var $myDiv = $('#grid');

                        if ($myDiv.length === 1) {

                            var count = 0;
                            var interval = setInterval(function() {
                                    @if (isset($despesas))
                                        if (count >= 150) {
                                        @else
                                            if (count >= 900) {
                                            @endif
                                            clearInterval(interval);
                                            $('.k-link')[0].click();
                                            console.log('Ordenação Por Grupo Clicado Inicialmente');
                                            $.LoadingOverlay("hide");
                                            return;
                                        }
                                        count += 10;
                                        $.LoadingOverlay("progress", count);
                                    }, 500);

                            }

                        });

                    @include('layouts/filtradata')

                    function categoryDropDownEditor(container, options) {
                    $('<input required data-text-field="CategoryName" data-value-field="CategoryID" data-bind="value:' + options.field + '"/>')
                    .appendTo(container)
                    .kendoDropDownList({
                        autoBind: false,
                        dataSource: {
                            type: "odata",
                            transport: {
                                read: "http://demos.telerik.com/kendo-ui/service/Northwind.svc/Categories"
                            }
                        }
                    });
            }
        </script>

@endsection
