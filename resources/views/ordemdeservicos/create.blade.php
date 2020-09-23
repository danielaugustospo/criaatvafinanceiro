@extends('layouts.app')


@section('content')
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->

<script type="text/javascript">
    $(document).ready(function($) {
        $("#nomeFormaPagamento").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#idClienteOrdemdeServico").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#idCodigoDespesas").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#idFormaPagamento").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#idFormaPagamentoReceita").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#conta").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function($) {
        $("#contaReceita").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });
    });
    $(document).ready(function() {
        $("#totalPrecoReal").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#totalPrecoCliente").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#lucro").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#valorEstornado").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#precoReal").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#precoCliente").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#valorTotalOrdemdeServico").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#valorProjetoOrdemdeServico").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#valorOrdemdeServico").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });
    $(document).ready(function() {
        $("#valorreceita").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });


</script>



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Ordem de Serviço</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Ops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


{!! Form::open(array('route' => 'ordemdeservicos.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeFormaPagamento" class="col-sm-2 col-form-label">Forma de Pagamento</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('nomeFormaPagamento', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <!-- <select name="nomeFormaPagamento" id="testa" class="selectPG js-example-basic-multiple"  multiple="multiple"> -->
        <select name="nomeFormaPagamento" id="nomeFormaPagamento" class="form-control col-sm-4 js-example-basic-multiple">
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
    <label for="idClienteOrdemdeServico" class="col-sm-1 col-form-label">Cliente</label>
    <div class="col-sm-5">
        <!-- {!! Form::text('idClienteOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <select name="idClienteOrdemdeServico" id="idClienteOrdemdeServico" class="form-control  js-example-basic-multiple">
            @foreach ($cliente as $clientes)
            <option value="{{ $clientes->id }}">{{ $clientes->nomeCliente }}</option>
            @endforeach
        </select>
    </div>
</div>



<div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Data Venda</label>
    <div class="col-sm-2">
        {!! Form::date('dataVendaOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
    <label for="dataOrdemdeServico" class="col-sm-2 col-form-label">Data Ordem de Serviço</label>
    <div class="col-sm-2">
        {!! Form::date('dataOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
    <label for="dataCriacaoOrdemdeServico" class="col-sm-1 col-form-label">Data Criação</label>
    <div class="col-sm-3">
        {!! Form::date('dataCriacaoOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>


<div class="form-group row">
    <label for="valorTotalOrdemdeServico" class="col-sm-2 col-form-label">Valor Total</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('valorTotalOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <input type="text" id="valorTotalOrdemdeServico" class="form-control" name="valorTotalOrdemdeServico" value="0,00" placeholder="Preencha o preço real" /><br>

    </div>
    <label for="valorProjetoOrdemdeServico" class="col-sm-1 col-form-label">Valor Projeto</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('valorProjetoOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <input type="text" id="valorProjetoOrdemdeServico" class="form-control" name="valorProjetoOrdemdeServico" value="0,00" placeholder="Preencha o preço real" /><br>

    </div>
    <label for="valorOrdemdeServico" class="col-sm-2 col-form-label">Valor Ordem de Serviço</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('valorOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <input type="text" id="valorOrdemdeServico" class="form-control" name="valorOrdemdeServico" value="0,00" placeholder="Preencha o preço real" /><br>

    </div>
</div>



<div class="form-group row">
    <label for="clienteOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        {!! Form::text('clienteOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="eventoOrdemdeServico" class="col-sm-2 col-form-label">Evento</label>
    <div class="col-sm-10">
        {!! Form::text('eventoOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="servicoOrdemdeServico" class="col-sm-2 col-form-label">Serviço</label>
    <div class="col-sm-10">
        {!! Form::text('servicoOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label">Observação</label>
    <div class="col-sm-10">
        {!! Form::text('obsOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>



<hr>
<input class="btn btn-primary" id="reveal" value="Cadastrar Despesa" readonly style="cursor:pointer;">
<input class="btn btn-danger" id="esconde" value="Remover Despesa" readonly style="cursor:pointer;">

<div id="ajax-content">

    <div id="div_dados_favorecido">

        <div class="pull-left">
            <h2>Cadastro de Despesas</h2>
        </div>

        <!-- Seção Despesas -->


        <div class="form-group row">
            <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
            <div class="col-sm-10">
                {!! Form::text('descricaoDespesa', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

            </div>
        </div>
        <div class="form-group row">
            <label for="idCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
            <div class="col-sm-10">
                <!-- {!! Form::text('idCodigoDespesas', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->

                <select name="idCodigoDespesas" id="idCodigoDespesas">
                    <option value="0" selected="selected">Sem Despesa Cadastrada</option>

                    @foreach ($codigoDespesa as $listaCodigoDespesas)
                    <option value="{{$listaCodigoDespesas->id}}">
                        Código da Despesa: {{$listaCodigoDespesas->idGrupoCodigoDespesa}} - Tipo de Despesa: {{$listaCodigoDespesas->despesaCodigoDespesa}}
                    </option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="form-group row">
            <label for="despesaCodigoDespesas" class="col-sm-2 col-form-label">Informação da Despesa</label>
            <div class="col-sm-10">
                {!! Form::text('despesaCodigoDespesas', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

            </div>
        </div>
        <div class="form-group row">
            <label for="idFornecedor" class="col-sm-2 col-form-label">Fornecedor</label>
            <div class="col-sm-10">
                <!-- {!! Form::text('idFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->

                <select name="idFornecedor" id="idFornecedor" class="form-control">
                    @foreach ($listaForncedores as $fornecedor)

                    <option value="{{ $fornecedor->id }}">Nome: {{ $fornecedor->nomeFornecedor }} - Razão Social: {{ $fornecedor->razaosocialFornecedor }} - Contato: {{ $fornecedor->contatoFornecedor }}</option>

                    @endforeach
                </select>

            </div>
        </div>
        <div class="form-group row">
            <label for="precoReal" class="col-sm-2 col-form-label">Preço Real</label>
            <div class="col-sm-2">
                <!-- {!! Form::text('precoReal', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'precoReal']) !!} -->
                <input type="text" id="precoReal" class="form-control" name="precoReal" value="0,00" placeholder="Preencha o preço real" /><br>

            </div>

            <label for="precoCliente" class="col-sm-2 col-form-label">Preço Cliente</label>
            <div class="col-sm-2">
                <!-- {!! Form::text('precoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <input type="text" id="precoCliente" class="form-control" name="precoCliente" value="0,00" placeholder="Preencha o preço cliente" /><br>

            </div>
            <label for="precoCliente" class="col-sm-1 col-form-label">Ativação</label>
            <div class="col-sm-1">
                <!-- {!! Form::text('precoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <!-- {!! Form::text('ativoDespesa', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!} -->
                <select name="ativoDespesa" id="ativoDespesa" style="padding:4px;" class="form-control">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>

            <label for="pago" class="col-sm-1 col-form-label">Pago</label>
            <div class="col-sm-1">
                <!-- {!! Form::text('pago', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <select name="pago" id="pago" style="padding:4px;" class="form-control">
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="quempagou" class="col-sm-2 col-form-label">Quem Pagou</label>
            <div class="col-sm-10">
                {!! Form::text('quempagou', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

            </div>
        </div>
        <div class="form-group row">
            <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
            <div class="col-sm-10">
                <!-- {!! Form::text('idFormaPagamento', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <select name="idFormaPagamento" id="idFormaPagamento" class="form-control col-sm-4 js-example-basic-multiple">
                    @foreach ($formapagamento as $formaPG)
                    <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
                    @endforeach
                </select>

                <label for="conta" class="col-sm-1 col-form-label">Conta</label>
                <!-- {!! Form::text('conta', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <select name="conta" id="conta" class="col-sm-6 form-control js-example-basic-multiple">
                    @foreach ($listaContas as $contas)

                    <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>

                    @endforeach
                </select>
            </div>


        </div>

        <div class="form-group row">
            <label for="nRegistro" class="col-sm-2 col-form-label">N° Registro</label>
            <div class="col-sm-2">
                {!! Form::text('nRegistro', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

            </div>

            <label for="valorEstornado" class="col-sm-2 col-form-label">Valor Estornado</label>
            <div class="col-sm-2">
                <!-- {!! Form::text('valorEstornado', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'value' => 'NAO', 'maxlength' => '100']) !!} -->
                <input type="text" id="valorEstornado" class="form-control" name="valorEstornado" value="0,00" placeholder="Preencha o valor estornado" /><br>

            </div>

            <label for="data" class="col-sm-1 col-form-label">Data Despesa</label>
            <div class="col-sm-3">
                {!! Form::date('data', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

            </div>
        </div>
        <div class="form-group row">
            <label for="totalPrecoReal" class="col-sm-2 col-form-label">Total Preço Real</label>
            <div class="col-sm-2">
                <!-- {!! Form::number('totalPrecoReal', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <input type="text" id="totalPrecoReal" class="form-control" name="totalPrecoReal" value="0,00" placeholder="Preencha o preço real" /><br>
            </div>


            <label for="totalPrecoCliente" class="col-sm-2 col-form-label">Total Preço Cliente</label>
            <div class="col-sm-2">
                <!-- {!! Form::text('totalPrecoCliente', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <input type="text" id="totalPrecoCliente" class="form-control" name="totalPrecoCliente" value="0,00" placeholder="Preencha o Total do Preço Cliente" /><br>

            </div>


            <label for="lucro" class="col-sm-1 col-form-label">Lucro</label>
            <div class="col-sm-3">
                <!-- {!! Form::text('lucro', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <input type="text" id="lucro" class="form-control" name="lucro" value="0,00" placeholder="Preencha o Lucro" /><br>

            </div>
        </div>
        <!-- <div class="form-group row">
            <label for="atuacao" class="col-sm-2 col-form-label">Atuação</label>
            <div class="col-sm-10"> -->
                {!! Form::hidden('atuacao', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

            <!-- </div>
        </div> -->

        {!! Form::hidden('idOS', 'null', ['placeholder' => 'Id OS ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idOS']) !!}
        {!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}

    </div>
</div>


<hr>
<input class="btn btn-primary"  id="revealreceita" value="Cadastrar Receita" readonly style="cursor:pointer;">
<input class="btn btn-danger"   id="escondereceita" value="Remover Receita" readonly style="cursor:pointer;">

<div id="ajax-content-receita">

    <div id="div_cadastro_receita">

        <div class="pull-left">
            <h2>Cadastro de Receitas</h2>
        </div>

        <!-- Seção Receitas -->

        <div class="form-group row">
            <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
            <div class="col-sm-3">
                <select name="idformapagamentoreceita" id="idFormaPagamentoReceita" class="form-control col-sm-8 js-example-basic-multiple">
                    <option value="0" selected="selected">Sem Receita</option>
                    @foreach ($formapagamento as $formaPG)
                        <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
                    @endforeach
                </select>
            </div>

                <label for="datapagamentoreceita" class="col-sm-1 col-form-label">Data de Pagamento</label>
                <div class="col-sm-3">
                    {!! Form::date('datapagamentoreceita', '', ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}

                </div>

            <label for="pagoreceita" class="col-sm-1 col-form-label">Pago</label>
            <div class="col-sm-2">
                <!-- {!! Form::text('pagoreceita', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <!-- {!! Form::text('pago', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
                <select name="pagoreceita" id="pagoreceita" style="padding:4px;" class="form-control">
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
            </div>
        </div>
        <div class="form-group row">

                <label for="dataemissaoreceita" class="col-sm-2 col-form-label">Data de Emissão</label>
                <div class="col-sm-3">
                    {!! Form::date('dataemissaoreceita', '', ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}

                </div>
                <label for="valorreceita" class="col-sm-1 col-form-label">Valor</label>
                <div class="col-sm-3">
                    <input type="text" id="valorreceita" class="col-sm-8 form-control" name="valorreceita" value="0,00" placeholder="Preencha o valor" /><br>
                </div>

                <label for="contareceita" class="col-sm-1 col-form-label">Conta</label>
                <div class="col-sm-2">

                <select name="contareceita" id="contaReceita" class="col-sm-12 form-control js-example-basic-multiple">
                    @foreach ($listaContas as $contas)

                    <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>

                    @endforeach
                </select>
                </div>

        </div>



        <div class="form-group row">
            <label for="registroreceita" class="col-sm-2 col-form-label">N° Registro</label>
            <div class="col-sm-3">
                {!! Form::text('registroreceita', '', ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}

            </div>

            <label for="emissaoreceita" class="col-sm-1 col-form-label">Emissão</label>
            <div class="col-sm-3">
                <input type="text" id="emissaoreceita" class="col-sm-8 form-control" name="emissaoreceita"  placeholder="Emissão" /><br>
            </div>

            <label for="nfreceita" class="col-sm-1 col-form-label">NF</label>
            <div class="col-sm-2">
                {!! Form::text('nfreceita', '', ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100']) !!}

            </div>
        </div>
              {!! Form::hidden('idosreceita', 'null', ['placeholder' => 'Id OS Receita', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idosreceita']) !!}

    </div>
</div>




{!! Form::hidden('dataExclusaoOrdemdeServico', '00', ['placeholder' => 'Data Exclusão', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'dataExclusaoOrdemdeServico']) !!}
{!! Form::hidden('ativoOrdemdeServico', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']) !!}
{!! Form::hidden('excluidoOrdemdeServico', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

 




@endsection
