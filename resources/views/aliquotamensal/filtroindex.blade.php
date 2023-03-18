<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">Conta</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple idconta" name="idconta" id="idconta">
                    <option value="">Listar todos</option>
                    @foreach ($listaContas as $contaProvider)
                        <option value="{{ $contaProvider->id }}">{{ $contaProvider->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Mês</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple mes" name="mes" id="mes">
                    <option value="">Listar todos</option>
                    @foreach ($consultaAliquotasProvider as $aliquotaProvider)
                        <option value="{{ $aliquotaProvider->mes }}">{{ $aliquotaProvider->mes }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2 pr-0">DAS/SEM FATOR</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple dasSemFatorR" name="dasSemFatorR" id="dasSemFatorR">
                    <option value="">Listar todos</option>
                    @foreach ($consultaAliquotasProvider as $aliquotaProvider)
                    <option value="{{ $aliquotaProvider->dasSemFatorR }}">{{ $aliquotaProvider->dasSemFatorR }}</option>
                    @endforeach
                </select>
            </div>

            <div class="group-row">
                <label for="" class="col-sm-1">ISS SEM FATOR</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple issSemFatorR" name="issSemFatorR" id="issSemFatorR">
                    <option value="">Listar todos</option>
                    @foreach ($consultaAliquotasProvider as $aliquotaProvider)
                    <option value="{{ $aliquotaProvider->issSemFatorR }}">{{ $aliquotaProvider->issSemFatorR }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">RECIBO SEM FATOR</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple reciboSemFatorR" name="reciboSemFatorR" id="reciboSemFatorR">
                    <option value="">Listar todos</option>
                    @foreach ($consultaAliquotasProvider as $aliquotaProvider)
                    <option value="{{ $aliquotaProvider->reciboSemFatorR }}">{{ $aliquotaProvider->reciboSemFatorR }}</option>
                    @endforeach
                </select>

            </div>
            <div class="group-row">
                <label for="" class="col-sm-1">DAS COM FATOR</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple dasComFatorR" name="dasComFatorR" id="dasComFatorR">
                    <option value="">Listar todos</option>
                    @foreach ($consultaAliquotasProvider as $aliquotaProvider)
                    <option value="{{ $aliquotaProvider->dasComFatorR }}">{{ $aliquotaProvider->dasComFatorR }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">ISS COM FATOR</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple issComFatorR" name="issComFatorR" id="issComFatorR">
                    <option value="">Listar todos</option>
                    @foreach ($consultaAliquotasProvider as $aliquotaProvider)
                    <option value="{{ $aliquotaProvider->issComFatorR }}">{{ $aliquotaProvider->issComFatorR }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">RECIBO COM FATOR</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple reciboComFatorR" name="reciboComFatorR" id="reciboComFatorR">
                    <option value="">Listar todos</option>
                    @foreach ($consultaAliquotasProvider as $aliquotaProvider)
                    <option value="{{ $aliquotaProvider->reciboComFatorR }}">{{ $aliquotaProvider->reciboComFatorR }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div>
        </div>
        <hr>
    </div>
    <br>
