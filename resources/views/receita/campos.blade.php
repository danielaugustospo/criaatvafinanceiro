<div class="form-group row">
    <label for="idclientereceita" class="col-sm-2 col-form-label">Cliente/Receita</label>
    <div class="col-sm-10 mb-3">
        <select name="idclientereceita" id="idclientereceita" class="selecionaComInput form-control"
            style="width: -webkit-fill-available;" required {{ $variavelDisabledNaView }}>
            @foreach ($todosClientesAtivos as $listaClientes)
                <option value="{{ $listaClientes->id }}">
                    {{ $listaClientes->razaosocialCliente }}
                </option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoreceita', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', 'required', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idformapagamentoreceita" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">
        <select name="idformapagamentoreceita" id="idFormaPagamentoReceita"
            class="selecionaComInput form-control col-sm-12 js-example-basic-multiple" required
            {{ $variavelDisabledNaView }}>
            @foreach ($formapagamento as $formaPG)
                <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="contareceita" class="col-sm-2 col-form-label">Conta</label>
    <div class="col-sm-4">
        <select name="contareceita" id="contaReceita"
            class="selecionaComInput col-sm-14 form-control js-example-basic-multiple" required
            {{ $variavelDisabledNaView }}>
            @foreach ($listaContas as $contas)
                <option value="{{ $contas->id }}"
                    @if (@isset($receita->contareceita)) @if ($receita->contareceita == $contas->id) selected @endif @endif >
                    {{ $contas->nomeConta }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="valorreceita" class="col-sm-2 col-form-label">Valor</label>
    <div class="col-sm-2">
        {!! Form::text('valorreceita', $valorReceita, ['placeholder' => 'Preencha este campo', 'class' => 'campo-moeda col-sm-12 form-control', 'maxlength' => '100', 'id' => 'valorreceita', 'valor' => '0,00', 'required', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="datapagamentoreceita" class="col-sm-2 col-form-label">Vencimento</label>
    <div class="col-sm-2">
        {!! Form::date('datapagamentoreceita', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', 'required', $variavelReadOnlyNaView]) !!}
    </div>
</div>

<div class="form-group row">
    <label for="pagoreceita" class="col-sm-2 col-form-label">Pago</label>
    <div class="col-sm-2">
        <select name="pagoreceita" id="pagoreceita" style="padding:4px;" class="form-control" required
            {{ $variavelDisabledNaView }}>
            @if (Request::path() == 'receita/create')
                <option value="N">Não</option>
                <option value="S" selected>Sim</option>
            @else
                <option value="S" {{ $receita->pagoreceita == 'S' ? ' selected' : '' }}>Sim</option>
                <option value="N" {{ $receita->pagoreceita == 'N' ? ' selected' : '' }}>Não</option>
            @endif
        </select>
    </div>
</div>


{!! Form::hidden('registroreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
{!! Form::hidden('id', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('dataemissaoreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}
{{-- {!! Form::hidden('idosreceita', $valorInput, ['placeholder' => 'Id OS Receita', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idosreceita']) !!} --}}
{{-- <input type="hidden" id="emissaoreceita" class="col-sm-8 form-control" name="emissaoreceita" placeholder="Emissão" value="0" /><br> --}}
{!! Form::hidden('nfreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100']) !!}
