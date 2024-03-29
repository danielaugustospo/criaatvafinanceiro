@can('pedidocompra-revisao')
    <button type="button" class="btn btn-primary mr-1" style="background-color: #0d663d;" data-toggle="modal" data-target="#modalPedidoCompraRevisao">
        <i class="fa fa-check" aria-hidden="true"></i><i class="fa fa-ban" aria-hidden="true"></i> FINALIZAÇÃO
    </button>
@endcan

<div class="modal fade bd-example-modal-lg" id="modalPedidoCompraRevisao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">



            {!! Form::model($pedido, ['method' => 'POST','route' => ['revisaoanalisepedido', $pedido->id]]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">FINALIZAÇÃO do pedido n°{{ $pedido->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $pedido->id }}">
                <input type="hidden" name="ped_aprovado" id="ped_aprovado" value="{{ $pedido->ped_aprovado }}">

                <div class="row mt-2 mb-2 col-sm-12">
                    <label class="col-sm-3 mr-2 mt-2" for="" style="color: red;">Cancelar Pedido?</label>
                    <input type="checkbox" id="ped_cancelado" @if ($pedido->ped_aprovado != '5') checked @endif data-toggle="toggle" data-on="✅Pedido Ativo" data-off="✖️ Pedido Cancelado" data-onstyle="success" data-offstyle="danger" data-height="40" data-width="200" data-style="ios" >                        
                </div>
                
                <div style="background-color: rgb(0, 0, 0);" class="p-2">

                    <div class="row mt-5 mb-2 col-sm-12">
                        <label class="col-sm-3 mr-2 mt-2" for="" style="color: white;">Lançado</label>
  
                        <select class="col-sm-2 form-control" name="ped_pago" id="statuspedido" required>
                            <option disabled>Selecione...</option>
                            <option @if($pedido->ped_pago == '1') selected @endif value="1">SIM</option>
                            <option @if($pedido->ped_pago == '0') selected @endif value="0">NÃO</option>
                        </select>
                        
                    </div>
                    
                    <div class="row mt-2 mb-2 col-sm-12" id="contaaprovada">
                        <label class="col-sm-3 mr-2 mt-2" for="" style="color: white;">Conta Aprovada</label>

                    <select name="ped_contaaprovada" id="ped_contaaprovada" class="selecionaComInput form-control"  style="min-width: 150px !important;">
                        <option>Selecione...</option>
                        @foreach ($listaContas as $contas)
                            <option value="{{ $contas->id }}" @if ($pedido->ped_contaaprovada == $contas->id) selected @endif>{{ $contas->apelidoConta }} | {{ $contas->nomeConta }}</option>
                        @endforeach
                    </select> 

                    </div>

                    <div class="row mt-2 mb-2 col-sm-12">
                        <label class="col-sm-3 mr-2 mt-2" for="" style="color: white;">Observação da FINALIZAÇÃO</label>
                        {!! Form::textarea('ped_observacao_revisao', $pedido->ped_observacao_revisao, ['class' => 'col-sm-8 form-control', 'maxlength' =>
                        '190']) !!}

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
