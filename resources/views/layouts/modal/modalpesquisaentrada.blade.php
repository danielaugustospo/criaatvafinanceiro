  <div class="modal fade bd-example-modal-lg modalentrada" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              {{-- modal content --}}
              <form action="{{ route('displayentrada') }}" id="formFiltraReceita" method="get">
                  @csrf
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="modal-header">
                              <label for="">Selecione a entrada</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="row">
                              <div class="col-8 col-sm-6">
                                  <div class="modal-body">
                                      <div class="row ml-2 mr-2">
                                          <label for="">Id entrada</label>
                                          <input class="form-control" list="datalistIdReceita" id="id" name="id"
                                              placeholder="Digite ou selecione...">
                                      </div>
                                      <hr>
                                      <div class="row ml-2 mr-2">
                                          <label for="">Descrição</label>
                                          <input class="form-control" list="datalistDescricaoReceita" id="receita"
                                              name="receita" placeholder="Digite ou selecione...">

                                      </div>
                                      <div class="row ml-2 mr-2">
                                          <label for="">Valor</label>
                                          <input type="text" class='campo-moeda form-control' name="valorreceita"
                                              id="precoReal" maxlength='100'>

                                      </div>

                                      <div class="row ml-2 mr-2">
                                          <label for="">ORDEM DE SERVIÇO</label>
                                          <input class="form-control" list="datalistOrdemServico" id="ordemservico"
                                              name="ordemservico" placeholder="Digite ou selecione...">

                                      </div>

                                  </div>


                              </div>
                              <div class="col-4 col-sm-6">
                                  {{-- Segunda Coluna --}}
                                  <div class="row mt-2 ml-2 mr-2">
                                      <label for="">Nota Fiscal</label>
                                      <input class="form-control" id="nfreceita" name="nfreceita"
                                          placeholder="Digite ou selecione...">
                                  </div>

                                  <div class="row ml-2 mr-2"><label for="">Cliente </label>
                                      <input class="form-control" list="datalistCliente" id="cliente" name="cliente"
                                          placeholder="Digite ou selecione...">
                                  </div>

                                  <div class="row ml-2 mr-2 mt-1">
                                      <label class="pr-2 mt-1" for="">Venc. </label>

                                      <input class="form-control col-sm-5 mr-1" type="date" name="dtinicio"
                                          id="dtinicio">
                                      <input class="form-control col-sm-5" type="date" name="dtfim" id="dtfim">

                                  </div>
                                  <div class="row ml-2 mr-2"><label for="">Pago </label>

                                      <select class="form-control" name="pagoreceita" id="pagoreceita">
                                          <option></option>
                                          <option value="N">NÃO PAGO</option>
                                          <option value="S">PAGO</option>
                                      </select>
                                  </div>
                                  <div class="row ml-2 mr-2"><label for="">CONTA </label>
                                      <input class="form-control" list="datalistContas" id="contareceita"
                                          name="contareceita" placeholder="Digite ou selecione...">
                                  </div>
                                  <input type="hidden" name="tpRel" id="tpRel" value="">
                              </div>

                          </div>
                          {{-- footer --}}
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                              <button type="submit" id="buscarreceita" class="btn btn-primary">Buscar</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
