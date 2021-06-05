<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">Id Conta</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaContas as $conta)
                    <option value="{{ $conta->id }}">{{ $conta->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Número Conta</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscanomeConta" name="nomeConta" id="nomeConta">
                    <option value="">Listar todos</option>
                    @foreach ($listaContas as $conta)
                    <option value="{{ $conta->nomeConta }}">{{ $conta->nomeConta }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">
                <label for="" class="col-sm-1">Agência Conta</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaapelidoConta" name="apelidoConta" id="apelidoConta">
                    <option value="">Listar todos</option>
                    @foreach ($listaContas as $conta)
                    <option value="{{ $conta->apelidoConta }}">{{ $conta->apelidoConta }}</option>
                    @endforeach
                </select>


                {{-- <label for="" class="col-sm-2">Id Banco</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaidBanco" name="idBanco" id="idBanco">
                    <option value="">Listar todos</option>
                    @foreach ($listaContas as $conta)
                    <option value="{{ $conta->idBanco }}">{{ $conta->idBanco }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
 --}}
            </div>
        </div>
        <hr>
    </div>
    <br>
