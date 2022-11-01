<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                    <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Bem Patrimonial</label>
                <select class="selecionaComInput form-control col-sm-3 js-example-basic-multiple buscanomeBensPatrimoniais" name="nomeBensPatrimoniais" id="nomeBensPatrimoniais">
                    <option value="">Listar todos</option>
                    @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                    <option value="{{ $bensPatrimoniais->nomeBensPatrimoniais }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-2 pr-0">Id Tipo Bem Patrimonial</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaidTipoBensPatrimoniais" name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais">
                    <option value="">Listar todos</option>
                    @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                    <option value="{{ $bensPatrimoniais->idTipoBensPatrimoniais }}">{{ $bensPatrimoniais->idTipoBensPatrimoniais }}</option>
                    @endforeach
                </select>


            </div>
            <div class="group-row">
                <label for="" class="col-sm-1">Descrição</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscadescricaoBensPatrimoniais" name="descricaoBensPatrimoniais" id="descricaoBensPatrimoniais">
                    <option value="">Listar todos</option>
                    @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                    <option value="{{ $bensPatrimoniais->descricaoBensPatrimoniais }}">{{ $bensPatrimoniais->descricaoBensPatrimoniais }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Status</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscastatusbenspatrimoniais" name="statusbenspatrimoniais" id="statusbenspatrimoniais">
                    <option value="">Listar todos</option>
                    @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                    <option value="{{ $bensPatrimoniais->statusbenspatrimoniais }}">{{ $bensPatrimoniais->statusbenspatrimoniais }}</option>
                    @endforeach
                </select>
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div>
        </div>
        <hr>
    </div>
    <br>
