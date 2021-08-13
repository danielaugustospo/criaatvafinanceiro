<table class="rwd-table" id="tabelalistadespesa">
    <tbody>
        <div class="row">
            <th>ORDEM SERVIÇO</th>
            <th>
                <nobr>NOTA FISCAL</nobr>
            </th>
            <th>DESCRIÇÃO</th>
            <th>UNIDADE</th>
            <th>
                <nobr>VALOR UNITÁRIO</nobr>
            </th>
            <th>
                <nobr>VALOR PARCELA</nobr>
            </th>
            <th>VENCIMENTO</th>
            <th>
                <nobr>PAGO EFETUADO</nobr>
            </th>
            <th></th>
        </div>
        <tr name="teste">
            <td data-th="OS">
                <select class="form-control selecionaComInput" name="idOSTabela[]" id="">
                    {{-- @foreach ($listaOrdemDeServicos as $os)
                    <option value="{{ $os->id }}">{{ $os->id }}</option>
                    @endforeach
                     --}}
                    <option value="CRIAATVA">SEM OS</option>
                    @foreach ($todasOSAtivas as $listaOS)
                      @isset($despesa)
                        @if ($despesa->idOS == $listaOS->id)
                          <option value="{{$listaOS->id}}" selected>{{$listaOS->id}} | {{$listaOS->eventoOrdemdeServico}}</option>
                          @if ($despesa->idOS == 'CRIAATVA')
                            <option value="CRIAATVA" selected>SEM OS</option>              
                          @endif
                        @endif
                      @endisset
                          <option value="{{$listaOS->id}}">{{$listaOS->id}}</option>
                    @endforeach
                </select>
            </td>
            <td data-th="NF">
                {!! Form::text('notaFiscalTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
            </td>
            <td data-th="DESCRIÇÃO">
                <div class="form-group row">
                    <button type="button" onclick="recarregaDescricaoDespesa()" class="btn btn-dark"><i
                        class="fas fa-sync"></i></i></button>
                    <button type="button"  data-toggle="modal" data-target=".materiais" class="btn btn-primary"><i
                        class="fas fa-plus"></i></i></button>
                    
                    <select class="selecionaComInput pt-3" name="descricaoTabela[]" id="descricaoDespesaTabela">
                        @foreach ($listaBensPatrimoniais as $bempatrimonial)
                        <option value="{{ $bempatrimonial->id }}">{{ $bempatrimonial->nomeBensPatrimoniais }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <td data-th="UNIDADE">
                {!! Form::text('quantidadeTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>
            <td data-th="VALOR UNITÁRIO">
                {!! Form::text('valorUnitarioTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control campo-moeda valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>

            <td data-th="PARCELA">
                {!! Form::text('valorparcelaTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class'
                => 'form-control campo-moeda valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>
            <td data-th="VENCIMENTO">
                {!! Form::date('vencimentoTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>
            <td>
                <select name="pago[]" id="pago" style="padding:4px;" class="selecionaComInput form-control"
                    {{$variavelDisabledNaView}}>
                    @if (Request::path() == 'despesas/create')
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                    @else
                    <option value="1" {{$despesa->pago == '1'?' selected':''}}>Sim</option>
                    <option value="0" {{$despesa->pago == '0'?' selected':''}}>Não</option>
                    @endif
                </select>
            </td>
            <td>
                <a href="#tabelaPagamento" class="duplicar">
                    <span class="badge badge-primary">
                        <i class="fa fa-clone" style="color: white;" aria-hidden="true"></i>
                        Duplicar
                    </span>
                </a>
                <a href="#tabelaPagamento" class="delete">
                    <span class="badge badge-danger">
                        <i class="fa fa-trash" style="color: white;" aria-hidden="true"></i>
                        Excluir
                    </span>
                </a>
            </td>
        </tr>
    </tbody>

</table>