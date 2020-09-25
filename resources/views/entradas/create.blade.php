@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Entradas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('entradas.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'entradas.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoentrada', '', ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Bem Patrimonial</label>
    <div class="col-sm-2">
        {!! Form::text('idbenspatrimoniais', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'idbenspatrimoniais']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>


<div class="form-group row">
    <label for="valorunitarioentrada" class="col-sm-2 col-form-label">Valor Unitário Entrada</label>
    <div class="col-sm-10">
        {!! Form::text('valorunitarioentrada', '', ['placeholder' => 'Valor Unitário Entrada', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

{!! Form::hidden('qtdeEntrada', '1', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'qtdeEntrada']) !!}
{!! Form::hidden('ativoentrada', '1', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoentrada']) !!}
{!! Form::hidden('excluidoentrada', '0', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '0', 'id' => 'excluidoentrada']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}






@endsection
