@include('pedidocompra/script')
@include('pedidocompra/estilo')
@include('despesas/cadastrafornecedor')
{{-- @include('layouts/cadastrafornecedor') --}}

<hr>

@isset($pedido)

    <div class="row">
        <label class="col-sm-2 pr-2" for="">Pedido</label>
        <input class="col-sm-1 form-control" type="text" name="id" id="" style="color:white; background-color: rgb(0, 0, 0);"
            value="@isset($pedido->id) {{ $pedido->id }} @endisset" {{ $variavelDisabledNaView }}
            readonly>
    </div>
@endisset


<div class="row">
    <label class="col-sm-2 pr-2" for="">Compra para:</label>

    <input class="ml-2 mr-2 mt-1" type="radio" name="oscriaatva" 

        @if((old('ped_os') ==  'CRIAATVA') || (old('oscriaatva') ==  'CRIAATVA')) checked @endif

        @isset($pedido) @if ($pedido->ped_os == 'CRIAATVA') checked  @endif @endisset
    
    name="ped_os" id="compraCRIAATVA" value="CRIAATVA" {{ $variavelDisabledNaView }}>

<label class="mr-2 mr-4" for="">CRIAATVA</label>
<input class="mr-2 mt-1" type="radio" name="oscriaatva" 

@if((old('ped_os') ==  'OS') || (old('oscriaatva') ==  'OS')) checked @endif

@isset($pedido) @if ($pedido->ped_os != 'CRIAATVA') checked @endif @endisset

name="ped_os" id="compraOS" value="OS" {{ $variavelDisabledNaView }}>
<label class="mr-2" for="">OS</label>


<div id="telaOS">
<select name="ped_os" id="ped_os" class="selecionaComInput col-sm-12" required {{ $variavelDisabledNaView }}>
    <option value="CRIAATVA">SEM OS</option>
    @foreach ($listaOrdemDeServicos as $listaOS)
        @isset($pedido)
            @if ($pedido->ped_os == $listaOS->id)
                <option value="{{ $listaOS->id }}" selected>{{ $listaOS->id }} |
                    {{ $listaOS->eventoOrdemdeServico }}</option>
                @if (($pedido->ped_os == 'CRIAATVA') || (old('ped_os') == 'CRIAATVA'))
                    <option value="CRIAATVA" selected>SEM OS</option>
                @endif
            @endif
        @endisset
        <option @if(old('ped_os') ==  $listaOS->id) selected @endif value="{{ $listaOS->id }}">{{ $listaOS->id }} | {{ $listaOS->eventoOrdemdeServico }}</option>
    @endforeach
</select>
</div>
</div>

<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-1" for="">Data</label>

