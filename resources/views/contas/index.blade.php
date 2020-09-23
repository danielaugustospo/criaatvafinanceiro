@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Contas Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('conta-create')
            <a class="btn btn-success" href="{{ route('contas.create') }}"> Criar Novo Cadastro de Conta</a>
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


$(document).ready(function(){


    $("#contasModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelacontas') }}",

        columns: [
            { name: 'id' },
            { name: 'agenciaConta' },
            { name: 'numeroConta' },
            { name: 'action', orderable: false, searchable:false},

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
            "next":"Próximo",
        },
    },

    });



    var table = $('#contasModel').DataTable();


     $('#contasModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "contas/"+data[0];
    } );
     $('#contasModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "contas/"+ data[0] + "/edit";
    } );
    //  $('#contasModel tbody').on( 'click', '#excluir', function () {
    //     var data = table.row( $(this).parents('tr') ).data();
    //     location.href = "bancos/destroy/" + data[0]);
    // } );


});
</script>


<div class="container">
        <table id="contasModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>Id</th>
                    <th>Agência Conta</th>
                    <th>Conta</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>

<!--

<table class="table table-bordered mt-2">
        <tr class="trTituloTabela">
            <th class="thTituloTabela">Id</th>
            <th class="thTituloTabela">Agência Conta</th>
            <th class="thTituloTabela">Conta</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $conta)

        <tr>
	        <td>{{ $conta->id }}</td>
	        <td>{{ $conta->agenciaConta }}</td>
	        <td>{{ $conta->numeroConta }}</td>
	        <td>
                <form action="{{ route('contas.destroy',$conta->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('contas.show',$conta->id) }}">Visualizar</a>
                    @can('conta-edit')
                        <a class="btn btn-primary" href="{{ route('contas.edit',$conta->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('conta-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table> -->

 
@endsection
