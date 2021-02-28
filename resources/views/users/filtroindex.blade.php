<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaUsuarios as $users)
                    <option value="{{ $users->id }}">{{ $users->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Descrição da Despesa</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaname" name="name" id="name">
                    <option value="">Listar todos</option>
                    @foreach ($listaUsuarios as $users)
                    <option value="{{ $users->name }}">{{ $users->name }}</option>
                    @endforeach
                </select>


            </div>
            <div class="group-row">
                <label for="" class="col-sm-1">Email</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaemail" name="email" id="email">
                    <option value="">Listar todos</option>
                    @foreach ($listaUsuarios as $users)
                    <option value="{{ $users->email }}">{{ $users->email }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Código Despesas</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaativoUser" name="ativoUser" id="ativoUser">
                    <option value="">Listar todos</option>
                    @foreach ($listaUsuarios as $users)
                    <option value="{{ $users->ativoUser }}">{{ $users->ativoUser }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div>

        </div>
        <hr>
    </div>
    <br>
