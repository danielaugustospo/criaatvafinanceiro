<div class="form-group row">
    <label for="nomeCliente" class="col-sm-2 col-form-label">Nome Fantasia</label>
    <div class="col-sm-10">
        {!! Form::text('nomeCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row">
    <label for="razaosocialCliente" class="col-sm-2 col-form-label">Razão Social</label>
    <div class="col-sm-10">
        {!! Form::text('razaosocialCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<hr />

<!--CEP/Endereço-->
<h4>Localização</h4>
<div class="form-group row">
    <label for="cepCliente" class="col-sm-1 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::number('cepCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'cep', 'onblur' =>'pesquisacep(this.value)', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '8', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="enderecoCliente" class="col-sm-1 col-form-label">Endereço</label>
    <div class="col-sm-5">
        {!! Form::text('enderecoCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'endereco', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<!--Bairro/Cidade/Estado-->
<div class="form-group row">
    <label for="bairroCliente" class="col-sm-1 col-form-label">Bairro</label>
    <div class="col-sm-2">
        {!! Form::text('bairroCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'bairro', 'maxlength' => '10', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="cidadeCliente" class="col-sm-1 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'cidade', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="estadoCliente" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('estadoCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'id' => 'uf', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<hr />
<h4>Contato</h4>
<!--1°Tel/2°Tel/Email-->
<div class="form-group row">
    <label for="telefone1Cliente" class="col-sm-1 col-form-label">1°Tel</label>
    <div class="col-sm-2">
        {!! Form::number('telefone1Cliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="telefone2Cliente" class="col-sm-1 col-form-label">2°Tel</label>
    <div class="col-sm-2">
        {!! Form::number('telefone2Cliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="emailCliente" class="col-sm-1 col-form-label">Email</label>
    <div class="col-sm-3">
        {!! Form::email('emailCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cnpjCliente" class="col-sm-1 col-form-label">CNPJ</label>
    <div class="col-sm-2">
        {!! Form::number('cnpjCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '14', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="inscEstadualCliente" class="col-sm-1 col-form-label">Insc. Estadual</label>
    <div class="col-sm-6">
        {!! Form::text('inscEstadualCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
    </div>
</div>


<!--CNPJ/Insc Estadual-->
<div class="form-group row">
    <label for="cpfCliente" class="col-sm-1 col-form-label">CPF</label>
    <div class="col-sm-2">
        {!! Form::number('cpfCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="identidadeCliente" class="col-sm-1 col-form-label">RG</label>
    <div class="col-sm-3">
        {!! Form::number('identidadeCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '10', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="dataCadastroCliente" class="col-sm-1 col-form-label">Data de Contrato</label>
    <div class="col-sm-2">
        {!! Form::date('dataCadastroCliente', $valorInput, ['placeholder' => 'Data Contrato', 'class' => 'form-control', 'maxlength' => '8', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<!--Contato/Site-->
<div class="form-group row">
    <label for="contatoCliente" class="col-sm-1 col-form-label">Contato</label>
    <div class="col-sm-2">
        {!! Form::text('contatoCliente', $valorInput, ['placeholder' => 'Contato', 'class' => 'form-control', 'maxlength' => '8', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="siteCliente" class="col-sm-1 col-form-label">Site</label>
    <div class="col-sm-6">
        {!! Form::text('siteCliente', $valorInput, ['placeholder' => 'Site', 'class' => 'form-control', 'maxlength' => '8', $variavelReadOnlyNaView]) !!}
    </div>

</div>


<hr />
<h4>Dados Bancários</h4>

<!--BANCO/AGENCIA/CONTA-->
<div class="form-group row">
    <label for="bancoCliente" class="col-sm-1 col-form-label">Banco Cliente</label>
    <div class="col-sm-3">
        <select class="selecionaComInput form-control" name="bancoCliente" id="bancoCliente" {{ $variavelDisabledNaView }}>
            @foreach ($listaBancos as $listabancos)

            <option value="{{$listabancos->id}}">
                {{$listabancos->nomeBanco}}
            </option>
            @endforeach

        </select>
    </div>
    <label for="agenciaCliente" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="nrcontaCliente" class="col-sm-2 col-form-label">Número Conta Cliente</label>
    <div class="col-sm-3">
        {!! Form::text('nrcontaCliente', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView]) !!}
    </div>
</div>

