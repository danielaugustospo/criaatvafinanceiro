@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Bancos Cadastrados</h2>
        </div>
        <div class="pull-right">
            @can('banco-create')
            <a class="btn btn-success" href="{{ route('bancos.create') }}"> Criar Novo Cadastro de Banco</a>
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
            <th class="thTituloTabela">Nome Banco</th>
            <th class="thTituloTabela">Código Banco</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $banco)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $banco->nomeBanco }}</td>
	        <td>{{ $banco->codigoBanco }}</td>
	        <td>
                <form action="{{ route('bancos.destroy',$banco->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('bancos.show',$banco->id) }}">Visualizar</a>
                    @can('banco-edit')
                        <a class="btn btn-primary" href="{{ route('bancos.edit',$banco->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('banco-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
