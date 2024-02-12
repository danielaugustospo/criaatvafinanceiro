@include('pedidocompra/script')
@include('pedidocompra/estilo')
<style>
    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
    .toggle.ios .toggle-handle { border-radius: 20px; }
  </style>
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
        <label class="col-sm-2  mr-2 mt-2" for="">STATUS DA COMPRA:</label>

        <input class="ml-2 mr-2" type="radio" name="ped_tipopedido" @if (old('ped_tipopedido') == '0' || old('ped_tipopedido') == '0') checked @endif
            @isset($pedido) @if ($pedido->ped_tipopedido == '0') checked  @endif @endisset
            name="ped_tipopedido" id="tipoPedidoAComprar" value="0" {{ $variavelDisabledNaView }}>
            <label class="mt-2 mr-2 mr-4 col-sm-2" for="">A COMPRAR</label>

            <input class="mr-2" type="radio" name="ped_tipopedido" @if (old('ped_tipopedido') == '1' || old('ped_tipopedido') == '1') checked @endif
            @isset($pedido) @if ($pedido->ped_tipopedido != '0') checked @endif @endisset
            name="ped_tipopedido" id="tipoPedidoComprado" value="1" {{ $variavelDisabledNaView }}>
            <label class="mt-2 mr-2 mr-4" for="">ITEM JÁ COMPRADO</label>

    </div>

    <div class="row">
        <label class="col-sm-2  mr-2 mt-2" for="">Compra para:</label>

        <input class="ml-2 mr-2" type="radio" name="oscriaatva" @if (old('ped_os') == 'EMPRESA GERAL' || old('oscriaatva') == 'EMPRESA GERAL') checked @endif
            @isset($pedido) @if ($pedido->ped_os == 'EMPRESA GERAL') checked  @endif @endisset
            name="ped_os" id="compraCRIAATVA" value="EMPRESA GERAL" {{ $variavelDisabledNaView }}>

        <label class="mt-2 mr-2 mr-4 col-sm-2" for="">EMPRESA</label>
        <input class="mr-2" type="radio" name="oscriaatva" @if (old('ped_os') == 'OS' || old('oscriaatva') == 'OS') checked @endif
            @isset($pedido) @if ($pedido->ped_os != 'EMPRESA GERAL') checked @endif @endisset
            name="ped_os" id="compraOS" value="OS" {{ $variavelDisabledNaView }}>
        <label class="mt-2 mr-2" for="">OS</label>


        <div id="telaOS">
            <select name="ped_os" id="ped_os" class="selecionaComInput col-sm-4 mt-2" required
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


        <label class="col-sm-2 mt-2" for="">Há Nota Fiscal?</label>


        <select name="nf_exigencia" class="mt-2 selecionaComInput col-sm-1" {{ $variavelDisabledNaView }}>
            @if (!isset($pedido))
                <option disabled selected>Selecione...</option>
            @endif
            @if (Request::path() == 'pedidocompra/create')
                <option value="N" {{ old('nf_exigencia') == 'N' ? ' selected' : '' }}>Não</option>
                <option value="S" {{ old('nf_exigencia') == 'S' ? ' selected' : '' }}>Sim</option>
            @else
                @if (!isset($pedido->nf_exigencia) || $pedido->nf_exigencia == null || $pedido->nf_exigencia == '' || $pedido->nf_exigencia == 0)
                    {!! $infoSelectVazio !!}
                @endif
                <option value="S" {{ (old('nf_exigencia') ?? $pedido->nf_exigencia) == 'S' ? ' selected' : '' }}>Sim</option>
                <option value="N" {{ (old('nf_exigencia') ?? $pedido->nf_exigencia) == 'N' ? ' selected' : '' }}>Não</option>
            @endif
        </select>
        
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

    @isset($pedido)
        <div class="row d-flex">
            <label class="col-sm-2 mr-2 mt-2" for="">Perfil Solicitante</label>
            <span class=" mt-2 text-danger">{{ $pedido->solicitante->name ?? 'Nenhum solicitante encontrado' }}</span>
        </div>
    @endisset

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
        <label class="col-sm-2 mr-2 mt-2" for="documentoAnexadoPedido">Anexar Documento</label>
        <input type="file" class="form-control-file btn btn-secondary col-sm-6" name="documentoAnexadoPedido[]" multiple  {{ $variavelDisabledNaView }}>
    </div>
    <div class="row mt-2 mb-2">
        @isset($pedido)
            <label class="col-sm-2 mr-2 mt-2" for="documentoAnexadoPedido">Documentos Anexados</label>
            <table class="p-2" style="background-color:white;">
                @foreach($pedido->documentosAnexados as $documento)
                <div class="mt-2">
                    <tr id="d{{$documento->id}}">
                        <th>
                            <a href="/public/pedidoCompra/p_{{$pedido->id}}/{{$documento->documento_anexado}}" target="_blank">{{$documento->documento_anexado}}</a>
                        </th>
                        <th>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removerDocumento('{{$pedido->id}}', '{{$documento->id}}')" {{ $variavelDisabledNaView }}>Remover</button>
                        </th>
                    </tr>
                </div>
                <br> <!-- Adiciona uma quebra de linha após cada bloco de div -->
                @endforeach
            </table>
        @endisset
    </div>
    
    

    <div class="row mt-2 mb-2">
        <label class="col-sm-2 mr-2 mt-2" for="">Observações</label>
        {!! Form::textarea('observacoes_solicitante', old('observacoes_solicitante'), [
            'class' => 'col-sm-12 form-control',
            'id' => 'observacoes_solicitante',
            'style' => 'color: red; font-weight: bold;',
            $variavelReadOnlyNaView,
        ]) !!}
    </div>
    <div id="contador_caracteres_restantes"></div>
    
    <script src="https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('observacoes_solicitante', {
            height: 400,
            width: 1275,
            extraPlugins: 'mentions',
            mentions: [{
                feed: dataFeed,
                itemTemplate:
                    '<li data-id="{id}">' +
                    '<strong class="username">{username}</strong>' +
                    '<span class="fullname">{fullname}</span>' +
                    '</li>',
                outputTemplate:
                    '<a href="mailto:{username}@example.com">@{username}</a><span>&nbsp;</span>',
                minChars: 0
            }]
        });
    
        // Função para atualizar o contador de caracteres restantes
        function atualizarContadorCaracteresRestantes() {
            var editor = CKEDITOR.instances.observacoes_solicitante;
            var maxLength = 1000;
            var texto = editor.getData();
            var caracteresRestantes = maxLength - texto.length;
            if(caracteresRestantes < 0){
                caracteresRestantes = 0;
            }
            var contadorElemento = document.getElementById('contador_caracteres_restantes');
            contadorElemento.textContent = "Caracteres restantes: " + caracteresRestantes;
        }
    
        // Atualiza o contador quando o conteúdo do editor muda
        CKEDITOR.instances.observacoes_solicitante.on('change', function () {
            atualizarContadorCaracteresRestantes();
        });
    
        // Limita o número máximo de caracteres
        CKEDITOR.instances.observacoes_solicitante.on('key', function (evt) {
            var editor = evt.editor;
            var texto = editor.getData();
            var maxLength = 1003;
            var keyCode = evt.data.keyCode;
            var deleteKeys = [8, 46];
    
            // Permite as teclas de exclusão
            if (deleteKeys.includes(keyCode)) return;
    
            // Impede a entrada de texto se o limite for atingido
            if (texto.length >= maxLength && !deleteKeys.includes(keyCode)) {
                evt.cancel();
                alert("Você atingiu o limite máximo de caracteres.");
                var textoTruncado = texto.substring(0, maxLength);
                editor.setData(textoTruncado);
            }

        });
    
        function dataFeed(opts, callback) {
            var matchProperty = 'username',
                data = users.filter(function (item) {
                    return item[matchProperty].indexOf(opts.query.toLowerCase()) == 0;
                });
    
            data = data.sort(function (a, b) {
                return a[matchProperty].localeCompare(b[matchProperty], undefined, {
                    sensitivity: 'accent'
                });
            });
    
            callback(data);
        }
    
        // Atualiza o contador quando a página é carregada
        window.onload = function () {
            atualizarContadorCaracteresRestantes();
        };
    </script>
    
    
    
    </div>

    
</div>
