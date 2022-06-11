@include('despesas/script')
@include('despesas/estilo')

@csrf

<br>
<hr>
<div class="form-group row">
    <h5 for="descricaoDespesa" style="color: red;" class="col-sm-2 "><b>É Compra?</b></h5>

    <div class="col-sm-3 mt-2">
        @if (Request::path() == 'despesas/create')
            <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" />
                SIM</label> <br />
            <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" /> NÃO</label>
        @endif
            @isset($despesa)
                
                    <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" {{ $variavelDisabledNaView }} @if ($despesa->ehcompra == 1) checked @endif /> SIM</label> <br />
                    <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" {{ $variavelDisabledNaView }} @if ($despesa->ehcompra == 0) checked @endif /> NÃO</label>
                
            @endisset
        
    </div>

    <div class="form-group row" id="telaCompraParcelada">
        <h5 for="descricaoDespesa" style="color: red;" class="col-sm-5 mr-5"><b>Compra Parcelada?</b></h5>
        <div class="col-sm-3 mt-2">
            <label for="parcelada" class="mr-2 ml-2"><input type="radio" value="S" name="compraparcelada"
                @if(isset($despesa)) disabled @endif id="parcelada" /> SIM</label> <br />
            <label for="naoparcelada" class="ml-2"><input type="radio" value="N" name="compraparcelada"
                @if(isset($despesa)) disabled checked @endif id="naoparcelada" /> NÃO</label>
        </div>
    </div>
    
</div>

<div class="form-group row">
    <label for="despesaCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-4">
        <select name="despesaCodigoDespesas" id="despesaCodigoDespesas" class="selecionaComInput col-sm-12"
            {{ $variavelDisabledNaView }} required>
            @if (!isset($despesa))
                <option disabled selected>Selecione...</option>
            @endif

            @foreach ($codigoDespesa as $listaCodigoDespesas)
                @isset($despesa)
                    @if ($despesa->despesaCodigoDespesas == $listaCodigoDespesas->id)
                        <option value="{{ $listaCodigoDespesas->id }}" selected>
                            {{ $listaCodigoDespesas->despesaCodigoDespesa }} | {{ $listaCodigoDespesas->grupoDespesa }}
                        </option>
                    @endif
                @endisset
                <option value="{{ $listaCodigoDespesas->id }}">{{ $listaCodigoDespesas->despesaCodigoDespesa }} |
                    {{ $listaCodigoDespesas->grupoDespesa }}</option>
            @endforeach
        </select>
        <div class="divRecarregaCodigoDespesa">
        </div>
    </div>

    <div class="col-sm2">
        <button type="button" onclick="recarregaCodigoDespesa()" class="btn btn-dark"><i
                class="fas fa-sync"></i></i></button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".codigodespesa"><i
                class="fas fa-industry pr-1"></i>Cadastrar Código de Despesa</button>
    </div>

</div>

