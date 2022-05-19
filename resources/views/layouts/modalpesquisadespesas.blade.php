  <!-- Modal -->
  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content"> --}}
  <div class="modal fade bd-example-modal-lg modaldepesas" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              {{-- modal content --}}
              <form action="{{ route('displaydespesas') }}" id="formFiltraDespesa" method="get">
                  @csrf
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="modal-header">
                              <label for="">Selecione a despesa</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="row">
                              <div class="col-8 col-sm-6">
                                  <div class="modal-body">
                                      <div class="row ml-2 mr-2">
                                          <label for="">Id Despesa</label>
                                          <input class="form-control" list="datalistId" id="id" name="id"
                                              placeholder="Digite ou selecione...">
                                      </div>
                                      <hr>
                                      <div class="row ml-2 mr-2">
                                          <label for="">Descrição</label>
                                          <input class="form-control" list="datalistDescricao" id="despesas"
                                              name="despesas" placeholder="Digite ou selecione...">

                                      </div>
                                      <div class="row ml-2 mr-2">
                                          <label for="">Valor</label>
                                          <input type="text" class='campo-moeda form-control' name="valor"
                                              id="precoReal" maxlength='100'>
                                          {{-- {!! Form::text('valor', null, ['class' => 'campo-moeda form-control', 'maxlength' => '100', 'id' => 'precoReal']) !!} --}}

                                      </div>

                                      <div class="row ml-2 mr-2"><label for="">Cód Despesa</label>
                                          <input class="form-control" list="datalistCodDespesa" id="coddespesa"
                                              name="coddespesa" placeholder="Digite ou selecione...">
                                      </div>

                                      <div class="row ml-2 mr-2"><label for="">ORDEM DE SERVIÇO </label>
                                          <input class="form-control" list="datalistOrdemServico" id="ordemservico"
                                              name="ordemservico" placeholder="Digite ou selecione...">
                                      </div>

                                  </div>


                              </div>
                              <div class="col-4 col-sm-6">
                                  {{-- Segunda Coluna --}}
                                <div class="row mt-2 ml-2 mr-2">
                                    <label for="">Nota Fiscal</label>
                                    <input class="form-control" 
                                    {{-- list="datalistnotaFiscal"  --}}
                                    id="notafiscal" 
                                    name="notafiscal" placeholder="Digite ou selecione...">
                                </div>
                                <div class="row ml-2 mr-2"><label for="">Fornecedor </label>
                                    <input class="form-control" list="datalistFornecedor" id="fornecedor"
                                        name="fornecedor" placeholder="Digite ou selecione...">
                                </div>
                                <div class="row ml-2 mr-2"><label for="">Cliente </label>
                                    <input class="form-control" list="datalistCliente" id="cliente"
                                        name="cliente" placeholder="Digite ou selecione...">
                                </div>
                                <div class="row ml-2 mr-2"><label for="">Fixa ou Variável </label>
                                    <select class="form-control" name="fixavariavel" id="fixavariavel">
                                        <option></option>
                                        <option value="0">VARIÁVEL</option>
                                        <option value="1">FIXA</option>
                                    </select>       
                                </div>
                                <div class="row ml-2 mr-2 mt-1">
                                    <label class="pr-2 mt-1" for="">Venc. </label>

                                    <input class="form-control col-sm-5 mr-1" type="date" name="dtinicio"
                                        id="dtinicio">
                                    <input class="form-control col-sm-5" type="date" name="dtfim" id="dtfim">

                                </div>
                                <div class="row ml-2 mr-2"><label for="">Pago </label>

                                    <select class="form-control" name="pago" id="pago">
                                            <option></option>
                                            <option value="N">NÃO PAGO</option>
                                            <option value="S">PAGO</option>
                                    </select>    
                                </div>
                                <div class="row ml-2 mr-2"><label for="">CONTA </label>
                                    <input class="form-control" list="datalistContas" id="conta" name="conta"
                                        placeholder="Digite ou selecione...">
                                </div>
                                <input type="hidden" name="tpRel" id="tpRel" value="">
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

  <datalist id="datalistId">
      @foreach ($listaDespesas as $despesas)
          <option value="{{ $despesas->id }}">{{ $despesas->id }}
          </option>
      @endforeach
  </datalist>
  
  <datalist id="datalistDescricao">
      @foreach ($listaDespesas as $despesas)
          <option value="{{ $despesas->descricaoDespesa }}">{{ $despesas->descricaoDespesa }}
          </option>
      @endforeach
  </datalist>

  <datalist id="datalistOrdemServico">
      @foreach ($pegaidOS as $ordemdeservico)
          <option value="{{ $ordemdeservico->id }}">{{ $ordemdeservico->id }}
          </option>
      @endforeach
  </datalist>

  <datalist id="datalistFornecedor">
      @foreach ($listaFornecedores as $fornecedores)
          <option value="{{ $fornecedores->razaosocialFornecedor }}">{{ $fornecedores->razaosocialFornecedor }}
          </option>
      @endforeach
  </datalist>

  <datalist id="datalistCodDespesa">
      @foreach ($listaCodigoDespesa as $coddespesa)
          <option value="{{ $coddespesa->despesaCodigoDespesa }}">{{ $coddespesa->despesaCodigoDespesa }}
          </option>
      @endforeach
  </datalist>
  <datalist id="datalistContas">
      @foreach ($listaContas as $conta)
          <option value="{{ $conta->apelidoConta }}">{{ $conta->nomeConta }} - {{ $conta->apelidoConta }}
          </option>
      @endforeach
  </datalist>
  {{-- <datalist id="datalistNotaFiscal">
      @foreach ($listaDespesas as $despesas)
          <option value="{{ $despesas->notaFiscal }}">{{ $despesas->notaFiscal }}</option>
      @endforeach
  </datalist> --}}
  <datalist id="datalistCliente">
      @foreach ($listaClientes as $cliente)
          <option value="{{ $cliente->id }}">{{ $cliente->razaosocialCliente }}</option>
      @endforeach
  </datalist>

