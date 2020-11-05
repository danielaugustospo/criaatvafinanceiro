@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Receita {{$receita->id}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('receita.index') }}"> Voltar</a>
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


{!! Form::model($receita, ['method' => 'PATCH','route' => ['receita.update', $receita->id]]) !!}

<div class="form-group row">
<label for="idOS" class="col-sm-2 col-form-label">Vincular a OS:</label>
<div class="col-sm-12 mb-3">
    <select name="idOS" id="idOS" class="selecionaComInput col-sm-12">
        @foreach ($todasOSAtivas as $listaOS)
        <option value="{{$listaOS->id}}">
            Código da OS: {{$listaOS->id}} - Evento: {{$listaOS->eventoOrdemdeServico}}
        </option>
        @endforeach
    </select>
</div>    
    <label for="dataemissaoreceita" class="col-sm-1 col-form-label">N° Registro</label>
    <div class="col-sm-4">
    {!! Form::text('registroreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}

    </div>


    <label for="datapagamentoreceita" class="col-sm-1 col-form-label">Data de Pagamento</label>
    <div class="col-sm-3">
        {!! Form::date('datapagamentoreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}
    </div>

    <label for="pagoreceita" class="col-sm-1 col-form-label">Pago</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('pagoreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <select name="pagoreceita" id="pagoreceita" style="padding:4px;" class="selecionaComInput form-control">
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>
</div>
<div class="form-group row">

    <label for="valorreceita" class="col-sm-1 col-form-label">Valor</label>
    <div class="col-sm-3">
        <input type="text" id="valorreceita" class="col-sm-8 form-control" name="valorreceita" value="{{ $receita->valorreceita }}" placeholder="Preencha o valor" /><br>
    </div>
    <label for="idFormaPagamento" class="col-sm-1 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">
        <select name="idformapagamentoreceita" id="idFormaPagamentoReceita" class="selecionaComInput form-control col-sm-10 js-example-basic-multiple">
            @foreach ($listametodopagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
    <label for="contareceita" class="col-sm-1 col-form-label">Conta</label>
    <div class="col-sm-2">

        <select name="contareceita" id="contaReceita" class="selecionaComInput col-sm-12 form-control js-example-basic-multiple">
            @foreach ($listaContas as $contas)
                <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>
            @endforeach
        </select>
    </div>

</div>


<input type="hidden" id="emissaoreceita" class="col-sm-8 form-control" value="{{$receita->emissaoreceita}}" name="emissaoreceita" placeholder="Emissão" /><br>

{!! Form::hidden('dataemissaoreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}

{!! Form::hidden('idosreceita', 'null', ['placeholder' => 'Id OS Receita', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idosreceita']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}

{!! Form::close() !!}

 
@endsection
