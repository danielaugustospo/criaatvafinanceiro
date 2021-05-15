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
        {!! Form::text('valorreceita[]', $dadosreceita->valorreceita, ['placeholder' => 'Preencha o valor', 'class' => 'padraoRealEdicao form-control', 'maxlength' => '100', 'step'=>'any', 'id'=>'padraoReal','required']) !!}

    </td>
    <td>
        <select name="pagoreceita[]" id="pagoreceita" style="padding:0px; width:150%;" class="form-control">
            <option value="S" {{$dadosreceita->pagoreceita == 'S'?' selected':''}}>Sim</option>
            <option value="N" {{$dadosreceita->pagoreceita == 'N'?' selected':''}}>Não</option>
        </select>
    </td>
    <td>
        {!! Form::date('dataemissaoreceita[]', $dadosreceita->dataemissaoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
    </td>
    <td>
        {!! Form::date('datapagamentoreceita[]', $dadosreceita->datapagamentoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
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
