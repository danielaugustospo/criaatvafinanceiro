@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Cliente</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Voltar</a>
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



{!! Form::open(array('route' => 'clientes.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeCliente" class="col-sm-2 col-form-label">Nome do Cliente</label>
    <div class="col-sm-10">
        {!! Form::text('nomeCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="razaosocialCliente" class="col-sm-2 col-form-label">Razão Social</label>
    <div class="col-sm-10">
        {!! Form::text('razaosocialCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />

<!--CEP/Endereço-->
<div class="form-group row">
    <label for="cepCliente" class="col-sm-1 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="enderecoCliente" class="col-sm-1 col-form-label">Endereço</label>
    <div class="col-sm-6">
        {!! Form::text('enderecoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Bairro/Cidade/Estado-->
<div class="form-group row">
    <label for="bairroCliente" class="col-sm-1 col-form-label">Bairro</label>
    <div class="col-sm-2">
        {!! Form::text('bairroCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cidadeCliente" class="col-sm-1 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="estadoCliente" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('estadoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />

<!--1°Tel/2°Tel/Email-->
<div class="form-group row">
    <label for="telefone1Cliente" class="col-sm-1 col-form-label">1°Tel</label>
    <div class="col-sm-2">
        {!! Form::text('telefone1Cliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="telefone2Cliente" class="col-sm-1 col-form-label">2°Tel</label>
    <div class="col-sm-2">
        {!! Form::text('telefone2Cliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="emailCliente" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
        {!! Form::text('emailCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjCliente" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-2">
        {!! Form::text('cnpjCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="inscEstadualCliente" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-6">
        {!! Form::text('inscEstadualCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfCliente" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-2">
        {!! Form::text('cpfCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="identidadeCliente" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-6">
        {!! Form::text('identidadeCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Contato/Site-->
<div class="form-group row">
    <label for="contatoCliente" class="col-sm-1 col-form-label">Contato</label>
    <div class="col-sm-2">
        {!! Form::text('contatoCliente', '', ['placeholder' => 'Contato', 'class' => 'form-control', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="siteCliente" class="col-sm-1 col-form-label">Site</label>
    <div class="col-sm-4">
        {!! Form::text('siteCliente', '', ['placeholder' => 'Site', 'class' => 'form-control', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="dataCadastroCliente" class="col-sm-1 col-form-label">Data de Contrato</label>
    <div class="col-sm-2">
        {!! Form::text('dataCadastroCliente', '', ['placeholder' => 'Data Contrato', 'class' => 'form-control', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>


<hr />


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoCliente" class="col-sm-1 col-form-label">Banco Cliente</label>
    <div class="col-sm-2">
        {!! Form::text('bancoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="agenciaCliente" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="nrcontaCliente" class="col-sm-2 col-form-label">Número Conta Cliente</label>
    <div class="col-sm-3">
        {!! Form::text('nrcontaCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoFavorecidoCliente" class="col-sm-1 col-form-label">Banco Favorecido Cliente</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('bancoFavorecidoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!} -->

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->

    <select class="form-control" name="bancoFavorecidoCliente" id="bancoFavorecidoCliente">
                @foreach ($todososbancos as $listabancos)

                <option value="{{$listabancos->id}}">
                    {{$listabancos->nomeBanco}}
                </option>
                @endforeach

    </select>

    </div>
    <label for="agenciafavorecidoCliente" class="col-sm-1 col-form-label">Agência Favorecido</label>
    <div class="col-sm-2">
        {!! Form::text('agenciafavorecidoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="contacorrentefavorecidoCliente" class="col-sm-2 col-form-label">Número Conta Favorecido Cliente</label>
    <div class="col-sm-3">
        {!! Form::text('contacorrentefavorecidoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="nomefavorecidoCliente" class="col-sm-1 col-form-label">Nome Completo Favorecido Cliente</label>
    <div class="col-sm-4">
        {!! Form::text('nomefavorecidoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cpffavorecidoCliente" class="col-sm-2 col-form-label">CNPJ/CNPJ Favorecido Cliente</label>
    <div class="col-sm-4">
        {!! Form::text('cpffavorecidoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

</div>

{!! Form::hidden('ativoCliente', '1', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoCliente', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>




@endsection
