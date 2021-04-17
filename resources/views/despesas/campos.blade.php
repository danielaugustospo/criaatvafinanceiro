<div class="form-group row">
    <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-4">

        <select name="idCodigoDespesas" id="idCodigoDespesas" class="selecionaComInput col-sm-12" {{$variavelDisabledNaView}}>
            @foreach ($codigoDespesa as $listaCodigoDespesas)
            <option value="{{$listaCodigoDespesas->id}}">
                Código da Despesa: {{$listaCodigoDespesas->idGrupoCodigoDespesa}} - Tipo de Despesa: {{$listaCodigoDespesas->despesaCodigoDespesa}}
            </option>
            @endforeach
        </select>

    </div>
</div>

<div class="form-group row">
    <label for="nRegistro" class="col-sm-2 col-form-label">N° Registro</label>
    <div class="col-sm-2">
        {{ Form::text('nRegistro', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView]) }}
    </div>
    <label for="idOS" class="col-sm-2 col-form-label">Vincular a OS</label>
    <div class="col-sm-4">

        <select name="idOS" id="idOS" class="selecionaComInput col-sm-12" {{$variavelDisabledNaView}}>
            @foreach ($todasOSAtivas as $listaOS)
            <option value="{{$listaOS->id}}">
                Código da OS: {{$listaOS->id}} - Evento: {{$listaOS->eventoOrdemdeServico}}
            </option>
            @endforeach
        </select>

    </div>


</div>
<div class="form-group row">
    <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoDespesa', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idFornecedor" class="col-sm-2 col-form-label">Fornecedor</label>
    <div class="col-sm-10">

        <select name="idFornecedor" id="idFornecedor" class="selecionaComInput form-control" {{$variavelDisabledNaView}}>
            @foreach ($listaForncedores as $fornecedor)
                <option value="{{ $fornecedor->id }}">{{ $fornecedor->nomeFornecedor }}</option>
            @endforeach
        </select>

    </div>
