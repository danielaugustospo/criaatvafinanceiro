@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Saídas</h2>
        </div>
        <div class="pull-right">
            @can('saidas-create')
            <a class="btn btn-success" href="{{ route('saidas.create') }}"> Cadastrar Nova Saída</a>
            @endcan
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
            <th class="thTituloTabela">Id</th>
            <th class="thTituloTabela">Nome da Saída</th>
            <th class="thTituloTabela">Descrição</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $saida)
        <tr>
	        <td>{{ $saida->id }}</td>
	        <td>{{ $saida->nomesaida }}</td>
	        <td>{{ $saida->descricaosaida }}</td>
	        <td>
                <form action="{{ route('saidas.destroy',$saida->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('saidas.show',$saida->id) }}">Visualizar</a>
                    @can('saidas-edit')
                        <a class="btn btn-primary" href="{{ route('saidas.edit',$saida->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('saidas-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach
    </table>


 
@endsection
