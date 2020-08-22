@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Cliente</h2>
        </div>
        <div class="pull-right">
            @can('cliente-create')
            <a class="btn btn-success" href="{{ route('clientes.create') }}"> Criar Novo Cadastro de Cliente</a>
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
            <th class="thTituloTabela">Nome Cliente</th>
            <th class="thTituloTabela">CNPJ Cliente</th>
            <th class="thTituloTabela">Contato Cliente</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($listaClientes as $cliente)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $cliente->nomeCliente }}</td>
	        <td>{{ $cliente->cnpjCliente }}</td>
	        <td>{{ $cliente->contatoCliente }}</td>
	        <td>
                <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('clientes.show',$cliente->id) }}">Visualizar</a>
                    @can('cliente-edit')
                        <a class="btn btn-primary" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('cliente-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
