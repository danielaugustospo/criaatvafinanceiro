@extends('layouts.app')


@section('content')

@isset($pedido)
  @if (($pedido->ped_usrsolicitante == Auth::id()) || ( Gate::check('pedidocompra-edit') ))

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Pedido de Compra n° @isset($pedido->id) {{ $pedido->id }} @endisset</h2>
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

{!! Form::model($pedido, ['method' => 'PATCH','route' => ['pedidocompra.update', $pedido->id]]) !!}
  
@include('pedidocompra/campos')

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

{!! Form::close() !!}



@else
<h1 class="text-center mt-5">NÃO AUTORIZADO. <br> CONTATE O ADMINISTRADOR DO SISTEMA</h1>
@endif

@endisset
@endsection