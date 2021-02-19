@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Gerenciamento de Entradas</h2>
        </div>
        <div class="pull-right">
            @can('entradas-create')
            <a class="btn btn-success" href="{{ route('entradas.create') }}"> Cadastrar Nova Entrada</a>
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
            <th class="thTituloTabela">Descrição Entrada</th>
            <th class="thTituloTabela">Bem Patrimonial</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $entrada)

        <tr>
	        <td>{{ $entrada->id }}</td>
	        <td>{{ $entrada->descricaoentrada }}</td>
	        <td>{{ $entrada->idBensPatrimoniais }}</td>
	        <td>
                <form action="{{ route('saidas.destroy',$entrada->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('saidas.show',$entrada->id) }}">Visualizar</a>
                    @can('entradas-edit')
                        <a class="btn btn-primary" href="{{ route('saidas.edit',$entrada->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('entradas-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>


@endsection
