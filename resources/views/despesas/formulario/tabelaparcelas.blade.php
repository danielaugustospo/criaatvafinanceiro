<table class="rwd-table tabelalistadespesa" id="tabelalistadespesa" style="font-size: 12px;max-width: max-content;width: 120%;">
    <tbody>
        <div class="justify-content-center" style="background-color: black; color:white;"><h4>Compra Parcelada</h4></div>
        <div class="row">
            <th>ORDEM SERVIÇO</th>
            <th>
                <nobr>NOTA FISCAL</nobr>
            </th>
            <th>DESCRIÇÃO</th>
            <th>QUANTIDADE</th>
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
                <select class="form-control selecionaComInput" name="idOSTabela[]" id="idOSTabela">
                    {{-- @foreach ($listaOrdemDeServicos as $os)
                    <option value="{{ $os->id }}">{{ $os->id }}</option>
                    @endforeach
                     --}}
                    <option value="EMPRESA GERAL">SEM OS</option>
                    @foreach ($todasOSAtivas as $listaOS)
                      @isset($despesa)
                        @if ($despesa->idOS == $listaOS->id)
                          <option value="{{$listaOS->id}}" selected>{{$listaOS->id}} | {{$listaOS->eventoOrdemdeServico}}</option>
                          @if ($despesa->idOS == 'EMPRESA GERAL')
                            <option value="EMPRESA GERAL" selected>SEM OS</option>              
                          @endif
                        @endif
                      @endisset
                          <option value="{{$listaOS->id}}">{{$listaOS->id}}</option>
                    @endforeach
                </select>
            </td>
            <td class="col-sm-1"  data-th="NF">
                {!! Form::text('notaFiscalTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
            </td>
            <td class="col-sm-2" data-th="DESCRIÇÃO">
                <div class="form-group row mt-3" id="telaDescricaoTabelaComEstoque">
                    <button type="button" onclick="recarregaDescricaoDespesaTabela()" class="btn btn-dark"><i
                        class="fas fa-sync"></i></i></button>
                    <button type="button"  data-toggle="modal" data-target=".materiais" class="btn btn-primary"><i
                        class="fas fa-plus"></i></i></button>
                    
                    <select class="selecionaComInput pt-3 required descParcelado
                    descParcelado descricaoTabela" name="descricaoTabela[]" id="descricaoDespesaTabela">
                        @if (!isset($despesa))
                            <option disabled value="" selected>Selecione...</option>
                        @endif
                        @foreach ($listaBensPatrimoniais as $bempatrimonial)
                            <option value="{{ $bempatrimonial->id }}">{{ $bempatrimonial->nomeBensPatrimoniais }}</option>
                        @endforeach
                        required
                    </select>
                </div>
                <div class="form-group row mt-3" id="telaDescricaoTabelaSemEstoque">
                    <input class="form-control descricaoTabelaSemEstoque"     style="font-size: .7rem;"  id="descricaoDespesa" @php
                    if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                        echo 'value="' . $despesa->descricaoDespesa . '"';
                    endif; @endphp name="descricaoTabelaSemEstoque[]" maxlength="50">

                    {{-- {!! Form::text('descricaoTabelaSemEstoque[]', $valorInput, ['class' =>'form-control descricaoTabelaSemEstoque', 'id' => 'telaDescricaoTabelaSemEstoque', 'maxlength' => 50]) !!} --}}
                </div>
            </td>
            <td data-th="QUANTIDADE">
                {!! Form::text('quantidadeTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control valoresoperacao quantidadeTabela', 'max' => '2999-12-31', 'id' => 'quantidadeTabela', $variavelReadOnlyNaView]) !!}

                {{-- <input list="tipoUnidade" name="quantidadeTabela[]" id="browser" value="">

                <datalist id="tipoUnidade">
                <option value="Metro">
                <option value="Galão">
                <option value="Vidro">
                <option value="Litro">
                <option value="Saco">
                <option value="Pote"> --}}


                </datalist>

            </td>
            <td data-th="VALOR UNITÁRIO">
                {!! Form::text('valorUnitarioTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control campo-moeda valoresoperacao', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>

            <td data-th="PARCELA">
                {!! Form::text('valorparcelaTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class'
                => 'form-control campo-moeda valoresoperacao valorparcelaTabela', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>
            <td data-th="VENCIMENTO">
                {!! Form::date('vencimentoTabela[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control vencimentoTabela', 'min' => '2000-01-01', 'max' => '2099-12-31', $variavelReadOnlyNaView]) !!}
            </td>
            <td>
                <select name="pagoTabela[]" id="pago" style="padding:4px;" class="selecionaComInput form-control"
                    {{$variavelDisabledNaView}}>
                    @if (Request::path() == 'despesas/create')
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                    @else
                    <option value="N" {{$despesa->pago == 'N'?' selected':''}}>Não</option>
                    <option value="S" {{$despesa->pago == 'S'?' selected':''}}>Sim</option>
                    @endif
                </select>
            </td>
            <td>
                <a href="#tabelaPagamento" class="duplicarParcelado" id="duplicarParcelado">
                    <span class="btn btn-primary">
                        <i class="fa fa-clone" style="color: white;" aria-hidden="true"></i>
                        Duplicar
                    </span>
                </a>
                <a href="#tabelaPagamento" class="deleteParcelado" id="deleteParcelado">
                    <span class="btn btn-danger">
                        <i class="fa fa-trash" style="color: white;" aria-hidden="true"></i>
                        Excluir
                    </span>
                </a>
            </td>
        </tr>
    </tbody>

</table>