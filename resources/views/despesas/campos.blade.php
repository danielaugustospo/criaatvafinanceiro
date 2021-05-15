@include('despesas/script')

<br>
<hr>
<div class="form-group row">
    <h5 for="descricaoDespesa" style="color: red;" class="col-sm-2 "><b>É Compra?</b></h5>
        <div class="col-sm-10 mt-2">
            <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" /> SIM</label>
            <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" /> NÃO</label>
        </div>
</div>

<div class="form-group row">
    <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-10">
        <select name="idCodigoDespesas" id="idCodigoDespesas" class="selecionaComInput col-sm-12" {{$variavelDisabledNaView}}>
            @foreach ($codigoDespesa as $listaCodigoDespesas)
            <option value="{{$listaCodigoDespesas->id}}">
                {{$listaCodigoDespesas->idGrupoCodigoDespesa}} | {{$listaCodigoDespesas->despesaCodigoDespesa}} | {{ $listaCodigoDespesas->grupoDespesa }}
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
    <label for="idOS" class="col-sm-1 col-form-label">OS</label>
    <div class="col-sm-7">

        <select name="idOS" id="idOS" class="selecionaComInput col-sm-12" {{$variavelDisabledNaView}}>
            @foreach ($todasOSAtivas as $listaOS)
            <option value="{{$listaOS->id}}">
                {{$listaOS->id}} - Evento {{$listaOS->eventoOrdemdeServico}}
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
<label for="tipoFornecedor" class="col-sm-2 col-form-label">Tipo Fornecedor</label>
<div class="col-sm-10 mt-2">
    <label for="chkForn" class="mr-2"><input type="radio" value="FOR" name="tipoFornecedor" id="chkForn" /> FORNECEDOR</label>
    <label for="chkFunc"><input type="radio" value="FUN" name="tipoFornecedor" id="chkFunc" /> PRESTADOR DE SERVIÇO</label>

</div>
</div>

<input type="hidden" name="idFornecedor" id="idFornecedor">

<div class="form-group row" id="telaFornecedor" >        
    <label for="" class="col-sm-2 col-form-label">Fornecedor</label>
    <div class="col-sm-4">
        
        <select onchange="pegaIdFornecedor();"  name="selecionaFornecedor" class="selecionaComInput selecionaFornecedor form-control col-sm-12" {{$variavelDisabledNaView}}>
            @foreach ($listaForncedores as $fornecedor)
            <option  value="{{ $fornecedor->id }}">{{ $fornecedor->nomeFornecedor }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row" id="telaFuncionario">        
    <label for="" class="col-sm-2 col-form-label">Prestador de Serviço</label>
    <div class="col-sm-4">

    <select onchange="pegaIdFuncionario();" name="selecionaFornecedor" class="selecionaComInput selecionaFuncionario form-control col-sm-12" {{$variavelDisabledNaView}}>
        @foreach ($listaFuncionarios as $funcionarios)
            <option value="{{ $funcionarios->id }}">{{ $funcionarios->nomeFuncionario }}</option>
        @endforeach
    </select>
    </div>
</div>

<br>

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
        {!! Form::text('precoReal', $precoReal, ['class' => 'padraoReal form-control', 'maxlength' => '100', 'id' => 'precoReal',  $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="vencimento" class="col-sm-2 col-form-label">Data da Compra</label>
    <div class="col-sm-3">
        {!! Form::date('vencimento', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="vencimento" class="col-sm-2 col-form-label">Data do Pagamento</label>
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
<div class="form-group row" id="divComprou">

    <label for="quemComprouSelect" class="col-sm-2 col-form-label">Quem Comprou</label>
    <div class="col-sm-4">
        <select onchange="alteraIdComprador();" name="quemComprouSelect" id="selecionaComprador" class="selecionaComInput quemComprouSelect form-control" {{$variavelDisabledNaView}}>
            @foreach ($listaFuncionarios as $funcionario)
                <option value="{{ $funcionario->id }}">{{ $funcionario->nomeFuncionario }}</option>
            @endforeach
        </select>    
    </div>
    <input type="hidden" name="quemcomprou" id="quemcomprou">

</div>

<div class="form-group row">

    <label for="idBanco" class="col-sm-2 col-form-label">Banco</label>
    <div class="col-sm-4">

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
            <option value="N">Não</option>
            <option value="S">Sim</option>
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
            <option value="0">Não</option>
            <option value="1">Sim</option>
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
            <option value="0">Não</option>
            <option value="1">Sim</option>
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

