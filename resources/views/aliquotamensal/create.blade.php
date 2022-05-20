@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Alíquota Mensal</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('aliquotamensal.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')


{!! Form::open(array('route' => 'aliquotamensal.store','method'=>'POST')) !!}

@include('aliquotamensal/campos')

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}


@endsection
