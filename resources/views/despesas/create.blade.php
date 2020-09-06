
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Despesas</h2>
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




{!! Form::open(array('route' => 'despesas.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoDespesa', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('idCodigoDespesas', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idOS" class="col-sm-2 col-form-label">OS Vinculada a Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('idOS', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="despesaCodigoDespesas" class="col-sm-2 col-form-label">Código Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('despesaCodigoDespesas', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idFornecedor" class="col-sm-2 col-form-label">Fornecedor</label>
    <div class="col-sm-10">
        {!! Form::text('idFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="precoReal" class="col-sm-2 col-form-label">Preço Real</label>
    <div class="col-sm-10">
        {!! Form::text('precoReal', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="atuacao" class="col-sm-2 col-form-label">Atuação</label>
    <div class="col-sm-10">
        {!! Form::text('atuacao', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="precoCliente" class="col-sm-2 col-form-label">Preço Cliente</label>
    <div class="col-sm-10">
        {!! Form::text('precoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="pago" class="col-sm-2 col-form-label">Pago</label>
    <div class="col-sm-10">
        {!! Form::text('pago', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="quempagou" class="col-sm-2 col-form-label">Quem Pagou</label>
    <div class="col-sm-10">
        {!! Form::text('quempagou', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-10">
        {!! Form::text('idFormaPagamento', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="conta" class="col-sm-2 col-form-label">Conta</label>
    <div class="col-sm-10">
        <!-- {!! Form::text('conta', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <select name="conta" class="form-control">
        @foreach ($listaContas as $contas)

            <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>

       @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="nRegistro" class="col-sm-2 col-form-label">N° Registro</label>
    <div class="col-sm-10">
        {!! Form::text('nRegistro', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="valorEstornado" class="col-sm-2 col-form-label">Valor Estornado</label>
    <div class="col-sm-10">
        {!! Form::text('valorEstornado', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="data" class="col-sm-2 col-form-label">Data</label>
    <div class="col-sm-10">
        {!! Form::text('data', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="totalPrecoReal" class="col-sm-2 col-form-label">Total Preço Real</label>
    <div class="col-sm-10">
        {!! Form::text('totalPrecoReal', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="totalPrecoCliente" class="col-sm-2 col-form-label">Total Preço Cliente</label>
    <div class="col-sm-10">
        {!! Form::text('totalPrecoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="lucro" class="col-sm-2 col-form-label">Lucro</label>
    <div class="col-sm-10">
        {!! Form::text('lucro', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>







{!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
{!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>




@endsection
