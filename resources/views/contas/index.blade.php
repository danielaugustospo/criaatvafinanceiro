@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Contas Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('conta-create')
            <a class="btn btn-success" href="{{ route('contas.create') }}"> Criar Novo Cadastro de Conta</a>
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
            <th class="thTituloTabela">Nome Conta</th>
            <th class="thTituloTabela">Código Conta</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $conta)

        <tr>
	        <td>{{ $conta->id }}</td>
	        <td>{{ $conta->agenciaConta }}</td>
	        <td>{{ $conta->numeroConta }}</td>
	        <td>
                <form action="{{ route('contas.destroy',$conta->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('contas.show',$conta->id) }}">Visualizar</a>
                    @can('conta-edit')
                        <a class="btn btn-primary" href="{{ route('contas.edit',$conta->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('conta-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
