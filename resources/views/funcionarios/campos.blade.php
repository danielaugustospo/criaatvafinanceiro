<div class="form-group row">
    <label for="nomeFuncionario" class="col-sm-2 col-form-label pt-0">Nome Completo do Funcionário <span style="color:red;">*</span></label>
    <div class="col-sm-10">
        {!! Form::text('nomeFuncionario', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'required', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row">
    <label for="cepFuncionario" class="col-sm-2 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepFuncionario', $valorInput, ['placeholder' => 'CEP', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'cep','onblur' =>'pesquisacep(this.value)', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="enderecoFuncionario" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-6">
        {!! Form::text('enderecoFuncionario', $valorInput, ['placeholder' => 'Endereço', 'class' => 'form-control', 'id' => 'endereco', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row ">
    <label for="bairroFuncionario" class="col-sm-2 col-form-label">Bairro</label>
    <div class="col-sm-3">
        {!! Form::text('bairroFuncionario', $valorInput, ['placeholder' => 'Bairro', 'class' => 'form-control', 'id' => 'bairro', 'maxlength' => '30', 'readonly', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="cidadeFuncionario" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeFuncionario', $valorInput, ['placeholder' => 'Cidade', 'class' => 'form-control', 'id' => 'cidade', 'maxlength' => '30', 'readonly', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="ufFuncionario" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('ufFuncionario', $valorInput, ['placeholder' => 'Estado', 'class' => 'form-control', 'id' => 'uf', 'maxlength' => '3', 'readonly', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<hr>
<h2>Contato</h2>
<div class="form-group row ">
    <label for="celularFuncionario" class="col-sm-2 col-form-label">Celular</label>
    <div class="col-sm-2">
        {!! Form::number('celularFuncionario', $valorInput, ['placeholder' => 'Celular', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="telresidenciaFuncionario" class="col-sm-2 col-form-label">Telefone Residência</label>
    <div class="col-sm-2">
        {!! Form::number('telresidenciaFuncionario', $valorInput, ['placeholder' => 'Tel Residência', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '10', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="contatoemergenciaFuncionario" class="col-sm-2 col-form-label">Contato Emergência</label>
    <div class="col-sm-2">
        {!! Form::number('contatoemergenciaFuncionario', $valorInput, ['placeholder' => 'Contato Emergência', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '10', $variavelReadOnlyNaView]) !!}
    </div>

</div>
<div class="form-group row ">
    <label for="emailFuncionario" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
        {!! Form::email('emailFuncionario', $valorInput, ['placeholder' => 'E-mail', 'class' => 'form-control', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Rede Social</label>
    <div class="col-sm-4">
        {!! Form::text('redesocialFuncionario', $valorInput, ['placeholder' => 'Rede Social', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
    </div>

</div>
<div class="form-group row ">
    <label for="facebookFuncionario" class="col-sm-2 col-form-label">Facebook</label>
    <div class="col-sm-4">
        {!! Form::text('facebookFuncionario', $valorInput, ['placeholder' => 'Facebook', 'class' => 'form-control', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Telegram</label>
    <div class="col-sm-4">
        {!! Form::text('telegramFuncionario', $valorInput, ['placeholder' => 'Telegram', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
    </div>

</div>
<hr>
<h2>Documentação do Funcionário</h2>
<div class="form-group row ">
    <label for="cpfFuncionario" class="col-sm-2 col-form-label">CPF <span style="color:red;">*</span></label>
    <div class="col-sm-4">
        {!! Form::number('cpfFuncionario', $valorInput, ['placeholder' => 'CPF (somente números)', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' , 'required', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row ">
    <label for="rgFuncionario" class="col-sm-2 col-form-label">RG</label>
    <div class="col-sm-4">
        {!! Form::text('rgFuncionario', $valorInput, ['placeholder' => 'RG (somente números)', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="orgaoRGFuncionario" class="col-sm-2 col-form-label">Órgão Emissor</label>
    <div class="col-sm-4">
        <select class="selecionaComInput form-control" name="orgaoRGFuncionario" {{$variavelDisabledNaView}}>
            @foreach ($todosorgaosrg as $listarg)
            <option value="{{$listarg->id}}">{{$listarg->nome}}</option>
            @endforeach
        </select>
    </div>
    <label for="expedicaoRGFuncionario" class="col-sm-2 col-form-label">Data de Emissão</label>
    <div class="col-sm-4">
        {!! Form::date('expedicaoRGFuncionario', $valorInput, ['class' => 'form-control', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row ">
    <label for="tituloFuncionario" class="col-sm-2 col-form-label">Título de Eleitor</label>
    <div class="col-sm-4">
        {!! Form::number('tituloFuncionario', $valorInput, ['placeholder' => 'Título de Eleitor', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '12', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<hr>
<h2>Filiação</h2>
<div class="form-group row ">
    <label for="maeFuncionario" class="col-sm-2 col-form-label">Mãe</label>
    <div class="col-sm-8">
        {!! Form::text('maeFuncionario', $valorInput, ['placeholder' => 'Mãe', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row ">
    <label for="paiFuncionario" class="col-sm-2 col-form-label">Pai</label>
    <div class="col-sm-8">
        {!! Form::text('paiFuncionario', $valorInput, ['placeholder' => 'Pai', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<hr>
<h2>Dados Profissionais</h2>
<div class="form-group row ">
    <label for="profissaoFuncionario" class="col-sm-2 col-form-label">Profissão</label>
    <div class="col-sm-4">
        {!! Form::text('profissaoFuncionario', $valorInput, ['placeholder' => 'Profissão', 'class' => 'form-control', 'maxlength' => '30', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="cargoEmpresaFuncionario" class="col-sm-2 col-form-label">Cargo na Empresa</label>
    <div class="col-sm-4">
        {!! Form::text('cargoEmpresaFuncionario', $valorInput, ['placeholder' => 'Cargo na Empresa', 'class' => 'form-control', 'maxlength' => '30', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row ">
    <label for="tipocontratoFuncionario" class="col-sm-2 col-form-label">Tipo de Contrato</label>
    <div class="col-sm-4">

<select name="tipocontratoFuncionario" class="selecionaComInput form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'funcionarios/create')
        <option value="1">Estagiário</option>
        <option value="2">Temporário</option>
        <option value="3">Contrato Efetivo</option>
        <option value="4">Funcionário</option>
    @else
        <option value="1" {{ $funcionario->tipocontratoFuncionario == '1'?' selected':''}}>Estagiário</option>
        <option value="2" {{ $funcionario->tipocontratoFuncionario == '2'?' selected':''}}>Temporário</option>
        <option value="3" {{ $funcionario->tipocontratoFuncionario == '3'?' selected':''}}>Contrato Efetivo</option>
        <option value="4" {{ $funcionario->tipocontratoFuncionario == '4'?' selected':''}}>Funcionário</option>
    @endif
</select>

    </div>
</div>


<div class="form-group row">
    <label for="grauescolaridadeFuncionario" class="col-sm-2 col-form-label">Grau de Escolaridade</label>

    <div class="col-sm-6 mt-2">
        @if (Request::path() == 'funcionarios/create')
            <input type="radio" name="grauescolaridadeFuncionario" class="fundamental" value="0" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Fundamental</label><br>
            <input type="radio" name="grauescolaridadeFuncionario" class="medio" value="1" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Médio</label><br>
            <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="2" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Cursando</label><br>
            <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="3" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Completo</label>
        @else
            <input type="radio" {{ $funcionario->grauescolaridadeFuncionario == '0'?' checked':''}} name="grauescolaridadeFuncionario" class="fundamental" value="0" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Fundamental</label><br>
            <input type="radio" {{ $funcionario->grauescolaridadeFuncionario == '1'?' checked':''}} name="grauescolaridadeFuncionario" class="medio" value="1" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Médio</label><br>
            <input type="radio" {{ $funcionario->grauescolaridadeFuncionario == '2'?' checked':''}} name="grauescolaridadeFuncionario" class="superior" value="2" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Cursando</label><br>
            <input type="radio" {{ $funcionario->grauescolaridadeFuncionario == '3'?' checked':''}} name="grauescolaridadeFuncionario" class="superior" value="3" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Completo</label>
        @endif
    </div>

    <div id="divcurso" class="form-group row col-sm-4">
        <label for="descformacaoFuncionario" class="col-sm-2 col-form-label">Curso Superior</label>
        {!! Form::text('descformacaoFuncionario', $valorInput, ['placeholder' => 'Curso', 'class' => 'form-control', 'maxlength' => '30', 'id' => 'descformacaoFuncionario', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row">

    <label for="certficFuncionario" class="col-sm-2 col-form-label">Possui Certificação Profissional?</label>
    @if (Request::path() == 'funcionarios/create')

        <input type="radio" name="certficFuncionario" class="semcert mr-2 mt-3"  value="0">
        <label for="certficFuncionario" class="col-form-label pl-0">Não</label>

        <input type="radio" name="certficFuncionario" class="comcert ml-2 m-1 mt-3"  value="1">
        <label for="certficFuncionario" class="col-form-label pl-0">Sim</label>
    @else

        <input type="radio" name="certficFuncionario" class="semcert mr-2 mt-3" {{ $funcionario->certficFuncionario == '0'?' checked':''}} value="0">
        <label for="certficFuncionario" class="col-form-label pl-0">Não</label>

        <input type="radio" name="certficFuncionario" class="comcert ml-2 m-1 mt-3" {{ $funcionario->certficFuncionario == '1'?' checked':''}} value="1">
        <label for="certficFuncionario" class="col-form-label pl-0">Sim</label>
    @endif
</div>
<div id="divcertprof" class="form-group row col-sm-12 mt-2">
    <label for="uncertificadoraFuncionario" class="col-sm-2 col-form-label pl-0">Unidade Certificadora</label>
    {!! Form::text('uncertificadoraFuncionario', $valorInput, ['placeholder' => 'Unidade Certificadora', 'class' => 'form-control col-sm-4', 'maxlength' => '60', 'id' => 'uncertificadoraFuncionario', $variavelReadOnlyNaView]) !!}


    <label for="anocertificacaoFuncionario" class="col-sm-2 col-form-label">Ano Certificação</label>
    {!! Form::text('anocertificacaoFuncionario', $valorInput, ['placeholder' => 'Ano Certificação', 'class' => 'form-control col-sm-2', 'maxlength' => '4', 'id' => 'anocertificacaoFuncionario', $variavelReadOnlyNaView]) !!}

</div>
<hr>
<h2>Dados Bancários Funcionário</h2>
@include('funcionarios/dadosbancarios')
