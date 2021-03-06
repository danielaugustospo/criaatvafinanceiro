@include('despesas/script')
@include('despesas/estilo')

<br>
<hr>
<div class="form-group row">
  <h5 for="descricaoDespesa" style="color: red;" class="col-sm-2 "><b>É Compra?</b></h5>

  <div class="col-sm-3 mt-2">
  @if (Request::path() == 'despesas/create')
    <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" /> SIM</label> <br/>
    <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" /> NÃO</label>
  @else
    @isset($despesa)
      @if ($despesa->ehcompra == 1)
        <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" checked /> SIM</label> <br/>
        <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" /> NÃO</label>
      @else
        <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" /> SIM</label> <br/>
        <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" checked/> NÃO</label>
      @endif    
    @endisset        
  @endif
  </div>
  @if (Request::path() == 'despesas/create')

  <div class="form-group row" id="telaParcelas">
  <h5 for="descricaoDespesa" style="color: red;" class="col-sm-5 mr-5"><b>Compra Parcelada?</b></h5>
  <div class="col-sm-3 mt-2">
    <label for="parcelada" class="mr-2 ml-2"><input type="radio" value="S" name="compraparcelada" id="parcelada"  /> SIM</label> <br/>
    <label for="naoparcelada" class="ml-2"><input type="radio" value="N" name="compraparcelada" id="naoparcelada" /> NÃO</label>
  </div>
  </div>
  @endif
</div>



<div class="form-group row">
  <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
  <div class="col-sm-4">
    <select name="idCodigoDespesas" id="idCodigoDespesas" class="selecionaComInput col-sm-12" {{$variavelDisabledNaView}}>
      @foreach ($codigoDespesa as $listaCodigoDespesas)
      <option value="{{$listaCodigoDespesas->id}}">
        {{$listaCodigoDespesas->despesaCodigoDespesa}} | {{ $listaCodigoDespesas->grupoDespesa }}
      </option>
      @endforeach
    </select>
    <div class="divRecarregaCodigoDespesa">
    </div>
  </div>

  {{-- <input type="text"> --}}

  <div class="col-sm2">
    <button type="button" onclick="recarregaCodigoDespesa()" class="btn btn-dark"><i class="fas fa-sync"></i></i></button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".codigodespesa"><i class="fas fa-industry pr-1"></i>Cadastrar Código de Despesa</button>
  </div>



</div>

<div class="form-group row" id="telaOS">
  <label for="idOS" class="col-sm-2 col-form-label">OS</label>
  <div class="col-sm-7">

    <select name="idOS" id="idOS" class="selecionaComInput col-sm-12" {{$variavelDisabledNaView}}>
      @foreach ($todasOSAtivas as $listaOS)
      <option value="{{$listaOS->id}}">
        {{$listaOS->id}} | {{$listaOS->eventoOrdemdeServico}}
      </option>
      @endforeach
    </select>

  </div>
