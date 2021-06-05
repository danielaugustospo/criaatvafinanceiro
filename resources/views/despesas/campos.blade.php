@include('despesas/script')
<style>
  @import 'https://fonts.googleapis.com/css?family=Open+Sans:600,700';

  * {
    font-family: 'Open Sans', sans-serif;
  }

  .rwd-table {
    margin: auto;
    min-width: 300px;
    max-width: 100%;
    border-collapse: collapse;
  }

  .rwd-table tr:first-child {
    border-top: none;
    background: #428bca;
    color: #fff;
  }

  .rwd-table tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    background-color: #f5f9fc;
  }

  .rwd-table tr:nth-child(odd):not(:first-child) {
    background-color: #ebf3f9;
  }

  .rwd-table th {
    display: none;
  }

  .rwd-table td {
    display: block;
  }

  .rwd-table td:first-child {
    margin-top: .5em;
  }

  .rwd-table td:last-child {
    margin-bottom: .5em;
  }

  .rwd-table td:before {
    content: attr(data-th) ": ";
    font-weight: bold;
    width: 120px;
    display: inline-block;
    color: #000;
  }

  .rwd-table th,
  .rwd-table td {
    text-align: left;
  }

  .rwd-table {
    color: #333;
    border-radius: .4em;
    overflow: hidden;
  }

  .rwd-table tr {
    border-color: #bfbfbf;
  }

  .rwd-table th,
  .rwd-table td {
    padding: .5em 1em;
  }

  @media screen and (max-width: 601px) {
    .rwd-table tr:nth-child(2) {
      border-top: none;
    }
  }

  @media screen and (min-width: 600px) {
    .rwd-table tr:hover:not(:first-child) {
      background-color: #d8e7f3;
    }

    .rwd-table td:before {
      display: none;
    }

    .rwd-table th,
    .rwd-table td {
      display: table-cell;
      padding: .25em .5em;
    }

    .rwd-table th:first-child,
    .rwd-table td:first-child {
      padding-left: 0;
    }

    .rwd-table th:last-child,
    .rwd-table td:last-child {
      padding-right: 0;
    }

    .rwd-table th,
    .rwd-table td {
      padding: 1em !important;
    }
  }


  /* THE END OF THE IMPORTANT STUFF */

  /* Basic Styling */
  body {
    background: #4B79A1;
    background: -webkit-linear-gradient(to left, #4B79A1, #283E51);
    background: linear-gradient(to left, #4B79A1, #283E51);
  }

  h1 {
    text-align: center;
    font-size: 2.4em;
    color: #f2f2f2;
  }

  .container {
    display: block;
    text-align: center;
  }

  h3 {
    display: inline-block;
    position: relative;
    text-align: center;
    font-size: 1.5em;
    color: #cecece;
  }

  h3:before {
    content: "\25C0";
    position: absolute;
    left: -50px;
    -webkit-animation: leftRight 2s linear infinite;
    animation: leftRight 2s linear infinite;
  }

  h3:after {
    content: "\25b6";
    position: absolute;
    right: -50px;
    -webkit-animation: leftRight 2s linear infinite reverse;
    animation: leftRight 2s linear infinite reverse;
  }

  @-webkit-keyframes leftRight {
    0% {
      -webkit-transform: translateX(0)
    }

    25% {
      -webkit-transform: translateX(-10px)
    }

    75% {
      -webkit-transform: translateX(10px)
    }

    100% {
      -webkit-transform: translateX(0)
    }
  }

  @keyframes leftRight {
    0% {
      transform: translateX(0)
    }

    25% {
      transform: translateX(-10px)
    }

    75% {
      transform: translateX(10px)
    }

    100% {
      transform: translateX(0)
    }
  }


  .delete {
    color: red;
    background-color: white;
    border-radius: 7%;
    padding: 3%;
  }
</style>
<br>
<hr>
<div class="form-group row">
  <h5 for="descricaoDespesa" style="color: red;" class="col-sm-2 "><b>É Compra?</b></h5>
  <div class="col-sm-10 mt-2">
    <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" required /> SIM</label>
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
  <label for="idOS" class="col-sm-2 col-form-label">OS</label>
  <div class="col-sm-10">

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
    {!! Form::text('descricaoDespesa', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required', $variavelReadOnlyNaView]) !!}
  </div>
</div>


{{-- <div class="form-group row">
<label for="tipoFornecedor" class="col-sm-2 col-form-label">Tipo Fornecedor</label>
<div class="col-sm-10 mt-2">
    <label for="chkForn" class="mr-2"><input type="radio" value="FOR" name="tipoFornecedor" id="chkForn" /> FORNECEDOR</label>
    <label for="chkFunc"><input type="radio" value="FUN" name="tipoFornecedor" id="chkFunc" /> PRESTADOR DE SERVIÇO</label>

</div>
</div> --}}

<input type="hidden" name="idFornecedor" id="idFornecedor">

<div class="form-group row" id="telaFornecedor">
  <label for="" class="col-sm-2 col-form-label">Fornecedor</label>
  <div class="col-sm-4">

    <select onchange="pegaIdFornecedor();" name="selecionaFornecedor" class="selecionaComInput selecionaFornecedor form-control col-sm-12" {{$variavelDisabledNaView}}>
      @foreach ($listaForncedores as $fornecedor)
      <option value="{{ $fornecedor->id }}">{{ $fornecedor->nomeFornecedor }}</option>
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

    <select name="idFormaPagamento" id="idFormaPagamento" class="selecionaComInput form-control col-sm-12 js-example-basic-multiple" required {{$variavelDisabledNaView}}>
      @foreach ($formapagamento as $formaPG)
      <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">

  <label for="conta" class="col-sm-2 col-form-label">Conta</label>
  <div class="col-sm-4">

    <select name="conta" id="conta" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple" required {{$variavelDisabledNaView}}>
      @foreach ($listaContas as $contas)

      <option value="{{ $contas->id }}">{{ $contas->nomeConta }}</option>

      @endforeach
    </select>
  </div>
</div>

<div class="form-group row">

  <label for="precoReal" class="col-sm-2 col-form-label">Valor</label>
  <div class="col-sm-2">
    {!! Form::text('precoReal', $precoReal, ['class' => 'padraoReal form-control', 'maxlength' => '100', 'id' => 'precoReal', 'required', $variavelReadOnlyNaView]) !!}
  </div>
</div>

<div class="form-group row" id="telaDataCompra">
  <label for="dataDaCompra" class="col-sm-2 col-form-label">Data da Compra</label>
  <div class="col-sm-3">
    {!! Form::date('dataDaCompra', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', $variavelReadOnlyNaView]) !!}
  </div>
</div>

<div class="form-group row" id="telaDataTrabalho">
  <label for="dataDoTrabalho" class="col-sm-2 col-form-label">Data do Trabalho</label>
  <div class="col-sm-3">
    {!! Form::date('dataDoTrabalho', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', $variavelReadOnlyNaView]) !!}
  </div>
</div>


<div class="form-group row">
  <label for="vencimento" class="col-sm-2 col-form-label">Data do Pagamento (Vencimento)</label>
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

    <select name="idBanco" id="idBanco" class="selecionaComInput form-control" {{$variavelDisabledNaView}}>
      @if (Request::path() == 'despesas/create')
      @foreach ($todosOSBancos as $listaBancosViewCadastro)
      <option value="{{ $listaBancosViewCadastro->id }}">{{ $listaBancosViewCadastro->codigoBanco }} | {{ $listaBancosViewCadastro->nomeBanco }}</option>
      @endforeach
      @else
      @foreach ($listabancos as $listaBancosViewEdit)
      <option value="{{ $listaBancosViewEdit->id }}">{{ $listaBancosViewEdit->codigoBanco }} | {{ $listaBancosViewEdit->nomeBanco }}</option>
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
  <label for="reembolsado" class="col-sm-2 col-form-label">Reembolsado</label>
  <div class="col-sm-4">
    {!! Form::text('reembolsado', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}

    {{-- <select name="quempagou" id="quempagou" style="padding:4px;" class="selecionaComInput form-control" {{$variavelDisabledNaView}}>
    @if (Request::path() == 'despesas/create')
    <option value="N">Não</option>
    <option value="S">Sim</option>
    @else
    <option value="S" {{$despesa->quempagou == 'S'?' selected':''}}>Sim</option>
    <option value="N" {{$despesa->quempagou == 'N'?' selected':''}}>Não</option>
    @endif
    </select> --}}
  </div>

</div>

{{-- <div class="form-group row">

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
</div> --}}

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
<div class="container tabelaDespesas" id="tabelaDespesas">
  <table class="rwd-table">
    <tbody>
      <tr>
        <th>OS</th>
        <th>NF</th>
        <th>DESCRIÇÃO</th>
        <th>QTD.</th>
        <th>
          <nobr>VALOR UNITÁRIO</nobr>
        </th>
        <th>
          <nobr>VALOR LÍQUIDO</nobr>
        </th>
        <th>
          <nobr>VALOR PARCELA</nobr>
        </th>
        <th>VENCIMENTO</th>
      </tr>
      <tr>
        <td data-th="OS">
          {!! Form::text('os[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="NF">
          {!! Form::text('notaFiscal[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="DESCRIÇÃO">
          <select name="" id="">
            @foreach ($listaBensPatrimoniais as $bempatrimonial)
            <option value="{{ $bempatrimonial->id }}">{{ $bempatrimonial->nomeBensPatrimoniais }}</option>
            @endforeach
          </select>
          {!! Form::text('descricao[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="QUANTIDADE">
          {!! Form::text('quantidade[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR UNITÁRIO">
          {!! Form::text('valorUnitario[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR LÍQUIDO">
          {!! Form::text('valorLiquido[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valorliquido', 'value' => '0,00', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="PARCELA">
          {!! Form::number('parcela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VENCIMENTO">
          {!! Form::date('vencimento[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
      </tr>
      <tr>
        <td data-th="OS">
          {!! Form::text('os[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="NF">
          {!! Form::text('notaFiscal[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="DESCRIÇÃO">
          {!! Form::text('descricao[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="QUANTIDADE">
          {!! Form::text('quantidade[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR UNITÁRIO">
          {!! Form::text('valorUnitario[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR LÍQUIDO">
          {!! Form::text('valorLiquido[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valorliquido', 'value' => '0,00', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="PARCELA">
          {!! Form::text('parcela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VENCIMENTO">
          {!! Form::date('vencimento[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
      </tr>
      <tr>
        <td data-th="OS">
          {!! Form::text('os[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="NF">
          {!! Form::text('notaFiscal[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="DESCRIÇÃO">
          {!! Form::text('descricao[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="QUANTIDADE">
          {!! Form::text('quantidade[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR UNITÁRIO">
          {!! Form::text('valorUnitario[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR LÍQUIDO">
          {!! Form::text('valorLiquido[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valorliquido', 'value' => '0,00', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="PARCELA">
          {!! Form::text('parcela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VENCIMENTO">
          {!! Form::date('vencimento[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
      </tr>
      <tr>
        <td data-th="OS">
          {!! Form::text('os[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="NF">
          {!! Form::text('notaFiscal[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="DESCRIÇÃO">
          {!! Form::text('descricao[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="QUANTIDADE">
          {!! Form::text('quantidade[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR UNITÁRIO">
          {!! Form::text('valorUnitario[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VALOR LÍQUIDO">
          {!! Form::text('valorLiquido[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valorliquido', 'value' => '0,00', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="PARCELA">
          {!! Form::text('parcela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VENCIMENTO">
          {!! Form::date('vencimento[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
      </tr>
      <tr>
        <td data-th="OS">
          {{-- {!! Form::text('os[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}
        </td>
        <td data-th="NF">
          {{-- {!! Form::text('notaFiscal[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}
        </td>
        <td data-th="DESCRIÇÃO">
          {{-- {!! Form::text('descricao[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}
        </td>
        <td data-th="QUANTIDADE">
          {{-- {!! Form::text('quantidade[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}
        </td>
        <td data-th="VALOR UNITÁRIO">
          {{-- {!! Form::text('valorUnitario[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}
        </td>
        <td data-th="VALOR LÍQUIDO">
          {{-- <input data-inputmask="'mask': '000.000.999.99'" id="resultadoLiquido" />      --}}

          <input type="text" class="form-control" id="resultadoLiquido">
          {{-- <input type="text" class="form-control" onclick="$(this).mask('R$ ###.###.##0,00', {reverse: true});" id="resultadoLiquido">      --}}

          {{-- {!! Form::text('valorLiquido[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control padraoRealEdicao', 'id' => 'resultadoLiquido', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}
        </td>
        <td data-th="PARCELA">
          {!! Form::text('parcela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
        <td data-th="VENCIMENTO">
          {!! Form::date('vencimento[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
        </td>
      </tr>

    </tbody>
  </table>
</div>

<script>
  $('table input').on('input', function () {
    var $linha = $(this).closest('tr');
    var tot = 0
    var anterior = 1
    $linha.find('input.valoresoperacao:not("button")').each(function () {


      tot = $(this).val();
      console.log('tot ' + tot)

      tot = tot.toString($(this).val()).replace(/\D/g, "");
      tot = tot.toString($(this).val()).replace(/(\d)(\d{8})$/, "$1$2");
      tot = tot.toString($(this).val()).replace(/(\d)(\d{5})$/, "$1$2");
      tot = tot.toString($(this).val()).replace(/(\d)(\d{2})$/, "$1.$2");
      tot = parseFloat(tot);

      // tot = parseFloat(($(this).val()).replace(',', '.'));
      tot = (isNaN(tot) ? 0 : tot) * anterior;
      anterior = tot;
      console.log('anterior ' + anterior);

    });
    $linha.find('input.valorliquido').text(tot);
    var tg = 0;
    $linha.closest('table').find('input.valorliquido').each(function () {
      if ($(this).attr("id")) {
        // td sem id é a coluna do total geral, mas seria melhor ter uma identificação ou classe.
        var valor = parseFloat($(this).text().replace(',', '.'));
        // var valor = $(this).text();
        console.log(valor);
        tg += (isNaN(valor) ? 0 : valor);
      }
    });
    $(".valorliquido").val(tg);
  }).trigger("input");

  // $(".valorliquido").blur(function() {

  //   var total = 0;
  //   $(".valorliquido").each(function(indice, item) {

  //     var valor = $(item).val();

  //     valor = valor.toString($(item).val()).replace(/\D/g, "");
  //     valor = valor.toString($(item).val()).replace(/(\d)(\d{8})$/, "$1$2");
  //     valor = valor.toString($(item).val()).replace(/(\d)(\d{5})$/, "$1$2");
  //     valor = valor.toString($(item).val()).replace(/(\d)(\d{2})$/, "$1.$2");
  //     valor = parseFloat(valor);

  //     console.log('Valor: ' + valor);
  //     if (!isNaN(valor)) {
  //       total += valor;
  //     }
  //     console.log('Valor Líquido Total: ' + total);


  //     var soma = total.toLocaleString(undefined, {
  //       minimumFractionDigits: 2
  //     });
  //     $('#resultadoLiquido')
  //       .val(soma)
  //       .maskMoney({
  //         prefix: 'R$ ',
  //         allowNegative: false,
  //         thousands: '.',
  //         decimal: ',',
  //         affixesStay: false
  //       });
  //   });
  // });

</script>

{{ Form::hidden('nRegistro', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView]) }}
{!! Form::hidden('despesaCodigoDespesas', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('ativoDespesa', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}

{!! Form::hidden('atuacao', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}
{!! Form::hidden('totalPrecoCliente', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('totalPrecoReal', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('idDespesaPai', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}


{!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}