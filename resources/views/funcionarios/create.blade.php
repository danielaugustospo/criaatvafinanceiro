@extends('layouts.app')


@section('content')

{!! Form::open(array('route' => 'funcionarios.store','method'=>'POST', 'enctype'=>'multipart/form-data' )) !!}

<div class="col-lg-12 margin-tb">
    <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
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


<div class="form-group row col-lg-12 mt-4">

    <h2 class="col-lg-4 pl-0">Cadastro de Funcionário</h2>
    <div class="col-lg-8 d-flex justify-content-end">
        <label class="col-sm-3 col-form-label pr-2">Cadastrar Foto</label>
        <input type="file" class="form-control-file btn btn-secondary col-sm-6" name="fotoFuncionario" name="fotoFuncionario">
    </div>

</div>


<div class="form-group row">
    <label for="nomeFuncionario" class="col-sm-2 col-form-label">Nome Completo do Funcionário</label>
    <div class="col-sm-10">
        {!! Form::text('nomeFuncionario', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'required']) !!}
    </div>

        <!-- <input type="text" class="form-control" nome="nomeFuncionario" id="nomeFuncionario" placeholder="Nome do Funcionário"> -->
</div>
<div class="form-group row">
    <label for="cepFuncionario" class="col-sm-2 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepFuncionario', '', ['placeholder' => 'CEP', 'class' => 'form-control', 'maxlength' => '8', 'required', 'id' => 'cep','onblur' =>'pesquisacep(this.value)']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="enderecoFuncionario" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-6">
        {!! Form::text('enderecoFuncionario', '', ['placeholder' => 'Endereço', 'class' => 'form-control', 'id' => 'endereco', 'maxlength' => '100']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="bairroFuncionario" class="col-sm-2 col-form-label">Bairro</label>
    <div class="col-sm-3">
        {!! Form::text('bairroFuncionario', '', ['placeholder' => 'Bairro', 'class' => 'form-control', 'id' => 'bairro', 'maxlength' => '30', 'readonly']) !!}
        <!-- <input type="text" class="form-control" id="bairroFuncionario" placeholder="Bairro"> -->
    </div>
    <label for="cidadeFuncionario" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeFuncionario', '', ['placeholder' => 'Cidade', 'class' => 'form-control', 'id' => 'cidade', 'maxlength' => '30', 'readonly']) !!}
        <!-- <input type="text" class="form-control" id="cidadeFuncionario" placeholder="Cidade"> -->
    </div>
    <label for="ufFuncionario" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('ufFuncionario', '', ['placeholder' => 'Estado', 'class' => 'form-control', 'id' => 'uf', 'maxlength' => '3', 'readonly']) !!}
        <!-- <input type="text" class="form-control" id="ufFuncionario" placeholder="UF"> -->
    </div>
</div>
<hr>
<h2>Contato</h2>
<div class="form-group row ">
    <label for="celularFuncionario" class="col-sm-2 col-form-label">Celular</label>
    <div class="col-sm-2">
        {!! Form::number('celularFuncionario', '219xxxxxxxx', ['placeholder' => 'Celular', 'class' => 'form-control', 'required', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11']) !!}
        <!-- <input type="text" class="form-control" id="celularFuncionario" placeholder="Celular"> -->
    </div>
    <label for="telresidenciaFuncionario" class="col-sm-2 col-form-label">Telefone Residência</label>
    <div class="col-sm-2">
        {!! Form::number('telresidenciaFuncionario', '21xxxxxxxx', ['placeholder' => 'Tel Residência', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '10']) !!}
        <!-- <input type="text" class="form-control" id="telresidenciaFuncionario" placeholder="Telefone Residência"> -->
    </div>
    <label for="contatoemergenciaFuncionario" class="col-sm-2 col-form-label">Contato Emergência</label>
    <div class="col-sm-2">
        {!! Form::number('contatoemergenciaFuncionario', '21xxxxxxxx', ['placeholder' => 'Contato Emergência', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '10']) !!}
        <!-- <input type="text" class="form-control" id="telresidenciaFuncionario" placeholder="Telefone Residência"> -->
    </div>

</div>
<div class="form-group row ">
    <label for="emailFuncionario" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
        {!! Form::email('emailFuncionario', null, ['placeholder' => 'E-mail', 'class' => 'form-control']) !!}
        <!-- <input type="email" class="form-control" id="emailFuncionario" placeholder="Email"> -->
    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Rede Social</label>
    <div class="col-sm-4">
        {!! Form::text('redesocialFuncionario', '', ['placeholder' => 'Rede Social', 'class' => 'form-control', 'maxlength' => '20']) !!}
        <!-- <input type="text" class="form-control" id="redesocialFuncionario" placeholder="Rede Social"> -->
    </div>

</div>
<div class="form-group row ">
    <label for="facebookFuncionario" class="col-sm-2 col-form-label">Facebook</label>
    <div class="col-sm-4">
        {!! Form::text('facebookFuncionario', null, ['placeholder' => 'Facebook', 'class' => 'form-control']) !!}
        <!-- <input type="email" class="form-control" id="emailFuncionario" placeholder="Email"> -->
    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Telegram</label>
    <div class="col-sm-4">
        {!! Form::text('telegramFuncionario', '', ['placeholder' => 'Telegram', 'class' => 'form-control', 'maxlength' => '20']) !!}
        <!-- <input type="text" class="form-control" id="redesocialFuncionario" placeholder="Rede Social"> -->
    </div>

</div>
<hr>
<h2>Documentação do Funcionário</h2>
<div class="form-group row ">
    <label for="cpfFuncionario" class="col-sm-2 col-form-label">CPF</label>
    <div class="col-sm-4">
        {!! Form::number('cpfFuncionario', '', ['placeholder' => 'CPF (somente números)', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' , 'required']) !!}
        <!-- <input type="text" class="form-control" id="cpfFuncionario" placeholder="CPF"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="rgFuncionario" class="col-sm-2 col-form-label">RG</label>
    <div class="col-sm-4">
        {!! Form::text('rgFuncionario', '', ['placeholder' => 'RG (somente números)', 'class' => 'form-control', 'maxlength' => '11']) !!}
        <!-- <input type="text" class="form-control" id="rgFuncionario" placeholder="RG"> -->
    </div>
    <label for="orgaoRGFuncionario" class="col-sm-2 col-form-label">Órgão Emissor</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('orgaoRGFuncionario', '', ['placeholder' => 'Orgão RG', 'class' => 'form-control', 'maxlength' => '11', 'list' => 'emissoresrg']) !!} -->
        <!-- <input type="text" class="form-control" id="orgaoRGFuncionario" placeholder="Orgão RG"> -->
        <select class="selecionaComInput form-control" name="orgaoRGFuncionario">
            @foreach ($todosorgaosrg as $listarg)
            <option value="{{$listarg->id}}">{{$listarg->nome}}</option>
            @endforeach
        </select>
    </div>
    <label for="expedicaoRGFuncionario" class="col-sm-2 col-form-label">Data de Emissão</label>
    <div class="col-sm-4">
        {!! Form::date('expedicaoRGFuncionario', null, ['class' => 'form-control']) !!}
        <!-- {!! Form::date('expedicaoRGFuncionario', \Carbon\Carbon::now() , ['class' => 'form-control']) !!} -->
        <!-- {!! Form::text('expedicaoRGFuncionario', '', ['placeholder' => 'Data Expedição RG', 'class' => 'form-control', 'maxlength' => '11']) !!} -->
        <!-- <input type="text" class="form-control" id="expedicaoRGFuncionario" placeholder="Data Expedição RG"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="tituloFuncionario" class="col-sm-2 col-form-label">Título de Eleitor</label>
    <div class="col-sm-4">
        {!! Form::number('tituloFuncionario', '', ['placeholder' => 'Título de Eleitor', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '12']) !!}
        <!-- <input type="text" class="form-control" id="tituloFuncionario" placeholder="Título de Eleitor"> -->
    </div>
</div>
<hr>
<h2>Filiação</h2>
<div class="form-group row ">
    <label for="maeFuncionario" class="col-sm-2 col-form-label">Mãe</label>
    <div class="col-sm-8">
        {!! Form::text('maeFuncionario', '', ['placeholder' => 'Mãe', 'class' => 'form-control', 'maxlength' => '50']) !!}
        <!-- <input type="text" class="form-control" id="maeFuncionario" placeholder="Mãe"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="paiFuncionario" class="col-sm-2 col-form-label">Pai</label>
    <div class="col-sm-8">
        {!! Form::text('paiFuncionario', '', ['placeholder' => 'Pai', 'class' => 'form-control', 'maxlength' => '50']) !!}
        <!-- <input type="text" class="form-control" id="paiFuncionario" placeholder="Pai"> -->
    </div>
</div>
<hr>
<h2>Dados Profissionais</h2>
<div class="form-group row ">
    <label for="profissaoFuncionario" class="col-sm-2 col-form-label">Profissão</label>
    <div class="col-sm-4">
        {!! Form::text('profissaoFuncionario', '', ['placeholder' => 'Profissão', 'class' => 'form-control', 'maxlength' => '30']) !!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
    <label for="cargoEmpresaFuncionario" class="col-sm-2 col-form-label">Cargo na Empresa</label>
    <div class="col-sm-4">
        {!! Form::text('cargoEmpresaFuncionario', '', ['placeholder' => 'Cargo na Empresa', 'class' => 'form-control', 'maxlength' => '30']) !!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="tipocontratoFuncionario" class="col-sm-2 col-form-label">Tipo de Contrato</label>
    <div class="col-sm-4">
        {!! Form::select('tipocontratoFuncionario', [
        '1' => 'Estagiário', '2' => 'Temporário', '3' => 'Contrato Efetivo' , '4' => 'Prestador de Serviço'
        ] , null, ['class' => 'form-control']
        )!!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
</div>


<div class="form-group row ">
    <label for="grauescolaridadeFuncionario" class="col-sm-2 col-form-label">Grau de Escolaridade</label>

    <div class="col-sm-6 mt-2">
        <input type="radio" name="grauescolaridadeFuncionario" class="fundamental" value="0" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Fundamental</label>
        <br>
        <input type="radio" name="grauescolaridadeFuncionario" class="medio" value="1" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Médio</label>
        <br>
        <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="2" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Superior Cursando</label>
        <br>
        <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="3" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Superior Completo</label>
    </div>

    <div id="divcurso" class="form-group row col-sm-4">
        <label for="descformacaoFuncionario" class="col-sm-2 col-form-label">Curso Superior</label>
        {!! Form::text('descformacaoFuncionario', '', ['placeholder' => 'Curso', 'class' => 'form-control', 'maxlength' => '30', 'id' => 'descformacaoFuncionario']) !!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
</div>
<div class="form-group row">

    <label for="certficFuncionario" class="col-sm-2 col-form-label">Possui Certificação Profissional?</label>
    <input type="radio" name="certficFuncionario" class="semcert mr-2 mt-3" checked value="0">
    <label for="certficFuncionario" class="col-form-label pl-0">Não</label>

    <input type="radio" name="certficFuncionario" class="comcert ml-2 m-1 mt-3" value="1">
    <label for="certficFuncionario" class="col-form-label pl-0">Sim</label>

</div>
<div id="divcertprof" class="form-group row col-sm-12 mt-2">
    <label for="uncertificadoraFuncionario" class="col-sm-2 col-form-label pl-0">Unidade Certificadora</label>
    <input class="form-control col-sm-4 " type="text" name="uncertificadoraFuncionario" id="uncertificadoraFuncionario" maxlength="60">

    <label for="anocertificacaoFuncionario" class="col-sm-2 col-form-label">Ano Certificação</label>
    <input class="form-control col-sm-2" type="text" name="anocertificacaoFuncionario" id="anocertificacaoFuncionario" maxlength="4">

</div>
<hr>
<h2>Dados Bancários Funcionário</h2>

<div class="form-group row">

    <label for="contacorrenteFuncionario" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-4">

        {!! Form::select('contacorrenteFuncionario', [
        'cc' => 'Conta Corrente', 'cp' => 'Conta Poupança'
        ] , null, ['class' => 'form-control']
        )!!}
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Banco</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('bancoFuncionario', '', ['placeholder' => 'Banco', 'class' => 'form-control', 'maxlength' => '11', 'list' => 'bancos' ]) !!} -->
        <select class="selecionaComInput form-control" name="bancoFuncionario">
            @foreach ($todososbancos as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Banco</label>

</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-4">
        {!! Form::text('nrcontaFuncionario', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11']) !!}
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Agência</label>
    <div class="col-sm-4">
        {!! Form::text('agenciaFuncionario', '', ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11']) !!}
    </div>

</div>

<hr>

<br>
<br>
<input class="btn btn-primary" id="reveal" value="Cadastrar Favorecido" style="cursor:pointer;">
<input class="btn btn-danger" id="esconde" value="Remover Favorecido" style="cursor:pointer;">
<div id="ajax-content">
    <div id="div_dados_favorecido">
        <h2>Cadastro de Favorecido</h2>
        <div class="form-group row">

            <label for="valor1" class="col-sm-2 col-form-label">Nome Completo do Favorecido</label>
            <div class="col-sm-4">
                {!! Form::text('nomefavorecidoFuncionario', '', ['placeholder' => 'Nome Completo do Favorecido', 'class' => 'form-control', 'id' => 'nomefavorecido', 'maxlength' => '11']) !!}
            </div>
            <label for="valor2" class="col-sm-2 col-form-label">CPF do Favorecido</label>
            <div class="col-sm-4">
                {!! Form::number('cpffavorecidoFuncionario', '', ['placeholder' => 'CPF do Favorecido', 'class' => 'form-control', 'id' => 'cpffavorecidoFuncionario', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11']) !!}
            </div>

        </div>
        <div class="form-group row">

            <label for="contacorrentefavorecidoFuncionario" class="col-sm-2 col-form-label">Tipo de Conta</label>
            <div class="col-sm-4">

                {!! Form::select('contacorrentefavorecidoFuncionario', [
                'cc' => 'Conta Corrente', 'cp' => 'Conta Poupança'
                ] , null, ['class' => 'form-control']
                )!!}

            </div>
            <label for="bancofavorecidoFuncionario" class="col-sm-2 col-form-label">Banco</label>
            <div class="col-sm-4">
                {!! Form::text('bancofavorecidoFuncionario', '', ['placeholder' => 'Banco', 'class' => 'form-control', 'id' => 'bancofavorecidoFuncionario', 'maxlength' => '11', 'list' => 'bancos']) !!}
            </div>

        </div>
        <div class="form-group row">

            <label for="nrcontafavorecidoFuncionario" class="col-sm-2 col-form-label">Número Conta</label>
            <div class="col-sm-4">
                {!! Form::text('nrcontafavorecidoFuncionario', '', ['placeholder' => 'Número Conta Favorecido', 'class' => 'form-control', 'id' => 'nrcontafavorecidoFuncionario', 'maxlength' => '11']) !!}
            </div>
            <label for="agenciafavorecidoFuncionario" class="col-sm-2 col-form-label">Agência</label>
            <div class="col-sm-4">
                {!! Form::text('agenciafavorecidoFuncionario', '', ['placeholder' => 'Agência', 'class' => 'form-control', 'id' => 'agenciafavorecidoFuncionario', 'maxlength' => '11']) !!}
            </div>
        </div>
    </div>
</div>

{!! Form::hidden('ativoFuncionario', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativoFuncionario', 'maxlength' => '11']) !!}
{!! Form::hidden('excluidoFuncionario', '0', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'excluidoFuncionario', 'maxlength' => '11']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}






@endsection