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
                    @foreach ($listaDespesas as $despesa)
                    <option value="{{ $despesa->descricaoDespesa }}">{{ $despesa->descricaoDespesa }}</option>
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
                <label for="" class="col-sm-2">Código Despesas</label>
                {{-- <input type="text" name="idCodigoDespesas" class="col-sm-4 form-control buscaIdCodigoDespesas" placeholder="Código de Despesas"> --}}
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaIdCodigoDespesas" name="idCodigoDespesas" id="idCodigoDespesas">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $despesa)
                    <option value="{{ $despesa->idCodigoDespesas }}">{{ $despesa->idCodigoDespesas }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Nota Fiscal</label>
                {{-- <input type="text" name="nRegistro" class="col-sm-2 form-control buscaNRegistro" placeholder="Registro"> --}}
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaNotaFiscal" name="notaFiscal" id="notaFiscal">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $despesa)
                    <option value="{{ $despesa->notaFiscal }}">{{ $despesa->notaFiscal }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row mt-3">
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
