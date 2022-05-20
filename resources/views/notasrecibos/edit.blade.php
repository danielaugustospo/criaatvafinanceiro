@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Nota/Recibo {{$notasrecibos->nfrecibo}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('notasrecibos.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')
{!! Form::model($notasrecibos, ['method' => 'PATCH','route' => ['notasrecibos.update', $notasrecibos->id]]) !!}

@include('notasrecibos/campos')

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
{!! Form::close() !!}


@endsection