@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Gerenciamento de Cliente</h2>
        </div>
        <div class="pull-right">
            @can('cliente-create')
            <a class="btn btn-success" href="{{ route('clientes.create') }}"> Criar Novo Cadastro de Cliente</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif



<table id="tabelaClientes" class="table table-bordered table-striped">

    <thead class="thead-dark">
        <th class="thTituloTabela">Id</th>
        <th class="thTituloTabela">Nome Fantasia</th>
        <th class="thTituloTabela">CNPJ Cliente</th>
        <th class="thTituloTabela">Contato Cliente</th>
        <th class="thTituloTabela" width="280px">Ação</th>
    </thead>
    @foreach ($listaClientes as $cliente)

    <tr>
        <td>{{ $cliente->id  }}</td>
        <td>{{ $cliente->nomeCliente }}</td>
        <td>{{ $cliente->cnpjCliente }}</td>
        <td>{{ $cliente->contatoCliente }}</td>
        <td>
            <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('clientes.show',$cliente->id) }}">Visualizar</a>
                @can('cliente-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('cliente-delete')
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach

</table>
<script>
    function createFilter(table, columns) {
        // var input = $('<input type="text"/>').on("keyup", function() {
        //     table.draw();
        // });

        $.fn.dataTable.ext.search.push(function(
            settings,
            searchData,
            index,
            rowData,
            counter
        ) {
            var val = input.val().toLowerCase();

            for (var i = 0, ien = columns.length; i < ien; i++) {
                if (searchData[columns[i]].toLowerCase().indexOf(val) !== -1) {
                    return true;
                }
            }

            return false;
        });

        return input;
    }

    $(document).ready(function() {


        $("#tabelaClientes").DataTable({
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nenhum dado cadastrado",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Pesquisar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",
                },
            },
        })


        var table = $("#tabelaClientes").DataTable();

        // var filter1 = createFilter(table, [0, 1]);
        // filter1.appendTo("body");
    });
</script>

 
@endsection
