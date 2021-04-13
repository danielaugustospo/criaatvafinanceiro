@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Dados de Fornecedores</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('fornecedor-create')
            <a class="btn btn-success" href="{{ route('fornecedores.create') }}">Cadastrar Fornecedor</a>
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

@include('fornecedores/filtroindex')


<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Nome Fantasia</th>
            <th class="text-center">Razão Social</th>
            <th class="text-center">CNPJ</th>
            <th class="text-center">CPF</th>
            <th class="text-center">Telefone 1</th>
            <th class="text-center">Telefone 2</th>
            <th class="text-center">Banco</th>
            <th class="text-center">N° Conta</th>
            <th class="text-center">Agência</th>
            <th class="text-center">Chave Pix 1</th>
            <th class="text-center">Chave Pix 2</th>

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
    $('input[name=nomeFornecedor]').val('');
    $('input[name=razaosocialFornecedor]').val('');
    $('input[name=cnpjFornecedor]').val('');
    $('input[name=cpfFornecedor]').val('');
    $('input[name=telefone1Fornecedor]').val('');
    $('input[name=telefone2Fornecedor]').val('');
    $('input[name=nrcontaFornecedor]').val('');
    $('input[name=agenciaFornecedor]').val('');
    $('input[name=chavePix1Fornecedor]').val('');
    $('input[name=chavePix2Fornecedor]').val('');
    $('input[name=bancoFornecedor]').val('');
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
        url: "{{ route('fornecedores.index') }}",
        data: function(d) {
                d.id                    = $('#id').val(),
                d.nomeFornecedor        = $('#nomeFornecedor').val(),
                d.razaosocialFornecedor = $('#razaosocialFornecedor').val(),
                d.cnpjFornecedor        = $('#cnpjFornecedor').val(),
                d.cpfFornecedor         = $('#cpfFornecedor').val(),
                d.telefone1Fornecedor   = $('#telefone1Fornecedor').val(),
                d.telefone2Fornecedor   = $('#telefone2Fornecedor').val(),
                d.bancoFornecedor       = $('#bancoFornecedor').val(),
                d.nrcontaFornecedor     = $('#nrcontaFornecedor').val(),
                d.agenciaFornecedor     = $('#agenciaFornecedor').val(),
                d.chavePix1Fornecedor   = $('#chavePix1Fornecedor').val(),
                d.chavePix2Fornecedor   = $('#chavePix2Fornecedor').val(),
                d.search                = $('input[type="search"]').val()
        }
    },

    columns: [
        {
            data: 'id',
            name: 'id'
        },
        {
            data: 'nomeFornecedor',
            name: 'nomeFornecedor'
        },
        {
            data: 'razaosocialFornecedor',
            name: 'razaosocialFornecedor'
        },
        {
            data: 'cnpjFornecedor',
            name: 'cnpjFornecedor'
        },
        {
            data: 'cpfFornecedor',
            name: 'cpfFornecedor'
        },
        {
            data: 'telefone1Fornecedor',
            name: 'telefone1Fornecedor'
        },
        {
            data: 'telefone2Fornecedor',
            name: 'telefone2Fornecedor'
        },
        {
            data: 'bancoFornecedor',
            name: 'bancoFornecedor'
        },
        {
            data: 'nrcontaFornecedor',
            name: 'nrcontaFornecedor'
        },
        {
            data: 'agenciaFornecedor',
            name: 'agenciaFornecedor'
        },
        {
            data: 'chavePix1Fornecedor',
            name: 'chavePix1Fornecedor'
        },
        {
            data: 'chavePix2Fornecedor',
            name: 'chavePix2Fornecedor'
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
