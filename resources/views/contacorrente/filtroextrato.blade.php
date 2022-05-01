<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">OS</label>
                <select class="selecionaComInput form-control col-sm-1 js-example-basic-multiple buscaOS" name="buscaOS" id="buscaOS">
                    <option value="">Listar todos</option>
                    @foreach ($listaOrdemDeServicos as $dados)
                    <option value="{{ $dados->id }}">{{ $dados->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Data</label>

                <input type="date" class="col-sm-2 buscaData" name="buscaData" id="buscaData">

                <label for="" class="col-sm-1">Valor</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaValor" name="buscaValor" id="buscaValor">
                    <option value="">Listar todos</option>
                    @foreach ($listaReceitasEDespesas as $dados)
                    <option value="{{ $dados->valorreceita }}">{{ $dados->valorreceita }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Conta</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaConta" name="buscaConta" id="buscaConta">
                    <option value="">Listar todos</option>
                    @foreach ($listaContas as $dados)
                    <option value="{{ $dados->apelidoConta }}">{{ $dados->apelidoConta }}</option>
                    @endforeach
                </select>
            </div>

            <div class="group-row">
                
                <label for="" class="col-sm-1">Período</label>
                <i for="daterange" class="fa fa-calendar-alt fa-2x pt-2" style="color:green;" aria-hidden="true"></i>
                <i class="fas fa-arrows-alt-h"></i>             
                <i for="daterange" class="fa fa-calendar-alt fa-2x pt-2 pr-2" style="color:red;" aria-hidden="true"></i>

                <input type="text" class="col-sm-3 daterange" style="padding-left:50px;"  name="daterange" id="daterange">
                <input type="hidden" class="col-sm-2 buscaDataInicio" name="buscaDataInicio" id="buscaDataInicio">
                <input type="hidden" class="col-sm-2 buscaDataFim" name="buscaDataFim" id="buscaDataFim">
                <input class="btn btn-primary ml-2 pesquisar" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">                
            </div>
        </div>
        <hr>
    </div>
    <br>
