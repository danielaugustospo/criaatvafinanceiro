<div class="form-group row">

    <label for="idosreceita" class="col-sm-2 col-form-label">Vincular a OS:</label>
    <div class="col-sm-10 mb-3">
        <select name="idosreceita" id="idosreceita" class="selecionaComInput form-control" style="width: -webkit-fill-available;" {{$variavelDisabledNaView}}>
            @foreach ($todasOSAtivas as $listaOS)
            <option value="{{$listaOS->id}}">
                Código da OS: {{$listaOS->id}} - Evento: {{$listaOS->eventoOrdemdeServico}}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">

    <label for="registroreceita" class="col-sm-2 col-form-label">N° Registro</label>
    <div class="col-sm-2">

        {!! Form::text('registroreceita', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>
    <label for="datapagamentoreceita" class="col-sm-2 col-form-label">Data de Pagamento</label>
    <div class="col-sm-3">
        {!! Form::date('datapagamentoreceita', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
    </div>

    <label for="pagoreceita" class="col-sm-1 col-form-label">Pago</label>
    <div class="col-sm-2">
        <select name="pagoreceita" id="pagoreceita" style="padding:4px;" class="form-control" {{$variavelDisabledNaView}}>
            @if (Request::path() == 'receita/create')
            <option value="N">Não</option>
            <option value="S">Sim</option>
            @else
            <option value="S" {{$receita->pagoreceita == 'S'?' selected':''}}>Sim</option>
            <option value="N" {{$receita->pagoreceita == 'N'?' selected':''}}>Não</option>
            @endif
        </select>

    </div>
</div>
<div class="form-group row">
    <label for="valorreceita" class="col-sm-2 col-form-label">Valor</label>
    <div class="col-sm-2">
        {!! Form::text('valorreceita', $valorReceita, ['placeholder' => 'Preencha este campo', 'class' => 'padraoReal col-sm-12 form-control', 'maxlength' => '100', 'id' => 'valorreceita', 'valor' => '0,00', $variavelReadOnlyNaView]) !!}
        {{-- <input type="text" id="valorreceita" class="padraoReal col-sm-8 form-control" name="valorreceita" value="0,00" placeholder="Preencha o valor" /><br> --}}
    </div>

    <label for="idformapagamentoreceita" class="col-sm-1 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">
        <select name="idformapagamentoreceita" id="idFormaPagamentoReceita" class="selecionaComInput form-control col-sm-10 js-example-basic-multiple" {{$variavelDisabledNaView}}>
            {{-- <option value="0" selected="selected">Sem Receita</option> --}}
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>
    </div>


    <label for="contareceita" class="col-sm-1 col-form-label">Conta</label>
    <div class="col-sm-2">

        <select name="contareceita" id="contaReceita" class="selecionaComInput col-sm-14 form-control js-example-basic-multiple" {{$variavelDisabledNaView}}>
            @foreach ($listaContas as $contas)
            <option value="{{ $contas->id }}">{{ $contas->numeroConta }}</option>
            @endforeach
        </select>
    </div>

</div>


{!! Form::hidden('id', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('dataemissaoreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}
{{-- {!! Form::hidden('idosreceita', $valorInput, ['placeholder' => 'Id OS Receita', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idosreceita']) !!}  --}}
{{-- <input type="hidden" id="emissaoreceita" class="col-sm-8 form-control" name="emissaoreceita" placeholder="Emissão" value="0" /><br> --}}
{!! Form::hidden('nfreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100']) !!}