<div class="form-group row" id="telaOS">
    <label for="idOS" class="col-sm-2 col-form-label">OS</label>
    <div class="col-sm-7">

        <select name="idOS" id="idOS" class="selecionaComInput col-sm-10" {{ $variavelDisabledNaView }}>
            <option value="CRIAATVA">SEM OS</option>
            @foreach ($todasOSAtivas as $listaOS)
                @isset($despesa)
                    @if ($despesa->idOS == $listaOS->id)
                        <option value="{{ $listaOS->id }}" selected>{{ $listaOS->id }} |
                            {{ $listaOS->eventoOrdemdeServico }}</option>
                        @if ($despesa->idOS == 'CRIAATVA')
                            <option value="CRIAATVA" selected>SEM OS</option>
                        @endif
                    @endif
                @endisset
                <option value="{{ $listaOS->id }}">{{ $listaOS->id }} | {{ $listaOS->eventoOrdemdeServico }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row" id="telaDescricao">
    <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
    <div class="col-sm-6">

        <div id="despesaCompra">
            <select class="selecionaComInput form-control descricaoDespesaCompra" id="descricaoDespesa" name="descricaoDespesaCompra">
                @if (!isset($despesa))
                    <option disabled selected>Selecione...</option>
                @endif
                @foreach ($listaBensPatrimoniais as $bempatrimonial)
                    <option value="{{ $bempatrimonial->id }}" @php
                        if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa == $bempatrimonial->id):
                            echo 'selected';
                        endif;
                    @endphp>
                        {{ $bempatrimonial->nomeBensPatrimoniais }}
                    </option>
                @endforeach

            </select>

        </div>
        <div id="despesaNaoCompra">
            <input class="form-control descricaoDespesa" list="datalistDescricao" id="descricaoDespesa" @php
                if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                    echo 'value="' . $despesa->descricaoDespesa . '"';
                endif;
            @endphp
                name="descricaoDespesaNaoCompra" placeholder="Digite ou selecione...">
            <datalist id="datalistDescricao">
                @foreach ($listaDespesas as $listaDespesas)
                    <option value="{{ $listaDespesas->descricaoDespesa }}">{{ $listaDespesas->descricaoDespesa }}
                    </option>
                @endforeach
            </datalist>
        </div>
    </div>
    
    <div class="col-sm-4" id="telaCadastrarMateriais">
        <button type="button" onclick="recarregaDescricaoDespesa()" class="btn btn-dark"><i
                class="fas fa-sync"></i></i></button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i
                class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
    </div>

</div>


<div class="form-group row" id="telaFornecedor">
    <label for="" class="col-sm-2 col-form-label">Fornecedor/Prestador de Serviço</label>
    <div class="col-sm-4">
        <select name="idFornecedor" id="selecionaFornecedor"
            class="selecionaComInput selecionaFornecedor form-control col-sm-12" {{ $variavelDisabledNaView }}>
            @if (!isset($despesa))
                <option disabled selected>Selecione...</option>
            @endif
            @foreach ($listaFornecedores as $fornecedor)
                @isset($despesa)
                    @if ($despesa->idFornecedor == $fornecedor->id)
                        <option value="{{ $fornecedor->id }}" selected>{{ $fornecedor->razaosocialFornecedor }}
                        </option>
                    @endif
                @endisset
                <option value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-4 pl-0">
        <button type="button" onclick="recarregaFornecedorDespesa()" class="btn btn-dark"><i
                class="fas fa-sync"></i></i></button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".fornecedor"><i
                class="fas fa-industry pr-1"></i>Cadastrar Fornecedor</button>
    </div>
</div>

<br>

