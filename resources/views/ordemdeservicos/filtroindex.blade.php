<div class="container shadowDiv mb-5 rounded" style="background-color: lightslategray !important; color:white;" id="container">

    {{-- <div class="container" id="container"> --}}
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">N° OS</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaOrdemDeServicos as $ordemDeServicos)
                    <option value="{{ $ordemDeServicos->id }}">{{ $ordemDeServicos->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Cliente</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaCliente" name="idClienteOrdemdeServico" id="idClienteOrdemdeServico">
                    <option value="">Listar todos</option>
                    @foreach ($listaOrdemDeServicos as $ordemDeServicos)
                    <option value="{{ $ordemDeServicos->idClienteOrdemdeServico }}">{{ $ordemDeServicos->idClienteOrdemdeServico }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">
                <label for="" class="col-sm-1">Evento</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaEvento" name="eventoOrdemdeServico" id="eventoOrdemdeServico">
                    <option value="">Listar todos</option>
                    @foreach ($listaOrdemDeServicos as $ordemDeServicos)
                    <option value="{{ $ordemDeServicos->eventoOrdemdeServico }}">{{ $ordemDeServicos->eventoOrdemdeServico }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Valor Projeto</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaValor" name="valorOrdemdeServico" id="valorOrdemdeServico">
                    <option value="">Listar todos</option>
                    @foreach ($listaOrdemDeServicos as $ordemDeServicos)
                    <option value="{{ $ordemDeServicos->valorOrdemdeServico }}">{{ $ordemDeServicos->valorOrdemdeServico }}</option>
                    @endforeach
                </select>

                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
    </div>
    <br>
</div>