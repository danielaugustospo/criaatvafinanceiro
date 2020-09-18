@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Código de Despesas Cadastrados</h2>
        </div>
        <div class="pull-right">
            @can('codigodespesa-create')
            <a class="btn btn-success" href="{{ route('codigodespesas.create') }}"> Criar Novo Cadastro de Código de Despesas</a>
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


    $("#codigoDespesasModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelacodigodespesas') }}",

        columns: [
            { name: 'id' },
            { name: 'despesaCodigoDespesa' },
            { name: 'idGrupoCodigoDespesa' },
            { name: 'ativoCodigoDespesa' },
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



    var table = $('#codigoDespesasModel').DataTable();


     $('#codigoDespesasModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "codigodespesas/"+data[0];
    } );
     $('#codigoDespesasModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "codigodespesas/"+ data[0] + "/edit";
    } );



});
</script>


<div class="container">
        <table id="codigoDespesasModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>Id</th>
                    <th>Nome Código Despesa</th>
                    <th>Grupo Código Despesa</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>



<!--


<table class="table table-bordered mt-2">

<tr class="trTituloTabela">
            <th class="thTituloTabela">Id</th>
            <th class="thTituloTabela">Nome Código Despesa</th>
            <th class="thTituloTabela">Grupo Código Despesa</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $codigodespesa)

        <tr>
	        <td>{{ $codigodespesa->id }}</td>
	        <td>{{ $codigodespesa->despesaCodigoDespesa }}</td>
	        <td>{{ $codigodespesa->idGrupoCodigoDespesa }}</td>
	        <td>
                <form action="{{ route('codigodespesas.destroy',$codigodespesa->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('codigodespesas.show',$codigodespesa->id) }}">Visualizar</a>
                    @can('codigodespesa-edit')
                        <a class="btn btn-primary" href="{{ route('codigodespesas.edit',$codigodespesa->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('codigodespesa-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table> -->

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
