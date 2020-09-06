@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Formas de Pagamento Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('formapagamento-create')
            <a class="btn btn-success" href="{{ route('formapagamentos.create') }}"> Criar Novo Cadastro de Formas de Pagamento</a>
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
            <th class="thTituloTabela">Nome Forma de Pagamento</th>
            <th class="thTituloTabela">Ativo ?</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $formadepagamento)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $formadepagamento->nomeFormaPagamento }}</td>
	        <td>{{ $formadepagamento->ativoFormaPagamento }}</td>
	        <td>
                <form action="{{ route('formapagamentos.destroy',$formadepagamento->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('formapagamentos.show',$formadepagamento->id) }}">Visualizar</a>
                    @can('formapagamento-edit')
                        <a class="btn btn-primary" href="{{ route('formapagamentos.edit',$formadepagamento->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('formapagamento-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
