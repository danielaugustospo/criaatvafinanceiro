@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados Conta {{ $conta->nomeConta }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contas.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('contas.destroy',$conta->id) }}" method="POST">
                    @can('conta-edit')
                        <a class="btn btn-primary" href="{{ route('contas.edit',$conta->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('conta-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>

        </div>
    </div>
</div>


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Apelido:</strong>
            {{ $conta->apelidoConta }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome Conta:</strong>
            {{ $conta->nomeConta }}
        </div>
    </div>
    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome Banco:</strong>
            @foreach ($banco as $listabancos)
                {{ $listabancos->nomeBanco }}
            @endforeach
        </div>
    </div> --}}


</div>

 
@endsection
