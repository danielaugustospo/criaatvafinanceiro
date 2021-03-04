<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">Inventário (Id)</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaid" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaInventario as $inventario)
                    <option value="{{ $inventario->id }}">{{ $inventario->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Nome</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscanomeestoque" name="nomeestoque" id="nomeestoque">
                    <option value="">Listar todos</option>
                    @foreach ($listaInventario as $inventario)
                    <option value="{{ $inventario->nomeestoque }}">{{ $inventario->nomeestoque }}</option>
                    @endforeach
                </select>


            </div>
            <div class="group-row">
                
                <label for="" class="col-sm-1">Descrição</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscadescricaoestoque" name="descricaoestoque" id="descricaoestoque">
                    <option value="">Listar todos</option>
                    @foreach ($listaInventario as $inventario)
                    <option value="{{ $inventario->descricaoestoque }}">{{ $inventario->descricaoestoque }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Bem Patrimonial</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaidbenspatrimoniais" name="idbenspatrimoniais" id="idbenspatrimoniais">
                    <option value="">Listar todos</option>
                    @foreach ($listaInventario as $inventario)
                    <option value="{{ $inventario->idbenspatrimoniais }}">{{ $inventario->idbenspatrimoniais }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
