<?php
    $intervaloCelulas   = 'A1:K1';
    $rotaapi            = 'api/apidespesas';
    $rotaapiupdate      = 'api/apicreatedespesas';
    $titulo             = 'Despesas (Geral)';
    $campodata          = 'vencimento';
    $relatorioKendoGrid = true;
    $idUser             = Crypt::encrypt(auth()->user()->id);
    $despesas           = (isset($despesas)) ? $despesas : '';
    $formaPagamento     = (isset($formaPagamento)) ? $formaPagamento : '';
    $dtiniciolancamento = (isset($dtiniciolancamento)) ? $dtiniciolancamento : '';
    $dtfimlancamento    = (isset($dtfimlancamento)) ? $dtfimlancamento : '';

    if (isset($idSalvo)) {
        //Verificação após retorno de lançamento de mais de uma despesa
        $tamanhoIdSalvo = count($idSalvo);
        if ($tamanhoIdSalvo > 1) {
            $idSalvo = implode(',', $idSalvo);
        }
    } else {
        $idSalvo = null;
    }

    $numberFormatter        = new \NumberFormatter('pt-BR', \NumberFormatter::CURRENCY);

    $chamadaCadastroModal   = 'atualizadespesa';
    $tituloCadastroModal    = 'Atualização de Despesa';
    $idFrame                = 'frameatualizadespesa';

    $chamadaCadastroModal1  = 'lancadespesa';
    $tituloCadastroModal1   = 'Lançamento de Despesa';
    $idFrame1               = 'framecriadepesa';
?>



<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>

</head>

@extends('layouts.app')

