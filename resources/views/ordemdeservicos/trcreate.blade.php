<tr class="linhaTabela" id="linhaTabela">
    <td data-label="Forma Pagamento">
        {!! Form::hidden('excluidoreceita[]', 0, ['placeholder' => 'Preencha este campo', 'maxlength' => '100', 'class' => 'excluidoreceita']) !!}
        <select name="idformapagamentoreceita[]" id="idFormaPagamentoReceita" class="selecionaComInput ">
            <option value="0" selected="selected">Sem Receita</option>
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>

    </td>
    <td data-label="Valor Parcela">
        {!! Form::text('valorreceita[]', $valorInput, ['placeholder' => 'Preencha o valor', 'class' => 'campo-moeda form-control', 'maxlength' => '100', 'step'=>'any', 'id'=>'campo-moeda','required']) !!}

    </td>
    <td data-label="Pago">
        <select name="pagoreceita[]" id="pagoreceita" style="padding:0px;" onclick="pegaIdFornecedor()" class="form-control">
            <option value="S" style="background-color:green;">Sim</option>
            <option value="N" style="background-color: #e3342f;">Não</option>
        </select>
    </td>
    <td data-label="Data Emissão">
        {!! Form::date('dataemissaoreceita[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control dataemissaoreceita', 'maxlength' => '100']) !!}
    </td>
    <td data-label="Data de Pagamento">
        {!! Form::date('datapagamentoreceita[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control datapagamentoreceita', 'maxlength' => '100', 'required']) !!}
    </td>
    <td data-label="Conta">
        <select name="contareceita[]" id="contaReceita" class="selecionaComInput form-control">
            @foreach ($listaContas as $contas)
                <option value="{{ $contas->id }}">{{ $contas->apelidoConta }}</option>
            @endforeach
        </select>
    </td>
    <td data-label="Nota Fiscal">
        {!! Form::text('nfreceita[]', $valorInput, ['placeholder' => 'N° Nota', 'class' => ' form-control', 'maxlength' => '100', 'required']) !!}
    </td>
    <td>
        <a href="#tabelaPagamento" class="duplicar pb-2">
            <span class="btn btn-primary">
                <i class="fa fa-clone" style="color: white;" aria-hidden="true"></i>
                Duplicar
            </span>
        </a>
        <a href="#tabelaPagamento" class="deletar" style="padding: 0%;">
            <span class="btn btn-danger">
                <i class="fa fa-trash" style="color: white;" aria-hidden="true"></i>
                Excluir
            </span>
        </a>
        {{-- <a href="#tabelaPagamento" class="delete"><i class="fa fa-trash" style="color: red;" aria-hidden="true"> Excluir</i></a></td> --}}
</tr>
