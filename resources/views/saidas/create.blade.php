@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Saídas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contas.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'contas.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeBanco" class="col-sm-2 col-form-label">Nome da Saída</label>
    <div class="col-sm-10">
        {!! Form::text('nomesaida', '', ['placeholder' => 'Agência Conta', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="descricaosaida" class="col-sm-2 col-form-label">Descrição da Saída</label>
    <div class="col-sm-2">
        {!! Form::text('descricaosaida', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'descricaosaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Bens Patrimoniais</label>
    <div class="col-sm-2">
        {!! Form::text('idbenspatrimoniais', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'idbenspatrimoniais']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Ativo</label>
    <div class="col-sm-2">
        {!! Form::text('ativadosaida', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'ativadosaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Excluído Saída</label>
    <div class="col-sm-2">
        {!! Form::text('excluidosaida', '', ['placeholder' => 'Excluído Saída', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'excluidosaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Portador Saída</label>
    <div class="col-sm-2">
        {!! Form::text('portadorsaida', '', ['placeholder' => 'Portador Saída', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'portadorsaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data Para Retirada</label>
    <div class="col-sm-2">
        {!! Form::text('datapararetiradasaida', '', ['placeholder' => 'Data Para Retirada', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'datapararetiradasaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data da Retirada Saída</label>
    <div class="col-sm-2">
        {!! Form::text('dataretiradasaida', '', ['placeholder' => 'Data da Retirada Saída', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'portadorsaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data da Retorno Saída</label>
    <div class="col-sm-2">
        {!! Form::text('dataretornoretiradasaida', '', ['placeholder' => 'Data de Retorno Saída', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'dataretornoretiradasaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Ocorrências</label>
    <div class="col-sm-2">
        {!! Form::text('ocorrenciasaida', '', ['placeholder' => 'Ocorrências', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'ocorrenciasaida']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}






@endsection
