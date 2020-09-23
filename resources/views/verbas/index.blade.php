@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Verbas Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('verba-create')
            <a class="btn btn-success" href="{{ route('verbas.create') }}"> Criar Novo Cadastro de Verba</a>
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
            <th class="thTituloTabela">Descrição Verba</th>
            <th class="thTituloTabela">Referência OS</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $verba)

        <tr>
	        <td>{{ $verba->id }}</td>
	        <td>{{ $verba->descricaoVerba }}</td>
	        <td>{{ $verba->idOSVerba }}</td>
	        <td>
                <form action="{{ route('verbas.destroy',$verba->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('verbas.show',$verba->id) }}">Visualizar</a>
                    @can('verba-edit')
                        <a class="btn btn-primary" href="{{ route('verbas.edit',$verba->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('verba-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

 
@endsection
