@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Forma de Pagamento {{$formapagamento->nomeFormaPagamento}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('formapagamentos.index') }}"> Voltar</a>
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


{!! Form::model($formapagamento, ['method' => 'PATCH','route' => ['formapagamentos.update', $formapagamento->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome da Forma de Pagamento:</strong>
            {!! Form::text('nomeFormaPagamento', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group row">
    <label for="idClienteOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('idClienteOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('dataVendaOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="valorTotalOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('valorTotalOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="valorProjetoOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('valorProjetoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="valorOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('valorOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="dataOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('dataOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="clienteOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('clienteOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="eventoOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('eventoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="servicoOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('servicoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('obsOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="dataCriacaoOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('dataCriacaoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="dataExclusaoOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('dataExclusaoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>



    {!! Form::hidden('ativoOrdemdeServico', null, ['placeholder' => 'Ativo?', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']) !!}
    {!! Form::hidden('excluidoOrdemdeServico', null, ['placeholder' => 'Excluído?', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']) !!}

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
