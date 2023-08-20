<div class="modal fade bd-example-modal-lg modalentradasestoque" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- modal content --}}
            <form action="entradas" id="formFiltraDespesa" method="get">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="modal-header">
                            <label for="">Selecione a entrada no estoque</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-8 col-sm-6">
                                <div class="modal-body">
                                    <div class="row ml-2 mr-2">
                                        <label for="">Id Entrada</label>
                                        <input class="form-control" list="datalistIdEntradaEstoque" id="id"
                                            name="id" placeholder="Digite ou selecione...">
                                    </div>
                                    <hr>
                                    <div class="row ml-2 mr-2">
                                        <label for="">Cód Barras</label>
                                        <input class="form-control" list="datalistCodBarras" id="codbarras"
                                            name="codbarras" placeholder="Digite ou selecione...">

                                    </div>

                                </div>


                            </div>
                            <div class="col-4 col-sm-6">
                                {{-- Segunda Coluna --}}
                                <div class="row mt-2 ml-2 mr-2">
                                    <label for="">Material</label>
                                    <input class="form-control" list="datalistMaterial" id="nomeBensPatrimoniais" name="nomeBensPatrimoniais"
                                        placeholder="Digite ou selecione...">
                                </div>
                                <div class="row ml-2 mr-2">
                                    <label for="">Descrição</label>
                                    <input class="form-control" list="datalistDescricao" id="descricaoentrada"
                                        name="descricaoentrada" placeholder="Digite ou selecione...">

                                </div>
                                <div class="row ml-2 mr-2 mt-1">
                                    <label class="pr-2 mt-1" for="">Entrada</label>

                                    <input class="form-control col-sm-5 mr-1" type="date" name="dtinicio"
                                        id="dtinicio">
                                    <input class="form-control col-sm-5" type="date" name="dtfim" id="dtfim">

                                </div>
                            </div>


                        </div>
                        <div class="row ml-2 mr-2 mt-1">
                            <label for="ocorrenciadevolucao" class="col-sm-2 col-form-label">TIPO DE ENTRADA</label>
                            <select class="selecionaComInput form-control" name="tipoEntrada" id="tipoEntrada">
                                <option value="">NENHUMA</option>
                                <option value="NOVO">NOVO</option>
                                <option value="DEVOLUÇÃO">DEVOLUÇÃO</option>
                            </select>
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

<datalist id="datalistIdEntradaEstoque">
    @foreach ($listaEntradas as $entradas)
        <option value="{{ $entradas->id }}">{{ $entradas->id }}
        </option>
    @endforeach
</datalist>
<datalist id="datalistCodBarras">
    @php $codbarrasArray = []; @endphp
    @foreach ($listaEntradas as $entradas)
        @if (!in_array($entradas->codbarras, $codbarrasArray))
            <option value="{{ $entradas->codbarras }}">{{ $entradas->codbarras }}</option>
            @php
                $codbarrasArray[] = $entradas->codbarras;
            @endphp
        @endif
    @endforeach
</datalist>
<datalist id="datalistMaterial">
    @foreach ($listaEntradas as $entradas)
        <option value="{{ $entradas->nomeBensPatrimoniais }}">{{ $entradas->nomeBensPatrimoniais }}
        </option>
    @endforeach
</datalist>
<datalist id="datalistDescricao">
    @foreach ($listaEntradas as $entradas)
        <option value="{{ $entradas->descricaoentrada }}">{{ $entradas->descricaoentrada }}
        </option>
    @endforeach
</datalist>