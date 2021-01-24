@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Órgãos Emissores de Registro Geral (RG)</h2>
        </div>
        <div class="pull-right">
            @can('orgaorg-create')
            <a class="btn btn-success" href="{{ route('orgaosrg.create') }}"> Cadastrar Novo Órgão Emissor de Registro Geral (RG)</a>
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


    $("#orgaosrgModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelaorgaosrg') }}",

        columns: [
            { name: 'id' },
            { name: 'nome' },
            { name: 'estadoOrgaoRG' },
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



    var table = $('#orgaosrgModel').DataTable();


     $('#orgaosrgModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "orgaosrg/"+data[0];
    } );
     $('#orgaosrgModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "orgaosrg/"+ data[0] + "/edit";
    } );



});
</script>


<div class="container">
        <table id="orgaosrgModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>Id</th>
                    <th>Nome Órgão</th>
                    <th>Unidade Federativa (Estado)</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>



<!--


<table class="table table-bordered mt-2">
        <tr>
            <th>Id</th>
            <th>Nome Órgão</th>
            <th>Unidade Federativa (Estado)</th>
            <th width="280px">Ação</th>
        </tr>
        @foreach ($data as $orgao)

        <tr>
	        <td>{{ $orgao->id }}</td>
	        <td>{{ $orgao->nome }}</td>
	        <td>{{ $orgao->estadoOrgaoRG }}</td>
	        <td>
                <form action="{{ route('orgaosrg.destroy',$orgao->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('orgaosrg.show',$orgao->id) }}">Visualizar</a>
                    @can('orgaorg-edit')
                        <a class="btn btn-primary" href="{{ route('orgaosrg.edit',$orgao->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('orgaorg-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach
    </table> -->


 
@endsection
