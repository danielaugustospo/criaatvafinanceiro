<div class="form-group row"><label class="col-sm-2 col-form-label"><u>1° Conta</u></label></div>

<div class="form-group row">

    <label for="contacorrenteFuncionario1" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteFuncionario1" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'funcionarios/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $funcionario->contacorrenteFuncionario1 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $funcionario->contacorrenteFuncionario1 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFuncionario1" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos1 as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFuncionario1', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFuncionario1', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixFuncionario1" class="col-sm-1 col-form-label">1° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFuncionario1', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>


<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>2° Conta</u></label></div>
    <div class="form-group row">

    <label for="contacorrenteFuncionario2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteFuncionario2" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'funcionarios/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $funcionario->contacorrenteFuncionario2 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $funcionario->contacorrenteFuncionario2 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFuncionario2" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos2 as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFuncionario2', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFuncionario2', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixFuncionario2" class="col-sm-1 col-form-label">2° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFuncionario2', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>


<hr>

<br>
<br>
@if ((Request::path() == 'funcionarios/create') || (Request::path() == 'funcionarios/'.$funcionario->id.'/edit'))

<input class="btn btn-primary" id="reveal" value="Cadastro de Terceiros" style="cursor:pointer;">
<input class="btn btn-danger" id="esconde" value="Remover Terceiros" style="cursor:pointer;">
@endif 
<div id="ajax-content">
    <div id="div_dados_favorecido">
        <h2>Cadastro de Terceiros</h2>
        <div class="form-group row">

            <label for="valor1" class="col-sm-2 col-form-label">Nome Completo do Favorecido</label>
            <div class="col-sm-4">
                {!! Form::text('nomefavorecidoFuncionario', $valorInput, ['placeholder' => 'Nome Completo do Favorecido', 'class' => 'form-control', 'id' => 'nomefavorecido', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
            </div>
            <label for="valor2" class="col-sm-2 col-form-label">CPF do Favorecido</label>
            <div class="col-sm-4">
                {!! Form::number('cpffavorecidoFuncionario', $valorInput, ['placeholder' => 'CPF do Favorecido', 'class' => 'form-control', 'id' => 'cpffavorecidoFuncionario', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView]) !!}
            </div>

        </div>
        <div class="form-group row">

            <label for="contacorrentefavorecidoFuncionario" class="col-sm-2 col-form-label">Tipo de Conta</label>
            <div class="col-sm-4">

        <select name="contacorrentefavorecidoFuncionario" class="selecionaComInput form-control js-example-basic-multiple buscaPrecoReal" {{$variavelDisabledNaView}}>
            @if (Request::path() == 'funcionarios/create')
                <option value="cc">Conta Corrente</option>
                <option value="cp">Conta Poupança</option>
            @else
                <option value="cc" {{ $funcionario->contacorrentefavorecidoFuncionario == 'cc'?' selected':''}}>Conta Corrente</option>
                <option value="cp" {{ $funcionario->contacorrentefavorecidoFuncionario == 'cp'?' selected':''}}>Conta Poupança</option>
            @endif

        </select>

            </div>
            <label for="bancofavorecidoFuncionario" class="col-sm-2 col-form-label">Banco</label>
            <div class="col-sm-4">
                {!! Form::text('bancofavorecidoFuncionario', $valorInput, ['placeholder' => 'Banco', 'class' => 'form-control', 'id' => 'bancofavorecidoFuncionario', 'maxlength' => '11', 'list' => 'bancos', $variavelReadOnlyNaView]) !!}
            </div>

        </div>
        <div class="form-group row">

            <label for="nrcontafavorecidoFuncionario" class="col-sm-2 col-form-label">Número Conta</label>
            <div class="col-sm-4">
                {!! Form::text('nrcontafavorecidoFuncionario', $valorInput, ['placeholder' => 'Número Conta Favorecido', 'class' => 'form-control', 'id' => 'nrcontafavorecidoFuncionario', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
            </div>
            <label for="agenciafavorecidoFuncionario" class="col-sm-2 col-form-label">Agência</label>
            <div class="col-sm-4">
                {!! Form::text('agenciafavorecidoFuncionario', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'id' => 'agenciafavorecidoFuncionario', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
            </div>
        </div>
    </div>
</div>
