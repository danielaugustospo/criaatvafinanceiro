<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaIdclientes" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaClientes as $clientes)
                    <option value="{{ $clientes->id }}">{{ $clientes->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Nome Fantasia</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscanomeCliente" name="nomeCliente" id="nomeCliente">
                    <option value="">Listar todos</option>
                    @foreach ($listaClientes as $clientes)
                    <option value="{{ $clientes->nomeCliente }}">{{ $clientes->nomeCliente }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Razão Social</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscarazaosocialCliente" name="razaosocialCliente" id="razaosocialCliente">
                    <option value="">Listar todos</option>
                    @foreach ($listaClientes as $clientes)
                    <option value="{{ $clientes->razaosocialCliente }}">{{ $clientes->razaosocialCliente }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">CNPJ</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscacnpjCliente" name="cnpjCliente" id="cnpjCliente">
                    <option value="">Listar todos</option>
                    @foreach ($listaClientes as $clientes)
                    <option value="{{ $clientes->cnpjCliente }}">{{ $clientes->cnpjCliente }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-2">Contato Cliente</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscacontatoCliente" name="contatoCliente" id="contatoCliente">
                    <option value="">Listar todos</option>
                    @foreach ($listaClientes as $clientes)
                    <option value="{{ $clientes->contatoCliente }}">{{ $clientes->contatoCliente }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Telefone</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscatelefone1Cliente" name="telefone1Cliente" id="telefone1Cliente">
                    <option value="">Listar todos</option>
                    @foreach ($listaClientes as $clientes)
                    <option value="{{ $clientes->telefone1Cliente }}">{{ $clientes->telefone1Cliente }}</option>
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
