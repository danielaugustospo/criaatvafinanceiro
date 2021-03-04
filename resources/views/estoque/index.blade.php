@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Estoque (Inventário)</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('estoque-create')
            <a class="btn btn-success" href="{{ route('estoque.create') }}"> Cadastro de Estoque</a>
            @endcan
            <input class="btn btn-primary" id="btnReveal" style="cursor:pointer;" value="Exibir Busca Personalizada" readonly>
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

@include('estoque/filtroindex')


<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Nome</th>
            <th class="text-center">Descrição</th>
            <th class="text-center">Id Bem Patrimonial</th>

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
    $('input[name=nomeestoque]').val('');
    $('input[name=descricaoestoque]').val('');
    $('input[name=idbenspatrimoniais]').val('');

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
        url: "{{ route('estoque.index') }}",
        data: function(d) {
                d.id                    = $('.buscaid').val(),
                d.nomeestoque           = $('.buscanomeestoque').val(),
                d.descricaoestoque      = $('.buscadescricaoestoque').val(),
                d.idbenspatrimoniais    = $('.buscaidbenspatrimoniais').val(),
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
            data: 'nomeestoque',
            name: 'nomeestoque'
        },
        {
            data: 'descricaoestoque',
            name: 'descricaoestoque'
        },
        {
            data: 'idbenspatrimoniais',
            name: 'idbenspatrimoniais'

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
