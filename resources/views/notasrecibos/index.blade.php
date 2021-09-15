@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Notas e Recibos</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            {{-- @can('notasrecibos-create')
            <a class="btn btn-success" href="{{ route('notasrecibos.create') }}"> Cadastrar Nota/Recibo</a>
            @endcan --}}
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
@include('notasrecibos/filtroindex')


<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th class="text-center">Data Emissão</th>
            <th class="text-center">Nota/Recibo</th>
            <th class="text-center">OS</th>
            <th class="text-center">Valor Nota/Recibo</th>
            <th class="text-center">Alíquota</th>
            <th class="text-center">Imposto</th>
            <th class="text-center">Data Recebimento</th>
            <th class="text-center">Nome Conta</th>
            <th width="100px" class="noExport">Ações</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script type="text/javascript">


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
        $('input[name=emissao]').val('');
        $('input[name=nfrecibo]').val('');
        $('input[name=OS]').val('');
        $('input[name=valorNfRecibo]').val('');
        $('input[name=aliquota]').val('');
        $('input[name=imposto]').val('');
        $('input[name=datapagamentoreceita]').val('');
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
            url: "{{ route('notasrecibos.index') }}",
            data: function(d) {
                d.dtemissao               = $('.emissao').val(),
                d.nfrecibo                = $('.nfrecibo').val(),
                d.idOS                    = $('.OS').val(),
                d.valorNfRecibo           = $('.valorNfRecibo').val(),
                d.idaliquota              = $('.idaliquota').val(),
                // d.tipoaliquota            = $('.buscatipoaliquota').val(),
                d.valorimposto            = $('.imposto').val(),
                d.dtRecebimento           = $('.datapagamentoreceita').val(),
                d.search                  = $('input[type="search"]').val()
            }
        },

        columns: [
            {
                data: 'Emissao',
                name: 'Emissao',
                render: $.fn.dataTable.render.moment( 'DD/MM/YYYY' )

            },
            {
                data: 'nfRecibo',
                name: 'nfRecibo'
            },
            {
                data: 'OS',
                name: 'OS'
            },
            {
                data: 'Valor',
                name: 'Valor',
                render: $.fn.dataTable.render.number('.', ',', 2)

            },
            {
                data: 'aliquota',
                name: 'aliquota',
                render: $.fn.dataTable.render.number('.', ',', 5)

            },
            {
                data: 'imposto',
                name: 'imposto',
                render: $.fn.dataTable.render.number('.', ',', 2)

            },

            {
                data: 'datapagamentoreceita',
                name: 'datapagamentoreceita',
                render: $.fn.dataTable.render.moment( 'DD/MM/YYYY' )
            },
            {
                data: 'nomeConta',
                name: 'nomeConta'
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
        dom: 'Bfrtip',
        buttons: [{
            extend: 'pageLength', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },{
            extend: 'copy', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'csv', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'excel', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'pdf', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'print', 
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
