<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Id Receita</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaIdReceita" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaReceitas as $receita)
                    <option value="{{ $receita->id }}">{{ $receita->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Valor</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaValor" name="valorreceita" id="valorreceita">
                    <option value="">Listar todos</option>
                    @foreach ($listaReceitas as $receita)
                    <option value="{{ $receita->valorreceita }}">{{ $receita->valorreceita }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Conta</label>
                {{-- <input type="text" name="contareceita" class="col-sm-2 form-control buscaPrecoReal" placeholder="Preço Real"> --}}
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaContaReceita" name="contareceita" id="contareceita">
                    <option value="">Listar todos</option>
                    @foreach ($listaContas as $contas)
                    <option value="{{ $contas->id }}">{{ $contas->nomeConta }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">Data</label><input type="date" name="datapagamentoreceita" class="col-sm-2 form-control buscaDataPagamento" placeholder="Data">
                <label for="" class="col-sm-2">Número OS</label>

                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaOSReceita" name="idosreceita" id="idosreceita">
                    <option value="">Listar todos</option>
                    @foreach ($listaReceitas as $receita)
                    <option value="{{ $receita->idosreceita }}">{{ $receita->idosreceita }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
