<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-1 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaTiposBensPatrimoniais as $product)
                    <option value="{{ $product->id }}">{{ $product->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Nome</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaname" name="name" id="name">
                    <option value="">Listar todos</option>
                    @foreach ($listaTiposBensPatrimoniais as $product)
                    <option value="{{ $product->name }}">{{ $product->name }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Detalhes</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscadetail" name="detail" id="detail">
                    <option value="">Listar todos</option>
                    @foreach ($listaTiposBensPatrimoniais as $product)
                    <option value="{{ $product->detail }}">{{ $product->detail }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div>
        </div>
        <hr>
    </div>
    <br>
