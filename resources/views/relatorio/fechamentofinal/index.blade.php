<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apidadosfechamentofinal";
    $titulo  = "Fechamento Final";
?>
<head>
    <meta charset="utf-8">
    <title>{{$titulo}}</title>
</head>

@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Relatório de {{$titulo}}</h2>
        </div>
    </div>
</div>



@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

{{-- @include('despesas/filtroindex') --}}


<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>

<script>

    @include('layouts/helpersview/iniciotabela')

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            valorOrdemdeServico: { type: "number" },
                            custo: { type: "number" },
                            lucro: { type: "number" },
                            porcentagem: { type: "number" },

                            // datapagamentoreceita: { type: "date" },
                        }
                    },
                },
                // group: {field: "status", aggregate: "count"},
                aggregate: [
                    { field: "idOS", aggregate: "count" },
                    { field: "valorOrdemdeServico", aggregate: "sum" },
                    { field: "custo", aggregate: "sum" },
                    { field: "lucro", aggregate: "sum" },
                    { field: "porcentagem", aggregate: "average" },
                    ]
            },

            filterable: true,
            sortable: true,
            resizable: true,
            scrollable: false,
            groupable: true,
            pageable: {
                pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                numeric: false
            },

            columns: [
                { field: "idOS", title: "OS", aggregates: ["count"], footerTemplate: "Total de OS: #=count#",  filterable: true, width: 30  },
                { field: "dataCriacaoOrdemdeServico", title: "Data OS", filterable: true, width: 30, format: "{0:dd/MM/yyyy}" },
                // { field: "datapagamentoreceita", title: "Data do Pagamento", filterable: true, width: 30, format: "{0:dd/MM/yyyy}" },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 60 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 60 },
                { field: "valorOrdemdeServico", title: "Valor do Projeto", filterable: true, width: 60, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "custo", title: "Total de Custos", filterable: true, width: 60, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "lucro", title: "Lucro ou Prejuízo", filterable: true, width: 60, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "porcentagem", title: "Perc(%)", filterable: true, width: 40, decimals: 2, aggregates: ["average"], footerTemplate: "Média : #: kendo.toString(average, 'n', 'pt-BR')  # %", format: '{0:0.00} %' },            
                { field: "status", title: "Pago", filterable: true, width: 40 },            
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


    // function template(data){
    //         var grid = $('#grid').data('kendoGrid');
            
    //         // var valorPorcentagem = 100*(+data.porcentagemOS)/grid.dataSource.aggregates().porcentagemOS.sum + ' %';
    //         var valorPorcentagem = 100 * (+data.lucro) / grid.dataSource.aggregates().valorOrdemdeServico.sum;
    //         valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2)+"%";
    //         return  valorPorcentagem;
    //     }



    $(window).on('load', function(){
    var counter = 0;
    
    setInterval(function (){    
    ++counter;

        if (counter == 5){
            console.log('Ordenação Por Grupo Clicado Inicialmente');
            $.LoadingOverlay("hide");
            $('.k-link')[0].click();  
            }
        }, 1000);

    });
                



</script>

@endsection