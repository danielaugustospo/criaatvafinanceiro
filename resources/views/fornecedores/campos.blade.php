
<div class="form-group row">
    <label for="nomeFornecedor" class="col-sm-2 col-form-label">Nome Fantasia</label>
    <div class="col-sm-10">
        {!! Form::text('nomeFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
    </div>
</div>
<div class="form-group row">
    <label for="razaosocialFornecedor" class="col-sm-2 col-form-label">Razão Social</label>
    <div class="col-sm-10">
        {!! Form::text('razaosocialFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
    </div>
</div>

<hr />
<h4>Localização</h4>

<div class="form-group row">
    <label for="cepFornecedor" class="col-sm-1 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'cep', 'onblur' =>'pesquisacep(this.value)', $variavelReadOnlyNaView ]) !!}

    </div>
    <label for="enderecoFornecedor" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-7">
        {!! Form::text('enderecoFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control','id' => 'endereco', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
    </div>
</div>

<!--Bairro/Cidade/Estado-->
<div class="form-group row">
    <label for="bairroFornecedor" class="col-sm-1 col-form-label">Bairro</label>
    <div class="col-sm-2">
        {!! Form::text('bairroFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'bairro', 'maxlength' => '10', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="cidadeFornecedor" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'cidade', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="estadoFornecedor" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('estadoFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control','id' => 'uf', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
    </div>
</div>

<hr />
<h4>Contato</h4>

<!--1°Tel/2°Tel/Email-->
<div class="form-group row">
    <label for="telefone1Fornecedor" class="col-sm-1 col-form-label">1°Tel</label>
    <div class="col-sm-3">
        {!! Form::number('telefone1Fornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="telefone2Fornecedor" class="col-sm-1 col-form-label">2°Tel</label>
    <div class="col-sm-3">
        {!! Form::number('telefone2Fornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="emailFornecedor" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
        {!! Form::text('emailFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjFornecedor" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-3">
        {!! Form::number('cnpjFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '14', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="inscEstadualFornecedor" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-3">
        {!! Form::text('inscEstadualFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView ]) !!}
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfFornecedor" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-3">
        {!! Form::number('cpfFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="identidadeFornecedor" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-3">
        {!! Form::text('identidadeFornecedor', $valorInput, ['placeholder' => 'Registro Geral', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView ]) !!}
    </div>
</div>

<!--Contato/Site-->
<div class="form-group row">
    <label for="contatoFornecedor" class="col-sm-1 col-form-label">Contato</label>
    <div class="col-sm-3">
        {!! Form::text('contatoFornecedor', $valorInput, ['placeholder' => 'Contato', 'class' => 'form-control', 'maxlength' => '8', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="siteFornecedor" class="col-sm-1 col-form-label">Site</label>
    <div class="col-sm-3">
        {!! Form::text('siteFornecedor', $valorInput, ['placeholder' => 'Site', 'class' => 'form-control', 'maxlength' => '30', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="dataCadastroFornecedor" class="col-sm-1 col-form-label">Data de Contrato</label>
    <div class="col-sm-3">
        {!! Form::date('dataCadastroFornecedor', $valorInput, ['placeholder' => 'Data Contrato', 'class' => 'form-control', 'maxlength' => '8', $variavelReadOnlyNaView ]) !!}
    </div>
</div>


<hr />
<h4>Dados Bancários</h4>


<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoFornecedor" class="col-sm-2 col-form-label">Banco Fornecedor</label>
    <div class="col-sm-3">

        <select class="selecionaComInput form-control" name="bancoFornecedor" id="bancoFornecedor" {{ $variavelDisabledNaView }}>
            @if (Request::path() == 'fornecedores/create')

                @foreach ($listaBancos as $listabancos)
                    <option value="{{$listabancos->id}}">{{$listabancos->nomeBanco}}</option>
                @endforeach
            @else
                @foreach ($bancos as $listabancos)
                    <option value="{{$listabancos->id}}">{{$listabancos->nomeBanco}}</option>
                @endforeach
            @endif

        </select>
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="nrcontaFornecedor" class="col-sm-2 col-form-label">Número Conta Fornecedor</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView ]) !!}
    </div>
</div>

<!-- <h5 class="pr-2">Chaves Pix</h5> -->
<div class="d-flex justify-content-center">
    <img src="{{env('APP_URL')}}img/logo_pix.png" class="mb-3" width="200px;" alt="">
</div>
<div class="form-group row">

    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 1</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix1Fornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 2</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix2Fornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 3</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix3Fornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25', $variavelReadOnlyNaView ]) !!}
    </div>
    <label for="agenciaFornecedor" class="col-sm-1 col-form-label">Chave 4</label>
    <div class="col-sm-2">
        {!! Form::text('chavePix4Fornecedor', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '25', $variavelReadOnlyNaView ]) !!}
    </div>

</div>