@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Funcionários</h2>
        </div>
        <div class="pull-right">
            @can('funcionario-create')
            <a class="btn btn-success" href="{{ route('funcionarios.create') }}"> Cadastrar Novo Funcionário</a>
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
            <th class="thTituloTabela">Nome Funcionário</th>
            <th class="thTituloTabela">Email Funcionário</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $funcionario)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $funcionario->nomeFuncionario }}</td>
	        <td>{{ $funcionario->emailFuncionario }}</td>
	        <td>
                <form action="{{ route('funcionarios.destroy',$funcionario->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('funcionarios.show',$funcionario->id) }}">Visualizar</a>
                    @can('funcionario-edit')
                        <a class="btn btn-primary" href="{{ route('funcionarios.edit',$funcionario->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('funcionario-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
