@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Código de Despesas Cadastrados</h2>
        </div>
        <div class="pull-right">
            @can('codigodespesa-create')
            <a class="btn btn-success" href="{{ route('codigodespesas.create') }}"> Criar Novo Cadastro de Código de Despesas</a>
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
            <th class="thTituloTabela">Nome Código Despesa</th>
            <th class="thTituloTabela">Grupo Código Despesa</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $codigodespesa)

        <tr>
	        <td>{{ $codigodespesa->id }}</td>
	        <td>{{ $codigodespesa->despesaCodigoDespesa }}</td>
	        <td>{{ $codigodespesa->idGrupoCodigoDespesa }}</td>
	        <td>
                <form action="{{ route('codigodespesas.destroy',$codigodespesa->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('codigodespesas.show',$codigodespesa->id) }}">Visualizar</a>
                    @can('codigodespesa-edit')
                        <a class="btn btn-primary" href="{{ route('codigodespesas.edit',$codigodespesa->id) }}">Editar</a>
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

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
