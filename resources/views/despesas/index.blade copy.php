@extends('layouts.app')

@section('content')


<div class="row">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Consulta de Despesas</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('despesa-create')
                <a class="btn btn-success" href="{{ route('despesas.create') }}">Cadastrar Despesas</a>
            @endcan
            @include('layouts/exibeFiltro')
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<hr>


@include('despesas/filtroindex')


<table class="table table-bordered data-table">
        <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Descrição Despesa</th>
                <th class="text-center">N° OS</th>
                <th class="text-center">Fornecedor</th>
                <th class="text-center">Vencimento</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Nota Fiscal</th>

                <th width="100px" class="noExport">Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

<script type="text/javascript">
    @include('layouts/daterange')


    $('#btnReveal').hide();

    $('#btnReveal').on('click', function () {
        $('#areaTabela').show('#div_BuscaPersonalizada');
        $('#btnReveal').hide();
        $('#btnEsconde').show();
        $('#div_BuscaPersonalizada').show();
    })

    $('#btnEsconde').on('click', function () {
        $('#areaTabela').hide('#div_BuscaPersonalizada');
        $('#btnEsconde').hide();
        $('#btnReveal').show();
        $('input[name=id]').val('');
        $('input[name=descricaoDespesa]').val('');
        $('input[name=precoReal]').val('');
        $('input[name=vencimento]').val('');
        $('input[name=idFornecedor]').val('');
        $('input[name=notaFiscal]').val('');
        $('input[name=idOS]').val('');
        $('input[name=buscaDataInicio]').val('');
        $('input[name=buscaDataFim]').val('');

        $('input[name=pesquisar]').click();
    })

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, 200, -1], ['5 resultados' , '10  resultados', '25  resultados', '50  resultados', '100  resultados', '200  resultados', "Listar Tudo"]],
        

        "language": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix": "",
            "sSearch": "Procurar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            },
            "buttons": {
            "copy": "Copiar",
            "csv": "Exportar em CSV",
            "excel": "Exportar para Excel (.xlsx)",
            "pdf": "Salvar em PDF",
            "print": "Imprimir",
            "pageLength": "Exibir por página" 
            }
        },

        ajax: {
            url: "{{ route('tabelaDespesas') }}",
            data: function(d) {
                d.idOS = $('.buscaIdOS').val(),
                    d.descricaoDespesa = $('.buscadescricaoDespesa').val(),
                    d.id = $('.buscaIdDespesa').val(),
                    d.precoReal = $('.buscaprecoreal').val(),
                    d.vencimento = $('.buscaVencimento').val(),
                    d.idFornecedor = $('.buscaIdFornecedor').val(),
                    d.notaFiscal = $('.buscaNotaFiscal').val(),
                    d.buscaDataInicio   = $('.buscaDataInicio').val(),
                    d.buscaDataFim      = $('.buscaDataFim').val(),

                    d.search = $('input[type="search"]').val()
            }
        },

        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'descricaoDespesa',
                name: 'descricaoDespesa'
            },
            {
                data: 'idOS',
                name: 'idOS'
            },
            {
                data: 'razaosocialFornecedor',
                name: 'razaosocialFornecedor'
            },
            {
                data: 'vencimento',
                name: 'vencimento',
                render: $.fn.dataTable.render.moment( 'DD/MM/YYYY' ),
                
            },
            {
                data: 'precoReal',
                name: 'precoReal',
                // render: $.fn.dataTable.render.number( ',', '.', 2 )
                render: $.fn.dataTable.render.number( '.', ',', 2)
            },
            {
                data: 'notaFiscal',
                name: 'notaFiscal'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                exportOptions: {
                visible: false
                },
            },
        ],

        rowGroup: {
                startRender: null,
                endRender: function ( rows, group ) {
                    
                    // Soma valor na coluna 6                
                    var salaryAvg = rows
                        .data('precoReal')
                        .pluck('precoReal')
                        .reduce( function (a, b) {
                            return(parseFloat(a)  + parseFloat(b) );
                            // return (a + b) *1;
                        });
                    // salaryAvg = $.fn.dataTable.render.number(',', '.', 0, 'R$').display( salaryAvg );
                    salaryAvg = $.fn.dataTable.render.number( '.', ',', 2 ).display( salaryAvg );
                    // salaryAvg = 4.40;

                    //Soma Idade  na coluna 4
                    // var ageAvg = rows
                    //     .data()
                    //     .pluck(3)
                    //     .reduce( function (a, b) {
                    //         return a + b*1;
                    //     }, 0) / rows.count();
                    
                    // Saída Dados 
                    linhagrupo = $('<tr/>')
                        .append( '<td colspan="3">Total de '+group+'</td>' )
                        .append( '<td/>' )
                        .append( '<td/>' )
                        .append( '<td>'+salaryAvg+'</td>' )
                        .append( '<td/>' )
                        .append( '<td/>' );
                        return linhagrupo;
                },
                dataSrc: 'razaosocialFornecedor'
            },
        dom: 'Bfrtip',
        buttons: [
            {
            extend: 'pdfHtml5',
            text: 'Baixar PDF',
            title: 'RELATÓRIO DE DESPESAS',

            exportOptions: {
                modifier: {
                    page: 'current',
                },
                columns: "thead th:not(.noExport)"

                // indice_do_array_agrupado_um:   'razaosocialFornecedor',
                // indice_do_array_agrupado_dois: 'precoReal',
                // indice_do_array_agrupado_tres: null,

                // posicao_um: 3,
                // posicao_dois: 5,
                // posicao_tres: null,

                
            }
            
        },

        {
            extend: 'pageLength', 
                    // title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },{
            extend: 'copy', 
                    // title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'csv', 
                    // title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'excel', 
                    // title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'pdf', 
                    // title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'print', 
                    // title: 'Test Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }
        ],
    });

    $("#pesquisar").click(function() {
        table.draw();
    });
    
</script>



@endsection