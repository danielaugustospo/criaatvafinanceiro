<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaFormaPG as $formapg)
                    <option value="{{ $formapg->id }}">{{ $formapg->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Nome</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscanomeFormaPagamento" name="nomeFormaPagamento" id="nomeFormaPagamento">
                    <option value="">Listar todos</option>
                    @foreach ($listaFormaPG as $formapg)
                    <option value="{{ $formapg->nomeFormaPagamento }}">{{ $formapg->nomeFormaPagamento }}</option>
                    @endforeach
                </select>

                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div>
        </div>
        <hr>
    </div>
    <br>
