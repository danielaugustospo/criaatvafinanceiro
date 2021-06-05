@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Contas Bancárias</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('conta-create')
            <a class="btn btn-success" href="{{ route('contas.create') }}">Cadastrar Conta Bancária</a>
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

@include('contas/filtroindex')


<table class="table table-bordered data-table">
        <thead>
            <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Apelido</th>
                <th class="text-center">Nome</th>
                {{-- <th class="text-center">Id Banco</th> --}}

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
        $('input[name=id]').val('');
        $('input[name=nomeConta]').val('');
        $('input[name=apelidoConta]').val('');
        // $('input[name=idBanco]').val('');
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
            url: "{{ route('contas.index') }}",
            data: function(d) {
                d.id            = $('.buscaId').val(),
                d.nomeConta   = $('.buscanomeConta').val(),
                d.apelidoConta  = $('.buscaapelidoConta').val(),
                // d.idBanco       = $('.buscaidBanco').val(),
                d.search        = $('input[type="search"]').val()
            }
        },

        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'nomeConta',
                name: 'nomeConta'
            },
            {
                data: 'apelidoConta',
                name: 'apelidoConta'
            },
            // {
            //     data: 'idBanco',
            //     name: 'idBanco'

            // },
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