@section('content')
    @if (isset($paginaModal))
    @else
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-center" style="color: red">Consulta de {{ $titulo }}</h2>
                    <div class="form-row d-flex justify-content-center">

                        @can('despesa-create')
                            <a class="btn btn-dark d-flex justify-content-center" href="{{ route('despesas.create') }}">Cadastrar
                                Despesas</a>
                            <button type="button" class="btn btn-secondary" onclick="abreModalCadastro();"
                                data-dismiss="modal">Cadastrar via modal</button>
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
    @endif
    @include('layouts/helpersview/mensagemRetorno')


    <hr>
    @if (!isset($permiteVisualizacaoDespesaCriada))
        @can('despesa-list')
            @php $permiteVisualizacaoDespesaCriada = 1; @endphp
        @endcan
    @endif

    @if (isset($permiteVisualizacaoDespesaCriada))
        <div id="filter-menu"></div>
        <br /><br />
        {{-- <div id="grid"></div> --}}
        <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
            @include('layouts/helpersview/infofiltrosdepesa')
        </div>

        <script>
            @if (isset($paginaModal))
            @else
                $.LoadingOverlay("show", {
                    image: "",
                    progress: true
                });
            @endif
            $(document).ready(function() {

                var dataSource = new kendo.data.DataSource({
                    @include('layouts/helpersview/transportdespesaskendogrid')

                    pageSize: 30,
                    schema: {

                        model: {
                            id: "id",
                            fields: {
                                valorUnitario: { type: "number" },
                                precoReal: { type: "number" },
                                vale: { type: "number" },
                                despesareal: { type: "number" },
                                vencimento: { type: "date" },
                                datavale: { type: "date" },
                                dataDaCompra: { type: "date" },
                                dataDoTrabalho: { type: "date" },
                                created_at: { type: "date" },
                            }
                        },
                    },

                    group: {
                        field: "razaosocialFornecedor",
                        aggregates: [
                                    { field: "razaosocialFornecedor", aggregate: "count" },
                                    { field: "valorUnitario",aggregate: "sum" },
                                    { field: "precoReal", aggregate: "sum" },
                                    { field: "vale", aggregate: "sum" },
                                    { field: "despesareal", aggregate: "sum" }
                        ]
                    },
                    aggregate: [
                        { field: "razaosocialFornecedor", aggregate: "count" },
                        { field: "valorUnitario", aggregate: "sum" },
                        { field: "precoReal", aggregate: "sum" },
                        { field: "vale", aggregate: "sum" },
                        { field: "despesareal", aggregate: "sum" }
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
                                    name: "Editar",
                                    iconClass: "k-icon k-i-pencil",
                                    click: function(e) {
                                        e.preventDefault();
                                        var tr = $(e.target).closest("tr"); // get the current table row (tr)
                                        var data = this.dataItem(tr);
                                        rota = 'modaledicaodespesas/' + data.id + '';
                                        $('#frameatualizadespesa').attr('src', rota);
                                        $('#tituloModal').text("Despesa id " + data.id +
                                            " - " + data.descricaoDespesa);
                                        $('.atualizadespesa').modal('toggle');
                                    }
                                }],
                                width: 90,
                                exportable: false,
                            }, {
                                command: [{
                                    name: "Excluir",
                                    iconClass: "k-icon k-i-trash",
                                    click: function(e) {

                                        // e.preventDefault();
                                        var tr = $(e.target).closest("tr"); // get the current table row (tr)
                                        var linha = this.dataItem(tr);
                                        var rota = `{{ url('despesas') }}/${linha.id}`;

                                        Swal.fire({
                                            title: "Excluir Despesa?",
                                            text: "Id: " + linha.id +
                                                " - Descrição: " + linha.descricaoDespesa,
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "Sim, desejo excluir!",
                                            cancelButtonText: "Cancelar",
                                            icon: 'warning'
                                        }).then((result) => {
                                            if (result.isConfirmed) {

                                                $.ajax({
                                                    url: rota,
                                                    type: "DELETE",
                                                    data: {
                                                        _token: "{{ csrf_token() }}",
                                                        id: linha.id,
                                                        assync: true
                                                    },
                                                    dataType: "json",
                                                    success: function() {
                                                        Swal.fire(
                                                            "Operação concluída!",
                                                            "Despesa " + linha.descricaoDespesa + " excluída com sucesso",
                                                            "success"
                                                        );
                                                        $('#grid').data('kendoGrid').dataSource.read();
                                                        $('#grid').data('kendoGrid').refresh();
                                                    },
                                                    error: function(
                                                        xhr,
                                                        ajaxOptions,
                                                        thrownError
                                                    ) {
                                                        Swal.fire(
                                                            "Operação não concluída!",
                                                            "Tente novamente",
                                                            "error"
                                                        );
                                                    }
                                                });

                                            }
                                        });

                                    }
                                }],
                                width: 100,
                                exportable: false,

                            },
                            {
                                field: "id", title: "ID", filterable: true, width: 100,
                            },
                            {
                                field: "apelidoConta", title: "C/C", filterable: true, width: 120,
                            },
                            {
                                field: "despesaCodigoDespesa",
                                title: "Cód.<br>Despesa",
                                filterable: true,
                                width: 120,
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
                                width: 120,
                                aggregates: ["count"],
                                footerTemplate: "QTD. Total: #=count#",
                                groupHeaderColumnTemplate: "Qtd.: #=count#"
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
                                width: 120,
                                decimals: 2,
                                aggregates: ["sum"],
                                groupHeaderColumnTemplate: "Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                footerTemplate: "Val. Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                format: '{0:0.00}'
                            },
                            {
                                field: "notaFiscal",
                                title: "NF",
                                filterable: true,
                                width: 100,
                            },
                            {
                                field: "pago",
                                title: "Pago",
                                filterable: true,
                                width: 90
                            },
                            {
                                field: "created_at",
                                format: "{0:dd/MM/yyyy}",
                                title: "Criado em",
                                filterable: true,
                                width: 90
                            },
                            {
                                field: "nomeFormaPagamento",
                                title: "Forma Pagamento",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "quantidade",
                                title: "Quantidade",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "valorUnitario",
                                title: "Valor Unitário",
                                filterable: true,
                                width: 150,
                                decimals: 2,
                                aggregates: ["sum"],
                                groupHeaderColumnTemplate: "Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                footerTemplate: "Val. Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                format: '{0:0.00}'
                            },
                            {
                                field: "vale",
                                title: "Vale",
                                filterable: true,
                                width: 150,
                                decimals: 2,
                                aggregates: ["sum"],
                                groupHeaderColumnTemplate: "Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                footerTemplate: "Val. Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                format: '{0:0.00}'
                            },
                            {
                                field: "despesareal",
                                title: "Valor<br>Final",
                                filterable: true,
                                width: 150,
                                decimals: 2,
                                aggregates: ["sum"],
                                groupHeaderColumnTemplate: "Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                footerTemplate: "Val. Total: #:kendo.toString(sum, 'c', 'pt-BR')#",
                                format: '{0:0.00}'
                            },
                            {
                                field: "datavale",
                                title: "PG<br>Vale",
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
                                field: "dataDaCompra",
                                title: "Data da Compra",
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
                                field: "dataDoTrabalho",
                                title: "Data do Trabalho",
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
                                field: "quemcomprou",
                                title: "Quem Comprou",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "nomeBanco",
                                title: "Banco",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "cheque",
                                title: "Cheque",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "reembolsado",
                                title: "Reembolsado",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "despesaFixa",
                                title: "Despesa Fixa",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "nomeFuncionario",
                                title: "Funcionário",
                                filterable: true,
                                width: 150,
                            },
                            {
                                field: "nomeusuario",
                                title: "Usuário Lançador",
                                filterable: true,
                                width: 150,
                            }

                        ],

                        groupExpand: function(e) {
                            for (let i = 0; i < e.group.items.length; i++) {
                                var expanded = e.group.items[i].value
                                e.sender.expandGroup(".k-grouping-row:contains(" + expanded +
                                    ")");
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


            });
            @if (!isset($paginaModal))
                $(window).on('load', function() {

                        var $myDiv = $('#grid');

                        if ($myDiv.length === 1) {

                            var count = 0;
                            var interval = setInterval(function() {
                                    @if (isset($despesas))
                                        if (count >= 80) {
                                        @else
                                            if (count >= 200) {
                                            @endif
                                            clearInterval(interval);
                                            $('.k-link').eq(0).click();
                                            console.log('Ordenação Por Grupo Clicado Inicialmente');
                                            $.LoadingOverlay("hide");
                                            return;
                                        }
                                        count += 10;
                                        $.LoadingOverlay("progress", count);
                                    }, 300);

                            }

                        });
                @endif

                function recarrega() {
                    $('#grid').data('kendoGrid').dataSource.read();
                    $('#grid').data('kendoGrid').refresh();

                    let timerInterval
                    Swal.fire({
                        title: 'Atualizando tabela!',
                        html: 'Fechando mensagem em <b></b> millisegundos.',
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('Mensagem fechada pelo temporizador')
                        }
                    })
                    //Atualiza iframe
                    $('iframe').attr('src', $('iframe').attr('src'));
                }

                function abreModalCadastro() {
                    $('.lancadespesa').modal('toggle');

                }

                @include('layouts/filtradata')
        </script>
    @else
        <h3 class="text-center">Visualização não permitida</h3>
    @endif





    {{-- Modal --}}

    <div class="modal fade @isset($chamadaCadastroModal1) {{ $chamadaCadastroModal1 }} @endisset"
        id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: none; max-heigth: none;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="tituloModal" style="color: red;"><b>
                            @isset($tituloCadastroModal1)
                                {{ $tituloCadastroModal1 }}
                            @endisset
                        </b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <iframe class="modal-body" src="{{ route('despesas.create') }}?paginaModal=true" id="{{ $idFrame1 }}"
                    frameborder="0" style="height: 60vh;">
                </iframe>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="recarrega();"
                        data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade @isset($chamadaCadastroModal) {{ $chamadaCadastroModal }} @endisset"
        id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: none; max-heigth: none;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="tituloModal" style="color: red;"><b>
                            @isset($tituloCadastroModal)
                                {{ $tituloCadastroModal }}
                            @endisset
                        </b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <iframe class="modal-body" src="modaledicaodespesas/1" id="{{ $idFrame }}" frameborder="0"
                    style="height: 60vh;">
                </iframe>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="recarrega();"
                        data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
