@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Contas Bancárias</h2>
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
    <label for="nomeBanco" class="col-sm-2 col-form-label">Agência Conta</label>
    <div class="col-sm-10">
        {!! Form::text('agenciaConta', '', ['placeholder' => 'Agência Conta', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="codigoBanco" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('numeroConta', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'numeroConta']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>

<div class="form-group row">
    <label for="codigoBanco" class="col-sm-2 col-form-label">Selcione o Banco</label>
    <div class="col-sm-12">
        <!-- {!! Form::text('idBanco', '', ['placeholder' => 'Id Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'idBanco']) !!} -->
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
        <select class="selecionaComInput form-control" name="idBanco" id="idBanco">
            @foreach ($banco as $dadosBanco)

            <option value="{{ $dadosBanco->id }}">Código: {{ $dadosBanco->codigoBanco }} - Banco: {{ $dadosBanco->nomeBanco }}</option>
            @endforeach

        </select>
    </div>
</div>

{!! Form::hidden('ativoConta', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoConta']) !!}
{!! Form::hidden('excluidoConta', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoConta']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

 




@endsection