</div>
<div class="form-group row" id="telaDescricao">
  <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
  <div class="col-sm-6">
    <select class="selecionaComInput form-control" name="descricaoDespesa" id="descricaoDespesa">
      @foreach ($listaBensPatrimoniais as $bempatrimonial)
      <option value="{{ $bempatrimonial->id }}">{{ $bempatrimonial->nomeBensPatrimoniais }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-sm-4">
    <button type="button" onclick="recarregaDescricaoDespesa()" class="btn btn-dark"><i class="fas fa-sync"></i></i></button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
  </div>
</div>

<input type="hidden" name="idFornecedor" id="idFornecedor">

<div class="form-group row" id="telaFornecedor">
  <label for="" class="col-sm-2 col-form-label">Fornecedor/Prestador de Serviço</label>
  <div class="col-sm-4">
    <select onchange="pegaIdFornecedor();" name="selecionaFornecedor" id="selecionaFornecedor" class="selecionaComInput selecionaFornecedor form-control col-sm-12" {{$variavelDisabledNaView}}>
      @foreach ($listaFornecedores as $fornecedor)
      <option value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-sm-4">
    <button type="button" onclick="recarregaFornecedorDespesa()" class="btn btn-dark"><i class="fas fa-sync"></i></i></button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".fornecedor"><i class="fas fa-industry pr-1"></i>Cadastrar Fornecedor</button>
  </div>
</div>

<div class="form-group row" id="telaFuncionario">
  <label for="" class="col-sm-2 col-form-label">Prestador de Serviço</label>
  <div class="col-sm-4">
    <select onchange="pegaIdFuncionario();" name="selecionaFornecedor" id="selecionaPrestadorServico" class="selecionaComInput selecionaFuncionario form-control col-sm-12" {{$variavelDisabledNaView}}>
      @foreach ($listaFornecedores as $fornecedor)
      <option value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
      @endforeach
    </select>
  </div>
</div>

<br>

<div class="form-group row">
  <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
  <div class="col-sm-4">
    <select name="idFormaPagamento" id="idFormaPagamento" class="selecionaComInput form-control col-sm-12 js-example-basic-multiple"  {{$variavelDisabledNaView}}>
      @foreach ($formapagamento as $formaPG)
      <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="conta" class="col-sm-2 col-form-label">Conta</label>
  <div class="col-sm-4">
    <select name="conta" id="conta" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple"  {{$variavelDisabledNaView}}>
      @foreach ($listaContas as $contas)
        <option value="{{ $contas->id }}">{{ $contas->nomeConta }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group row" id="telaValor">
  <label for="precoReal" class="col-sm-2 col-form-label">Valor</label>
  <div class="col-sm-2">
    {!! Form::text('precoReal', $precoReal, ['class' => 'campo-moeda form-control', 'maxlength' => '100', 'id' => 'precoReal',  $variavelReadOnlyNaView]) !!}
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


<div class="form-group row" id="telaDataPagamento">
  <label for="vencimento" class="col-sm-2 col-form-label">Data do Pagamento (Vencimento)</label>
  <div class="col-sm-3">
    {!! Form::date('vencimento', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', $variavelReadOnlyNaView]) !!}
  </div>
</div>


<div class="form-group row" id="telaNF">
  <label for="notaFiscal" class="col-sm-2 col-form-label">Nota Fiscal</label>
  <div class="col-sm-2">
    {!! Form::text('notaFiscal', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
  </div>
</div>

<div class="form-group row" id="divComprou">
  <label for="quemComprouSelect" class="col-sm-2 col-form-label">Quem Comprou</label>
  <div class="col-sm-4">
    <select onchange="alteraIdComprador();" name="quemComprouSelect" id="selecionaComprador" class="selecionaComInput quemComprouSelect form-control" {{$variavelDisabledNaView}}>
      @foreach ($listaFornecedores as $fornecedor)
      <option value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
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

  </div>
</div>

<div class="form-group row">
  <label for="cheque" class="col-sm-2 col-form-label">Cheque</label>
  <div class="col-sm-2">
    {!! Form::text('cheque', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
  </div>
</div>

<div class="form-group row" id="telaPago">
  <label for="pago" class="col-sm-2 col-form-label">Pago</label>
  <div class="col-sm-2">
    <select name="pago" id="pago" style="padding:4px;" class="selecionaComInput form-control" {{$variavelDisabledNaView}}>
      @if (Request::path() == 'despesas/create')
      <option value="0">Não</option>
      <option value="1">Sim</option>
      @else
      <option value="1" {{$despesa->pago == '1'?' selected':''}}>Sim</option>
      <option value="0" {{$despesa->pago == '0'?' selected':''}}>Não</option>
      @endif
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="reembolsado" class="col-sm-2 col-form-label">Reembolsado</label>
  {{-- <div class="col-sm-4">
    {!! Form::text('reembolsado', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView ]) !!}
  </div> --}}
  <div class="col-sm-4">
    <select onchange="pegaIdFornecedor();" name="reembolsado" id="reembolsado" class="selecionaComInput reembolsado form-control col-sm-12" {{$variavelDisabledNaView}}>
      @foreach ($listaFornecedores as $fornecedor)
      <option value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
      @endforeach
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

@include('despesas/cadastracodigodespesa')
{{-- @include('despesas/criagrupodespesa') --}}
@include('despesas/cadastramaterial')
@include('despesas/cadastrafornecedor')

<div class="container tabelaDespesas" id="tabelaDespesas">
  <div class="pb-2 container row">
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-users-cog"> </i><i class="fas fa-coins pr-1"> </i>Adicionar Grupo Despesa</button> --}}
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i class="fas fa-industry pr-1"></i>Cadastrar Materiais</button> --}}
  </div>
  @include('despesas/tabelaparcelas')
</div>


{{  Form::hidden('nRegistro', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView]) }}
{!! Form::hidden('despesaCodigoDespesas', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('ativoDespesa', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}
{!! Form::hidden('ehcompra', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}
{!! Form::hidden('totalPrecoCliente', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('totalPrecoReal', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('idDespesaPai', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}
{!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}