@if (Request::path() == 'pedidocompra/create')
{!! Form::date('ped_data', new \DateTime(), ['class' => 'col-sm-3 form-control', 'maxlength' => '100', 'readonly']) !!}
@else
{!! Form::date('ped_data', $valorInput, ['class' => 'col-sm-3 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
@endif

</div>

<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="">Nome Comprador</label>
{{-- {!! Form::text('ped_nomecomprador', $valorInput, ['class' => 'col-sm-8 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}


<select name="ped_nomecomprador" class="selecionaComInput  form-control col-sm-8" {{ $variavelDisabledNaView }}>
@if (!isset($pedido))
    <option disabled selected>Selecione...</option>
@endif
@foreach ($listaFornecedores as $fornecedor)
    @isset($pedido)
        @if ($pedido->ped_nomecomprador == $fornecedor->id)
            <option 
                @if(old('ped_nomecomprador') ==  $fornecedor->id) selected @endif
                value="{{ $fornecedor->id }}" selected>{{ $fornecedor->razaosocialFornecedor }}</option>
        @endif
    @endisset
    <option @if(old('ped_nomecomprador') ==  $fornecedor->id) selected @endif value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
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
        <option @if(old('ped_fornecedor') ==  $fornecedor->id) selected @endif value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
    @endforeach
</select>
</div>

<div class="col-sm-4">
<button type="button" onclick="recarregaFornecedor()" class="btn btn-dark" {{ $variavelDisabledNaView }}><i
        class="fas fa-sync"></i></i></button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".fornecedor"
    {{ $variavelDisabledNaView }}><i class="fas fa-industry pr-1"></i>Cadastrar Fornecedor</button>
</div>
{{-- <input type="text" class="form-control" name="ped_fornecedor"> --}}
</div>

<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="ped_descprod">Descrição/Produto</label>
{{-- <input type="text" class="col-sm-8 form-control" value="@isset($pedido->ped_descprod) {{ $pedido->ped_descprod }} @endisset" name="ped_descprod"> --}}
{!! Form::text('ped_descprod', old('ped_descprod'), ['class' => 'col-sm-8 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
</div>

<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="ped_precounit">Preço Unitário</label>
{!! Form::text('ped_precounit',  old('ped_precounit'), ['class' => 'campo-moeda form-control col-sm-3 mr-2', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}


<label class="col-sm-2 mt-2" for="ped_qtd">Quantidade</label>
{!! Form::text('ped_qtd', old('ped_qtd'), ['class' => 'col-sm-1 form-control', 'maxlength' => '10', $variavelReadOnlyNaView]) !!}
</div>


<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="ped_valortotal">Valor Total</label>
{{-- <input type="text" class="campo-moeda form-control col-sm-3" value="@isset($pedido->ped_valortotal) {{ $pedido->ped_valortotal }} @endisset" name="ped_valortotal"> --}}
{!! Form::text('ped_valortotal', old('ped_valortotal'), ['class' => 'campo-moeda form-control col-sm-3', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}

</div>

<div class="form-row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="">Compra</label>
{{-- {!! Form::text('ped_cartaodecredito', $valorInput, ['class' => 'col-sm-8 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!} --}}


<label for="ped_formapag" class="ml-2"> <input type="radio" value="avista"
    @if(old('ped_formapag') ==  'avista') checked @endif
    @isset($pedido) @if ($pedido->ped_formapag == 'avista') checked @endif @endisset name="ped_formapag" id="avista"
    {{ $variavelDisabledNaView }} /> A vista</label>

<label for="ped_formapag" class="mr-2 ml-2"> <input type="radio" value="cred"
    @if(old('ped_formapag') ==  'cred') checked  @endif
    @isset($pedido) @if ($pedido->ped_formapag == 'cred') checked @endif @endisset name="ped_formapag" id="comcartao"
    {{ $variavelDisabledNaView }} /> Cartão de Crédito</label> <br />

<label for="ped_formapag" class="ml-2"> <input type="radio" value="faturado"
    @if(old('ped_formapag') ==  'faturado') checked  @endif
    @isset($pedido) @if ($pedido->ped_formapag == 'faturado') checked @endif @endisset name="ped_formapag" id="faturado"
    {{ $variavelDisabledNaView }} /> Faturado</label>

<label for="ped_formapag" class="ml-2"> <input type="radio" value="reembolsado"
    @if(old('ped_formapag') ==  'reembolsado') checked @endif
    @isset($pedido) @if ($pedido->ped_formapag == 'reembolsado') checked @endif @endisset name="ped_formapag" id="reembolsado"
    {{ $variavelDisabledNaView }} />Reembolsado</label>

<div id="divDadosCartao" class="form-row col-sm-12">

<label class="col-sm-2 mr-2 mt-2" for="ped_numcartao">Últimos 4 Dígitos</label>

{!! Form::text('ped_numcartao', old('ped_numcartao'), ['class' => 'col-sm-2 form-control', 'id' => 'ped_numcartao', 'maxlength' => '4', $variavelReadOnlyNaView]) !!}

<label class="col-sm-2 mr-2 mt-2" for="">Parcelamento em x</label>
{{-- {!! Form::number('ped_vzscartao', $valorInput, ['class' => 'col-sm-8 form-control', 'min' => '1', 'max' => '24', 'maxlength' => '2', $variavelReadOnlyNaView]) !!} --}}

<select name="ped_vzscartao" class="selecionaComInput col-sm-2" id="ped_vzscartao"
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
        <option @if(old('ped_vzscartao') ==  $i ) selected @endif value="{{ $i }}">{{ $i }}x</option>
    @endfor
</select>
</div>

</div>
<div id="telaReembolsado" class="row mt-2 mb-2">
    <label class="col-sm-2 mr-2 mt-2" for="">Reembolsado p/</label>
    <select name="ped_reembolsado" class="selecionaComInput form-control col-sm-4" {{ $variavelDisabledNaView }}>
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
        <option @if(old('ped_reembolsado') ==  $fornecedor->id ) selected @endif value="{{ $fornecedor->id }}">{{ $fornecedor->razaosocialFornecedor }}</option>
    @endforeach
    </select>
    </div>
    
<div id="divDadosBancarios">
{{-- <label class="col-sm-2 mr-2 mt-2" for="">Forma de pagamento</label> --}}

<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="">Chave Pix</label>
{!! Form::text('ped_pix',  old('ped_pix'), ['class' => 'col-sm-4 form-control', 'id' => 'ped_pix', 'maxlength' => '50', $variavelReadOnlyNaView]) !!}

</div>

<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="">Banco</label>

<select class="selecionaComInput col-sm-3 form-control" id="ped_banco" name="ped_banco"
    {{ $variavelDisabledNaView }}>
    @if (!isset($pedido))
        <option disabled selected>Selecione...</option>
    @endif
    @foreach ($listaBancos as $bancos)
        <option @if(old('ped_banco') ==  $bancos->id ) selected @endif value="{{ $bancos->id }}" 
            @isset($pedido) @if ($pedido->ped_banco == $bancos->id) selected @endif @endisset>{{ $bancos->codigoBanco }} - {{ $bancos->nomeBanco }}</option>
    @endforeach
</select>

<label class="col-sm-2 mr-2 mt-2" for="ped_agenciaconta">Agência</label>
<input name="ped_agenciaconta" id="ped_agenciaconta" class="col-sm-3 form-control" maxlength="10"
    {{ $variavelReadOnlyNaView }}
    value="@isset($pedido->ped_agenciaconta)  {{ $pedido->ped_agenciaconta }} @else {{old('ped_agenciaconta')}} @endisset">

<label class="col-sm-2 mr-2 mt-2" for="ped_conta">Conta</label>
<input name="ped_conta" id="ped_conta" class="col-sm-3 form-control" maxlength="10"
    {{ $variavelReadOnlyNaView }}
    value="@isset($pedido->ped_conta)  {{ $pedido->ped_conta }} @else {{old('ped_conta')}} @endisset">

<label class="col-sm-2 mr-2 mt-2" for="ped_conta">CPF/CNPJ</label>
<input name="ped_cpfcnpj" id="ped_cpfcnpj" class="col-sm-3 form-control" maxlength="11"
    {{ $variavelReadOnlyNaView }}
    value="@isset($pedido->ped_cpfcnpj)  {{ $pedido->ped_cpfcnpj }} @else {{old('ped_cpfcnpj')}} @endisset">

{{-- <label class="col-sm-2 mr-2 mt-2" for="ped_tipoconta">Tipo Conta</label> --}}
{{-- {!! Form::text('ped_tipoconta', $valorInput, ['class' => 'col-sm-3 form-control', 'maxlength' => '10', 'required' => 'required', $variavelReadOnlyNaView]) !!} --}}

{{-- <select class="selecionaComInput col-sm-3 form-control" name="ped_tipoconta" {{$variavelDisabledNaView}}>
    <option value="CP" @isset($pedido) @if ($pedido->ped_tipoconta == 'CP') selected @endif @endisset>CONTA POUPANÇA</option>
    <option value="CC" @isset($pedido) @if ($pedido->ped_tipoconta == 'CC') selected @endif @endisset>CONTA CORRENTE</option>   
</select> --}}


</div>
</div>
<div id="divFaturado" class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="">Faturado em x</label>

<select name="ped_periodofaturado" class="selecionaComInput col-sm-2" id="ped_periodofaturado"
{{ $variavelDisabledNaView }}>
@if (!isset($pedido))
    <option disabled selected>Selecione...</option>
@endif
@for ($i = 1; $i <= 48; $i++)
    @isset($pedido)
        @if ($pedido->ped_periodofaturado == $i)
            <option value="{{ $i }}" selected>{{ $i }}x</option>
        @endif
    @endisset
    <option @if(old('ped_periodofaturado') ==  $i ) selected @endif value="{{ $i }}">{{ $i }}x</option>
@endfor
</select>
</div>


<div class="row mt-2 mb-2">
<label class="col-sm-2 mr-2 mt-2" for="ped_notafiscal">Nota Fiscal</label>
{!! Form::text('ped_notafiscal', old('ped_notafiscal'), ['class' => 'col-sm-3 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}

</div>
