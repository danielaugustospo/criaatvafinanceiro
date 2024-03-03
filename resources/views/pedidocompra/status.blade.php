<h2 class="text-center"> Status do Pedido <b>{{ $pedido->id }}</b></h2>
<div class="container d-flex justify-content-center align-items-center">

    <div class="progresses row  d-flex justify-content-center align-items-center">
        @if ($pedido->ped_aprovado == '0')
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div class="steps-error">
                <span class="font-weight-bold">2</span>
            </div>
            <span class="line-error">Reprovado</span>

            <div class="steps-error">
                <span class="font-weight-bold">x</span>
            </div>
            {{-- <span class="line-warning">Finalização</span>

            <div class="steps-warning">
                <span><i class="fa fa-check"></i></span>
            </div> --}}
        @elseif ($pedido->ped_aprovado == '1')
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div class="steps-success">
                <span class="font-weight-bold">2</span>
            </div>
            <span class="line-success">Aprovado</span>

            <div class="steps-warning">
                <span class="font-weight-bold">3</span>
            </div>
            <span class="line-warning">Aguardando Finalização</span>

            <div class="steps-warning">
                <span><i class="fa fa-check"></i></span>
            </div>
        @elseif (($pedido->ped_aprovado == '3') || ($pedido->ped_aprovado == '6') || ($pedido->ped_aprovado == '7'))
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div                 
                @if($pedido->ped_aprovado == '7') class="steps-warning-orange"  
                @elseif($pedido->ped_aprovado == '6') class="steps-warning"  
                @elseif($pedido->ped_aprovado == '3') class="steps-warning-lime" 
                @endif >
                <span class="font-weight-bold">2</span>
            </div>
            
            <span 
                @if($pedido->ped_aprovado == '7') class="line-warning-orange"  
                @elseif($pedido->ped_aprovado == '6') class="line-warning"  
                @elseif($pedido->ped_aprovado == '3') class="line-warning-lime" 
                @endif 
            >

                @if($pedido->ped_aprovado == '7') {{ 'Aguardando Compra' }}   
                @elseif($pedido->ped_aprovado == '6') {{ 'Aguardando Expedição' }}   
                @elseif($pedido->ped_aprovado == '3') {{ 'Aguardando Aprovação' }}   
                @endif
            </span>

            <div class="steps-warning">
                <span class="font-weight-bold">3</span>
            </div>
            <span class="line-warning">Aguardando Finalização</span>

            <div class="steps-warning">
                <span><i class="fa fa-check"></i></span>
            </div>
        @elseif ($pedido->ped_aprovado == '4')
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div class="steps-success">
                <span class="font-weight-bold">2</span>
            </div>
            <span class="line-success">Aprovado</span>

            <div class="steps-success">
                <span class="font-weight-bold">3</span>
            </div>
            <span class="line-success">Finalizado</span>

            <div class="steps-success">
                <span><i class="fa fa-check"></i></span>
            </div>
        @elseif ($pedido->ped_aprovado == '5')
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div class="steps-error">
                <span class="font-weight-bold">2</span>
            </div>
            <span class="line-error">Cancelado</span>

            <div class="steps-error">
                <span class="font-weight-bold">x</span>
            </div>
        @endif

    </div>
</div>
