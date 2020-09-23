@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da OS {{$ordemdeservico->id}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
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


{!! Form::model($ordemdeservico, ['method' => 'PATCH','route' => ['ordemdeservicos.update', $ordemdeservico->id]]) !!}

<div class="form-group row">
    <label for="nomeFormaPagamento" class="col-sm-2 col-form-label">Forma de Pagamento</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('nomeFormaPagamento', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <!-- <select name="nomeFormaPagamento" id="testa" class="selectPG js-example-basic-multiple"  multiple="multiple"> -->
        <select name="nomeFormaPagamento" id="nomeFormaPagamento" class="form-control col-sm-4 js-example-basic-multiple">
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
    <label for="idClienteOrdemdeServico" class="col-sm-1 col-form-label">Cliente</label>
    <div class="col-sm-5">
        <!-- {!! Form::text('idClienteOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <select name="idClienteOrdemdeServico" id="idClienteOrdemdeServico" class="form-control  js-example-basic-multiple">
            @foreach ($cliente as $clientes)
            <option value="{{ $clientes->id }}">{{ $clientes->nomeCliente }}</option>
            @endforeach
        </select>
    </div>
</div>



<div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Data Venda</label>
    <div class="col-sm-2">
        {!! Form::date('dataVendaOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
    <label for="dataOrdemdeServico" class="col-sm-2 col-form-label">Data Ordem de Serviço</label>
    <div class="col-sm-2">
        {!! Form::date('dataOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
    <label for="dataCriacaoOrdemdeServico" class="col-sm-1 col-form-label">Data Criação</label>
    <div class="col-sm-3">
        {!! Form::date('dataCriacaoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>


<div class="form-group row">
    <label for="valorTotalOrdemdeServico" class="col-sm-2 col-form-label">Valor Total</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('valorTotalOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <input type="text" id="valorTotalOrdemdeServico" class="form-control" name="valorTotalOrdemdeServico" value="{{$ordemdeservico->valorTotalOrdemdeServico}}" placeholder="Preencha o preço real" /><br>

    </div>
    <label for="valorProjetoOrdemdeServico" class="col-sm-1 col-form-label">Valor Projeto</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('valorProjetoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <input type="text" id="valorProjetoOrdemdeServico" class="form-control" name="valorProjetoOrdemdeServico" value="{{$ordemdeservico->valorProjetoOrdemdeServico}}" placeholder="Preencha o preço real" /><br>

    </div>
    <label for="valorOrdemdeServico" class="col-sm-2 col-form-label">Valor Ordem de Serviço</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('valorOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <input type="text" id="valorOrdemdeServico" class="form-control" name="valorOrdemdeServico" value="{{$ordemdeservico->valorOrdemdeServico}}" placeholder="Preencha o preço real" /><br>

    </div>
</div>



<div class="form-group row">
    <label for="clienteOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('clienteOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="eventoOrdemdeServico" class="col-sm-2 col-form-label">Evento</label>
    <div class="col-sm-10">
        {!! Form::text('eventoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="servicoOrdemdeServico" class="col-sm-2 col-form-label">Serviço</label>
    <div class="col-sm-10">
        {!! Form::text('servicoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label">Observação</label>
    <div class="col-sm-10">
        {!! Form::text('obsOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>

{!! Form::hidden('dataExclusaoOrdemdeServico', '00', ['placeholder' => 'Data Exclusão', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'dataExclusaoOrdemdeServico']) !!}
{!! Form::hidden('ativoOrdemdeServico', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']) !!}
{!! Form::hidden('excluidoOrdemdeServico', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']) !!}


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

{!! Form::close() !!}

 
@endsection
