@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Código de Despesa {{ $codigodespesa->despesaCodigoDespesa }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('codigodespesas.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('codigodespesas.destroy',$codigodespesa->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('codigodespesa-edit')
                        <a class="btn btn-primary" href="{{ route('codigodespesas.edit',$codigodespesa->id) }}">Editar</a>
                    @endcan
                    @can('codigodespesa-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
            </form>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Id:</strong>
            {{ $codigodespesa->id }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Código Banco:</strong>
            {{ $codigodespesa->despesaCodigoDespesa }}
        </div>
    </div>
</div>

 
@endsection
