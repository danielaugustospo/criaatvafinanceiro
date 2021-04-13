@if (Route::currentRouteName() == 'contasAPagar')
    @php
       $recebeVariavel =  $listaContasAPagar;
    @endphp
@else
    @php
        $recebeVariavel =  $listaContasAReceber;
    @endphp
@endif


<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">OS</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaOS" name="buscaOS" id="buscaOS">
                    <option value="">Listar todos</option>
                    @foreach ($recebeVariavel as $dados)
                    <option value="{{ $dados->idOS }}">{{ $dados->idOS }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Cliente</label>
                <select class="selecionaComInput form-control col-sm-6 js-example-basic-multiple buscaCliente" name="buscaCliente" id="buscaCliente">
                    <option value="">Listar todos</option>
                    @foreach ($recebeVariavel as $dados)
                    <option value="{{ $dados->idCliente }}">{{ $dados->nomeCliente }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row"> 

                <label for="" class="col-sm-1">Data</label>
                {{-- <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaCliente" name="buscaCliente" id="buscaCliente">
                    <option value="">Listar todos</option>
                    @foreach ($recebeVariavel as $dados)
                    <option value="{{ $dados->vencimento }}">{{ $dados->vencimento }}</option>
                    @endforeach
                </select> --}}
                <input type="date" class="col-sm-2 buscaData" name="buscaData" id="buscaData">

                <label for="" class="col-sm-1">Evento</label>
                <select class="selecionaComInput form-control col-sm-6 js-example-basic-multiple buscaEvento" name="buscaEvento" id="buscaEvento">
                    <option value="">Listar todos</option>
                    @foreach ($recebeVariavel as $dados)
                    <option value="{{ $dados->evento }}">{{ $dados->evento }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">
                <label for="" class="col-sm-1">Valor</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaValor" name="buscaValor" id="buscaValor">
                    <option value="">Listar todos</option>
                    @foreach ($recebeVariavel as $dados)
                    <option value="{{ $dados->preco }}">{{ $dados->preco }}</option>
                    @endforeach
                </select>


                <label for="" class="col-sm-1">Conta</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaConta" name="buscaConta" id="buscaConta">
                    <option value="">Listar todos</option>
                    @foreach ($recebeVariavel as $dados)
                    <option value="{{ $dados->agencia }}">{{ $dados->agencia }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Nota Fiscal</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaNF" name="buscaNF" id="buscaNF">
                    <option value="">Listar todos</option>
                    @foreach ($recebeVariavel as $dados)
                    <option value="{{ $dados->notaFiscal }}">{{ $dados->notaFiscal }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">
                
                <label for="" class="col-sm-1">Período</label>
                <input type="text" class="col-sm-3 daterange" name="daterange" id="daterange">
                <input type="hidden" class="col-sm-2 buscaDataInicio" name="buscaDataInicio" id="buscaDataInicio">
                <input type="hidden" class="col-sm-2 buscaDataFim" name="buscaDataFim" id="buscaDataFim">

                <input class="btn btn-primary ml-2 pesquisar" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">                
            </div>
        </div>
        <hr>
    </div>
    <br>
