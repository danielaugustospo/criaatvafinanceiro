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
</table>


{!! $data->render() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
