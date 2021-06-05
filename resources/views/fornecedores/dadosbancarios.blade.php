<div class="form-group row"><label class="col-sm-2 col-form-label"><u>1° Conta</u></label></div>

<div class="form-group row">

    <label for="contacorrenteFornecedor1" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteFornecedor1" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'fornecedores/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $fornecedor->contacorrenteFornecedor1 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $fornecedor->contacorrenteFornecedor1 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor1" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos1 as $bancos)
            <option value="{{$bancos->codigoBanco}}">{{$bancos->codigoBanco}} | {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor1', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor1', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixFornecedor1" class="col-sm-1 col-form-label">1° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFornecedor1', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>


<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>2° Conta</u></label></div>
    <div class="form-group row">

    <label for="contacorrenteFornecedor2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteFornecedor2" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'fornecedores/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $fornecedor->contacorrenteFornecedor2 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $fornecedor->contacorrenteFornecedor2 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor2" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos2 as $bancos)
            <option value="{{$bancos->codigoBanco}}">  {{$bancos->codigoBanco}} | {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor2', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor2', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixFornecedor2" class="col-sm-1 col-form-label">2° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFornecedor2', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>

<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>3° Conta</u></label></div>
    <div class="form-group row">

    <label for="contacorrenteFornecedor2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

<select name="contacorrenteFornecedor3" class="selecionaComInput  form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'fornecedores/create')
        <option value="cc">Conta Corrente</option>
        <option value="cp">Conta Poupança</option>
    @else
        <option value="cc" {{ $fornecedor->contacorrenteFornecedor3 == 'cc'?' selected':''}}>Conta Corrente</option>
        <option value="cp" {{ $fornecedor->contacorrenteFornecedor3 == 'cp'?' selected':''}}>Conta Poupança</option>
    @endif

</select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor3" {{$variavelDisabledNaView}}>
            @foreach ($todososbancos3 as $bancos)
            <option value="{{$bancos->codigoBanco}}">{{$bancos->codigoBanco}} | {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor3', $valorInput, ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor3', $valorInput, ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="chavePixFornecedor3" class="col-sm-1 col-form-label">3° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFornecedor3', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView ]) !!}
    </div>
</div>