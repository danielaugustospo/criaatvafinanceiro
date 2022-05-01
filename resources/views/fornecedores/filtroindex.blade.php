<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">


                <label for="" class="col-sm-2">Nome Fantasia</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple" name="nomeFornecedor" id="nomeFornecedor">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->nomeFornecedor }}">{{ $fornecedores->nomeFornecedor }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-2">Razão Social</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple" name="razaosocialFornecedor" id="razaosocialFornecedor">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->razaosocialFornecedor }}">{{ $fornecedores->razaosocialFornecedor }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">
                <label for="" class="col-sm-2">Id Fornecedor</label>
                <select class="selecionaComInput form-control col-sm-1 js-example-basic-multiple" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->id }}">{{ $fornecedores->id }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">CNPJ</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple" name="cnpjFornecedor" id="cnpjFornecedor">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->cnpjFornecedor }}">{{ $fornecedores->cnpjFornecedor }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">CPF</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple" name="cpfFornecedor" id="cpfFornecedor">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->cpfFornecedor }}">{{ $fornecedores->cpfFornecedor }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