<div class="form-group row">
    <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">
        <select name="idFormaPagamento" id="idFormaPagamento"
            class="selecionaComInput form-control col-sm-12 js-example-basic-multiple" {{ $variavelDisabledNaView }}>
            @if (!isset($despesa))
                <option disabled selected>Selecione...</option>
            @endif
            @foreach ($formapagamento as $formaPG)
                @isset($despesa)
                    @if ($despesa->idFormaPagamento == $formaPG->id)
                        <option value="{{ $formaPG->id }}" selected>{{ $formaPG->nomeFormaPagamento }}</option>
                    @endif
                @endisset
                <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="conta" class="col-sm-2 col-form-label">Conta</label>
    <div class="col-sm-4">
        <select name="conta" id="conta" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple conta"
            {{ $variavelDisabledNaView }}>
            @if (!isset($despesa))
                <option disabled selected>Selecione...</option>
            @endif
            @foreach ($listaContas as $contas)
                @isset($despesa)
                    @if ($despesa->conta == $contas->id)
                        <option value="{{ $contas->id }}" selected>{{ $contas->nomeConta }}</option>
                    @endif
                @endisset
                <option value="{{ $contas->id }}">{{ $contas->nomeConta }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row" id="telaQuantidade">
    <label for="quantidadeSemParcelamento" class="col-sm-2 col-form-label">Quantidade / Unidade</label>
    <div class="col-sm-2">
        {!! Form::text('quantidadeSemParcelamento', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="valorUnitarioSemParcelamento" class="col-sm-1 col-form-label">Valor Unitário</label>
    <div class="col-sm-2">
        {!! Form::text('valorUnitarioSemParcelamento', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control campo-moeda valoresoperacao', 'maxlength' => '50', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row" id="telaValor">
    <label for="precoReal" class="col-sm-2 col-form-label">Valor</label>
    <div class="col-sm-2">
        {!! Form::text('precoReal', $precoReal, ['class' => 'campo-moeda form-control precoReal', 'maxlength' => '100', 'id' => 'precoReal', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="vale" style="color: red;" class="col-sm-1 col-form-label">Vale</label>
    <div class="col-sm-2">
        {!! Form::text('vale', $vale, ['class' => 'campo-moeda form-control', 'style' => 'color: red;', 'maxlength' => '100', 'id' => 'vale', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="datavale" style="color: red;" class="col-sm-1 col-form-label">Data Vale</label>
    <div class="col-sm-2">
        {!! Form::date('datavale', $valorInput, ['class' => 'campo-moeda form-control', 'style' => 'color: red;', 'maxlength' => '100', 'id' => 'datavale', $variavelReadOnlyNaView]) !!}
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
        <select onchange="alteraIdComprador();" name="quemComprouSelect" id="selecionaComprador"
            class="selecionaComInput quemComprouSelect form-control" {{ $variavelDisabledNaView }}>
            @if (!isset($despesa->quemcomprou) || $despesa->quemcomprou == null)
                <option disabled selected>SEM REEMBOLSO</option>
            @endif
            @foreach ($listaFornecedores as $fornecedor)
                @isset($despesa)
                    @if ($despesa->quemcomprou == $fornecedor->id)
                        <option value="{{ $fornecedor->id }}" selected>{{ $fornecedor->razaosocialFornecedor }}
                        </option>
                    @endif
                @endisset
                <option value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" value="{{ old('quemcomprou') }}" name="quemcomprou" id="quemcomprou">
</div>

<div class="form-group row">
    <label for="idBanco" class="col-sm-2 col-form-label">Banco</label>
    <div class="col-sm-4">
        <select name="idBanco" id="idBanco" class="selecionaComInput form-control" {{ $variavelDisabledNaView }}>
            @if (!isset($despesa->idBanco) || $despesa->idBanco == null || $despesa->idBanco == 0)
            <option value="0" selected>SEM BANCO</option>
            @endif
            @foreach ($listaBancos as $listaBancosViewEdit)
            @isset($despesa)
                @if ($despesa->idBanco == $listaBancosViewEdit->id)
                <option value="{{ $listaBancosViewEdit->id }}" selected>
                    {{ $listaBancosViewEdit->codigoBanco }} | {{ $listaBancosViewEdit->nomeBanco }}
                </option>
            @endif
            @endisset
            <option value="{{ $listaBancosViewEdit->id }}">
                {{ $listaBancosViewEdit->codigoBanco }} | {{ $listaBancosViewEdit->nomeBanco }}
            </option>            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="cheque" class="col-sm-2 col-form-label">Cheque</label>
    <div class="col-sm-2">
        {!! Form::text('cheque', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row" id="telaPago">
    <label for="pago" class="col-sm-2 col-form-label">Pago</label>
    <div class="col-sm-2">
        <select name="pago" id="pago" style="padding:4px;" class="selecionaComInput form-control"
            {{ $variavelDisabledNaView }}>
            @if (Request::path() == 'despesas/create')
                <option value="N">Não</option>
                <option value="S">Sim</option>
            @else
                @if (isset($despesa))
                    @if (!isset($despesa->pago) || $despesa->pago == null)
                        <option disabled selected>Selecione...</option>
                    @endif
                @endif
                <option value="S" {{ $despesa->pago == 'S' ? ' selected' : '' }}>Sim</option>
                <option value="N" {{ $despesa->pago == 'N' ? ' selected' : '' }}>Não</option>
            @endif
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="reembolsado" class="col-sm-2 col-form-label">Reembolsado</label>

    <div class="col-sm-4">
        <select name="reembolsado" id="reembolsado" class="selecionaComInput reembolsado form-control col-sm-12"
            {{ $variavelDisabledNaView }}>

            @foreach ($listaFornecedores as $fornecedor)
                @isset($despesa)
                    @if ($despesa->reembolsado == $fornecedor->id)
                        <option value="{{ $fornecedor->id }}" selected>{{ $fornecedor->razaosocialFornecedor }}
                        </option>
                    @endif
                    @if ($despesa->reembolsado == '0')
                        <option value="0" selected>SEM REEMBOLSO</option>
                    @endif
                @endisset
                <option value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
            @endforeach

            <?php if (!isset($despesa->reembolsado) || $despesa->reembolsado == null) {
                echo '<option value="0" selected>SEM REEMBOLSO</option>';
            } ?>
        </select>
    </div>
</div>


<div class="form-group row">
    @if (Request::path() == 'despesas/create')
        <label for="despesaFixa" class="col-sm-2 col-form-label">Despesa Fixa?</label>
        <div class="col-sm-2">
            <select name="despesaFixa" id="despesaFixa"
                class="selecionaComInput form-control col-sm-12  js-example-basic-multiple"
                {{ $variavelDisabledNaView }}>
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
    @elseif ($despesa->idDespesaPai == 0 || $despesa->despesaFixa == null || $despesa->idDespesaPai == null)
        <label for="despesaFixa" class="col-sm-2 col-form-label">Despesa Fixa?</label>
        <div class="col-sm-2">
            <select name="despesaFixa" id="despesaFixa"
                class="selecionaComInput form-control col-sm-12  js-example-basic-multiple"
                {{ $variavelDisabledNaView }}>
                <option value="0" @if ($despesa->despesaFixa == '0' || $despesa->despesaFixa == null) : {{ 'selected' }} @endif>Não</option>
                <option value="1" {{ $despesa->despesaFixa == '1' ? ' selected' : '' }}>Sim</option>
            </select>
        </div>
    @else
        <label for="despesaFixa" class="text-center col-sm-12 mt-5 pr-2" style="color:red;">Esta despesa já é uma
            despesa fixa. Despesa Pai id n°{{ $despesa->idDespesaPai }}</label>
    @endif

    <div class="form-group row" id="telaPrestador">
        <label for="" class="col-sm-3 col-form-label">Código Funcionário</label>
        <div class="col-sm-6">
            <select name="idFuncionario" id="idFuncionario" class="selecionaComInput form-control col-sm-12"
                {{ $variavelDisabledNaView }}>
                @if (Request::path() == 'despesas/create')
                    <option value="0" selected>SEM FUNCIONÁRIO</option>
                    @foreach ($listaFuncionarios as $funcionario)
                        <option value="{{ $funcionario->id }}">{{ $funcionario->nomeFuncionario }}</option>
                    @endforeach
                @else
                    @isset($despesa)
                        @foreach ($listaFuncionarios as $funcionario)
                            @if ($despesa->idFuncionario == $funcionario->id)
                                <option value="{{ $funcionario->id }}" selected>{{ $funcionario->nomeFuncionario }}
                                </option>
                            @endif
                        @endforeach
                        @if ($despesa->idFuncionario == '0' || $despesa->idFuncionario == null)
                            <option value="0" selected>SEM FUNCIONÁRIO</option>
                        @endif
                        @foreach ($listaFuncionarios as $funcionario)
                            <option value="{{ $funcionario->id }}">{{ $funcionario->nomeFuncionario }}</option>
                        @endforeach
                    @endisset
                @endif

            </select>
        </div>
    </div>

</div>

@include('despesas/cadastracodigodespesa')
{{-- @include('despesas/criagrupodespesa') --}}
@include('despesas/cadastramaterial')
@include('layouts/cadastrafornecedor')

@if(!isset($despesa))
    <div class="tabelaDespesas" id="tabelaDespesas">
        <div class="pb-2 container row">
        </div>
        @include('despesas/tabelaparcelas')
    </div>
@endif


{{ Form::hidden('nRegistro', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView]) }}
{!! Form::hidden('ativoDespesa', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}
{{-- <!-- {!! Form::hidden('ehcompra', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'ehcompra']) !!} --> --}}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}

{!! Form::hidden('idDespesaPai', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '2']) !!}
{!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
{!! Form::hidden('excluidoDespesa', $valorSemCadastro, ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}
