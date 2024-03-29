@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Fornecedor</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('fornecedores.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')

{!! Form::open(array('route' => 'fornecedores.store','method'=>'POST')) !!}
{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}

@include('fornecedores/campos')

{!! Form::hidden('ativoFornecedor', '1', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoFornecedor', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

@endsection

<style>
    .valido {
        border: 1px solid green;
    }

    .invalido {
        border: 1px solid red;
    }
</style>