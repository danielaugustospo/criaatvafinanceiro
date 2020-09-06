@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Despesas Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('despesa-create')
            <a class="btn btn-success" href="{{ route('despesas.create') }}"> Criar Novo Cadastro de Despesas</a>
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
            <th class="thTituloTabela">Nome Despesa</th>
            <th class="thTituloTabela">N° OS</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $despesa)

        <tr>
	        <td>{{ $despesa->id }}</td>
	        <td>{{ $despesa->descricaoDespesa }}</td>
	        <td>{{ $despesa->idOS }}</td>
	        <td>
                <form action="{{ route('despesas.destroy',$despesa->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('despesas.show',$despesa->id) }}">Visualizar</a>
                    @can('despesa-edit')
                        <a class="btn btn-primary" href="{{ route('despesas.edit',$despesa->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('despesa-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
