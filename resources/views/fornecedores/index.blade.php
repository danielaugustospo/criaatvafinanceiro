@php $relatorioKendoGrid = true; @endphp
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Dados de Fornecedores</h2>
            </div>
            <div class="d-flex justify-content-between pull-right">
                @can('fornecedor-create')
                    <a class="btn btn-success" href="{{ route('fornecedores.create') }}">Cadastrar Fornecedor</a>
                @endcan
                {{-- @include('layouts/exibeFiltro') --}}
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <hr>


    <div id="filter-menu"></div>
    <br /><br />
    <div id="grid">
        {{-- @include('layouts/helpersview/infofiltrosdepesa') --}}
    </div>

    <script>
        $.LoadingOverlay("show", {
            image: "",
            progress: true
        });

        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: "/listaFornecedores",
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

                    sheet.frozenRows = 1;
                    sheet.mergedCells = ["A1:I1"];
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

                    // group: [{
                    //     field: "razaosocialFornecedor"
                    // }],
                    aggregate: [{
                        field: "precoReal",
                        aggregate: "sum"
                    }]
                },

                columns: [{
                        field: "id",
                        title: "Id",
                        filterable: true,
                        width: 60
                    },
                    {
                        field: "razaosocialFornecedor",
                        title: "Rz Social",
                        filterable: true,
                        width: 90
                    },
                    {
                        field: "nomeFornecedor",
                        title: "Nome Fantasia",
                        filterable: true,
                        width: 90
                    },
                    {
                        field: "cnpjFornecedor",
                        title: "CNPJ",
                        filterable: true,
                        width: 90
                    },
                    {
                        field: "cpfFornecedor",
                        title: "CPF",
                        filterable: true,
                        width: 90
                    },
                    {
                        field: "telefone1Fornecedor",
                        title: "Telefone 1",
                        filterable: true,
                        width: 90
                    },
                    {
                        field: "telefone2Fornecedor",
                        title: "Telefone 2",
                        filterable: true,
                        width: 90
                    },
                    {
                        field: "chavePixFornecedor1",
                        title: "1° PIX",
                        filterable: true,
                        width: 90
                    },
                    {
                        field: "chavePixFornecedor2",
                        title: "2° PIX",
                        filterable: true,
                        width: 90
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
                    if (count >= 100) {
                        clearInterval(interval);

                        var verificador = document.getElementsByClassName('k-link')[0];

                        if (verificador != null) {
                            // $('.k-link')[0].click();
                            // $('.k-link')[0].click();
                            // $('.k-link')[0].click();
                            // console.log('Ordenação Por Grupo Clicado Inicialmente');
                            $.LoadingOverlay("hide");
                        } else {
                            var temporizador = setInterval(feedbackCarregamentoRelatorio, 5000);
                        }

                        function feedbackCarregamentoRelatorio() {
                            console.log('Funcionalidade ainda não carregada. Aguarde alguns segundos');
                            var verificador = document.getElementsByClassName('k-link')[0];
                            if (verificador != null) {
                                // $('.k-link')[0].click();
                                clearInterval(temporizador);
                                console.log('Ordenação Por Grupo Clicado Inicialmente');
                                $.LoadingOverlay("hide");
                            }
                        }
                        return;
                    }
                    count += 10;
                    $.LoadingOverlay("progress", count);
                }, 300);

            }


        });
        
    </script>
@endsection
