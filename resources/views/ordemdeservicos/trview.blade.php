<tr class="linhaTabela">
    <td>
        {!! Form::hidden('idReceita[]', $dadosreceita->idReceita, ['placeholder' => 'Preencha este campo', 'maxlength' => '100', 'class' => 'idReceita']) !!}

        <select name="idformapagamentoreceita[]" id="idFormaPagamentoReceita" class="selecionaComInput form-control">
            <option value="0" selected="selected">Sem Receita</option>
            @foreach ($formapagamento as $formaPG)
            <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach
        </select>

    </td>
    <td>
        {!! Form::text('valorreceita[]', $dadosreceita->valorreceita, ['placeholder' => 'Preencha o valor', 'class' => 'col campo-moeda form-control', 'maxlength' => '100', 'step'=>'any', 'id'=>'campo-moeda','required']) !!}

    </td>
    <td>
        <select name="pagoreceita[]" id="pagoreceita" style="padding:0px; width:150%;" class="form-control">
            <option value="S" {{$dadosreceita->pagoreceita == 'S'?' selected':''}} style="background-color:green;">Sim</option>
            <option value="N" {{$dadosreceita->pagoreceita == 'N'?' selected':''}} style="background-color: #e3342f;">Não</option>
        </select>
    </td>
    <td>
        {!! Form::date('dataemissaoreceita[]', $dadosreceita->dataemissaoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'col form-control', 'maxlength' => '100', 'required']) !!}
    </td>
    <td>
        {!! Form::date('datapagamentoreceita[]', $dadosreceita->datapagamentoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'col form-control', 'maxlength' => '100', 'required']) !!}
    </td>
    <td>
        <select name="contareceita[]" id="contaReceita" class="col-lg-12 selecionaComInput form-control">
            @foreach ($listaContas as $contas)
            <option value="{{ $contas->id }}">{{ $contas->apelidoConta }}</option>
            @endforeach
        </select>
    </td>
    <td>
        {!! Form::text('nfreceita[]', $dadosreceita->nfreceita, ['placeholder' => 'N° Nota', 'class' => 'form-control pl-0 pr-0', 'maxlength' => '100', 'required']) !!}
    </td>
    <td>
        <a href="#tabelaPagamento" class="duplicar pb-2">
            <span class="badge badge-primary">
                <i class="fa fa-clone" style="color: white;" aria-hidden="true"></i>
                Duplicar
            </span>
        </a>
        <a href="#tabelaPagamento" class="deletar" style="padding: 0%;">
            <span class="badge badge-danger">
                <i class="fa fa-trash" style="color: white;" aria-hidden="true"></i>
                Excluir
            </span>
        </a>
    </td>    
        {{-- <a href="#tabelaPagamento" class="delete">Excluir</a></td> --}}
    
</tr>

