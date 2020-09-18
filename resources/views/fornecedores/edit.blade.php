@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Forncedor {{$fornecedor->nomeFornecedor}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('fornecedores.index') }}"> Voltar</a>
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


{!! Form::model($fornecedor, ['method' => 'PATCH','route' => ['fornecedores.update', $fornecedor->id]]) !!}


<div class="form-group row">
    <label for="nomeFornecedor" class="col-sm-2 col-form-label">Nome do Fornecedor</label>
    <div class="col-sm-10">
        {!! Form::text('nomeFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="razaosocialFornecedor" class="col-sm-2 col-form-label">Razão Social</label>
    <div class="col-sm-10">
        {!! Form::text('razaosocialFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />

<!--CEP/Endereço-->
<div class="form-group row">
    <label for="cepFornecedor" class="col-sm-1 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="enderecoFornecedor" class="col-sm-1 col-form-label">Endereço</label>
    <div class="col-sm-6">
        {!! Form::text('enderecoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Bairro/Cidade/Estado-->
<div class="form-group row">
    <label for="bairroFornecedor" class="col-sm-1 col-form-label">Bairro</label>
    <div class="col-sm-2">
        {!! Form::text('bairroFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cidadeFornecedor" class="col-sm-1 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="estadoFornecedor" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('estadoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />

<!--1°Tel/2°Tel/Email-->
<div class="form-group row">
    <label for="telefone1Fornecedor" class="col-sm-1 col-form-label">1°Tel</label>
    <div class="col-sm-2">
        {!! Form::text('telefone1Fornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="telefone2Fornecedor" class="col-sm-1 col-form-label">2°Tel</label>
    <div class="col-sm-2">
        {!! Form::text('telefone2Fornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="emailFornecedor" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
        {!! Form::text('emailFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjFornecedor" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-2">
        {!! Form::text('cnpjFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="inscEstadualFornecedor" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-6">
        {!! Form::text('inscEstadualFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfFornecedor" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-2">
        {!! Form::text('cpfFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="identidadeFornecedor" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-6">
        {!! Form::text('identidadeFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Contato/Site-->
<div class="form-group row">
    <label for="contatoFornecedor" class="col-sm-1 col-form-label">Contato</label>
    <div class="col-sm-2">
        {!! Form::text('contatoFornecedor', null, ['placeholder' => 'Contato', 'class' => 'form-control', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="siteFornecedor" class="col-sm-1 col-form-label">Site</label>
    <div class="col-sm-4">
        {!! Form::text('siteFornecedor', null, ['placeholder' => 'Site', 'class' => 'form-control', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="dataCadastroFornecedor" class="col-sm-1 col-form-label">Data de Contrato</label>
    <div class="col-sm-2">
        {!! Form::text('dataCadastroFornecedor', null, ['placeholder' => 'Data Contrato', 'class' => 'form-control', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>


<hr />


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoFornecedor" class="col-sm-1 col-form-label">Banco Fornecedor</label>
    <div class="col-sm-2">
        {!! Form::text('bancoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="nrcontaFornecedor" class="col-sm-2 col-form-label">Número Conta Fornecedor</label>
    <div class="col-sm-3">
        {!! Form::text('nrcontaFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoFavorecidoFornecedor" class="col-sm-1 col-form-label">Banco Favorecido Fornecedor</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('bancoFavorecidoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!} -->

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->

    <select class="form-control" name="bancoFavorecidoFornecedor" id="bancoFavorecidoFornecedor">
                @foreach ($todososbancos as $listabancos)

                <option value="{{$listabancos->id}}">
                    {{$listabancos->nomeBanco}}
                </option>
                @endforeach

    </select>

    </div>
    <label for="agenciafavorecidoFornecedor" class="col-sm-1 col-form-label">Agência Favorecido</label>
    <div class="col-sm-2">
        {!! Form::text('agenciafavorecidoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="contacorrentefavorecidoFornecedor" class="col-sm-2 col-form-label">Número Conta Favorecido Fornecedor</label>
    <div class="col-sm-3">
        {!! Form::text('contacorrentefavorecidoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="nomefavorecidoFornecedor" class="col-sm-1 col-form-label">Nome Completo Favorecido Fornecedor</label>
    <div class="col-sm-4">
        {!! Form::text('nomefavorecidoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cpffavorecidoFornecedor" class="col-sm-2 col-form-label">CNPJ/CNPJ Favorecido Fornecedor</label>
    <div class="col-sm-4">
        {!! Form::text('cpffavorecidoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

</div>

{!! Form::hidden('ativoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}



{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
