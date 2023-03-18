@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Bem Patrimonial: <b>{{ $benspatrimoniais->nomeBensPatrimoniais }}</b></h2>
        </div>
        <div class="pull-right mb-3">
            <a class="btn btn-primary" href="{{ route('benspatrimoniais.index') }}"> Voltar</a>
        </div>
        <hr>
        <form action="{{ route('benspatrimoniais.destroy',$benspatrimoniais->id) }}" method="POST">
            @can('benspatrimoniais-edit')
                <a class="btn btn-primary" href="{{ route('benspatrimoniais.edit',$benspatrimoniais->id) }}">Editar</a>
            @endcan

            {{-- @csrf
            @method('DELETE')
            @can('benspatrimoniais-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
            @endcan --}}
        </form>

    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            <label for="">{{ $benspatrimoniais->nomeBensPatrimoniais }}</label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Estoque Mínimo:</strong>
            <label for="">{{ $benspatrimoniais->qtdestoqueminimo }}</label>
        </div>
    </div>

</div>


@endsection
