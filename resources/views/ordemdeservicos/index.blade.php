@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de OS</h2>
        </div>
        <div class="pull-right">
            @can('ordemdeservico-create')
            <a class="btn btn-success" href="{{ route('ordemdeservicos.create') }}"> Criar Novo Cadastro de Ordem de Serviço</a>
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
            <th class="thTituloTabela">OS n°</th>
            <th class="thTituloTabela">Nome OS</th>
            <th class="thTituloTabela">Cliente</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $ordemdeservico)

        <tr>
	        <td>{{ $ordemdeservico->id }}</td>
	        <td>{{ $ordemdeservico->eventoOrdemdeServico }}</td>
	        <td>{{ $ordemdeservico->clienteOrdemdeServico }}</td>
	        <td>
                <form action="{{ route('ordemdeservicos.destroy',$ordemdeservico->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('ordemdeservicos.show',$ordemdeservico->id) }}">Visualizar</a>
                    @can('ordemdeservico-edit')
                        <a class="btn btn-primary" href="{{ route('ordemdeservicos.edit',$ordemdeservico->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('ordemdeservico-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
