@extends('layouts.app')


@section('content')

<script>
    $(document).ready(function($) {
        $("#idFormaPagamento").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#conta").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#idCodigoDespesas").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#idFornecedor").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#idOS").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
</script>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Despesa n° {{$despesa->id}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('despesas.index') }}"> Voltar</a>
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


{!! Form::model($despesa, ['method' => 'PATCH','route' => ['despesas.update', $despesa->id]]) !!}

<div class="form-group row">
    <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoDespesa', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-4">

        <select name="idCodigoDespesas" id="idCodigoDespesas" class="col-sm-12">
            @foreach ($codigoDespesa as $listaCodigoDespesas)
            <option value="{{$listaCodigoDespesas->id}}">
                Código da Despesa: {{$listaCodigoDespesas->idGrupoCodigoDespesa}} - Tipo de Despesa: {{$listaCodigoDespesas->despesaCodigoDespesa}}
            </option>
            @endforeach
        </select>

    </div>
    <label for="idOS" class="col-sm-2 col-form-label">Vincular a OS</label>
    <div class="col-sm-4">

        <select name="idOS" id="idOS" class="col-sm-12">
            @foreach ($todasOSAtivas as $listaOS)
            <option value="{{$listaOS->id}}">
                Código da OS: {{$listaOS->id}} - Evento: {{$listaOS->eventoOrdemdeServico}}
            </option>
            @endforeach
        </select>

    </div>
</div>
<div class="form-group row">
    <label for="despesaCodigoDespesas" class="col-sm-2 col-form-label">Informação da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('despesaCodigoDespesas', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idFornecedor" class="col-sm-2 col-form-label">Fornecedor</label>
    <div class="col-sm-10">

        <select name="idFornecedor" id="idFornecedor" class="form-control">
            @foreach ($listaForncedores as $fornecedor)

            <option value="{{ $fornecedor->id }}">Nome: {{ $fornecedor->nomeFornecedor }} - Razão Social: {{ $fornecedor->razaosocialFornecedor }} - Contato: {{ $fornecedor->contatoFornecedor }}</option>

            @endforeach
        </select>

    </div>
</div>
<div class="form-group row">

    <label for="precoReal" class="col-sm-2 col-form-label">Preço Real</label>
    <div class="col-sm-2">
        <input type="text" id="precoReal" class="form-control" name="precoReal" value="{{$despesa->precoReal}}" placeholder="Preencha o preço real" /><br>

    </div>
    <label for="ativoDespesa" class="col-sm-1 col-form-label">Ativação</label>
    <div class="col-sm-1">
        <select name="ativoDespesa" id="ativoDespesa" style="padding:4px;" class="form-control">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
    </div>

    <label for="pago" class="col-sm-1 col-form-label">Pago</label>
    <div class="col-sm-1">
        <select name="pago" id="pago" style="padding:4px;" class="form-control">
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="quempagou" class="col-sm-2 col-form-label">Quem Pagou</label>
    <div class="col-sm-10">
        {!! Form::text('quempagou', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">

    <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">

        <select name="idFormaPagamento" id="idFormaPagamento" class="form-control col-sm-12 js-example-basic-multiple">
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
    <label for="conta" class="col-sm-1 col-form-label">Conta</label>
    <div class="col-sm-4">

    <select name="conta" id="conta" class="form-control col-sm-12  js-example-basic-multiple">
        @foreach ($listaContas as $contas)

        <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>

        @endforeach
    </select>
    </div>

</div>

<div class="form-group row">
    <label for="nRegistro" class="col-sm-2 col-form-label">N° Registro</label>
    <div class="col-sm-2">
        {!! Form::text('nRegistro', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>

    <label for="valorEstornado" class="col-sm-2 col-form-label">Valor Estornado</label>
    <div class="col-sm-2">
        <input type="text" id="valorEstornado" class="form-control" name="valorEstornado" value="{{$despesa->valorEstornado}}" placeholder="Preencha o valor estornado" /><br>

    </div>

    <label for="data" class="col-sm-1 col-form-label">Data Despesa</label>
    <div class="col-sm-3">
        {!! Form::date('data', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>


{!! Form::hidden('atuacao', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('excluidoDespesa', null, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}
{!! Form::hidden('precoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('totalPrecoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('totalPrecoReal', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('lucro', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}


{!! Form::hidden('ativoDespesa', null, ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
{!! Form::hidden('excluidoDespesa', null, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
