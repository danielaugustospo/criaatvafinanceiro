@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Usuários</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Criar Novo Usuário</a>
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
    
    
    $("#usersmodel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelausuarios') }}",
        
        columns: [
            { name: 'id' },
            { name: 'name' },
            { name: 'email' },
            { name: 'ativoUser' },
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


    var table = $('#usersmodel').DataTable();
     

     $('#usersmodel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "users/"+data[0];
    } );
     $('#usersmodel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "users/"+ data[0] + "/edit";
    } );

 
});
</script>


<div class="container">
        <table id="usersmodel" class="table table-bordered table-striped">
            <thead class="thead-dark">
    
            <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
              
            </thead>
        </table>
    </div>







<!-- 
<table class="table table-bordered mt-2">
  <tr class="trTituloTabela">
   <th class="thTituloTabela">No</th>
   <th class="thTituloTabela">Name</th>
   <th class="thTituloTabela">Email</th>
   <th class="thTituloTabela">Regras</th>
   <th class="thTituloTabela" width="280px">Ação</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Visualizar</a>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table> -->


{!! $data->render() !!}

 
@endsection
