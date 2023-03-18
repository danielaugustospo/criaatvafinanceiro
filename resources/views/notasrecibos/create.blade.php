@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Notas/Recibos</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('notasrecibos.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')




{!! Form::open(array('route' => 'notasrecibos.store','method'=>'POST')) !!}

@include('notasrecibos/campos')


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}


@endsection
