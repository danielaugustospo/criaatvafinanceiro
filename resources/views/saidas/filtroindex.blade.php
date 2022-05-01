<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">N° Saída (Id)</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaIdDespesa" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaSaidas as $saidas)
                    <option value="{{ $saidas->id }}">{{ $saidas->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">Nome da Saída</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscanomesaida" name="nomesaida" id="nomesaida">
                    <option value="">Listar todos</option>
                    @foreach ($listaSaidas as $saidas)
                    <option value="{{ $saidas->nomesaida }}">{{ $saidas->nomesaida }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Descrição da Saída</label>
                {{-- <input type="text" name="precoReal" class="col-sm-2 form-control buscaPrecoReal" placeholder="Preço Real"> --}}
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscadescricaosaida" name="descricaosaida" id="descricaosaida">
                    <option value="">Listar todos</option>
                    @foreach ($listaSaidas as $saidas)
                    <option value="{{ $saidas->descricaosaida }}">{{ $saidas->descricaosaida }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">Id Bem Patrimonial</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaidbenspatrimoniais" name="idbenspatrimoniais" id="idbenspatrimoniais">
                    <option value="">Listar todos</option>
                    @foreach ($listaSaidas as $saidas)
                    <option value="{{ $saidas->idbenspatrimoniais }}">{{ $saidas->idbenspatrimoniais }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-1">Portador Saída</label>
                {{-- <input type="text" name="nRegistro" class="col-sm-2 form-control buscaNRegistro" placeholder="Registro"> --}}
                <select class="selecionaComInput form-control col-sm-8 js-example-basic-multiple buscaportadorsaida" name="portadorsaida" id="portadorsaida">
                    <option value="">Listar todos</option>
                    @foreach ($listaSaidas as $saidas)
                    <option value="{{ $saidas->portadorsaida }}">{{ $saidas->portadorsaida }}</option>
                    @endforeach
                </select>
                <label for="datapararetiradasaida" class="col-sm-1">Data Para Retirada</label><input type="date" name="datapararetiradasaida"       class="col-sm-2 form-control buscadatapararetiradasaida" placeholder="Data Agendada para Saída">
                <label for="dataretiradasaida" class="col-sm-1">Data da Retirada</label><input type="date"   name="dataretiradasaida"               class="col-sm-2 form-control buscadataretiradasaida" placeholder="Data da Saída">
                <label for="dataretornoretiradasaida" class="col-sm-1">Data Retorno</label><input type="date"       name="dataretornoretiradasaida" class="col-sm-2 form-control buscadataretornoretiradasaida" placeholder="Data Retorno">

            </div>
            <div class="row mt-3">
                <label for="" class="col-sm-1">Ocorrência</label>
                {{-- <input type="text" name="idOS" class="col-sm-2 form-control buscaIdOS" placeholder="N° da OS"> --}}
                <select class="selecionaComInput form-control col-sm-8 js-example-basic-multiple buscaocorrenciasaida" name="ocorrenciasaida" id="ocorrenciasaida">
                    <option value="">Listar todos</option>
                    @foreach ($listaSaidas as $saidas)
                    <option value="{{ $saidas->ocorrenciasaida }}">{{ $saidas->ocorrenciasaida }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
