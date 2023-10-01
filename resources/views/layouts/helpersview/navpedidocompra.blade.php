<?php use App\Providers\AppServiceProvider;
?>

@can('pedidocompra-list')
    <li class="nav-item dropdown">

        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>

            @can('pedidocompra-analise')
                @if (AppServiceProvider::pegaCountPedidoAguardandoAprovacaoAvaliador()[0]->aguardaprov > 0)
                    <span class="badge badge-warning mt-0"
                        style="font-size: 12; background-color:#7731b7 !important; color:white;">
                        {{ AppServiceProvider::pegaCountPedidoAguardandoAprovacaoAvaliador()[0]->aguardaprov }}
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
                        style="font-size: 12;">{{ AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado }}
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
            @endcan

            <a class="dropdown-item" href="{{ route('pedidocompra.index') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Meus Pedidos
            </a>

            @can('pedidocompra-analise')
                <hr>
                <label style="background-color:black;" class="col-sm-12 text-white">PEDIDOS GERAIS:</label>

                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=3&notificado=1&listarTodos=true">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;
                    Avaliador - 
                    <span class="badge badge-warning mt-0" style="font-size: 20; background-color:#7731b7 !important; color:white;">
                        {{ AppServiceProvider::pegaCountPedidoAguardandoAprovacaoAvaliador()[0]->aguardaprov }}</span>
                    pedido(s) para aprovar
                </a>
                <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?listarTodos=true"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Listar Todos</a>

            @endcan
        </div>
    </li>
@endcan
