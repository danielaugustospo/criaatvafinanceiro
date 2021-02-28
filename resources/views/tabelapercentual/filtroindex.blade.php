<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaTabela as $tabela)
                    <option value="{{ $tabela->id }}">{{ $tabela->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Nome Tabela</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscanometabelapercentual" name="nometabelapercentual" id="nometabelapercentual">
                    <option value="">Listar todos</option>
                    @foreach ($listaTabela as $tabela)
                    <option value="{{ $tabela->nometabelapercentual }}">{{ $tabela->nometabelapercentual }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Percentual</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscapercentualtabelapercentual" name="percentualtabelapercentual" id="percentualtabelapercentual">
                    <option value="">Listar todos</option>
                    @foreach ($listaTabela as $tabela)
                    <option value="{{ $tabela->percentualtabelapercentual }}">{{ $tabela->percentualtabelapercentual }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">Id OS</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscapgtabelapercentual" name="pgtabelapercentual" id="pgtabelapercentual">
                    <option value="">Listar todos</option>
                    @foreach ($listaTabela as $tabela)
                    <option value="{{ $tabela->pgtabelapercentual }}">{{ $tabela->pgtabelapercentual }}</option>
                    @endforeach
                </select>
                
                <label for="" class="col-sm-2">Pago</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaidostabelapercentual" name="idostabelapercentual" id="idostabelapercentual">
                    <option value="">Listar todos</option>
                    @foreach ($listaTabela as $tabela)
                    <option value="{{ $tabela->idostabelapercentual }}">{{ $tabela->idostabelapercentual }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
