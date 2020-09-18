@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Bancos Cadastrados</h2>
        </div>
        <div class="pull-right">
            @can('banco-create')
            <a class="btn btn-success" href="{{ route('bancos.create') }}"> Criar Novo Cadastro de Banco</a>
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
    
    
    $("#bancos").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelabanco') }}",
        
        columns: [
            { name: 'id' },
            { name: 'nomeBanco' },
            { name: 'codigoBanco' },
            { name: 'ativoBanco' },
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



    var table = $('#bancos').DataTable();
     

     $('#bancos tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "bancos/"+data[0];
    } );
     $('#bancos tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "bancos/"+ data[0] + "/edit";
    } );
    //  $('#bancos tbody').on( 'click', '#excluir', function () {
    //     var data = table.row( $(this).parents('tr') ).data();
    //     location.href = "bancos/destroy/" + data[0]);
    // } );

 
});
</script>


<div class="container">
        <table id="bancos" class="table table-bordered table-striped">
            <thead class="thead-dark">
    
            <tr>
                    <th>Id</th>
                    <th>Nome Banco</th>
                    <th>Código Banco</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
              
            </thead>
        </table>
    </div>



<!-- <table class="table table-bordered mt-2">

<tr class="trTituloTabela">
            <th class="thTituloTabela">Id</th>
            <th class="thTituloTabela">Nome Banco</th>
            <th class="thTituloTabela">Código Banco</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $banco)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $banco->nomeBanco }}</td>
	        <td>{{ $banco->codigoBanco }}</td>
	        <td>
                <form action="{{ route('bancos.destroy',$banco->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('bancos.show',$banco->id) }}">Visualizar</a>
                    @can('banco-edit')
                        <a class="btn btn-primary" href="{{ route('bancos.edit',$banco->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('banco-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table> -->

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
