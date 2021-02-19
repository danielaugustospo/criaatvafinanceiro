@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Gerenciamento de Estoque</h2>
        </div>
        <div class="pull-right">
            @can('estoque-create')
            <a class="btn btn-success" href="{{ route('estoque.create') }}"> Cadastro de Estoque</a>
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
            <th class="thTituloTabela">Nome Estoque</th>
            <th class="thTituloTabela">Descrição Estoque</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $estoque)

        <tr>
	        <td>{{ $estoque->id }}</td>
	        <td>{{ $estoque->nomeestoque }}</td>
	        <td>{{ $estoque->descricaoestoque }}</td>
	        <td>
                <form action="{{ route('estoque.destroy',$estoque->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('estoque.show',$estoque->id) }}">Visualizar</a>
                    @can('estoque-edit')
                        <a class="btn btn-primary" href="{{ route('estoque.edit',$estoque->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('estoque-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

 
@endsection
