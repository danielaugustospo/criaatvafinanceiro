@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Cliente {{ $cliente->nomeCliente }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                    @can('cliente-edit')
                        <a class="btn btn-primary" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('cliente-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>

        </div>
    </div>
</div>


{!! Form::model($cliente, ['method' => 'PATCH','route' => ['clientes.update', $cliente->id] ]) !!}

<div class="form-group row">
    <label for="nomeCliente" class="col-sm-2 col-form-label">Nome Fantasia</label>
    <div class="col-sm-10">
        {!! Form::text('nomeCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="razaosocialCliente" class="col-sm-2 col-form-label">Razão Social</label>
    <div class="col-sm-10">
        {!! Form::text('razaosocialCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />

<!--CEP/Endereço-->
<h4>Localização</h4>
<div class="form-group row">
    <label for="cepCliente" class="col-sm-1 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::number('cepCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'cep', 'onblur' =>'pesquisacep(this.value)', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','readonly', 'maxlength' => '8']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="enderecoCliente" class="col-sm-1 col-form-label">Endereço</label>
    <div class="col-sm-5">
        {!! Form::text('enderecoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'endereco', 'readonly', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<!--Bairro/Cidade/Estado-->
<div class="form-group row">
    <label for="bairroCliente" class="col-sm-1 col-form-label">Bairro</label>
    <div class="col-sm-2">
        {!! Form::text('bairroCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'bairro', 'readonly', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="cidadeCliente" class="col-sm-1 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'cidade', 'readonly', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="estadoCliente" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('estadoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'uf', 'readonly', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>

<hr />
<h4>Contato</h4>
<!--1°Tel/2°Tel/Email-->
<div class="form-group row">
    <label for="telefone1Cliente" class="col-sm-1 col-form-label">1°Tel</label>
    <div class="col-sm-2">
        {!! Form::number('telefone1Cliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','readonly', 'maxlength' => '11']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="telefone2Cliente" class="col-sm-1 col-form-label">2°Tel</label>
    <div class="col-sm-2">
        {!! Form::number('telefone2Cliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','readonly', 'maxlength' => '11']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="emailCliente" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
        {!! Form::email('emailCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjCliente" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-2">
        {!! Form::number('cnpjCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','readonly', 'maxlength' => '14']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="inscEstadualCliente" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-6">
        {!! Form::text('inscEstadualCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '20']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfCliente" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-2">
        {!! Form::number('cpfCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','readonly', 'maxlength' => '11']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="identidadeCliente" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-3">
        {!! Form::number('identidadeCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','readonly', 'maxlength' => '10']) !!}
        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="dataCadastroCliente" class="col-sm-1 col-form-label">Data de Contrato</label>
    <div class="col-sm-2">
        {!! Form::text('dataCadastroCliente', null, ['placeholder' => 'Data Contrato', 'class' => 'form-control', 'readonly', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>

<!--Contato/Site-->
<div class="form-group row">
    <label for="contatoCliente" class="col-sm-1 col-form-label">Contato</label>
    <div class="col-sm-2">
        {!! Form::text('contatoCliente', null, ['placeholder' => 'Contato', 'class' => 'form-control', 'readonly', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="siteCliente" class="col-sm-1 col-form-label">Site</label>
    <div class="col-sm-6">
        {!! Form::text('siteCliente', null, ['placeholder' => 'Site', 'class' => 'form-control', 'readonly', 'maxlength' => '8']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>

</div>


<hr />
<h4>Dados Bancários</h4>

<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoCliente" class="col-sm-1 col-form-label">Banco Cliente</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('bancoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '10']) !!} -->
        <select class="selecionaComInput form-control" name="bancoCliente" id="bancoCliente" disabled>
            @foreach ($todososbancosCliente as $listabancos)

            <option value="{{$listabancos->id}}">
                {{$listabancos->nomeBanco}}
            </option>
            @endforeach

        </select>
        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="agenciaCliente" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
    <label for="nrcontaCliente" class="col-sm-2 col-form-label">Número Conta Cliente</label>
    <div class="col-sm-3">
        {!! Form::text('nrcontaCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '10']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>


    {!! Form::hidden('ativoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '10']) !!}
    {!! Form::hidden('excluidoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '10']) !!}


    <!-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!} -->
    {!! Form::close() !!}


     
    @endsection
