@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Cliente: <b>{{$cliente->nomeCliente}}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')


{!! Form::model($cliente, ['method' => 'PATCH','route' => ['clientes.update', $cliente->id] ]) !!}

@include('clientes/campos')


{!! Form::hidden('bancoFavorecidoCliente', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('agenciafavorecidoCliente', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('contacorrentefavorecidoCliente', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('nomefavorecidoCliente', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('cpffavorecidoCliente', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '14']) !!}


{!! Form::hidden('ativoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}


 
@endsection
