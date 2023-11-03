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
        @elseif ($pedido->ped_aprovado == '3')
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div class="steps-warning">
                <span class="font-weight-bold">2</span>
            </div>
            <span class="line-warning">Aguardando Aprovação</span>

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
