@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Alíquota Mensal {{$dadosaliquotamensal->mes}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('aliquotamensal.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Ops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


{!! Form::model($dadosaliquotamensal, ['method' => 'PATCH','route' => ['aliquotamensal.update', $dadosaliquotamensal->id]]) !!}

@include('aliquotamensal/campos')

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
{!! Form::close() !!}


@endsection