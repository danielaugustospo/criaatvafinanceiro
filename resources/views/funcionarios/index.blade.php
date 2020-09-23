@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Funcionários</h2>
        </div>
        <div class="pull-right">
            @can('funcionario-create')
            <a class="btn btn-success" href="{{ route('funcionarios.create') }}"> Cadastrar Novo Funcionário</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif



<table id="tabelaFuncionarios" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th class="thTituloTabela">Id</th>
        <th class="thTituloTabela">CPF</th>
        <th class="thTituloTabela">Nome Funcionário</th>
        <th class="thTituloTabela">Telefone Funcionário</th>
        <th class="thTituloTabela">Email Funcionário</th>
        <th class="thTituloTabela" width="280px">Ação</th>
    </thead>
    @foreach ($data as $funcionario)

    <tr>
        <td>{{ $funcionario->id }}</td>
        <td>{{ $funcionario->cpfFuncionario }}</td>
        <td>{{ $funcionario->nomeFuncionario }}</td>
        <td>Celular: {{ $funcionario->celularFuncionario }} <br> Tel Residência: {{ $funcionario->telresidenciaFuncionario }}</td>
        <td>{{ $funcionario->emailFuncionario }}</td>
        <td>
            <form action="{{ route('funcionarios.destroy',$funcionario->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('funcionarios.show',$funcionario->id) }}">Visualizar</a>
                @can('funcionario-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('funcionarios.edit',$funcionario->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('funcionario-delete')
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


        $("#tabelaFuncionarios").DataTable({
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
        })


        var table = $("#tabelaFuncionarios").DataTable();

        // var filter1 = createFilter(table, [0, 1]);
        // filter1.appendTo("body");
    });
</script>


 
@endsection
