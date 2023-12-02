<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-2">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaEntradas as $entradas)
                    <option value="{{ $entradas->id }}">{{ $entradas->id }}</option>
                    @endforeach
                </select>
{{-- 
                <label for="" class="col-sm-2">Cod Barras</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscadescricaoentrada" name="descricaoentrada" id="descricaoentrada">
                    <option value="">Listar todos</option>
                    @foreach ($listaEntradas as $entradas)
                    <option value="{{ $entradas->codbarras }}">{{ $entradas->codbarras }}</option>
                    @endforeach
                </select> --}}

            </div>
            <div class="group-row">
                <label for="" class="col-sm-2">Quantidade</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaqtdeEntrada" name="qtdeEntrada" id="qtdeEntrada">
                    <option value="">Listar todos</option>
                    @foreach ($listaEntradas as $entradas)
                    <option value="{{ $entradas->qtdeEntrada }}">{{ $entradas->qtdeEntrada }}</option>
                    @endforeach
                </select>


                <label for="" class="col-sm-2">Material</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaidbenspatrimoniais" name="idbenspatrimoniais" id="idbenspatrimoniais">
                    <option value="">Listar todos</option>
                    @foreach ($listaEntradas as $entradas)
                    <option value="{{ $entradas->idbenspatrimoniais }}">{{ $entradas->nomeBensPatrimoniais }}</option>
                    @endforeach
                </select>
            </div>
            <div class="group-row">
                {{-- <label for="" class="col-sm-1">Valor Unitário</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscavalorunitarioentrada" name="valorunitarioentrada" id="valorunitarioentrada">
                    <option value="">Listar todos</option>
                    @foreach ($listaEntradas as $entradas)
                    <option value="{{ $entradas->valorunitarioentrada }}">{{ $entradas->valorunitarioentrada }}</option>
                    @endforeach
                </select> --}}
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">

            </div>
        </div>
        <hr>
    </div>
    <br>
