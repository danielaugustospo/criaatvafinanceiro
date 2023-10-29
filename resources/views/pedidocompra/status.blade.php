<h2 class="text-center"> Status do Pedido </h2>
<div class="container d-flex justify-content-center align-items-center">

    <div class="progresses">
        @if ($pedido->ped_aprovado == '0')
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div class="steps-success">
                <span class="font-weight-bold">2</span>
            </div>
            <span class="line-error">Reprovado</span>

            <div class="steps-error">
                <span class="font-weight-bold">3</span>
            </div>
            <span class="line-warning">Revisão</span>

            <div class="steps-warning">
                <span><i class="fa fa-check"></i></span>
            </div>
        @elseif ($pedido->ped_aprovado == '1')
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
            <span class="line-warning">Aguardando Revisão</span>

            <div class="steps-warning">
                <span><i class="fa fa-check"></i></span>
            </div>
        @elseif ($pedido->ped_aprovado == '3')
            <div class="steps-success">
                <span class="font-weight-bold">1</span>
            </div>
            <span class="line-success text-center">Solicitado</span>

            <div class="steps-success">
                <span class="font-weight-bold">2</span>
            </div>
            <span class="line-warning">Aguardando Aprovação</span>

            <div class="steps-warning">
                <span class="font-weight-bold">3</span>
            </div>
            <span class="line-warning">Aguardando Revisão</span>

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
            <span class="line-success">Revisado</span>

            <div class="steps-success">
                <span><i class="fa fa-check"></i></span>
            </div>
        @endif

    </div>
</div>
