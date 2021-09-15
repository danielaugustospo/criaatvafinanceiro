<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Data Emissão</label>
                <input type="date" class="form-control col-sm-2 emissao" name="emissao" id="emissao">

                <label for="" class="col-sm-2">Nota/Recibo</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple nfrecibo" name="nfrecibo" id="nfrecibo">
                    <option value="">Listar todos</option>
                    @foreach ($consultaNotasRecibosProvider as $notaReciboProvider)
                    <option value="{{ $notaReciboProvider->nfRecibo }}">{{ $notaReciboProvider->nfRecibo }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">OS</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple OS" name="OS" id="OS">
                    <option value="">Listar todos</option>
                    @foreach ($consultaNotasRecibosProvider as $notaReciboProvider)
                    <option value="{{ $notaReciboProvider->OS }}">{{ $notaReciboProvider->OS }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">Valor nf/Recibo</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple valorNfRecibo" name="valorNfRecibo" id="valorNfRecibo">
                    <option value="">Listar todos</option>
                    @foreach ($consultaNotasRecibosProvider as $notaReciboProvider)
                    <option value="{{ $notaReciboProvider->Valor }}">{{ $notaReciboProvider->Valor }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-2">Alíquota</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple aliquota" name="aliquota" id="aliquota">
                    <option value="">Listar todos</option>
                    @foreach ($consultaNotasRecibosProvider as $notaReciboProvider)
                    <option value="{{ $notaReciboProvider->aliquota }}">{{ $notaReciboProvider->aliquota }}</option>
                    @endforeach
                </select>

                {{-- <label for="" class="col-sm-1">Tipo Alíquota</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaidaliquota" name="idaliquota" id="idaliquota">
                    <option value="">Listar todos</option>
                    @foreach ($consultaNotasRecibosProvider as $notaReciboProvider)
                    <option value="{{ $notaReciboProvider->idaliquota }}">{{ $notaReciboProvider->idaliquota }}</option>
                    @endforeach
                </select> --}}
                
                <label for="" class="col-sm-1">Valor Imposto</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple imposto" name="imposto" id="imposto">
                    <option value="">Listar todos</option>
                    @foreach ($consultaNotasRecibosProvider as $notaReciboProvider)
                    <option value="{{ $notaReciboProvider->imposto }}">{{ $notaReciboProvider->imposto }}</option>
                    @endforeach
                </select>


            </div>
            <div class="row mt-3">


                <label for="" class="col-sm-2">Data Recebimento</label>
                <input type="date" class="form-control col-sm-2 datapagamentoreceita" name="datapagamentoreceita" id="datapagamentoreceita">

                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
