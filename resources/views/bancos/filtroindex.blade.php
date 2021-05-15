<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                {{-- <label for="" class="col-sm-2">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaid" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaBancos as $bancos)
                    <option value="{{ $bancos->id }}">{{ $bancos->id }}</option>
                    @endforeach
                </select> --}}

                <label for="" class="col-sm-2">Código do Banco</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscacodigoBanco" name="codigoBanco" id="codigoBanco">
                    <option value="">Listar todos</option>
                    @foreach ($listaBancos as $bancos)
                    <option value="{{ $bancos->codigoBanco }}">{{ $bancos->codigoBanco }}</option>
                    @endforeach
                </select>


                <label for="" class="col-sm-3">Nome Instituição Bancária</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscanomeBanco" name="nomeBanco" id="nomeBanco">
                    <option value="">Listar todos</option>
                    @foreach ($listaBancos as $bancos)
                    <option value="{{ $bancos->nomeBanco }}">{{ $bancos->nomeBanco }}</option>
                    @endforeach
                </select>

                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div>

            {{-- <div class="group-row">
                <label for="" class="col-sm-2">Código do Banco</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscacodigoBanco" name="codigoBanco" id="codigoBanco">
                    <option value="">Listar todos</option>
                    @foreach ($listaBancos as $bancos)
                    <option value="{{ $bancos->codigoBanco }}">{{ $bancos->codigoBanco }}</option>
                    @endforeach
                </select>

                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div> --}}

        </div>
        <hr>
    </div>
    <br>
