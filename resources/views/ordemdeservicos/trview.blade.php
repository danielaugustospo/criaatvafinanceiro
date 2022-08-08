<tr class="linhaTabela">
    <td>
        {!! Form::hidden('idReceita[]', $dadosreceita->idReceita, ['placeholder' => 'Preencha este campo', 'maxlength' => '100', 'class' => 'idReceita']) !!}
        {!! Form::hidden('excluidoreceita[]', 0, ['placeholder' => 'Preencha este campo', 'maxlength' => '100', 'class' => 'excluidoreceita']) !!}
        <select name="idformapagamentoreceita[]" id="idFormaPagamentoReceita" class="selecionaComInput form-control" {{ $disabledOrNo }}>
            @foreach ($listaFormaPG as $formaPG)
                @if ($formaPG->id == $dadosreceita->idformapagamentoreceita)            
                    <option value="{{ $formaPG->id }}" selected>{{ $formaPG->nomeFormaPagamento }}</option>
                @elseif ($dadosreceita->idformapagamentoreceita == '0')            
                    <option value="0" selected>Sem Receita</option>
                @endif
                    <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
            @endforeach


        </select>
    </td>
    <td>
        {!! Form::text('valorreceita[]', $dadosreceita->valorreceita, ['placeholder' => 'Preencha o valor', 'class' => 'col campo-moeda valorreceita form-control', 'maxlength' => '100', 'step'=>'any', 'id'=>'campo-moeda', $readonlyOrNo]) !!}
    </td>
    <td>
        <select name="pagoreceita[]" id="pagoreceita" style="padding:0px; width:150%;" class="form-control" {{ $disabledOrNo }}>
            <option value="S" {{$dadosreceita->pagoreceita == 'S'?' selected':''}} style="background-color:green;">Sim</option>
            <option value="N" {{$dadosreceita->pagoreceita == 'N'?' selected':''}} style="background-color: #e3342f;">Não</option>
        </select>
    </td>
    <td>
        {!! Form::date('dataemissaoreceita[]', $dadosreceita->dataemissaoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'col form-control', 'maxlength' => '100',  $readonlyOrNo]) !!}
    </td>
    <td>
        {!! Form::date('datapagamentoreceita[]', $dadosreceita->datapagamentoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'col form-control', 'maxlength' => '100',  $readonlyOrNo ]) !!}
    </td>
    <td>
        <select name="contareceita[]" id="contaReceita" class="col-lg-12 selecionaComInput form-control" {{ $disabledOrNo }}>
            @foreach ($listaContas as $contas)
                @if ($contas->id == $dadosreceita->contareceita)            
                    <option value="{{ $contas->id }}" selected>{{ $contas->apelidoConta }}</option>
                @endif
                    <option value="{{ $contas->id }}">{{ $contas->apelidoConta }}</option>
            @endforeach
        </select>
    </td>
    <td>
        {!! Form::text('nfreceita[]', $dadosreceita->nfreceita, ['placeholder' => 'N° Nota', 'class' => 'form-control', 'maxlength' => '100', 'required', $readonlyOrNo]) !!}
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
    </td>    
</tr>

