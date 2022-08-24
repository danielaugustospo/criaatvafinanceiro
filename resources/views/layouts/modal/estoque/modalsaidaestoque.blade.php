<div class="modal fade bd-example-modal-lg modalsaidasestoque" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- modal content --}}
            <form action="saidas" id="formFiltraDespesa" method="get">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="modal-header">
                            <label for="">Selecione a baixa do estoque</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-6">
                                <div class="modal-body">
                                    <div class="row ml-2 mr-2">
                                        <label for="">Id Saída</label>
                                        <input class="form-control" list="datalistIdSaidaEstoque" id="id"
                                            name="id" placeholder="Digite ou selecione...">
                                    </div>
                                    <hr>
                                    <div class="row ml-2 mr-2">
                                        <label for="">Cód Barras</label>
                                        <input class="form-control" list="datalistCodBarras" id="codbarras"
                                            name="codbarras" placeholder="Digite ou selecione...">

                                    </div>
                                    <div class="row ml-2 mr-2">
                                        <label for="">Portador</label>
                                        <input class="form-control" list="datalistPortador" id="portador"
                                            name="portador" placeholder="Digite ou selecione...">
                                    </div>
                                    <div class="row ml-2 mr-2">
                                        <label for="">Data da Retirada</label>
                                        <div class="row  ml-1 mr-2">
                                        <input class="form-control col-sm-5 mr-1" type="date"
                                        name="dataretiradainicial" id="dataretiradainicial">
                                        <input class="form-control col-sm-5" type="date" name="dataretiradafinal"
                                        id="dataretiradafinal">

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-4 col-sm-6">
                                {{-- Segunda Coluna --}}
                                <div class="row mt-2 ml-2 mr-2">
                                    <label for="">Material</label>
                                    <input class="form-control" list="datalistMaterial" id="nomeBensPatrimoniais"
                                        name="nomeBensPatrimoniais" placeholder="Digite ou selecione...">
                                </div>
                                <div class="row ml-2 mr-2">
                                    <label for="">Descrição</label>
                                    <input class="form-control" list="datalistDescricao" id="descricaosaida"
                                        name="descricaosaida" placeholder="Digite ou selecione...">

                                </div>
                                <div class="row ml-2 mr-2">
                                    <label for="">OS</label>
                                    <input class="form-control" list="datalistOS" id="ordemdeservico"
                                        name="ordemdeservico" placeholder="Digite ou selecione...">
                                </div>
                                <div class="row ml-2 mr-2 mt-1">
                                    <label class="pr-2 mt-1" for="">Data Para Retorno</label>
                                    <div class="row ml-2 mr-2">

                                    <input class="form-control col-sm-4 mr-1" type="date"
                                        name="datapararetornoinicial" id="datapararetornoinicial">
                                    <input class="form-control col-sm-4" type="date" name="datapararetornofinal"
                                        id="datapararetornofinal">
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- footer --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" id="buscarDespesa" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<datalist id="datalistIdSaidaEstoque">
    @foreach ($listaSaidas as $saidas)
        <option value="{{ $saidas->id }}">{{ $saidas->id }}
        </option>
    @endforeach
</datalist>
<datalist id="datalistCodBarras">
    @foreach ($listaSaidas as $saidas)
        <option value="{{ $saidas->codbarras }}">{{ $saidas->codbarras }}
        </option>
    @endforeach
</datalist>
<datalist id="datalistPortador">
    @foreach ($listaSaidas as $saidas)
        <option value="{{ $saidas->portador }}">{{ $saidas->portador }}
        </option>
    @endforeach
</datalist>
<datalist id="datalistMaterial">
    @foreach ($listaSaidas as $saidas)
        <option value="{{ $saidas->nomeBensPatrimoniais }}">{{ $saidas->nomeBensPatrimoniais }}
        </option>
    @endforeach
</datalist>
<datalist id="datalistDescricao">
    @foreach ($listaSaidas as $saidas)
        <option value="{{ $saidas->descricaosaida }}">{{ $saidas->descricaosaida }}
        </option>
    @endforeach
</datalist>
<datalist id="datalistOS">
    @foreach ($listaSaidas as $saidas)
        <option value="{{ $saidas->ordemdeservico }}">{{ $saidas->ordemdeservico }}
        </option>
    @endforeach
</datalist>