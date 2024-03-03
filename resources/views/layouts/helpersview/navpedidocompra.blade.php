<?php use App\Providers\AppServiceProvider;
?>

@can('pedidocompra-list')
    <li class="nav-item dropdown">

        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>


            @can('pedidocompra-revisao')
                @if (AppServiceProvider::pegaCountPedidoAguardandoFinalizacao()[0]->aguardfinalizacao > 0)
                    <span class="badge badge-warning mt-0"
                        style="font-size: 12; background-color:#7731b7 !important; color:white;">F 
                        {{ AppServiceProvider::pegaCountPedidoAguardandoFinalizacao()[0]->aguardfinalizacao }}
                    </span>
                @endif
            @endcan

            @can('pedidocompra-analise')
                @if (AppServiceProvider::pegaCountPedidoAguardandoAprovacaoAvaliador()[0]->aguardaprov > 0)
                    <span class="badge badge-warning mt-0"
                        style="font-size: 12; background-color:#7731b7 !important; color:white;"> 
                            A
                            {{ AppServiceProvider::pegaCountPedidoAguardandoAprovacaoAvaliador()[0]->aguardaprov }}
                        </span>
                @endif
                @if (AppServiceProvider::pegaCountPedidoAguardandoCompraAvaliador()[0]->aguardcompra > 0)
                    <span class="badge badge-warning mt-0"
                        style="font-size: 12; background-color:#7731b7 !important; color:white;"> 
                            C
                            {{ AppServiceProvider::pegaCountPedidoAguardandoCompraAvaliador()[0]->aguardcompra }}
                        </span>
                @endif
            @endcan

            @can('pedidocompra-expedicao')

                @if (AppServiceProvider::pegaCountPedidoAguardandoExpedicao()[0]->aguardexpedicao > 0)
                    <span class="badge badge-warning mt-0"
                        style="font-size: 12; background-color:#7731b7 !important; color:white;"> 
                            E
                            {{ AppServiceProvider::pegaCountPedidoAguardandoExpedicao()[0]->aguardexpedicao }}
                        </span>
                @endif
            @endcan

            @can('pedidocompra-list')
                @if (AppServiceProvider::pegaCountPedidoNaoAprovado(Auth::id())[0]->countpedidonaoaprovado > 0)
                    <span class="badge badge-danger"
                        style="font-size: 12;">{{ AppServiceProvider::pegaCountPedidoNaoAprovado(Auth::id())[0]->countpedidonaoaprovado }}
                    </span>
                @endif
                @if (AppServiceProvider::pegaCountPedidoAguardandoAprovacao(Auth::id())[0]->aguardaprov > 0)
                    <span class="badge badge-warning"
                        style="font-size: 12;">{{ AppServiceProvider::pegaCountPedidoAguardandoAprovacao(Auth::id())[0]->aguardaprov }}
                    </span>
                @endif
                @if (AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado > 0)
                    <span class="badge badge-success"
                        style="font-size: 12;">A{{ AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado }}
                    </span>
                @endif
                @if (AppServiceProvider::pegaCountPedidoFinalizado(Auth::id())[0]->countpedidofinalizado > 0)
                    <span class="badge badge-success"
                        style="font-size: 12;">F{{ AppServiceProvider::pegaCountPedidoFinalizado(Auth::id())[0]->countpedidofinalizado }}
                    </span>
                @endif
            @endcan
            Pedido Compra
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            @can('pedidocompra-create')
            <a class="dropdown-item" href="{{ route('pedidocompra.create') }}">
                <i class="fa fa-plus" aria-hidden="true"></i>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                &nbsp;Novo Pedido</a>

            <label style="background-color:black;" class="col-sm-12 text-white">Meus pedidos:</label>
                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=0&notificado=1">
                    <span class="badge badge-danger" style="font-size: 20;">
                        {{ AppServiceProvider::pegaCountPedidoNaoAprovado(Auth::id())[0]->countpedidonaoaprovado }}
                    </span> pedido(s) não aprovado(s)
                </a>

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=3&notificado=1">
                    <span class="badge badge-warning" style="font-size: 20;">
                        {{ AppServiceProvider::pegaCountPedidoAguardandoAprovacao(Auth::id())[0]->aguardaprov }}
                    </span>
                    pedido(s) aguardando aprovação
                </a>

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=1&notificado=1">
                    <span class="badge badge-success" style="font-size: 20;">
                        {{ AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado }}
                    </span>
                    pedido(s) aprovado(s)
                </a>

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=4&notificado=1">
                    <span class="badge badge-success" style="font-size: 20;">
                        {{ AppServiceProvider::pegaCountPedidoFinalizado(Auth::id())[0]->countpedidofinalizado }}
                    </span>
                    pedido(s) finalizado(s)
                </a>
            @endcan

            <a class="dropdown-item" href="{{ route('pedidocompra.index') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Meus Pedidos
            </a>

            @can('pedidocompra-analise')
                <hr>
                <label style="background-color:black;" class="col-sm-12 text-white">PEDIDOS GERAIS:</label>

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=7&notificado=1&listarTodos=true">
                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;
                    Avaliador - 
                    <span class="badge badge-warning mt-0" style="font-size: 20; background-color:#7731b7 !important; color:white;">
                        {{ AppServiceProvider::pegaCountPedidoAguardandoCompraAvaliador()[0]->aguardcompra }}</span>
                    pedido(s) para Comprar
                </a>

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=3&notificado=1&listarTodos=true">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;
                    Avaliador - 
                    <span class="badge badge-warning mt-0" style="font-size: 20; background-color:#7731b7 !important; color:white;">
                        {{ AppServiceProvider::pegaCountPedidoAguardandoAprovacaoAvaliador()[0]->aguardaprov }}</span>
                    pedido(s) para aprovar
                </a>
            @endcan
            @can('pedidocompra-expedicao')

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=6&listarTodos=true">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>&nbsp;
                    EXPEDIÇÃO - 
                    <span class="badge badge-warning mt-0" style="font-size: 20; background-color:#7731b7 !important; color:white;">
                        {{ AppServiceProvider::pegaCountPedidoAguardandoExpedicao()[0]->aguardexpedicao }}</span>
                    pedido(s) para validar
                </a>
            @endcan
            @can('pedidocompra-revisao')

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=1&listarTodos=true">
                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                    FINALIZAÇÃO - 
                    <span class="badge badge-warning mt-0" style="font-size: 20; background-color:#7731b7 !important; color:white;">
                        {{ AppServiceProvider::pegaCountPedidoAguardandoFinalizacao()[0]->aguardfinalizacao }}</span>
                    pedido(s) para finalizar
                </a>
            @endcan
            @can('pedidocompra-analise')
                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?listarTodos=true"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Listar Todos</a>
            @endcan


        </div>
    </li>
@endcan