</div>
<div class="form-group row">
    <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">

        <select name="idFormaPagamento" id="idFormaPagamento" class="selecionaComInput form-control col-sm-12 js-example-basic-multiple" {{$variavelDisabledNaView}}>
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">

    <label for="conta" class="col-sm-2 col-form-label">Conta</label>
    <div class="col-sm-4">

        <select name="conta" id="conta" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple" {{$variavelDisabledNaView}}>
            @foreach ($listaContas as $contas)

            <option value="{{ $contas->id }}">{{ $contas->numeroConta }}</option>

            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">

    <label for="precoReal" class="col-sm-2 col-form-label">Preço</label>
    <div class="col-sm-2">
         {{-- <input type="text" id="precoReal" class="padraoReal form-control" name="precoReal" value="{{ $despesa->precoReal }}" placeholder="Preencha o preço cliente" $variavelReadOnlyNaView /><br>  --}}
        {!! Form::text('precoReal', $precoReal, ['class' => 'padraoReal form-control', 'maxlength' => '100', 'id' => 'precoReal',  $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="vencimento" class="col-sm-2 col-form-label">Vencimento</label>
    <div class="col-sm-3">
        {!! Form::date('vencimento', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">

    <label for="notaFiscal" class="col-sm-2 col-form-label">Nota Fiscal</label>
    <div class="col-sm-2">
        {!! Form::text('notaFiscal', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>
<div class="form-group row">

    <label for="idBanco" class="col-sm-2 col-form-label">Banco</label>
    <div class="col-sm-2">

        <select name="idBanco" id="idBanco"  class="selecionaComInput form-control" {{$variavelDisabledNaView}}>
            @if (Request::path() == 'despesas/create')
                @foreach ($todosOSBancos as $listaBancosViewCadastro)
                    <option value="{{ $listaBancosViewCadastro->id }}">{{ $listaBancosViewCadastro->codigoBanco }} | {{ $listaBancosViewCadastro->nomeBanco }}</option>
                @endforeach            
            @else
                @foreach ($listabancos as $listaBancosViewEdit)
                    <option value="{{ $listaBancosViewEdit->id }}">{{ $listaBancosViewEdit->codigoBanco }}  | {{ $listaBancosViewEdit->nomeBanco }}</option>
                @endforeach
            @endif
        </select>
        <!-- <input type="text" id="precoCliente" class="padraoReal form-control" name="precoCliente" value="0,00" placeholder="Preencha o preço cliente" /><br> -->
        {{-- {!! Form::text('idBanco', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}
    </div>
</div>
<div class="form-group row">

    <label for="cheque" class="col-sm-2 col-form-label">Cheque</label>
    <div class="col-sm-2">
        <!-- <input type="text" id="precoCliente" class="padraoReal form-control" name="precoCliente" value="0,00" placeholder="Preencha o preço cliente" /><br> -->
        {!! Form::text('cheque', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="pago" class="col-sm-2 col-form-label">Pago</label>
    <div class="col-sm-2">
        <select name="pago" id="pago" style="padding:4px;" class="selecionaComInput form-control" {{$variavelDisabledNaView}}>
            @if (Request::path() == 'despesas/create')
            <option value="N">Não</option>
            <option value="S">Sim</option>
            @else
            <option value="1" {{$despesa->pago == '1'?' selected':''}}>Sim</option>
            <option value="0" {{$despesa->pago == '0'?' selected':''}}>Não</option>
            @endif
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="quempagou" class="col-sm-2 col-form-label">Reembolsado</label>
    <div class="col-sm-2">
        <select name="quempagou" id="quempagou" style="padding:4px;" class="selecionaComInput form-control" {{$variavelDisabledNaView}}>
            @if (Request::path() == 'despesas/create')
            <option value="S">Sim</option>
            <option value="N">Não</option>
            @else
            <option value="S" {{$despesa->quempagou == 'S'?' selected':''}}>Sim</option>
            <option value="N" {{$despesa->quempagou == 'N'?' selected':''}}>Não</option>
            @endif
        </select>
    </div>

</div>


<div class="form-group row">

    <label for="valorEstornado" class="col-sm-2 col-form-label">Valor Estornado</label>
    <div class="col-sm-2">
        <select name="valorEstornado" id="valorEstornado" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple" {{$variavelDisabledNaView}}>
            @if (Request::path() == 'despesas/create')
            <option value="1">Sim</option>
            <option value="0">Não</option>
            @else
            <option value="0" {{$despesa->valorEstornado == '0'?' selected':''}}>Não</option>
            <option value="1" {{$despesa->valorEstornado == '1'?' selected':''}}>Sim</option>
            @endif
        </select>
    </div>
</div>

<div class="form-group row">
    @if (Request::path() == 'despesas/create')
    <label for="despesaFixa" class="col-sm-2 col-form-label">Despesa Fixa?</label>
    <div class="col-sm-2">
        <select name="despesaFixa" id="despesaFixa" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple" {{$variavelDisabledNaView}}>
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
    </div>
    @elseif ($despesa->idDespesaPai == 0)
    <label for="despesaFixa" class="col-sm-2 col-form-label">Despesa Fixa?</label>
    <div class="col-sm-2">
        <select name="despesaFixa" id="despesaFixa" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple" {{$variavelDisabledNaView}}>
            <option value="0" {{$despesa->despesaFixa == '0'?' selected':''}}>Não</option>
            <option value="1" {{$despesa->despesaFixa == '1'?' selected':''}}>Sim</option>
        </select>
    </div>
    @else
    <label for="despesaFixa" class="text-center col-sm-12 mt-5 pr-2" style="color:red;">Esta despesa já é uma despesa fixa. Despesa Pai id n°{{$despesa->idDespesaPai}}</label>
    @endif
</div>



{!! Form::hidden('despesaCodigoDespesas', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('ativoDespesa', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}

{!! Form::hidden('atuacao', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}
{!! Form::hidden('totalPrecoCliente', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('totalPrecoReal', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('idDespesaPai', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}


{!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}