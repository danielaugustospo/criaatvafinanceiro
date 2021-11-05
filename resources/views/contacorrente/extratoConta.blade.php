<head>
    <meta charset="utf-8">
    <title>Conta Corrente</title>
</head>
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Consulta de Extrato</h2>
            <div class="d-flex justify-content-between pull-right">
                <div class="col-sm-6">
                @can('receita-create')
                <a class="btn btn-success" href="{{ route('receita.create') }}">Cadastrar Receita</a>
                <a class="btn btn-dark" href="{{ route('despesas.create') }}">Cadastrar Despesa</a>
                @endcan
            </div>
        </div>

            {{-- @include('layouts/exibeFiltro') --}}
        </div>
    </div>
</div>

<style>
    .green {
        background-color: rgb(207, 241, 248);
        color: rgb(12, 95, 109) !important;
    }
    .red {
        background-color: rgb(248, 215, 215) !important;
        color: rgb(151, 13, 13);
    }
    .trTabela {
        background-color: slategray;
    }

</style>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<hr>
{{-- @include('contacorrente/filtroextrato') --}}


<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>

<script>

    var dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                url: "{{ route('apiextratocontarelatorio') }}",
                dataType: "json"
            },
        },
    });

    //Se não houver essa declaração, ele retorna erro dizendo que não encontrou o metodo e não exporta o pdf
    var detailColsVisibility = {};

    dataSource.fetch().then(function () {
        var data = dataSource.data();

        // initialize a Kendo Grid with the returned data from the server.
        $("#grid").kendoGrid({
            toolbar: ["excel", "pdf"],
            excel: {
                fileName: "Relatório de " + document.title + ".xlsx",
                // proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
                // filterable: true
            },
            excelExport: function (e) {

                var sheet = e.workbook.sheets[0];
                sheet.frozenRows = 1;
                sheet.mergedCells = ["A1:H1"];
                sheet.name = "Relatorio de " + document.title + " -  CRIAATVA";

                var myHeaders = [{
                    value: "Relatório de " + document.title,
                    textAlign: "center",
                    background: "black",
                    color: "#ffffff"
                }];

                sheet.rows.splice(0, 0, { cells: myHeaders, type: "header", height: 70 });
            },

            pdf: {
                fileName: "Relatório de " + document.title + ".pdf",

                allPages: true,
                avoidLinks: true,
                paperSize: "A4",
                margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "1cm" },
                landscape: true,
                repeatHeaders: true,
                template: $("#page-template").html(),
                scale: 0.8
            },
            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            dtoperacao: { type: "date" },
                            valorreceita: { type: "number" },
                            apelidoConta: { type: "string" },
                        }
                    },
                },

                group: {
                    field: "apelidoConta", aggregates: [
                        { field: "apelidoConta", aggregate: "count" },
                        { field: "valorreceita", aggregate: "sum" },
                        // { field: "UnitsOnOrder", aggregate: "average" },
                    ]
                },
                aggregate: [{ field: "apelidoConta", aggregate: "count" },
                { field: "valorreceita", aggregate: "sum" }],
                // { field: "UnitsOnOrder", aggregate: "average" },
                // { field: "UnitsInStock", aggregate: "min" },
                // { field: "UnitsInStock", aggregate: "max" }]
            },
            height: 550,
            filterable: true,
            sortable: true,
            resizable: true,
            // responsible: true,
            pageable: {
                pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                numeric: false
            },
            columns: [
                // { field: "id", title: "ID", filterable: true, width: 50 },
                { field: "dtoperacao", title: "Data", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                { field: "historico", title: "Histórico", filterable: true, width: 100 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 100 },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                // { field: "vencimento", title: "Vencimento", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                { field: "valorreceita", title: "Valor", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Subtotal: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "saldo", title: "Saldo", filterable: true, width: 100, decimals: 2, aggregates: ["sum"],  format: '{0:0.00}' },
                // { field: "notaFiscal", title: "Nota Fiscal", filterable: true, width: 100 },
            ],
            columnMenu: true,
            dataBound: function (e) {
                var grid = this;
                var columns = grid.columns;
                // populate initial columns list if the detailColsVisibility object is empty
                if (Object.getOwnPropertyNames(detailColsVisibility).length == 0) {
                    for (var i = 0; i < columns.length; i++) {
                        detailColsVisibility[columns[i].field] = !columns[i].hidden;
                    }
                }
                else {
                    // restore columns visibility state using the stored values
                    for (var i = 0; i < columns.length; i++) {
                        var column = columns[i];
                        if (detailColsVisibility[column.field]) {
                            grid.showColumn(column);
                        }
                        else {
                            grid.hideColumn(column);
                        }
                    }
                }
            },
            columnHide: function (e) {
                // hide column in all other detail Grids
                showHideAll(false, e.column.field, e.sender.element);
                // store new visibility state of column
                detailColsVisibility[e.column.field] = false;

            },
            columnShow: function (e) {
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
                }
                else {
                    grid.hideColumn(field);
                }
            }
        }

    });
</script>


@endsection