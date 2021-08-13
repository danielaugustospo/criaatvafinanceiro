@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <hr class="col-sm-5">

        <div class="pull-left">
            <h2 class="text-center">Consulta de OS</h2>
        </div>
        <hr class="col-sm-5">
        <div class="d-flex justify-content-between pull-right">
            @can('ordemdeservico-create')
            <a class="btn btn-success ml-3" href="{{ route('ordemdeservicos.create') }}"> Cadastrar OS</a>
            @endcan
            <input class="btn btn-primary" id="btnReveal" style="cursor:pointer;" value="Exibir Busca" readonly>
            <input class="btn btn-secondary" id="btnEsconde" style="cursor:pointer;" value="Ocultar Busca" readonly>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<hr>

@include('ordemdeservicos/filtroindex')

<div class="container shadowDiv mb-5 p-2 rounded" style="background-color: white !important;" id="container">

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th class="text-center">N° OS</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Evento</th>
                <th class="text-center">Valor Projeto</th>

                <th width="100px" class="noExport">Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $('#btnReveal').hide();

    $('#btnReveal').on('click', function() {
        $('#areaTabela').show('#div_BuscaPersonalizada');
        $('#btnReveal').hide();
        $('#btnEsconde').show();
        $('#div_BuscaPersonalizada').show();
    })

    $('#btnEsconde').on('click', function() {
        $('#areaTabela').hide('#div_BuscaPersonalizada');
        $('#btnEsconde').hide();
        $('#btnReveal').show();
        $('input[name=id]').val('');
        $('input[name=idClienteOrdemdeServico]').val('');
        $('input[name=eventoOrdemdeServico]').val('');
        $('input[name=valorOrdemdeServico]').val('');
        $('input[name=pesquisar]').click();
    })

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        "iDisplayLength": 10,
        "aLengthMenu": [
            [5, 10, 25, 50, 100, 200, -1],
            ['5 resultados', '10  resultados', '25  resultados', '50  resultados', '100  resultados', '200  resultados', "Listar Tudo"]
        ],


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
            url: "{{ route('tabelaOrdemServicos') }}",
            data: function(d) {
                d.id = $('.buscaId').val(),
                    d.idClienteOrdemdeServico = $('.buscaCliente').val(),
                    d.eventoOrdemdeServico = $('.buscaEvento').val(),
                    d.valorOrdemdeServico = $('.buscaValor').val(),
                    d.search = $('input[type="search"]').val()
            }
        },

        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'razaosocialCliente',
                name: 'razaosocialCliente'
            },
            {
                data: 'eventoOrdemdeServico',
                name: 'eventoOrdemdeServico',
            },
            {
                data: 'valorOrdemdeServico',
                name: 'valorOrdemdeServico',
                render: $.fn.dataTable.render.number('.', ',', 2)
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
            }, {
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
        "order": [[ 0, "desc" ]]
    });

    $("#pesquisar").click(function() {
        table.draw();
    });
</script>

@endsection