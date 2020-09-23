@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Receita Id: {{ $receita->id }} - OS Associada: {{ $receita->idosreceita }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('receita.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('receita.destroy',$receita->id) }}" method="POST">
                @can('receita-edit')
                <a class="btn btn-primary" href="{{ route('receita.edit',$receita->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('receita-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>

        </div>
    </div>
</div>


{!! Form::model($receita, ['method' => 'PATCH','route' => ['receita.update', $receita->id]]) !!}

<div class="form-group row">
    <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-3">
        <select name="idformapagamentoreceita" id="idFormaPagamentoReceita" class="form-control col-sm-8 js-example-basic-multiple" disabled>
            <option value="0" selected="selected">Sem Receita</option>
            @foreach ($listametodopagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>

    <label for="datapagamentoreceita" class="col-sm-1 col-form-label">Data de Pagamento</label>
    <div class="col-sm-3">
        {!! Form::date('datapagamentoreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>

    <label for="pagoreceita" class="col-sm-1 col-form-label">Pago</label>
    <div class="col-sm-2">
        {!! Form::text('pagoreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>
</div>
<div class="form-group row">

    <label for="dataemissaoreceita" class="col-sm-2 col-form-label">Data de Emissão</label>
    <div class="col-sm-3">
        {!! Form::date('dataemissaoreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>
    <label for="valorreceita" class="col-sm-1 col-form-label">Valor</label>
    <div class="col-sm-3">
        <input type="text" id="valorreceita" class="col-sm-8 form-control" name="valorreceita" value="{{ $receita->valorreceita }}" placeholder="Preencha o valor" readonly/><br>
    </div>

    <label for="contareceita" class="col-sm-1 col-form-label">Conta</label>
    <div class="col-sm-2">

        <select name="contareceita" id="contaReceita" class="col-sm-12 form-control js-example-basic-multiple" disabled>
            @foreach ($listaContas as $contas)

            <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>

            @endforeach
        </select>
    </div>

</div>



<div class="form-group row">
    <label for="registroreceita" class="col-sm-2 col-form-label">N° Registro</label>
    <div class="col-sm-3">
        {!! Form::text('registroreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>

    <label for="emissaoreceita" class="col-sm-1 col-form-label">Emissão</label>
    <div class="col-sm-3">
        <input type="text" id="emissaoreceita" class="col-sm-8 form-control" name="emissaoreceita" placeholder="Emissão" readonly/><br>
    </div>

    <label for="nfreceita" class="col-sm-1 col-form-label">NF</label>
    <div class="col-sm-2">
        {!! Form::text('nfreceita', null, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>
</div>

{!! Form::close() !!}



 
@endsection
