@include('layouts/modal/includesmodal')

@if (isset($mensagem))
    <div class="alert alert-success" role="alert">
        <p>{{ $mensagem }}</p>
    </div>
@endif

{!! Form::open(['route' => 'cadastrofornecedor', 'method' => 'POST']) !!}
{!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}

<div class="form-group row">
    <label for="razaosocialFornecedor" class="col-sm-2 col-form-label">Razão Social <span
            style="color:red;">*</span></label>

    <div class="col-sm-10">
        {!! Form::text('razaosocialFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="nomeFornecedor" class="col-sm-2 col-form-label">Nome Fantasia</label>
    <div class="col-sm-10">
        {!! Form::text('nomeFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>

<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjFornecedor" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-3">
        {!! Form::number('cnpjFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput' => 'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);', 'maxlength' => '14']) !!}
    </div>
    <label for="inscEstadualFornecedor" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-3">
        {!! Form::text('inscEstadualFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}
    </div>
    <label for="inscMunicipalFornecedor" class="col-sm-1 col-form-label">Insc. Municipal</label>
    <div class="col-sm-3">
        {!! Form::text('inscMunicipalFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20']) !!}
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfFornecedor" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-3">
        {!! Form::number('cpfFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput' => 'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);', 'maxlength' => '11']) !!}
    </div>
    <label for="identidadeFornecedor" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-3">
        {!! Form::text('identidadeFornecedor', '', ['placeholder' => 'Registro Geral', 'class' => 'form-control', 'maxlength' => '20']) !!}
    </div>
</div>
<h4>Dados Bancários</h4>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>1° Conta</u></label></div>

<div class="form-group row">

    <label for="contacorrenteFornecedor1" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteFornecedor1" class="selecionaComInput  form-control js-example-basic-multiple">
    @if (Request::path() == 'fornecedores/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" >Conta Corrente</option>
        <option value="cp" >Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor1">
            <option>SEM BANCO</option>
            @foreach ($listaBancos as $bancos)
            <option value="{{$bancos->codigoBanco}}">{{$bancos->codigoBanco}} | {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor1', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11']) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor1', '', ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11']) !!}
    </div>
    <label for="chavePixFornecedor1" class="col-sm-1 col-form-label">1° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFornecedor1', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50' ]) !!}
    </div>
</div>

{!! Form::hidden('ativoFornecedor', '1', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoFornecedor', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}
