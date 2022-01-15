@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Novo Pedido de Compra</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('pedidocompra.index') }}"> Voltar</a>
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


{!! Form::open(array('route' => 'pedidocompra.store','method'=>'POST')) !!}

@include('pedidocompra/campos')

{!! Form::hidden('ped_usrsolicitante', Auth::user()->id, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '5']) !!}
{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}




@endsection