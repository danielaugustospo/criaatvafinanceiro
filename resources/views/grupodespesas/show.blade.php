@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Grupo de Despesa {{ $grupodespesa->grupoDespesa }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('grupodespesas.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('grupodespesas.destroy',$grupodespesa->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('grupodespesa-edit')
                        <a class="btn btn-primary" href="{{ route('grupodespesas.edit',$grupodespesa->id) }}">Editar</a>
                    @endcan
                    @can('grupodespesa-delete')
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
            {{ $grupodespesa->id }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Grupo:</strong>
            {{ $grupodespesa->grupoDespesa }}
        </div>
    </div>
</div>

 
@endsection
