@include('pedidocompra/script')
@include('pedidocompra/estilo')
@include('despesas/cadastrafornecedor')
<hr>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-sm-12">

    @isset($pedido)
        <div class="row">
            <label class="col-sm-2 pr-2" for="">Pedido</label>
            <input class="col-sm-1 form-control" type="text" name="id" id=""
                style="color:white; background-color: rgb(0, 0, 0);"
                value="@isset($pedido->id) {{ $pedido->id }} @endisset" {{ $variavelDisabledNaView }}
                readonly>
        </div>
    @endisset


    <div class="row">
        <label class="col-sm-2  mr-2" for="">Compra para:</label>

        <input class="ml-2 mr-2" type="radio" name="oscriaatva" @if (old('ped_os') == 'EMPRESA GERAL' || old('oscriaatva') == 'EMPRESA GERAL') checked @endif
            @isset($pedido) @if ($pedido->ped_os == 'EMPRESA GERAL') checked  @endif @endisset
            name="ped_os" id="compraCRIAATVA" value="EMPRESA GERAL" {{ $variavelDisabledNaView }}>

        <label class="mt-2 mr-2 mr-4" for="">EMPRESA</label>
        <input class="mr-2" type="radio" name="oscriaatva" @if (old('ped_os') == 'OS' || old('oscriaatva') == 'OS') checked @endif
            @isset($pedido) @if ($pedido->ped_os != 'EMPRESA GERAL') checked @endif @endisset
            name="ped_os" id="compraOS" value="OS" {{ $variavelDisabledNaView }}>
        <label class="mt-2 mr-2" for="">OS</label>


        <div id="telaOS">
            <select name="ped_os" id="ped_os" class="selecionaComInput col-sm-9" required
                {{ $variavelDisabledNaView }}>
                <option value="EMPRESA GERAL">SEM OS</option>
                @foreach ($listaOrdemDeServicos as $listaOS)
                    @isset($pedido)
                        @if ($pedido->ped_os == $listaOS->id)
                            <option value="{{ $listaOS->id }}" selected>{{ $listaOS->id }} |
                                {{ $listaOS->eventoOrdemdeServico }}</option>
                            @if ($pedido->ped_os == 'EMPRESA GERAL' || old('ped_os') == 'EMPRESA GERAL')
                                <option value="EMPRESA GERAL" selected>SEM OS</option>
                            @endif
                        @endif
                    @endisset
                    <option @if (old('ped_os') == $listaOS->id) selected @endif value="{{ $listaOS->id }}">
                        {{ $listaOS->id }} | {{ $listaOS->eventoOrdemdeServico }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-1" for="">Data</label>

        @if (Request::path() == 'pedidocompra/create')
            {!! Form::date('ped_data', new \DateTime(), [
                'class' => 'col-sm-3 form-control',
                'maxlength' => '100',
                'readonly',
            ]) !!}
        @else
            {!! Form::date('ped_data', $valorInput, [
                'class' => 'col-sm-3 form-control',
                'maxlength' => '100',
                $variavelReadOnlyNaView,
            ]) !!}
        @endif

    </div>

    <div class="row d-flex">
        <label class="col-sm-2 mr-2 mt-2" for="">Nome Comprador</label>

        <select name="ped_nomecomprador" class="selecionaComInput col-sm-8" {{ $variavelDisabledNaView }}>
            @if (!isset($pedido))
                <option disabled selected>Selecione...</option>
            @endif
            @foreach ($listaFornecedores as $fornecedor)
                @isset($pedido)
                    @if ($pedido->ped_nomecomprador == $fornecedor->id)
                        <option @if (old('ped_nomecomprador') == $fornecedor->id) selected @endif value="{{ $fornecedor->id }}" selected>
                            {{ $fornecedor->razaosocialFornecedor }}</option>
                    @endif
                @endisset
                <option @if (old('ped_nomecomprador') == $fornecedor->id) selected @endif value="{{ $fornecedor->id }}">
                    {{ $fornecedor->razaosocialFornecedor }}</option>
            @endforeach
        </select>
    </div>

    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="">Fornecedor</label>
        <div class="pl-0 col-sm-5">
            <select name="ped_fornecedor" id="selecionaFornecedor"
                class="selecionaComInput selecionaFornecedor  form-control" {{ $variavelDisabledNaView }}>
                @if (!isset($pedido))
                    <option disabled selected>Selecione...</option>
                @endif
                @foreach ($listaFornecedores as $fornecedor)
                    @isset($pedido)
                        @if ($pedido->ped_fornecedor == $fornecedor->id)
                            <option value="{{ $fornecedor->id }}" selected>{{ $fornecedor->razaosocialFornecedor }}
                            </option>
                        @endif
                    @endisset
                    <option @if (old('ped_fornecedor') == $fornecedor->id) selected @endif value="{{ $fornecedor->id }}">
                        {{ $fornecedor->razaosocialFornecedor }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-4">
            <button type="button" onclick="recarregaFornecedor()" class="btn btn-dark"
                {{ $variavelDisabledNaView }}><i class="fas fa-sync"></i></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".fornecedor"
                {{ $variavelDisabledNaView }}><i class="fas fa-industry pr-1"></i>Cadastrar Fornecedor</button>
        </div>
    </div>

    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="ped_descprod">Descrição/Produto</label>
        {!! Form::text('ped_descprod', old('ped_descprod'), [
            'class' => 'col-sm-8 form-control',
            'maxlength' => '100',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>

    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="ped_precounit">Preço Unitário</label>
        {!! Form::text('ped_precounit', old('ped_precounit'), [
            'class' => 'campo-moeda form-control col-sm-3 mr-2 ped_precounit',
            'id' => 'ped_precounit',
            'maxlength' => '100',
            $variavelReadOnlyNaView,
        ]) !!}


        <label class="col-sm-2 mt-2" for="ped_qtd">Quantidade</label>
        {!! Form::text('ped_qtd', old('ped_qtd'), [
            'class' => 'col-sm-1 form-control ped_qtd',
            'id' => 'ped_qtd',
            'maxlength' => '10',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>

    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="ped_valortotal">Valor Total</label>
        {!! Form::text('ped_valortotal', old('ped_valortotal'), [
            'class' => 'campo-moeda form-control col-sm-3 ped_valortotal',
            'id' => 'ped_valortotal',
            'maxlength' => '100',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>

    <div class="form-row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="">FORMA DE PAGAMENTO</label>

        <label for="ped_formapag" class="ml-2"> <input type="radio" value="avista"
                @if (old('ped_formapag') == 'avista') checked @endif
                @isset($pedido) @if ($pedido->ped_formapag == 'avista') checked @endif @endisset
                name="ped_formapag" id="avista" {{ $variavelDisabledNaView }} /> A vista</label>

        <label for="ped_formapag" class="mr-2 ml-2"> <input type="radio" value="cred"
                @if (old('ped_formapag') == 'cred') checked @endif
                @isset($pedido) @if ($pedido->ped_formapag == 'cred') checked @endif @endisset
                name="ped_formapag" id="comcartao" {{ $variavelDisabledNaView }} /> Cartão de Crédito</label> <br />

        <label for="ped_formapag" class="ml-2"> <input type="radio" value="faturado"
                @if (old('ped_formapag') == 'faturado') checked @endif
                @isset($pedido) @if ($pedido->ped_formapag == 'faturado') checked @endif @endisset
                name="ped_formapag" id="faturado" {{ $variavelDisabledNaView }} /> Faturado</label>

        <label for="ped_formapag" class="ml-2"> <input type="radio" value="reembolsado"
                @if (old('ped_formapag') == 'reembolsado') checked @endif
                @isset($pedido) @if ($pedido->ped_formapag == 'reembolsado') checked @endif @endisset
                name="ped_formapag" id="reembolsado" {{ $variavelDisabledNaView }} />Reembolsado</label>

        <div id="divDadosCartao" class="form-row col-sm-12">


            <label class="col-sm-2 mr-2 mt-2" for="ped_numcartao">Cartão - 4 Dígitos Finais</label>

            {!! Form::text('ped_numcartao', old('ped_numcartao'), [
                'class' => 'col-sm-3 form-control',
                'id' => 'ped_numcartao',
                'maxlength' => '4',
                $variavelReadOnlyNaView,
            ]) !!}


            <label class="col-sm-2 mr-2 ml-3 mt-2" for="">Parcelamento em x</label>

            <select name="ped_vzscartao" class="selecionaComInput col-sm-1" id="ped_vzscartao"
                {{ $variavelDisabledNaView }}>
                @if (!isset($pedido))
                    <option disabled selected>Selecione...</option>
                @endif
                @for ($i = 1; $i <= 48; $i++)
                    @isset($pedido)
                        @if ($pedido->ped_vzscartao == $i)
                            <option value="{{ $i }}" selected>{{ $i }}x</option>
                        @endif
                    @endisset
                    <option @if (old('ped_vzscartao') == $i) selected @endif value="{{ $i }}">
                        {{ $i }}x</option>
                @endfor
            </select>
        </div>

    </div>

    <div id="telaReembolsado" class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="">Reembolsado p/</label>
        <select name="ped_reembolsado" class="selecionaComInput form-control col-sm-3" {{ $variavelDisabledNaView }}>
            @if (!isset($pedido))
                <option disabled selected>Selecione...</option>
            @endif
            @foreach ($listaFornecedores as $fornecedor)
                @isset($pedido)
                    @if ($pedido->ped_reembolsado == $fornecedor->id)
                        <option value="{{ $fornecedor->id }}" selected>{{ $fornecedor->razaosocialFornecedor }}
                        </option>
                    @endif
                @endisset
                <option @if (old('ped_reembolsado') == $fornecedor->id) selected @endif value="{{ $fornecedor->id }}">
                    {{ $fornecedor->razaosocialFornecedor }}</option>
            @endforeach
        </select>
    </div>


    <div id="divFaturado">
        <div class="row mt-2 mb-2">
        <div class="col-sm-2 mr-2 mt-2"></div>

        <label for="boleto_faturado" class="ml-2"> <input type="radio" value="boleto"
            @if (old('tipoFaturado') == 'boleto') checked @endif
            @isset($pedido) @if (($pedido->ped_formapag = 'faturado') && !is_null($pedido->ped_boleto)) checked @endif @endisset
            name="tipoFaturado" id="boleto_faturado" {{ $variavelDisabledNaView }} />Boleto</label>
            
        <label for="transferencia_faturado" class="ml-2"> <input type="radio" value="transferencia"
            @if (old('tipoFaturado') == 'transferencia') checked @endif
            @isset($pedido) @if (($pedido->ped_formapag = 'faturado') && (!is_null($pedido->ped_banco) || !is_null($pedido->ped_pix))) checked @endif @endisset
            name="tipoFaturado" id="transferencia_faturado" {{ $variavelDisabledNaView }} />Transferência</label>
        </div>


        <div id="divBoleto" class="row mt-2 mb-2">
            <label class="col-sm-2 mr-2 mt-2" for="ped_boleto">Boleto</label>
            {!! Form::text('ped_boleto', old('ped_boleto'), [
                'class' => 'col-sm-4 form-control',
                'maxlength' => '100',
                'id' => 'ped_boleto',
                $variavelReadOnlyNaView,
            ]) !!}
        </div>


        <div class="row mt-2 mb-2">
            <label class="col-sm-2 mr-2 mt-2" for="">Faturado em x</label>
            <select name="ped_periodofaturado" class="selecionaComInput col-sm-2 form-control"
                id="ped_periodofaturado" {{ $variavelDisabledNaView }}>
                @if (!isset($pedido))
                    <option disabled selected>Selecione...</option>
                @endif
                @for ($i = 1; $i <= 48; $i++)
                    @isset($pedido)
                        @if ($pedido->ped_periodofaturado == $i)
                            <option value="{{ $i }}" selected>{{ $i }}x</option>
                        @endif
                    @endisset
                    <option @if (old('ped_periodofaturado') == $i) selected @endif value="{{ $i }}">
                        {{ $i }}x</option>
                @endfor
            </select>
        </div>
    </div>


    <hr>

    <div id="divDadosBancarios">
        <h1 style="color:black;">Dados Pix</h1>
        <div class="row mt-2 mb-2">
            <label class="col-sm-2 mr-2 mt-2" for="">Chave Pix</label>
            {!! Form::text('ped_pix', old('ped_pix'), [
                'class' => 'col-sm-3 form-control',
                'id' => 'ped_pix',
                'maxlength' => '50',
                $variavelReadOnlyNaView,
            ]) !!}

            <label class="col-sm-2 mr-2 mt-2" for="">Favorecido</label>
            {!! Form::text('ped_favorecido', old('ped_favorecido'), [
                'class' => 'col-sm-3 form-control',
                'id' => 'ped_favorecido',
                'maxlength' => '80',
                $variavelReadOnlyNaView,
            ]) !!}

        </div>
        <hr>
        <h1 style="color:black;">Dados Bancários</h1>
        <div class="row mt-2 mb-2">
            <label class="col-sm-2 mr-2 mt-2" for="">Banco</label>

            <select class="selecionaComInput col-sm-3 form-control" id="ped_banco" name="ped_banco"
                {{ $variavelDisabledNaView }}>
                @if (!isset($pedido) || is_null($pedido->ped_banco) || empty($pedido->ped_banco))
                    {!! $infoSelectVazio !!}
                @endif

                @foreach ($listaBancos as $bancos)
                    <option @if (old('ped_banco') == $bancos->id || (isset($pedido) && $pedido->ped_banco == $bancos->id)) selected @endif value="{{ $bancos->id }}">
                        {{ $bancos->codigoBanco }} - {{ $bancos->nomeBanco }}
                    </option>
                @endforeach
            </select>


            <label class="col-sm-2 mr-2 mt-2" for="ped_agenciaconta">Agência</label>
            <input name="ped_agenciaconta" id="ped_agenciaconta" class="col-sm-3 form-control" maxlength="10"
                {{ $variavelReadOnlyNaView }}
                value="@isset($pedido->ped_agenciaconta)  {{ $pedido->ped_agenciaconta }} @else {{ old('ped_agenciaconta') }} @endisset">

            <label class="col-sm-2 mr-2 mt-2" for="ped_conta">Conta</label>
            <input name="ped_conta" id="ped_conta" class="col-sm-3 form-control" maxlength="10"
                {{ $variavelReadOnlyNaView }}
                value="@isset($pedido->ped_conta)  {{ $pedido->ped_conta }} @else {{ old('ped_conta') }} @endisset">

            <label class="col-sm-2 mr-2 mt-2" for="ped_conta">CPF/CNPJ</label>
            <input name="ped_cpfcnpj" id="ped_cpfcnpj" class="col-sm-3 form-control" maxlength="14"
                {{ $variavelReadOnlyNaView }}
                value="@isset($pedido->ped_cpfcnpj)  {{ $pedido->ped_cpfcnpj }} @else {{ old('ped_cpfcnpj') }} @endisset">
        </div>
    </div>

    <hr>
    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="ped_notafiscal">Nota Fiscal</label>
        {!! Form::text('ped_notafiscal', old('ped_notafiscal'), [
            'class' => 'col-sm-3 form-control',
            'maxlength' => '100',
            $variavelReadOnlyNaView,
        ]) !!}

    </div>

    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="">Observações</label>
        {!! Form::text('observacoes_solicitante', old('observacoes_solicitante'), [
            'class' => 'col-sm-8 form-control',
            'id' => 'observacoes_solicitante',
            'maxlength' => '100',
            'style' => 'color: red; font-weight: bold;',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
</div>
