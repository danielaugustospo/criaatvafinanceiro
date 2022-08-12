{{-- <table class="rwd-table" id="tabelalistadespesamultipla" 
    style="font-size: 12px;
    /* max-width: max-content; */

    background-color:black !important;
    display: table;
    width: 100%;
    overflow-x: scroll;
    overflow-y: scroll;
    white-space: nowrap;
    "
> --}}
<table class="rwd-table tabelalistadespesamultipla" id="tabelalistadespesamultipla" style="font-size: 12px;max-width: max-content;width: 120%;">

    <tbody>
        <div class="justify-content-center" style="background-color: black; color:white;"><h4>Múltiplos Lançamentos</h4></div>
        <div class="row">
            <th>ORDEM SERVIÇO</th>
            <th><nobr>NOTA FISCAL</nobr></th>
            <th>DESCRIÇÃO</th>
            <th>QUANTIDADE</th>
            <th><nobr>VALOR UNITÁRIO</nobr></th>
            <th><nobr>VALOR TOTAL</nobr></th>
            <th>VENCIMENTO</th>
            <th><nobr>PAGO EFETUADO</nobr></th>
            {{-- <th><nobr>Fornecedor (NOVO)</nobr></th>
            <th><nobr>Despesa Fixa  (NOVO)</nobr></th> --}}
            <th></th>
        </div>
        <tr name="teste">
            <td data-th="OS">
                <select class="form-control selecionaComInput" name="idOSTabelaMultiplo[]" id="idOSTabela">
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
                {!! Form::text('notaFiscalTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]) !!}
            </td>
            <td class="col-sm-2" data-th="DESCRIÇÃO">
                <div class="form-group row mt-3" id="telaDescricaoTabelaComEstoqueMultiplo">
                    <button type="button" onclick="recarregaDescricaoDespesaTabelaMultiplo()" class="btn btn-dark"><i
                        class="fas fa-sync"></i></i></button>
                    <button type="button"  data-toggle="modal" data-target=".materiais" class="btn btn-primary"><i
                        class="fas fa-plus"></i></i></button>
                    
                    <select class="selecionaComInput pt-3 required descMultiplo descricaoTabela" name="descricaoTabelaMultiplo[]" id="descricaoDespesaTabela">
                        @if (!isset($despesa))
                            <option disabled value="" selected>Selecione...</option>
                        @endif
                        @foreach ($listaBensPatrimoniais as $bempatrimonial)
                            <option value="{{ $bempatrimonial->id }}">{{ $bempatrimonial->nomeBensPatrimoniais }}</option>
                        @endforeach
                        required
                    </select>
                </div>
                <div class="form-group row mt-3" id="telaDescricaoTabelaSemEstoqueMultiplo">
                    <input class="form-control descricaoTabelaSemEstoque"     style="font-size: .7rem;"  id="descricaoDespesa" @php
                    if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                        echo 'value="' . $despesa->descricaoDespesa . '"';
                    endif; @endphp name="descricaoTabelaSemEstoqueMultiplo[]" maxlength="50">

                    {{-- {!! Form::text('descricaoTabelaSemEstoqueMultiplo[]', $valorInput, ['class' =>'form-control descricaoTabelaSemEstoque', 'id' => 'telaDescricaoTabelaSemEstoque', 'maxlength' => 50]) !!} --}}
                </div>
            </td>
            <td data-th="QUANTIDADE">
                {!! Form::text('quantidadeTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control valoresoperacao quantidadeTabela', 'max' => '2999-12-31', 'id' => 'quantidadeTabela', $variavelReadOnlyNaView]) !!}

                {{-- <input list="tipoUnidade" name="quantidadeTabelaMultiplo[]" id="browser" value="">

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
                {!! Form::text('valorUnitarioTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control campo-moeda valoresoperacao valunitariomultiplo', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>

            <td data-th="VALOR TOTAL">
                {!! Form::text('valorparcelaTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class'
                => 'form-control campo-moeda valoresoperacao valorparcelaTabela valtotalmultiplo', 'maxlength' => '100', $variavelReadOnlyNaView]) !!}
            </td>
            <td data-th="VENCIMENTO">
                {!! Form::date('vencimentoTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control vencimentoTabela', 'min' => '2000-01-01', 'max' => '2099-12-31', $variavelReadOnlyNaView]) !!}
            </td>
            <td>
                <select name="pagoTabelaMultiplo[]" id="pago" style="padding:4px;" class="selecionaComInput form-control" style=" min-width: 100px !important;"
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
            {{-- <td>Fornecedor</td>
            <td>Despesa Fixa</td> --}}
            <td>
                <a href="#tabelaPagamento" class="duplicarNaoParceladoMultiplo" id="duplicarNaoParceladoMultiplo">
                    <span class="btn btn-primary">
                        <i class="fa fa-clone" style="color: white;" aria-hidden="true"></i>
                        Duplicar
                    </span>
                </a>
                <a href="#tabelaPagamento" class="deleteNaoParceladoMultiplo" id="deleteNaoParceladoMultiplo">
                    <span class="btn btn-danger">
                        <i class="fa fa-trash" style="color: white;" aria-hidden="true"></i>
                        Excluir
                    </span>
                </a>
            </td>
        </tr>
    </tbody>

</table>