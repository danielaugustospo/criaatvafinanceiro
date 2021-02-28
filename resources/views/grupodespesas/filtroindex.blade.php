<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Id Grupo</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaIdGrupo" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaGrupoDespesas as $grupodespesa)
                    <option value="{{ $grupodespesa->id }}">{{ $grupodespesa->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-3">Nome do Grupo da Despesa</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaGrupoDespesa" name="grupoDespesa" id="grupoDespesa">
                    <option value="">Listar todos</option>
                    @foreach ($listaGrupoDespesas as $nomeGrupoDespesa)
                    <option value="{{ $nomeGrupoDespesa->grupoDespesa }}">{{ $nomeGrupoDespesa->grupoDespesa }}</option>
                    @endforeach
                </select>
                    <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>

    </div>
</div>
<br>
