<div class="form-group row"><label class="col-sm-2 col-form-label"><u>1° Conta</u></label></div>

<div class="form-group row">

    <label for="contacorrenteCliente1" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteCliente1" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'clientes/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $cliente->contacorrenteCliente1 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $cliente->contacorrenteCliente1 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoCliente1" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos1 as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaCliente1', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaCliente1', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixCliente1" class="col-sm-1 col-form-label">1° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixCliente1', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>


<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>2° Conta</u></label></div>
    <div class="form-group row">

    <label for="contacorrenteCliente2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteCliente2" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'clientes/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $cliente->contacorrenteCliente2 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $cliente->contacorrenteCliente2 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoCliente2" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos2 as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaCliente2', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaCliente2', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixCliente2" class="col-sm-1 col-form-label">2° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixCliente2', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>
<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>3° Conta</u></label></div>
    <div class="form-group row">

    <label for="contacorrenteCliente3" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteCliente3" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'clientes/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $cliente->contacorrenteCliente3 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $cliente->contacorrenteCliente3 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="bancoCliente3" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoCliente3" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos2 as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaCliente3', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaCliente3', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixCliente3" class="col-sm-1 col-form-label">3° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixCliente3', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>
<hr>


