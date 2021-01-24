@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Fornecedor {{$fornecedor->nomeFornecedor}}</h2>
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
    <label for="nomeFornecedor" class="col-sm-2 col-form-label">Nome Fantasia</label>
    <div class="col-sm-10">
        {!! Form::text('nomeFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="razaosocialFornecedor" class="col-sm-2 col-form-label">Razão Social</label>
    <div class="col-sm-10">
        {!! Form::text('razaosocialFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />
<h4>Localização</h4>

<!--CEP/Endereço-->
<div class="form-group row">
    <label for="cepFornecedor" class="col-sm-1 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', 'id' => 'cep', 'onblur' =>'pesquisacep(this.value)' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="enderecoFornecedor" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-7">
        {!! Form::text('enderecoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control','id' => 'endereco', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Bairro/Cidade/Estado-->
<div class="form-group row">
    <label for="bairroFornecedor" class="col-sm-1 col-form-label">Bairro</label>
    <div class="col-sm-2">
        {!! Form::text('bairroFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'bairro', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cidadeFornecedor" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'cidade', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="estadoFornecedor" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('estadoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control','id' => 'uf', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />
<h4>Contato</h4>

<!--1°Tel/2°Tel/Email-->
<div class="form-group row">
    <label for="telefone1Fornecedor" class="col-sm-1 col-form-label">1°Tel</label>
    <div class="col-sm-3">
        {!! Form::number('telefone1Fornecedor', null, ['placeholder' => 'DDD + Telefone', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="telefone2Fornecedor" class="col-sm-1 col-form-label">2°Tel</label>
    <div class="col-sm-3">
        {!! Form::number('telefone2Fornecedor', null, ['placeholder' => 'DDD + Telefone', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="emailFornecedor" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
        {!! Form::email('emailFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjFornecedor" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-3">
        {!! Form::number('cnpjFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '14' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="inscEstadualFornecedor" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-3">
        {!! Form::text('inscEstadualFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfFornecedor" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-3">
        {!! Form::number('cpfFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="identidadeFornecedor" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-3">
        {!! Form::text('identidadeFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '13' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Contato/Site-->
<div class="form-group row">
    <label for="contatoFornecedor" class="col-sm-1 col-form-label">Contato</label>
    <div class="col-sm-3">
        {!! Form::text('contatoFornecedor', null, ['placeholder' => 'Contato', 'class' => 'form-control', 'maxlength' => '8' ]) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="siteFornecedor" class="col-sm-1 col-form-label">Site</label>
    <div class="col-sm-3">
        {!! Form::text('siteFornecedor', null, ['placeholder' => 'Site', 'class' => 'form-control', 'maxlength' => '8' ]) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="dataCadastroFornecedor" class="col-sm-1 col-form-label">Data de Contrato</label>
    <div class="col-sm-3">
        {!! Form::text('dataCadastroFornecedor', null, ['placeholder' => 'Data Contrato', 'class' => 'form-control', 'maxlength' => '8' ]) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>


<hr />
<h4>Dados Bancários</h4>


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoFornecedor" class="col-sm-2 col-form-label">Banco Fornecedor</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('bancoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10'  ]) !!} -->

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
        {!! Form::text('agenciaFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="nrcontaFornecedor" class="col-sm-2 col-form-label">Número Conta Fornecedor</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10' ]) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="d-flex justify-content-center">
        <img src="../../img/logo_pix.png" class="mb-3" width="200px;" alt="">
    </div>
<div class="form-group row">

    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 1</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix1Fornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25' ]) !!}
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 2</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix2Fornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25' ]) !!}
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 3</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix3Fornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25' ]) !!}
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 4</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix4Fornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25' ]) !!}
    </div>

</div>


{!! Form::hidden('ativoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoFornecedor', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}

<button class="btn btn-success btn-sm" type="submit">Salvar</button>

{!! Form::close() !!}

@endsection