<?php
$intervaloCelulas = 'A1:F1';
$rotaapi = 'api/apidespesas';
$titulo = 'Controle de consumo de materiais';
$campodata = 'vencimento';
$relatorioKendoGrid = true;
$rel = 'controleconsumomaterial';

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




    @include('layouts/helpersview/mensagemRetorno')



    <div id="filter-menu"></div>
    <br /><br />
    <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-center">Relatório de {{ $titulo }}</h2>
                </div>
            </div>
        </div>
        <a onclick="abreModalDespesas(param = 'controleconsumomaterial');" class="d-flex justify-content-center" style="color: blue;" href="#"> <i
            class="fas fa-sync"></i>Acessar Outro Período/Conta</a>

        <div id="chart"></div>
        {{-- @include('layouts/helpersview/infofiltrosdepesa') --}}
    </div>

    <script>
    var pdfButtonClicked = false;
    
    function createChart(data) {
            
        var chart = $("#chart").data("kendoChart");
        // Calculate total value
        var totalValue = data.reduce(function(sum, item) {
            return sum + parseFloat(item.precoReal);
        }, 0);

        // Group data by tipo (groupDespesa) and calculate type totals
        var typeTotals = {};
        data.forEach(function(item) {
            if (!typeTotals[item.tipo]) {
                typeTotals[item.tipo] = 0;
            }
            typeTotals[item.tipo] += parseFloat(item.precoReal);
        });

        // Calculate percentages and update data
        var newData = [];
        for (var type in typeTotals) {
            var typePercentage = (typeTotals[type] / totalValue) * 100;

            newData.push({
                value: typePercentage.toFixed(2),
                category: type,
                color: getRandomColor()
            });
        }

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
                    template: "#= data.category #: \n (#= data.value#%)"
                }
            },
            series: [{
                type: "pie",
                startAngle: 150,
                data: newData
            }],
            tooltip: {
                visible: true,
                template: "#= data.category #: \n (#= data.value#%)",
                format: "{0}%"
            }
        });
    }

        $.LoadingOverlay("show", {
            image: "",
            progress: true
        });

        @can('rel-controleconsumomateriais')
        var dataSource = new kendo.data.DataSource({
            @include('layouts/helpersview/transportdespesaskendogrid')

        });


        //Se não houver essa declaração, ele retorna erro dizendo que não encontrou o metodo e não exporta o pdf
        var detailColsVisibility = {};

            dataSource.fetch().then(function() {
                var data = dataSource.data();
                // $(document).ready(createChart(data));
                $(document).bind("kendo:skinChange", createChart(data));

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
                                    var
                                        row = sheet.rows[rowIndex];
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
                        // paperSize: "A4",
                        margin: {
                            top: "3.5cm",
                            left: "3.5cm",
                            right: "1cm",
                            bottom: "0.5cm"
                        },

                        @if (isset($orientacao))
                            landscape: true,
                        @else
                            landscape: true,
                        @endif

                        repeatHeaders: false,
                        // // template: renderizaHtmlPDF(),
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
                                    valorUnitario: {
                                        type: "number"
                                    },
                                    precoReal: {
                                        type: "number"
                                    },
                                }
                            },
                        },

                        group: [{
                            field: "razaosocialFornecedor"
                        }],
                        aggregate: [{
                                field: "material",
                                aggregate: "count"
                            },
                            // { field: "apelidoConta", aggregate: "count" },
                            {
                                field: "valorUnitario",
                                aggregate: "sum"
                            },
                            {
                                field: "precoReal",
                                aggregate: "sum"
                            },
                            // { field: "porcentagemOS", aggregate: "sum" }
                        ]

                    },

                    columns: [{
                            field: "material",
                            title: "Material",
                            filterable: true,
                            width: 200
                        },
                        {
                            field: "tipo",
                            title: "Tipo",
                            filterable: true,
                            width: 150
                        },
                        {
                            field: "unidade",
                            title: "Unidade",
                            filterable: true,
                            width: 150
                        },
                        {
                            field: "qtde",
                            title: "Qtde",
                            filterable: true,
                            width: 100
                        },
                        {
                            field: "valorUnitario",
                            title: "Preço Unitario",
                            filterable: true,
                            width: 150,
                            decimals: 2,
                            aggregates: ["sum"],
                            groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #",
                            footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #",
                            format: '{0:0.00}'
                        },
                        {
                            field: "precoReal",
                            title: "Valor Total",
                            filterable: true,
                            width: 150,
                            decimals: 2,
                            aggregates: ["sum"],
                            groupHeaderColumnTemplate: "Total : #: kendo.toString(sum, 'c', 'pt-BR') #",
                            footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #",
                            format: '{0:0.00}'
                        }
                        // { field: "descricaoDespesa", title: "Material", filterable: true, width: 200 },
                        // { field: "vencimento", title: "Data", filterable: true, width: 150, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
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

                        var filteredData = this.dataSource.view();

                        // Atualiza o gráfico com os dados filtrados
                        // updateChart(filteredData);
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

                            var verificador = document.getElementsByClassName('k-link')[0];

                            if (verificador != null) {
                                $('.k-link')[0].click();
                                console.log('Ordenação Por Grupo Clicado Inicialmente');
                                $.LoadingOverlay("hide");
                            } else {
                                var temporizador = setInterval(feedbackCarregamentoRelatorio, 5000);
                            }

                            function feedbackCarregamentoRelatorio() {
                                console.log('Funcionalidade ainda não carregada. Aguarde alguns segundos');
                                var verificador = document.getElementsByClassName('k-link')[0];
                                if (verificador != null) {
                                    $('.k-link')[0].click();
                                    clearInterval(temporizador);
                                    console.log('Ordenação Por Grupo Clicado Inicialmente');
                                    $.LoadingOverlay("hide");
                                }
                            }
                            return;
                        }
                        count += 10;
                        $.LoadingOverlay("progress", count);
                    }, 100);

                }

            });


            <?php if (!isset($campodata)) $campodata = 'created_at'; ?>
            
            function renderizaHtmlPDF() {
                if (!pdfButtonClicked) {
                    return; // Não faz nada se o botão não foi clicado
                }

                // Selecione a div com o ID "chart"
                var chartDiv = document.getElementById("chart");

                // Crie um elemento de imagem
                var imageElement = document.createElement("img");

                // Defina os atributos da imagem
                imageElement.src = "https://devcriaatva.danieltecnologia.com/img/inventario.png";               

                // Adicione a imagem à div
                chartDiv.appendChild(imageElement);
                document.getElementById("#page-template").innerHTML = "I have changed!";
                $html = $("#page-template").html();
                
                return $html;
            }


            $("#grid").on("click", "[name='custompdfexport']", function() {
                // Defina pdfButtonClicked como true
                pdfButtonClicked = true;
alert('teste');
                // Resto do seu código aqui

                // Chamar a função renderizaHtmlPDF aqui
                var pdfTemplate = renderizaHtmlPDF();
                
                // Resto do seu código aqui
            });


            function betweenFilter(args) {
                var filterCell = args.element.parents(".k-filtercell");

                filterCell.empty();
                filterCell.html('<label style="width: 0px;">De: <input class="start-date"/></label>' +
                    '<label class="pt-3"> <br><br> Até: ' + '<input  class="end-date"/></label>');

                $(".start-date", filterCell).kendoDatePicker({
                    change: function(e) {
                        var startDate = e.sender.value(),
                            endDate = $("input.end-date", filterCell).data("kendoDatePicker").value(),
                            dataSource = $("#grid").data("kendoGrid").dataSource;

                        if (startDate & endDate) {
                            var filter = {
                                logic: "and",
                                filters: []
                            };
                            filter.filters.push({
                                field: "{{ $campodata }}",
                                operator: "gte",
                                value: startDate
                            });
                            filter.filters.push({
                                field: "{{ $campodata }}",
                                operator: "lte",
                                value: endDate
                            });
                            dataSource.filter(filter);
                            var pegaApelidoConta = $("#grid").data("kendoGrid").dataSource.data()[0].conta;
                            var dataPrimeiroPeriodo = dataSource._filter.filters[0].value;
                            var dataSegundoPeriodo = dataSource._filter.filters[1].value;

                            dataUmFormatoAmericano = dataPrimeiroPeriodo.toISOString().substring(0, 10);
                            dataUm = dataUmFormatoAmericano.split("-").reverse().join("/");

                            dataDoisFormatoAmericano = dataSegundoPeriodo.toISOString().substring(0, 10);
                            dataDois = dataDoisFormatoAmericano.split("-").reverse().join("/");
                        }
                    }
                });
                $(".end-date", filterCell).kendoDatePicker({
                    change: function(e) {
                        var startDate = $("input.start-date", filterCell).data("kendoDatePicker").value(),
                            endDate = e.sender.value(),
                            dataSource = $("#grid").data("kendoGrid").dataSource;

                        if (startDate & endDate) {
                            var filter = {
                                logic: "and",
                                filters: []
                            };
                            filter.filters.push({
                                field: "{{ $campodata }}",
                                operator: "gte",
                                value: startDate
                            });
                            filter.filters.push({
                                field: "{{ $campodata }}",
                                operator: "lte",
                                value: endDate
                            });
                            dataSource.filter(filter);

                            var pegaApelidoConta = $("#grid").data("kendoGrid").dataSource.data()[0].conta;
                            var dataPrimeiroPeriodo = dataSource._filter.filters[0].value;
                            var dataSegundoPeriodo = dataSource._filter.filters[1].value;

                            dataUmFormatoAmericano = dataPrimeiroPeriodo.toISOString().substring(0, 10);
                            dataUm = dataUmFormatoAmericano.split("-").reverse().join("/");

                            dataDoisFormatoAmericano = dataSegundoPeriodo.toISOString().substring(0, 10);
                            dataDois = dataDoisFormatoAmericano.split("-").reverse().join("/");

                        }
                    }
                });

            }

            <?php if(isset($campodata2)){   ?>

            function segundoFiltroPeriodo(args) {
                var filterCell = args.element.parents(".k-filtercell");

                filterCell.empty();
                filterCell.html('<label style="width: 0px;">De: <input class="start-date"/></label>' +
                    '<label class="pt-3"> <br><br> Até: ' + '<input  class="end-date"/></label>');

                $(".start-date", filterCell).kendoDatePicker({
                    change: function(e) {
                        var startDate = e.sender.value(),
                            endDate = $("input.end-date", filterCell).data("kendoDatePicker").value(),
                            dataSource = $("#grid").data("kendoGrid").dataSource;

                        if (startDate & endDate) {
                            var filter = {
                                logic: "and",
                                filters: []
                            };
                            filter.filters.push({
                                field: "{{ $campodata2 }}",
                                operator: "gte",
                                value: startDate
                            });
                            filter.filters.push({
                                field: "{{ $campodata2 }}",
                                operator: "lte",
                                value: endDate
                            });
                            dataSource.filter(filter);
                        }
                    }
                });
                $(".end-date", filterCell).kendoDatePicker({
                    change: function(e) {
                        var startDate = $("input.start-date", filterCell).data("kendoDatePicker").value(),
                            endDate = e.sender.value(),
                            dataSource = $("#grid").data("kendoGrid").dataSource;

                        if (startDate & endDate) {
                            var filter = {
                                logic: "and",
                                filters: []
                            };
                            filter.filters.push({
                                field: "{{ $campodata2 }}",
                                operator: "gte",
                                value: startDate
                            });
                            filter.filters.push({
                                field: "{{ $campodata2 }}",
                                operator: "lte",
                                value: endDate
                            });
                            dataSource.filter(filter);
                        }
                    }
                });

            }
            <?php } ?>


            function template(data) {
                var grid = $('#grid').data('kendoGrid');

                var valorPorcentagem = 100 * (+data.precoReal) / grid.dataSource.aggregates().precoReal.sum;
                valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2) + "%";
                return valorPorcentagem;
            }

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
    </script>
@else
    @include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection