<?php
    $titulo  = "Faturamento por Cliente";
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

            <div class="d-flex justify-content-center">
                <label for="">Exibindo filtros para:</label>
                @php
                if ($_SERVER['QUERY_STRING'] == 'p=s'):
                    $complementorota = 'S';
                    echo ' <span class="badge badge-primary"><label class="pt-1">Pago</label></span>';
                    echo '<label class="pl-2"><a href="fatporcliente?p=n"> Alterar para Não Pago</a></label>';
                elseif ($_SERVER['QUERY_STRING'] == 'p=n'):
                    $complementorota = 'N';
                    echo ' <span class="badge badge-danger"><label class="pt-1">Não Pago</label></span>';
                    echo '<label class="pl-2"><a href="fatporcliente?p=s"> Alterar para Pago</a></label>';
                else:
                    $complementorota = null;
                endif;
                @endphp
            </div>

        </div>
    </div>
<?php
    $intervaloCelulas = "A1:H1"; 
    $urlCompleta = route('apifaturamentoporcliente')."?a=".$complementorota;

    $campodata = 'datapagamentoreceita';
?>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


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
                                valortotal: {
                                    type: "number"
                                },
                                valorrecebido: {
                                    type: "number"
                                },
                                porcentagemOS: {
                                    type: "number"
                                },
                                razaosocialCliente: {
                                    type: "string"
                                },
                                datapagamentoreceita: {
                                    type: "date"
                                },

                            }
                        },
                    },
                    group: [{field: "razaosocialCliente", aggregate: "count"}],

                    aggregate: [{
                            field: "razaosocialCliente",
                            aggregate: "count"
                        },
                        {
                            field: "valortotal",
                            aggregate: "sum"
                        },
                        {
                            field: "valorrecebido",
                            aggregate: "sum"
                        },
                        {
                            field: "porcentagemOS",
                            aggregate: "sum"
                        }
                    ],
                },

                columns: [
                    { field: "razaosocialCliente", title: "Cliente", aggregates: ["count"], filterable: true, width: 150},
                    { field: "datapagamentoreceita", title: "Data", filterable: true, width: 100,format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                    { field: "valortotal", title: "Valor Total", filterable: true, width: 180, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') # ", format: '{0:0.00}'},
                    // { field: "valorrecebido", title: "Valor Recebido", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') # ", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') # ", format: '{0:0.00}' },

                    // { field: "porcentagemOS", title: "Perc(%)", filterable: true, width: 20,  format: '{0:0.00}'}
                    { field: "porcentagemOS", title: "Perc(%)", width: 180, template:template }
                ],

                @include('layouts/helpersview/finaltabela')
                function template(data){
                    var grid = $('#grid').data('kendoGrid');
                    
                    // var valorPorcentagem = 100*(+data.porcentagemOS)/grid.dataSource.aggregates().porcentagemOS.sum + ' %';
                    var valorPorcentagem = 100 * (+data.valortotal) / grid.dataSource.aggregates().valortotal.sum;
                    valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2)+"%";
                    return  valorPorcentagem;
                }
                @include('layouts/filtradata')
    </script>


@endsection
