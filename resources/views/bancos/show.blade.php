@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Banco {{ $banco->nomeBanco }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('bancos.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('bancos.destroy',$banco->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('banco-edit')
                        <a class="btn btn-primary" href="{{ route('bancos.edit',$banco->id) }}">Editar</a>
                    @endcan
                    @can('banco-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
            </form>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $banco->nomeBanco }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Código Banco:</strong>
            {{ $banco->codigoBanco }}
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
