<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">


                    <label for="" class="col-sm-1">N° da OS</label>
                    {{-- <input type="text" name="idOS" class="col-sm-2 form-control buscaIdOS" placeholder="N° da OS"> --}}
                    <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaIdOS" name="idOS" id="idOS">
                        <option value="">Listar todos</option>
                        @foreach ($listaDespesas as $despesa)
                        <option value="{{ $despesa->idOS }}">{{ $despesa->idOS }}</option>
                        @endforeach
                    </select>
                <label for="" class="col-sm-2">Descrição da Despesa</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscadescricaoDespesa" name="descricaoDespesa" id="descricaoDespesa">
                    <option value="">Listar todos</option>
                    @foreach ($listaBensPatrimoniais as $descricao)
                    <option value="{{ $descricao->id }}">{{ $descricao->nomeBensPatrimoniais }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Valor</label>
                {{-- <input type="text" name="precoReal" class="col-sm-2 form-control buscaPrecoReal" placeholder="Preço Real"> --}}
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscavalorparcela" name="valorparcela" id="valorparcela">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $despesa)
                    <option value="{{ $despesa->valorparcela }}">{{ $despesa->valorparcela }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">Data</label><input type="date" name="vencimento" class="col-sm-2 form-control buscaVencimento" placeholder="Vencimento">
                <label for="" class="col-sm-2">Fornecedor</label>
                {{-- <input type="text" name="idCodigoDespesas" class="col-sm-4 form-control buscaIdCodigoDespesas" placeholder="Código de Despesas"> --}}
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaIdFornecedor" name="idFornecedor" id="idFornecedor">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->id }}">{{ $fornecedores->razaosocialFornecedor }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Nota Fiscal</label>
                {{-- <input type="text" name="nRegistro" class="col-sm-2 form-control buscaNRegistro" placeholder="Registro"> --}}
                <input class="form-control col-sm-2  buscaNotaFiscal" name="notaFiscal" id="notaFiscal">
                {{-- <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaNotaFiscal" name="notaFiscal" id="notaFiscal">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $despesa)
                    <option value="{{ $despesa->notaFiscal }}">{{ $despesa->notaFiscal }}</option>
                    @endforeach
                </select> --}}

            </div>

            <div class="group-row">
                
                <label for="" class="col-sm-1">Período</label>
                <i for="daterange" class="fa fa-calendar-alt fa-2x pt-2" style="color:green;" aria-hidden="true"></i>
                <i class="fas fa-arrows-alt-h"></i>             
                <i for="daterange" class="fa fa-calendar-alt fa-2x pt-2 pr-2" style="color:red;" aria-hidden="true"></i>

                <input type="text" class="col-sm-3 daterange" style="padding-left:50px;"  name="daterange" id="daterange">
                <input type="hidden" class="col-sm-2 buscaDataInicio" name="buscaDataInicio" id="buscaDataInicio">
                <input type="hidden" class="col-sm-2 buscaDataFim" name="buscaDataFim" id="buscaDataFim">
                {{-- <input class="btn btn-primary ml-2 pesquisar" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">                 --}}
            </div>

            <div class="row mt-3">
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>

    