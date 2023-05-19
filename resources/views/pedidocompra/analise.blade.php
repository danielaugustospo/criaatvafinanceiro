<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modalPedidoCompra">
    <i class="fa fa-check" aria-hidden="true"></i><i class="fa fa-ban" aria-hidden="true"></i> Análise
</button>

<div class="modal fade" id="modalPedidoCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">



            {!! Form::model($pedido, ['method' => 'POST','route' => ['retornoanalisepedido', $pedido->id]]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Avaliação do pedido n°{{ $pedido->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $pedido->id }}">
                <div style="background-color: rgb(0, 0, 0);" class="p-2">
                    <div class="row mt-5 mb-2">
                        <label class="col-sm-3 mr-2 mt-2" for="" style="color: white;">Aprovado</label>
  
                        <select class="col-sm-5 form-control" name="ped_aprovado" id="statuspedido" required>
                            <option>Selecione...</option>
                            <option @if($pedido->ped_aprovado == '1') selected @endif value="1">SIM</option>
                            <option @if($pedido->ped_aprovado == '0') selected @endif value="0">NÃO</option>
                        </select>
                    </div>

                    <div class="row mt-2 mb-2" id="contaaprovada">
                        <label class="col-sm-3 mr-2 mt-2" for="" style="color: white;">Conta Aprovada</label>
                        {{-- {!! Form::text('ped_contaaprovada', $valorInput, ['class' => 'col-sm-5 form-control',
                        'maxlength' => '100']) !!} --}}

                    <select name="ped_contaaprovada" id="ped_contaaprovada" class="selecionaComInput form-control  js-example-basic-multiple" >
                        @foreach ($listaContas as $contas)
                        @isset($pedido->ped_contaaprovada)
                            @if ($pedido->ped_contaaprovada == $contas->id)
                            <option value="{{ $contas->id }}" selected>{{ $contas->apelidoConta }}</option>
                            @endif
                        @endisset  
                        <option value="{{ $contas->id }}">{{ $contas->apelidoConta }}</option>
                    @endforeach
                    </select>

                    </div>

                    <div class="row mt-2 mb-2" id="exigenciaaprovacao">
                        <label class="col-sm-3 mr-2 mt-2" for="" style="color: white;">Exigência Para Aprovação</label>
                        {!! Form::textarea('ped_exigaprov', $pedido->ped_exigaprov, ['class' => 'col-sm-8 form-control', 'maxlength' =>
                        '190']) !!}

                    </div>
                    <div class="row mt-2 mb-2 ">
                        <label class="col-sm-3 mr-2 mt-2" for="" style="color: white;">Observação</label>
                        {!! Form::textarea('ped_observacao', $pedido->ped_observacao, ['class' => 'col-sm-8 form-control', 'maxlength' =>
                        '150']) !!}

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

<script>

$( document ).ready(function() {
    if($( "#statuspedido" ).val() == '1') {
        $("#contaaprovada").show();
        $("#exigenciaaprovacao").hide();

    } else {
        $("#contaaprovada").hide();
        $("#exigenciaaprovacao").show();
    }
});

$( "#statuspedido" ).change(function() {
    if($( "#statuspedido" ).val() == '1') {
        $("#contaaprovada").show();
        $("#exigenciaaprovacao").hide();

    } else if($( "#statuspedido" ).val() == '0') {
        $("#contaaprovada").hide();
        $("#exigenciaaprovacao").show();
    }
});

// $("#statuspedido").click(function() {
//     if ($( "#statuspedido" ).val() = '1') {
//         $("#contaaprovada").show();
//         $("#exigenciaaprovacao").hide();

//     } else {
//         $("#contaaprovada").hide();
//         $("#exigenciaaprovacao").show();
//     }
// });
</script>