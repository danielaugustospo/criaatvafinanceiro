@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Fornecedor</h2>
        </div>
        <div class="pull-right">
            @can('fornecedor-create')
            <a class="btn btn-success" href="{{ route('fornecedores.create') }}"> Criar Novo Cadastro de Fornecedor</a>
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
            <th class="thTituloTabela">Nome Fornecedor</th>
            <th class="thTituloTabela">CNPJ Fornecedor</th>
            <th class="thTituloTabela">Contato Fornecedor</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($listaFornecedores as $fornecedor)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $fornecedor->nomeFornecedor }}</td>
	        <td>{{ $fornecedor->cnpjFornecedor }}</td>
	        <td>{{ $fornecedor->contatoFornecedor }}</td>
	        <td>
                <form action="{{ route('fornecedores.destroy',$fornecedor->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('fornecedores.show',$fornecedor->id) }}">Visualizar</a>
                    @can('fornecedor-edit')
                        <a class="btn btn-primary" href="{{ route('fornecedores.edit',$fornecedor->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('fornecedor-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
