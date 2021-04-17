<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">N° OS</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaIdOS" name="buscaIdOS" id="buscaIdOS">
                    <option value="">Listar todos</option>
                    @foreach ($listaOrdemDeServicos as $os)
                    <option value="{{ $os->id }}">{{ $os->id }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Evento</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaEventoOrdemdeServico" name="buscaEventoOrdemdeServico" id="buscaEventoOrdemdeServico">
                    <option value="">Listar todos</option>
                    @foreach ($listaOrdemDeServicos as $os)
                    <option value="{{ $os->eventoOrdemdeServico }}">{{ $os->eventoOrdemdeServico }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Despesa</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaDescricaoDespesa" name="buscaDescricaoDespesa" id="buscaDescricaoDespesa">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $despesas)
                    <option value="{{ $despesas->descricaoDespesa }}">{{ $despesas->descricaoDespesa }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">



                <label for="" class="col-sm-1">Nome<br> Fantasia</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaNomeFornecedor" name="buscaNomeFornecedor" id="buscaNomeFornecedor">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->nomeFornecedor }}">{{ $fornecedores->nomeFornecedor }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Razão Social</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaRazaosocialFornecedor" name="buscaRazaosocialFornecedor" id="buscaRazaosocialFornecedor">
                    <option value="">Listar todos</option>
                    @foreach ($listaFornecedores as $fornecedores)
                    <option value="{{ $fornecedores->razaosocialFornecedor }}">{{ $fornecedores->razaosocialFornecedor }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">N° Registro</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaNRegistro" name="buscaNRegistro" id="buscaNRegistro">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $despesas)
                    <option value="{{ $despesas->nRegistro }}">{{ $despesas->nRegistro }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">
                <label for="" class="col-sm-2">Data</label>
                <select class="selecionaComInput form-control col-sm-1 js-example-basic-multiple buscaVencimento" name="buscaVencimento" id="buscaVencimento">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $fornecedores)
                    <option value="{{ $despesas->vencimento }}">{{ $despesas->vencimento }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Valor</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaPrecoReal" name="buscaPrecoReal" id="buscaPrecoReal">
                    <option value="">Listar todos</option>
                    @foreach ($listaDespesas as $despesas)
                    <option value="{{ $despesas->precoReal }}">{{ $despesas->precoReal }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Pago</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscaPago" name="buscaPago" id="buscaPago">
                    <option value="">Listar todos</option>
                    <option value="S">SIM</option>
                    <option value="N">NÃO</option>

                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
