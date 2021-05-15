<tr class="linhaTabela">
    <td>
        <select name="idformapagamentoreceita[]" id="idFormaPagamentoReceita" class="selecionaComInput form-control">
            <option value="0" selected="selected">Sem Receita</option>
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>

    </td>
    <td>
        {!! Form::text('valorreceita[]', $valorInput, ['placeholder' => 'Preencha o valor', 'class' => 'padraoReal form-control', 'maxlength' => '100', 'step'=>'any', 'id'=>'padraoReal','required']) !!}

    </td>
    <td>
        <select name="pagoreceita[]" id="pagoreceita" style="padding:0px; width:150%;" class="form-control">
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </td>
    <td>
        {!! Form::date('dataemissaoreceita[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
    </td>
    <td>
        {!! Form::date('datapagamentoreceita[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
    </td>
    <td>
        <select name="contareceita[]" id="contaReceita" class="selecionaComInput form-control js-example-basic-multiple">
            @foreach ($listaContas as $contas)
            <option value="{{ $contas->id }}">{{ $contas->numeroConta }}</option>
            @endforeach
        </select>
    </td>
    <td><a href="#tabelaPagamento" class="delete">Excluir</a></td>
</tr>
