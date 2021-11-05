@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Contas a Receber</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('receita-create')
            <a class="btn btn-success" href="{{ route('receita.create') }}">Cadastrar Receita</a>
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
{{-- @include('contacorrente/filtroindex') --}}



<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>

<script>

    var dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                url: "{{ route('apidespesas') }}",
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
                            precoReal: { type: "number" },
                            razaosocialFornecedor: { type: "string" },
                            vencimento: { type: "date" },
                        }
                    },
                },

                group: {
                    field: "razaosocialFornecedor", aggregates: [
                        { field: "razaosocialFornecedor", aggregate: "count" },
                        { field: "precoReal", aggregate: "sum" },
                        // { field: "UnitsOnOrder", aggregate: "average" },
                        // { field: "notaFiscal", aggregate: "count" }
                    ]
                },
                aggregate: [{ field: "razaosocialFornecedor", aggregate: "count" },
                { field: "precoReal", aggregate: "sum" }],
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
                { field: "id", title: "ID", filterable: true, width: 50 },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 100 },
                { field: "despesaCodigoDespesa", title: "Despesa", filterable: true, width: 100 },
                { field: "nomeBensPatrimoniais", title: "Bens Patrimoniais", filterable: true, width: 100 },
                { field: "idOS", title: "OS", filterable: true, width: 100 },
                { field: "razaosocialFornecedor", title: "Fornecedor", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                { field: "vencimento", title: "Vencimento", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                { field: "precoReal", title: "Valor", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Subtotal: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "notaFiscal", title: "Nota Fiscal", filterable: true, width: 100 },

                {
                    command: [{
                        name: "Visualizar",
                        click: function (e) {
                            e.preventDefault();
                            var tr = $(e.target).closest("tr"); // get the current table row (tr)
                            var data = this.dataItem(tr);
                            window.location.href = location.href + '/' + data.id;
                        }
                    }],
                    width: 100,
                    exportable: false,
                },
                {
                    command: [{
                        name: "Editar",
                        click: function (e) {
                            e.preventDefault();
                            var tr = $(e.target).closest("tr"); // get the current table row (tr)
                            var data = this.dataItem(tr);
                            window.location.href = location.href + '/' + data.id + '/edit';
                        }
                    }],
                    width: 80,
                    exportable: false,
                },
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