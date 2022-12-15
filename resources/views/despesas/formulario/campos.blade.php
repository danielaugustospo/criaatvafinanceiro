@include('despesas/script')
@include('despesas/estilo')

<script>
    // Show full page LoadingOverlay
    $.LoadingOverlay("show", {
        image: "",
        text: "Carregando..."
    });

    setTimeout(function() {
        $.LoadingOverlay("text", "Finalizando...");
        $.LoadingOverlay("hide");
    }, 2500);
    // setTimeout(function() {
    //     $.LoadingOverlay("hide");
    // }, 900);
</script>
@csrf

<br>
<hr>

@include('despesas/formulario/perguntaslancamento')

<div class="pl-2 pr-2" id="telaGeral">
    <div class="tabelaDespesas" id="tabelaMultiplasDespesas">
        <div class="pb-2 container row">
        </div>
        @include('despesas/formulario/tabelamultiplasdespesas')
    </div>

    <br>
    <hr>

    <div class="form-group row">
        <label for="despesaCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
        <div class="col-sm-4">
            <select name="despesaCodigoDespesas" id="despesaCodigoDespesas"
                class="selecionaComInput col-sm-12 despesaCodigoDespesas" {{ $variavelDisabledNaView }} required>

                @if (!isset($despesa->despesaCodigoDespesas) ||
                    $despesa->despesaCodigoDespesas == null ||
                    $despesa->despesaCodigoDespesas == '' ||
                    $despesa->despesaCodigoDespesas == 0)
                    {!! $infoSelectVazio !!}
                @endif

                @foreach ($codigoDespesa as $listaCodigoDespesas)
                    <option value="{{ $listaCodigoDespesas->id }}" @if (isset($despesa) && $despesa->despesaCodigoDespesas == $listaCodigoDespesas->id) selected @endif>
                        {{ $listaCodigoDespesas->despesaCodigoDespesa }} | {{ $listaCodigoDespesas->grupoDespesa }}
                    </option>
                @endforeach
            </select>
            <div class="divRecarregaCodigoDespesa"></div>
        </div>

        <div class="col-sm2">
            <button type="button" onclick="recarregaCodigoDespesa()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".codigodespesa"><i
                    class="fas fa-industry pr-1"></i>Cadastrar Código de Despesa</button>
        </div>

    </div>
    
    <div class=" form-group row" id="telaPrestador">
        <label for="valorUnitario" class="col-sm-2 col-form-label">Código Funcionário</label>
        <div class="col-sm-7">
            <select name="idFuncionario" id="idFuncionario" class="selecionaComInput form-control col-sm-10"
                    {{ $variavelDisabledNaView }}>

                    @if (!isset($despesa->idFuncionario) ||
                        $despesa->idFuncionario == null ||
                        $despesa->idFuncionario == '' ||
                        $despesa->idFuncionario == 0)
                        {!! $infoSelectVazio !!}
                    @else
                    {!! $infoSelectVazio !!}
                    @endif

                    @foreach ($listaFuncionarios as $funcionario)
                        <option value="{{ $funcionario->id }}" @if (isset($despesa) && $despesa->idFuncionario == $funcionario->id) selected @endif>
                            {{ $funcionario->nomeFuncionario }}
                        </option>
                    @endforeach
                        

                </select>
        </div>
        </div>

        {{-- Tela Prestador de Serviços --}}

    <div class="form-group row" id="telaOS">
        <label for="idOS" class="col-sm-2 col-form-label">OS</label>
        <div class="col-sm-7">

            <select name="idOS" id="idOS" class="selecionaComInput col-sm-10" {{ $variavelDisabledNaView }}>
                <option value="EMPRESA/CRIAATVA">SEM OS</option>
                @foreach ($todasOSAtivas as $listaOS)
                    @isset($despesa)
                        @if ($despesa->idOS == $listaOS->id)
                            <option value="{{ $listaOS->id }}" selected>{{ $listaOS->id }} |
                                {{ $listaOS->eventoOrdemdeServico }}</option>
                            @if ($despesa->idOS == 'EMPRESA/CRIAATVA')
                                <option value="EMPRESA/CRIAATVA" selected>SEM OS</option>
                            @endif
                        @endif
                    @endisset
                    <option value="{{ $listaOS->id }}">{{ $listaOS->id }} |
                        {{ $listaOS->eventoOrdemdeServico }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Tela Descrição --}}
    <div class="form-group row" id="telaDescricao">
        <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
        <div class="col-sm-6">

            <div id="despesaCompra">
                <select class="selecionaComInput form-control descricaoDespesaCompra" id="descricaoDespesa"
                    name="descricaoDespesaCompra" {{$variavelDisabledNaView}}>

                    @if (!isset($despesa->descricaoDespesa) ||
                    $despesa->descricaoDespesa == null ||
                    $despesa->descricaoDespesa == '' ||
                    $despesa->descricaoDespesa == 0)
                    {!! $infoSelectVazio !!}
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
            <div id="despesaCompraSemEstoque">
                <input class="form-control descricaoDespesaSemEstoque" id="descricaoDespesa" @php
                    if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                        echo 'value="' . $despesa->descricaoDespesa . '"' . $variavelDisabledNaView;
                    endif;
                @endphp
                    name="descricaoDespesaSemEstoque">
            </div>
            <div id="despesaNaoCompra">
                <input class="form-control descricaoDespesa" list="datalistDescricao" id="descricaoDespesa"
                    @php
                        if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                            echo 'value="' . $despesa->descricaoDespesa . '"' . $variavelDisabledNaView;
                        endif;
                    @endphp name="descricaoDespesaNaoCompra" placeholder="Digite ou selecione...">
                <datalist id="datalistDescricao">
                    @foreach ($listaDespesas as $listaDespesas)
                        <option value="{{ $listaDespesas->descricaoDespesa }}">
                            {{ $listaDespesas->descricaoDespesa }}
                        </option>
                    @endforeach
                </datalist>
            </div>
        </div>

        {{-- Tela Cadastrar Materiais --}}
        <div class="col-sm-4" id="telaCadastrarMateriais">
            <button type="button" onclick="recarregaDescricaoDespesa()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i
                    class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
        </div>

    </div>

    {{-- Tela Fornecedor --}}
    <div class="form-group row" id="telaFornecedor">
        <label for="" class="col-sm-2 col-form-label">Fornecedor / Prestador de Serviço</label>
        <div class="col-sm-4">
            <select name="idFornecedor" id="selecionaFornecedor"
                class="selecionaComInput selecionaFornecedor form-control col-sm-12" {{ $variavelDisabledNaView }}>
                @if (!isset($despesa->idFornecedor) ||
                    $despesa->idFornecedor == null ||
                    $despesa->idFornecedor == '' ||
                    $despesa->idFornecedor == 0)
                    {!! $infoSelectVazio !!}
                @endif
                @foreach ($listaFornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" @if (isset($despesa) && $despesa->idFornecedor == $fornecedor->id) selected @endif>
                        {{ $fornecedor->razaosocialFornecedor }}
                    </option>
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
                class="selecionaComInput form-control col-sm-12 idFormaPagamento" {{ $variavelDisabledNaView }}>
                @if (!isset($despesa->idFormaPagamento) ||
                    $despesa->idFormaPagamento == null ||
                    $despesa->idFormaPagamento == '' ||
                    $despesa->idFormaPagamento == 0)
                    {!! $infoSelectVazio !!}
                @endif
                @foreach ($formapagamento as $formaPG)
                    <option value="{{ $formaPG->id }}" @if (isset($despesa) && $despesa->idFormaPagamento == $formaPG->id) selected @endif>
                        {{ $formaPG->nomeFormaPagamento }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="conta" class="col-sm-2 col-form-label">Conta</label>
        <div class="col-sm-4">
            <select name="conta" id="conta"
                class="selecionaComInput form-control col-sm-12  js-example-basic-multiple conta"
                {{ $variavelDisabledNaView }}>

                @if (!isset($despesa->conta) || $despesa->conta == null || $despesa->conta == '' || $despesa->conta == 0)
                    {!! $infoSelectVazio !!}
                @endif

                @foreach ($listaContas as $contas)
                    <option value="{{ $contas->id }}" @if (isset($despesa) && $despesa->conta == $contas->id) selected @endif>
                        {{ $contas->nomeConta }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Tela Quantidade --}}
    <div class="form-group row" id="telaQuantidade">
        <label for="quantidade" class="col-sm-2 col-form-label">Quantidade / Unidade</label>
        <div class="col-sm-2">
            {!! Form::text('quantidade', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control',
                'maxlength' => '20',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
        <label for="valorUnitario" class="col-sm-1 col-form-label">Valor Unitário</label>
        <div class="col-sm-2">
            {!! Form::text('valorUnitario', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control campo-moeda valoresoperacao',
                'maxlength' => '50',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
    </div>

    <div class="form-group row" id="telaValor">
        <label for="precoReal" class="col-sm-2 col-form-label">Valor</label>
        <div class="col-sm-2">
            {!! Form::text('precoReal', $precoReal, [
                'class' => 'campo-moeda form-control precoReal',
                'maxlength' => '100',
                'id' => 'precoReal',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
        <label for="vale" style="color: red;" class="col-sm-1 col-form-label">Vale</label>
        <div class="col-sm-2">
            {!! Form::text('vale', $vale, [
                'class' => 'campo-moeda form-control',
                'style' => 'color: red;',
                'maxlength' => '100',
                'id' => 'vale',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
        <label for="datavale" style="color: red;" class="col-sm-1 col-form-label">Data Vale</label>
        <div class="col-sm-2">
            {!! Form::date('datavale', $valorInput, [
                'class' => 'campo-moeda form-control',
                'style' => 'color: red;',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'id' => 'datavale',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
    </div>

    <div class="form-group row" id="telaDataCompra">
        <label for="dataDaCompra" class="col-sm-2 col-form-label">Data da Compra</label>
        <div class="col-sm-3">
            {!! Form::date('dataDaCompra', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'class' => 'form-control',
                'id' => 'dataDaCompra',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
    </div>

    <div class="form-group row" id="telaDataTrabalho">
        <label for="dataDoTrabalho" class="col-sm-2 col-form-label">Data do Trabalho</label>
        <div class="col-sm-3">
            {!! Form::date('dataDoTrabalho', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'class' => 'form-control',
                'id' => 'dataDoTrabalho',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
    </div>


    <div class="form-group row" id="telaDataPagamento">
        <label for="vencimento" class="col-sm-2 col-form-label">Data do Pagamento (Vencimento)</label>
        <div class="col-sm-3">
            {!! Form::date('vencimento', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'class' => 'form-control',
                'id' => 'vencimento',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
    </div>


    <div class="form-group row" id="telaNF">
        <label for="notaFiscal" class="col-sm-2 col-form-label">Nota Fiscal</label>
        <div class="col-sm-2">
            {!! Form::text('notaFiscal', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control',
                'maxlength' => '20',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
    </div>

    <div class="form-group row" id="divComprou">
        <label for="quemComprouSelect" class="col-sm-2 col-form-label">Quem Comprou</label>
        <div class="col-sm-4">
            <select onchange="alteraIdComprador();" name="quemComprouSelect" id="selecionaComprador"
                class="selecionaComInput quemComprouSelect form-control" {{ $variavelDisabledNaView }}>

                @if (!isset($despesa->quemcomprou) ||
                    $despesa->quemcomprou == null ||
                    $despesa->quemcomprou == '' ||
                    $despesa->quemcomprou == 0)
                    {!! $infoSelectVazio !!}
                @endif

                @foreach ($listaFornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" @if (isset($despesa) && $despesa->quemcomprou == $fornecedor->id) selected @endif>
                        {{ $fornecedor->razaosocialFornecedor }}
                    </option>
                @endforeach
            </select>
        </div>
        <input type="hidden" value="{{ old('quemcomprou') }}" name="quemcomprou" id="quemcomprou">
    </div>

    <div class="form-group row">
        <label for="idBanco" class="col-sm-2 col-form-label">Banco</label>
        <div class="col-sm-4">
            <select name="idBanco" id="idBanco" class="selecionaComInput form-control"
                {{ $variavelDisabledNaView }}>
                @if (!isset($despesa->idBanco) || $despesa->idBanco == null || $despesa->idBanco == '' || $despesa->idBanco == 0)
                    {!! $infoSelectVazio !!}
                @endif
                @foreach ($listaBancos as $listaBancosViewEdit)
                    <option value="{{ $listaBancosViewEdit->id }}" @if (isset($despesa) && $despesa->idBanco == $listaBancosViewEdit->id) selected @endif>
                        {{ $listaBancosViewEdit->codigoBanco }} | {{ $listaBancosViewEdit->nomeBanco }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="cheque" class="col-sm-2 col-form-label">Cheque</label>
        <div class="col-sm-2">
            {!! Form::text('cheque', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control',
                'maxlength' => '100',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>
    </div>

    {{-- Tela Pago --}}
    <div class="form-group row" id="telaPago">
        <label for="pago" class="col-sm-2 col-form-label">Pago</label>
        <div class="col-sm-2">
            <select name="pago" id="pago" style="padding:4px;" class="selecionaComInput form-control"
                {{ $variavelDisabledNaView }}>
                @if (Request::path() == 'despesas/create')
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                @else
                    @if (!isset($despesa->pago) || $despesa->pago == null || $despesa->pago == '' || $despesa->pago == 0)
                        {!! $infoSelectVazio !!}
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

                @if (!isset($despesa->reembolsado) ||
                    $despesa->reembolsado == null ||
                    $despesa->reembolsado == '' ||
                    $despesa->reembolsado == 0)
                    {!! $infoSelectVazio !!}
                @endif

                @foreach ($listaFornecedores as $fornecedor)
                    <option value="{{ $fornecedor->id }}" @if (isset($despesa) && $despesa->reembolsado == $fornecedor->id) selected @endif>
                        {{ $fornecedor->razaosocialFornecedor }}
                    </option>
                @endforeach
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
                    <option value="0" @if ($despesa->despesaFixa == '0' || $despesa->despesaFixa == null) : {{ 'selected' }} @endif>Não
                    </option>
                    <option value="1" {{ $despesa->despesaFixa == '1' ? ' selected' : '' }}>Sim</option>
                </select>
            </div>
        @else
            <label for="despesaFixa" class="text-center col-sm-12 mt-5 pr-2" style="color:red;">Esta despesa já é uma
                despesa fixa. Despesa Pai id n°{{ $despesa->idDespesaPai }}</label>
        @endif
        
       

    </div>

    @include('despesas/cadastracodigodespesa')
    {{-- @include('despesas/criagrupodespesa') --}}
    @include('despesas/cadastramaterial')
    @include('layouts/cadastrafornecedor')

    @if (!isset($despesa))
        <div class="tabelaDespesas" id="tabelaDespesas">
            <div class="pb-2 container row">
            </div>
            @include('despesas/formulario/tabelaparcelas')
        </div>
    @endif

    @isset($paginaModal)
        <input type="hidden" value="1" name="paginaModal">
    @else
        <input type="hidden" value="0" name="paginaModal">
    @endisset

    {{ Form::hidden('nRegistro', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView]) }}

    {!! Form::hidden('idDespesaPai', $valorSemCadastro, [
        'placeholder' => 'Preencha este campo',
        'class' => 'form-control',
        'maxlength' => '2',
    ]) !!}
    {!! Form::hidden('ativoDespesa', '1', [
        'placeholder' => 'Ativo ',
        'class' => 'form-control',
        'maxlength' => '1',
        'id' => 'ativoDespesa',
    ]) !!}
    {!! Form::hidden('excluidoDespesa', $valorSemCadastro, [
        'placeholder' => 'Excluído ',
        'class' => 'form-control',
        'maxlength' => '1',
        'id' => 'excluidoDespesa',
    ]) !!}

</div>
