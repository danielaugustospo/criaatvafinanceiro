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
    $(document).ready(function() {
        $(".padraoReal").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
</script>
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


<!-- Seção Despesas -->


<div class="form-group row">
    <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoDespesa', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('idCodigoDespesas', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->

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
        {!! Form::text('despesaCodigoDespesas', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

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

    <label for="precoCliente" class="col-sm-2 col-form-label">Preço Cliente</label>
    <div class="col-sm-2">
        <input type="text" id="precoCliente" class="padraoReal form-control" name="precoCliente" value="0,00" placeholder="Preencha o preço cliente" /><br>

    </div>
    <label for="precoCliente" class="col-sm-1 col-form-label">Ativação</label>
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
        {!! Form::text('quempagou', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

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
        {!! Form::text('nRegistro', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>

    <label for="valorEstornado" class="col-sm-2 col-form-label">Valor Estornado</label>
    <div class="col-sm-2">
        <input type="text" id="valorEstornado" class="padraoReal form-control" name="valorEstornado" value="0,00" placeholder="Preencha o valor estornado" /><br>

    </div>

    <label for="data" class="col-sm-1 col-form-label">Data Despesa</label>
    <div class="col-sm-3">
        {!! Form::date('data', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>


{!! Form::hidden('atuacao', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}
{!! Form::hidden('precoReal', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('totalPrecoCliente', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('totalPrecoReal', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('lucro', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}


{!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
{!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>


@endsection
