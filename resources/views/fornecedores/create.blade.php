@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Fornecedor</h2>
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



{!! Form::open(array('route' => 'fornecedores.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeFornecedor" class="col-sm-2 col-form-label">Nome do Fornecedor</label>
    <div class="col-sm-10">
        {!! Form::text('nomeFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="razaosocialFornecedor" class="col-sm-2 col-form-label">Razão Social</label>
    <div class="col-sm-10">
        {!! Form::text('razaosocialFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />
<h4>Localização</h4>

<!--CEP/Endereço-->
<div class="form-group row">
    <label for="cepFornecedor" class="col-sm-1 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'cep', 'onblur' =>'pesquisacep(this.value)' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="enderecoFornecedor" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-7">
        {!! Form::text('enderecoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control','id' => 'endereco', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Bairro/Cidade/Estado-->
<div class="form-group row">
    <label for="bairroFornecedor" class="col-sm-1 col-form-label">Bairro</label>
    <div class="col-sm-2">
        {!! Form::text('bairroFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'bairro', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cidadeFornecedor" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'cidade', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="estadoFornecedor" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('estadoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control','id' => 'uf', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />
<h4>Contato</h4>

<!--1°Tel/2°Tel/Email-->
<div class="form-group row">
    <label for="telefone1Fornecedor" class="col-sm-1 col-form-label">1°Tel</label>
    <div class="col-sm-3">
        {!! Form::number('telefone1Fornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="telefone2Fornecedor" class="col-sm-1 col-form-label">2°Tel</label>
    <div class="col-sm-3">
        {!! Form::number('telefone2Fornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="emailFornecedor" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
        {!! Form::text('emailFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjFornecedor" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-3">
        {!! Form::number('cnpjFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','max' => '14' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="inscEstadualFornecedor" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-3">
        {!! Form::text('inscEstadualFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfFornecedor" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-3">
        {!! Form::number('cpfFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="identidadeFornecedor" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-3">
        {!! Form::text('identidadeFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Contato/Site-->
<div class="form-group row">
    <label for="contatoFornecedor" class="col-sm-1 col-form-label">Contato</label>
    <div class="col-sm-3">
        {!! Form::text('contatoFornecedor', '', ['placeholder' => 'Contato', 'class' => 'form-control', 'maxlength' => '8' ]) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="siteFornecedor" class="col-sm-1 col-form-label">Site</label>
    <div class="col-sm-3">
        {!! Form::text('siteFornecedor', '', ['placeholder' => 'Site', 'class' => 'form-control', 'maxlength' => '8' ]) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="dataCadastroFornecedor" class="col-sm-1 col-form-label">Data de Contrato</label>
    <div class="col-sm-3">
        {!! Form::text('dataCadastroFornecedor', '', ['placeholder' => 'Data Contrato', 'class' => 'form-control', 'maxlength' => '8' ]) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>


<hr />
<h4>Dados Bancários</h4>


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoFornecedor" class="col-sm-2 col-form-label">Banco Fornecedor</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('bancoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10'  ]) !!} -->

        <select class="selecionaComInput form-control" name="bancoFornecedor" id="bancoFornecedor">
            @foreach ($todososbancos as $listabancos)

            <option value="{{$listabancos->id}}">
                {{$listabancos->nomeBanco}}
            </option>
            @endforeach

        </select>
        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="nrcontaFornecedor" class="col-sm-2 col-form-label">Número Conta Fornecedor</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoFavorecidoFornecedor" class="col-sm-2 col-form-label">Banco Favorecido Fornecedor</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('bancoFavorecidoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10'  ]) !!} -->

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->

        <select class="selecionaComInput form-control" name="bancoFavorecidoFornecedor" id="bancoFavorecidoFornecedor">
            <option value="0000">Não possui Favorecido</option>
            @foreach ($todososbancos as $listabancos)
            <option value="{{$listabancos->id}}">
                {{$listabancos->nomeBanco}}
            </option>
            @endforeach
        </select>

    </div>
    <label for="agenciafavorecidoFornecedor" class="col-sm-1 col-form-label">Agência Favorecido</label>
    <div class="col-sm-2">
        {!! Form::text('agenciafavorecidoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="contacorrentefavorecidoFornecedor" class="col-sm-1 col-form-label">Número Conta Favorecido Fornecedor</label>
    <div class="col-sm-3">
        {!! Form::text('contacorrentefavorecidoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="nomefavorecidoFornecedor" class="col-sm-2 col-form-label">Nome Completo Favorecido Fornecedor</label>
    <div class="col-sm-4">
        {!! Form::text('nomefavorecidoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control col-sm-12', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cpffavorecidoFornecedor" class="col-sm-2 col-form-label">CNPJ/CNPJ Favorecido Fornecedor</label>
    <div class="col-sm-4">
        {!! Form::number('cpffavorecidoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'max' => '14' ]) !!}
    </div>

    {!! Form::hidden('ativoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
    {!! Form::hidden('excluidoFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}


    {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
    {!! Form::close() !!}



    @endsection


    <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
    <style>
        .valido {
            border: 1px solid green;
        }

        .invalido {
            border: 1px solid red;
        }
    </style>
