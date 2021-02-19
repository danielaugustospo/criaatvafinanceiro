@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Gerenciamento de Bens Patrimoniais</h2>
        </div>
        <div class="pull-right">
            @can('benspatrimoniais-create')
            <a class="btn btn-success" href="{{ route('benspatrimoniais.create') }}"> Cadastrar Bem Patrimonial</a>
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
            <th class="thTituloTabela">Bem Patrimonial</th>
            <th class="thTituloTabela">Descrição</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $bempatrimonial)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $bempatrimonial->nomeBensPatrimoniais }}</td>
	        <td>{{ $bempatrimonial->descricaoBensPatrimoniais }}</td>
	        <td>
                <form action="{{ route('benspatrimoniais.destroy',$bempatrimonial->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('benspatrimoniais.show',$bempatrimonial->id) }}">Visualizar</a>
                    @can('benspatrimoniais-edit')
                        <a class="btn btn-primary" href="{{ route('benspatrimoniais.edit',$bempatrimonial->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('benspatrimoniais-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

 
@endsection
