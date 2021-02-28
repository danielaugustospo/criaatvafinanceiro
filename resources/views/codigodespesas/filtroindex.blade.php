<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">Código</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaCodigoDespesa as $codigodespesa)
                    <option value="{{ $codigodespesa->id }}">{{ $codigodespesa->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Nome</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaCodigoDespesa" name="despesaCodigoDespesa" id="despesaCodigoDespesa">
                    <option value="">Listar todos</option>
                    @foreach ($listaCodigoDespesa as $nome)
                    <option value="{{ $nome->despesaCodigoDespesa }}">{{ $nome->despesaCodigoDespesa }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Grupo de Despesa</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaidGrupoCodigoDespesa" name="idGrupoCodigoDespesa" id="idGrupoCodigoDespesa">
                    <option value="">Listar todos</option>
                    @foreach ($listaCodigoDespesa as $idGrupoDespesa)
                    <option value="{{ $idGrupoDespesa->idGrupoCodigoDespesa }}">{{ $idGrupoDespesa->idGrupoCodigoDespesa }}</option>
                    @endforeach
                </select>
                    <input class="btn btn-primary ml-5" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">


            </div>
        </div>
        <hr>

    </div>
</div>
<br>
