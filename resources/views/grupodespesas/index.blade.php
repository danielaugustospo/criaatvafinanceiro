@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Grupo de Despesas</h2>
        </div>
        <div class="pull-right">
            @can('codigodespesa-create')
            <a class="btn btn-success" href="{{ route('grupodespesas.create') }}">Cadastrar Grupo de Despesas</a>
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


    $("#grupoDespesaModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelagrupodespesas') }}",

        columns: [
            { name: 'id' },
            { name: 'grupoDespesa' },
            { name: 'action', orderable: false, searchable:false},

        ],
        "language": {
        "lengthMenu": "Exibindo _MENU_ registros por página",
        "zeroRecords": "Nenhum dado cadastrado",
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



    var table = $('#grupoDespesaModel').DataTable();


     $('#grupoDespesaModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "grupodespesas/"+data[0];
    } );
     $('#grupoDespesaModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "grupodespesas/"+ data[0] + "/edit";
    } );



});
</script>


<div class="container">
        <table id="grupoDespesaModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>Id</th>
                    <th>Grupo</th>
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
        @foreach ($data as $grupodespesa)

        <tr>
	        <td>{{ $grupodespesa->id }}</td>
	        <td>{{ $grupodespesa->despesaCodigoDespesa }}</td>
	        <td>{{ $grupodespesa->idGrupoCodigoDespesa }}</td>
	        <td>
                <form action="{{ route('grupodespesas.destroy',$grupodespesa->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('grupodespesas.show',$grupodespesa->id) }}">Visualizar</a>
                    @can('codigodespesa-edit')
                        <a class="btn btn-primary" href="{{ route('grupodespesas.edit',$grupodespesa->id) }}">Editar</a>
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

 
@endsection
