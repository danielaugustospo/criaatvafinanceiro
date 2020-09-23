@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Fornecedor</h2>
        </div>
        <div class="pull-right">
            @can('fornecedor-create')
            <a class="btn btn-success" href="{{ route('fornecedores.create') }}"> Criar Novo Cadastro de Fornecedor</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif




<script>
    $(document).ready(function() {


        $("#tabelaFornecedoresModel").DataTable({
            serverSide: true,
            ajax: "{{ route('tabelafornecedores') }}",

            columns: [{
                    name: 'id'
                },
                {
                    name: 'nomeFornecedor'
                },
                {
                    name: 'cnpjFornecedor'
                },
                {
                    name: 'contatoFornecedor'
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nothing found - sorry",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Pesquisar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",
                },
            },

        });



        var table = $('#tabelaFornecedoresModel').DataTable();


        $('#tabelaFornecedoresModel tbody').on('click', '#visualizar', function() {
            var data = table.row($(this).parents('tr')).data();
            location.href = "fornecedores/" + data[0];
        });
        $('#tabelaFornecedoresModel tbody').on('click', '#editar', function() {
            var data = table.row($(this).parents('tr')).data();
            location.href = "fornecedores/" + data[0] + "/edit";
        });


    });
</script>


<div class="container">
    <table id="tabelaFornecedoresModel" class="table table-bordered table-striped">
        <thead class="thead-dark">

            <tr>
                <th>Id</th>
                <th>Nome Fornecedor</th>
                <th>CNPJ Fornecedor</th>
                <th>Contato Fornecedor</th>
                <th>Ações</th>
            </tr>

        </thead>
    </table>
</div>





<!-- <table class="table table-bordered mt-2">

        <tr class="trTituloTabela">
            <th class="thTituloTabela">Id</th>
            <th class="thTituloTabela">Nome Fornecedor</th>
            <th class="thTituloTabela">CNPJ Fornecedor</th>
            <th class="thTituloTabela">Contato Fornecedor</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($listaFornecedores as $fornecedor)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $fornecedor->nomeFornecedor }}</td>
	        <td>{{ $fornecedor->cnpjFornecedor }}</td>
	        <td>{{ $fornecedor->contatoFornecedor }}</td>
	        <td>
                <form action="{{ route('fornecedores.destroy',$fornecedor->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('fornecedores.show',$fornecedor->id) }}">Visualizar</a>
                    @can('fornecedor-edit')
                        <a class="btn btn-primary" href="{{ route('fornecedores.edit',$fornecedor->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('fornecedor-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table> -->

 
@endsection
