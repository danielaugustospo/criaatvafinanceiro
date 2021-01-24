@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Despesa {{ $despesa->descricaoDespesa }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('despesas.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('despesas.destroy',$despesa->id) }}" method="POST">
                @can('despesa-edit')
                <a class="btn btn-primary" href="{{ route('despesas.edit',$despesa->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('despesa-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>

        </div>
    </div>
</div>


{!! Form::model($despesa, ['method' => 'PATCH','route' => ['despesas.update', $despesa->id]]) !!}

<div class="form-group row">
    <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoDespesa', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-4">
        <select name="idCodigoDespesas" id="idCodigoDespesas" disabled class="col-sm-12">
            @foreach ($codigoDespesa as $listaCodigoDespesas)
            <option value="{{$listaCodigoDespesas->id}}">
                Cód Despesa: {{$listaCodigoDespesas->idGrupoCodigoDespesa}} - Tipo: {{$listaCodigoDespesas->despesaCodigoDespesa}}
            </option>
            @endforeach
        </select>
    </div>

    <label for="idOS" class="col-sm-2 col-form-label">Vincular a OS</label>
    <div class="col-sm-4">

        <select name="idOS" id="idOS" disabled class="col-sm-12">
            @foreach ($todasOSAtivas as $listaOS)
            <option value="{{$listaOS->id}}">
                Cód OS: {{$listaOS->id}} - Evento: {{$listaOS->eventoOrdemdeServico}}
            </option>
            @endforeach
        </select>

    </div>
</div>
<div class="form-group row">
    <label for="despesaCodigoDespesas" class="col-sm-2 col-form-label">Informação da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('despesaCodigoDespesas', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idFornecedor" class="col-sm-2 col-form-label">Fornecedor</label>
    <div class="col-sm-10">

        <select name="idFornecedor" id="idFornecedor" disabled class="form-control">
            @foreach ($listaForncedores as $fornecedor)
            <option value="{{ $fornecedor->id }}">Nome: {{ $fornecedor->nomeFornecedor }} - Razão Social: {{ $fornecedor->razaosocialFornecedor }} - Contato: {{ $fornecedor->contatoFornecedor }}</option>
            @endforeach
        </select>

    </div>
</div>
<div class="form-group row">

    <label for="precoReal" class="col-sm-2 col-form-label">Preço Real</label>
    <div class="col-sm-2">
        <input type="text" id="precoReal" class="form-control" name="precoReal" value="{{$despesa->precoReal}}" placeholder="Preencha o preço real" readonly /><br>
    </div>
    <label for="ativoDespesa" class="col-sm-1 col-form-label">Ativação</label>
    <div class="col-sm-1">
        <select name="ativoDespesa" id="ativoDespesa" disabled style="padding:4px;" class="form-control">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
    </div>

    <label for="pago" class="col-sm-1 col-form-label">Pago</label>
    <div class="col-sm-1">
        <select name="pago" id="pago" disabled style="padding:4px;" class="form-control">
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="quempagou" class="col-sm-2 col-form-label">Quem Pagou</label>
    <div class="col-sm-10">
        {!! Form::text('quempagou', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>
</div>
<div class="form-group row">

    <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">

        <select name="idFormaPagamento" id="idFormaPagamento" disabled class="form-control col-sm-12 js-example-basic-multiple">
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
    <label for="conta" class="col-sm-1 col-form-label">Conta</label>
    <div class="col-sm-4">

        <select name="conta" id="conta" disabled class="form-control col-sm-12  js-example-basic-multiple">
            @foreach ($listaContas as $contas)
            <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>
            @endforeach
        </select>
    </div>

</div>

<div class="form-group row">
    <label for="nRegistro" readonly class="col-sm-2 col-form-label">N° Registro</label>
    <div class="col-sm-2">
        {!! Form::text('nRegistro', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>

    <label for="valorEstornado" class="col-sm-2 col-form-label">Valor Estornado</label>
    <div class="col-sm-2">
        <input type="text" id="valorEstornado" class="form-control" name="valorEstornado" value="{{$despesa->valorEstornado}}" placeholder="Preencha o valor estornado" readonly /><br>
    </div>

    <label for="vencimento" class="col-sm-1 col-form-label">Vencimento</label>
    <div class="col-sm-3">
        {!! Form::date('vencimento', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>
</div>




@endsection