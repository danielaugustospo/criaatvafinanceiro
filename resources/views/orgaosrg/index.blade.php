@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Órgãos Emissores de Registro Geral (RG)</h2>
        </div>
        <div class="pull-right">
            @can('orgaorg-create')
            <a class="btn btn-success" href="{{ route('orgaosrg.create') }}"> Cadastrar Novo Órgão Emissor de Registro Geral (RG)</a>
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
        <tr>
            <th>Id</th>
            <th>Nome Órgão</th>
            <th>Unidade Federativa (Estado)</th>
            <th width="280px">Ação</th>
        </tr>
        @foreach ($data as $orgao)

        <tr>
	        <td>{{ $orgao->id }}</td>
	        <td>{{ $orgao->nome }}</td>
	        <td>{{ $orgao->estadoOrgaoRG }}</td>
	        <td>
                <form action="{{ route('orgaosrg.destroy',$orgao->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('orgaosrg.show',$orgao->id) }}">Visualizar</a>
                    @can('orgaorg-edit')
                        <a class="btn btn-primary" href="{{ route('orgaosrg.edit',$orgao->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('orgaorg-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach
    </table>


<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
