<div class="form-group row"><label class="col-sm-2 col-form-label"><u>1° Conta</u></label></div>

<div class="form-group row">

    <label for="contacorrenteFornecedor1" class="col-sm-2 col-form-label">Dados Bancários - Sistema Legado</label>
    <div class="col-sm-8">
        {!! Form::text('dadoslegado', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            'readonly',
        ]) !!}
    </div>
</div>
<div class="form-group row">

    <label for="contacorrenteFornecedor1" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

        <select name="contacorrenteFornecedor1" class="selecionaComInput  form-control js-example-basic-multiple"
            {{ $variavelDisabledNaView }}>

            {!! $infoSelectVazio !!}
            <option value="cc" @if (isset($fornecedor) && $fornecedor->contacorrenteFornecedor1 == 'cc') selected @endif>Conta Corrente</option>
            <option value="cp" @if (isset($fornecedor) && $fornecedor->contacorrenteFornecedor1 == 'cp') selected @endif>Conta Poupança</option>

        </select>



    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor1" {{ $variavelDisabledNaView }}>
            
            <option value="0">0000 | NÃO INFORMADO</option>
            @foreach ($todososbancos1 as $bancos)
            <option value="{{ $bancos->id }}" @if (isset($fornecedor) && $fornecedor->bancoFornecedor1 == $bancos->id) selected @endif>
                {{ $bancos->codigoBanco }} | {{ $bancos->nomeBanco }}
            </option>
            @endforeach
            @if (!isset($fornecedor->bancoFornecedor1) ||
                $fornecedor->bancoFornecedor1 == null ||
                $fornecedor->bancoFornecedor1 == '' ||
                $fornecedor->bancoFornecedor1 == 0)
                {{-- {!! $infoSelectVazio !!} --}}
                <option value="0" selected>0000 | NÃO INFORMADO</option>
            @endif

        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor1', $valorInput, [
            'placeholder' => 'Número Conta',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor1', $valorInput, [
            'placeholder' => 'Agência',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
    <label for="chavePixFornecedor1" class="col-sm-1 col-form-label">1° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFornecedor1', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
</div>


<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>2° Conta</u></label></div>
<div class="form-group row">

    <label for="contacorrenteFornecedor2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

        <select name="contacorrenteFornecedor2" class="selecionaComInput  form-control js-example-basic-multiple"
            {{ $variavelDisabledNaView }}>

            {!! $infoSelectVazio !!}
            <option value="cc" @if (isset($fornecedor) && $fornecedor->contacorrenteFornecedor2 == 'cc') selected @endif>Conta Corrente</option>
            <option value="cp" @if (isset($fornecedor) && $fornecedor->contacorrenteFornecedor2 == 'cp') selected @endif>Conta Poupança</option>

        </select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor2" {{ $variavelDisabledNaView }}>

            {{-- TUDO --}}
            <option value="0">0000 | NÃO INFORMADO</option>
            @foreach ($todososbancos1 as $bancos)
            <option value="{{ $bancos->id }}" @if (isset($fornecedor) && $fornecedor->bancoFornecedor2 == $bancos->id) selected @endif>
                {{ $bancos->codigoBanco }} | {{ $bancos->nomeBanco }}
            </option>
            @endforeach
            @if (!isset($fornecedor->bancoFornecedor2) ||
                $fornecedor->bancoFornecedor2 == null ||
                $fornecedor->bancoFornecedor2 == '' ||
                $fornecedor->bancoFornecedor2 == 0)
                {{-- {!! $infoSelectVazio !!} --}}
                <option value="0" selected>0000 | NÃO INFORMADO</option>
            @endif

        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor2', $valorInput, [
            'placeholder' => 'Número Conta',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor2', $valorInput, [
            'placeholder' => 'Agência',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
    <label for="chavePixFornecedor2" class="col-sm-1 col-form-label">2° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFornecedor2', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
</div>

<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>3° Conta</u></label></div>
<div class="form-group row">

    <label for="contacorrenteFornecedor2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

        <select name="contacorrenteFornecedor3" class="selecionaComInput  form-control js-example-basic-multiple"
            {{ $variavelDisabledNaView }}>

            {!! $infoSelectVazio !!}
            <option value="cc" @if (isset($fornecedor) && $fornecedor->contacorrenteFornecedor3 == 'cc') selected @endif>Conta Corrente</option>
            <option value="cp" @if (isset($fornecedor) && $fornecedor->contacorrenteFornecedor3 == 'cp') selected @endif>Conta Poupança</option>

        </select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor3" {{ $variavelDisabledNaView }}>
            {{-- TUDO --}}
            <option value="0">0000 | NÃO INFORMADO</option>
            @foreach ($todososbancos1 as $bancos)
            <option value="{{ $bancos->id }}" @if (isset($fornecedor) && $fornecedor->bancoFornecedor3 == $bancos->id) selected @endif>
                {{ $bancos->codigoBanco }} | {{ $bancos->nomeBanco }}
            </option>
            @endforeach
            @if (!isset($fornecedor->bancoFornecedor3) ||
                $fornecedor->bancoFornecedor3 == null ||
                $fornecedor->bancoFornecedor3 == '' ||
                $fornecedor->bancoFornecedor3 == 0)
                {{-- {!! $infoSelectVazio !!} --}}
                <option value="0" selected>0000 | NÃO INFORMADO</option>
            @endif
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        {!! Form::text('nrcontaFornecedor3', $valorInput, [
            'placeholder' => 'Número Conta',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        {!! Form::text('agenciaFornecedor3', $valorInput, [
            'placeholder' => 'Agência',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
    <label for="chavePixFornecedor3" class="col-sm-1 col-form-label">3° PIX</label>
    <div class="col-sm-4">
        {!! Form::text('chavePixFornecedor3', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
</div>
