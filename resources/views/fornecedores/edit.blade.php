@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Fornecedor {{$fornecedor->nomeFornecedor}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('fornecedores.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')


{!! Form::model($fornecedor, ['method' => 'PATCH','route' => ['fornecedores.update', $fornecedor->id]]) !!}
<button class="btn btn-success btn-sm" type="submit">Salvar</button>

@include('fornecedores/campos')


{!! Form::hidden('ativoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

<button class="btn btn-success btn-sm" type="submit">Salvar</button>

{!! Form::close() !!}

@endsection