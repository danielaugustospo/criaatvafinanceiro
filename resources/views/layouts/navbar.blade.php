<?php
use  App\Providers\AppServiceProvider;

?>

<nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
    @yield('nav')
    <div class="container" style="max-width: fit-content !important;">
        <a href="{{ route('home') }}" class="mr-3"> <i class="fas fa-home" style="color: white;"></i></a>
        <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
            Criaatva
        </a>

       

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>


            <ul class="navbar-nav ml-auto">
                @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                @else

                <li class="nav-item dropdown">
                    @can('ordemdeservico-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        OS <span class="caret"></span>
                    </a>
                    @endcan

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('ordemdeservico-list')
                        <a class="dropdown-item" href="{{ route('ordemdeservicos.index') }}">Consultar</a>
                        @endcan
                        @can('ordemdeservico-create')
                        <a class="dropdown-item" href="{{ route('ordemdeservicos.create') }}">Cadastrar</a>
                        @endcan

                        {{-- @can('tabelapercentual-list')
                        <a class="dropdown-item" href="{{ route('tabelapercentual.index') }}">Tabela Percentual</a>
                        @endcan --}}
                    </div>
                </li>

                <li class="nav-item dropdown">
                    @can('despesa-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Despesas <span class="caret"></span>
                    </a>
                    @endcan
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('despesa-list')
                        <a class="dropdown-item" href="{{ route('despesas.index') }}">Consultar</a>
                        @endcan
                        @can('despesa-create')
                        <a class="dropdown-item" href="{{ route('despesas.create') }}">Cadastrar</a>
                        @endcan
                        @can('codigodespesa-list')
                        <a class="dropdown-item" href="{{ route('codigodespesas.index') }}">Código Despesas</a>
                        @endcan
                        @can('grupodespesa-list')
                        <a class="dropdown-item" href="{{ route('grupodespesas.index') }}">Grupo Despesas</a>
                        @endcan
                    </div>
                </li>
                <li class="nav-item dropdown">
                    @can('receita-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Receitas <span class="caret"></span>
                    </a>
                    @endcan
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('receita-list')
                        <a class="dropdown-item" href="{{ route('receita.index') }}">Consultar</a>
                        @endcan
                        @can('receita-create')
                        <a class="dropdown-item" href="{{ route('receita.create') }}">Cadastrar</a>
                        @endcan
                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('relatorio') }}" role="button">
                        Relatórios <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('entradas-list')
                        <a class="dropdown-item" href="{{ route('resumofinanceiro') }}">Resumo Financeiro</a>
                        @endcan
                    </div>
                </li>

                @can('pedidocompra-list')
                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    @can('pedidocompra-analise')
                        @if((AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado) > 0)    
                            <span class="badge badge-warning mt-0" style="font-size: 12;">{{ AppServiceProvider::pegaCountPedidoAguardandoAprovacao()[0]->aguardaprov }}</span>
                        @endif
                    @endcan
                    @can('pedidocompra-list')
                        @if((AppServiceProvider::pegaCountPedidoNaoAprovado(Auth::id())[0]->countpedidonaoaprovado) > 0)    
                            <span class="badge badge-danger" style="font-size: 12;">{{ AppServiceProvider::pegaCountPedidoNaoAprovado(Auth::id())[0]->countpedidonaoaprovado }}</span>
                        @endif
                        @if((AppServiceProvider::pegaCountPedidoAguardandoAprovacao(Auth::id())[0]->aguardaprov) > 0)    
                            <span class="badge badge-warning" style="font-size: 12;">{{ AppServiceProvider::pegaCountPedidoAguardandoAprovacao(Auth::id())[0]->aguardaprov }}</span>
                        @endif
                        @if((AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado) > 0)    
                            <span class="badge badge-success" style="font-size: 12;">{{ AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado }}</span>
                        @endif

                    @endcan
                    Pedido Compra
                </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        @can('pedidocompra-create')
                        @if(Gate::check('pedidocompra-analise'))
                        @else
                            <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=0&notificado=0">
                                <span class="badge badge-danger" style="font-size: 20;">
                                 {{ AppServiceProvider::pegaCountPedidoNaoAprovado(Auth::id())[0]->countpedidonaoaprovado }} 
                                </span> pedido(s) não aprovado(s) 
                            </a>

                        
                            <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=3&notificado=1"><span class="badge badge-warning" style="font-size: 20;">{{ AppServiceProvider::pegaCountPedidoAguardandoAprovacao(Auth::id())[0]->aguardaprov }}</span> pedido(s) aguardando aprovação</a>
                            <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=1&notificado=1"><span class="badge badge-success" style="font-size: 20;">{{ AppServiceProvider::pegaCountPedidoAprovado(Auth::id())[0]->countpedidoaprovado }}</span> pedido(s) aprovado(s)</a>
                            @endif
                            @endcan
                            <a class="dropdown-item" href="{{ route('pedidocompra.index') }}">Listar todos</a>
                        @can('pedidocompra-analise')
                        <hr>
                        <a class="dropdown-item" href="{{ route('pedidocompra.index') }}?aprovado=3&notificado=1">Avaliador - <span class="badge badge-warning mt-0" style="font-size: 20;">{{ AppServiceProvider::pegaCountPedidoAguardandoAprovacao()[0]->aguardaprov }}</span>  pedido(s) para aprovar</a>
                        @endcan
                    </div>
                </li>
                @endcan

                <li class="nav-item dropdown">
                    @can('fornecedor-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Forn. <span class="caret"></span>
                    </a>
                    @endcan

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('fornecedor-create')
                        <a class="dropdown-item" href="{{ route('fornecedores.create') }}">Cadastrar</a>
                        @endcan
                        @can('fornecedor-list')
                        <a class="dropdown-item" href="{{ route('fornecedores.index') }}">Consultar</a>
                        @endcan
                    </div>
                </li>

                <li class="nav-item dropdown">
                    @can('cliente-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Clientes <span class="caret"></span>
                    </a>
                    @endcan

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('cliente-create')
                        <a class="dropdown-item" href="{{ route('clientes.create') }}">Cadastrar</a>
                        @endcan
                        @can('cliente-list')
                        <a class="dropdown-item" href="{{ route('clientes.index') }}">Consultar</a>
                        @endcan
                    </div>
                </li>

                <li class="nav-item dropdown">
                    @can('funcionario-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Funcionários <span class="caret"></span>
                    </a>
                    @endcan

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('funcionario-create')
                        <a class="dropdown-item" href="{{ route('funcionarios.create') }}">Cadastrar</a>
                        @endcan
                        @can('funcionario-list')
                        <a class="dropdown-item" href="{{ route('funcionarios.index') }}">Consultar</a>
                        @endcan
                    </div>
                </li>

                @can('notasrecibos-list')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Notas/Alíquotas <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('notasrecibos-list')
                        <a class="dropdown-item" href="{{ route('notasrecibos.index') }}">Consultar Notas/Recibos</a>
                        @endcan

                        @can('notasrecibos-list')
                        <a class="dropdown-item" href="{{ route('aliquotamensal.index') }}">Alíquotas Mensais</a>
                        @endcan

                    </div>
                </li>
                @endcan


                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Conf. <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('usuario-list')
                        <a class="dropdown-item" href="{{ route('users.index') }}">Usuários</a>
                        @endcan

                        @can('banco-list')
                        <a class="dropdown-item" href="{{ route('bancos.index') }}">Bancos</a>
                        @endcan

                        @can('formapagamento-list')
                        <a class="dropdown-item" href="{{ route('formapagamentos.index') }}">Formas de Pagamento</a>
                        @endcan

                        @can('conta-list')
                        <a class="dropdown-item" href="{{ route('contas.index') }}">Contas</a>
                        @endcan

                        @can('codigodespesa-list')
                        <a class="dropdown-item" href="{{ route('codigodespesas.index') }}">Código Despesas</a>
                        @endcan

                        @can('role-list')
                        <a class="dropdown-item" href="{{ route('roles.index') }}">Regras</a>
                        @endcan

                        @can('orgaorg-list')
                        <a class="dropdown-item" href="{{ route('orgaosrg.index') }}">Órgãos RG</a>
                        @endcan

                        @can('benspatrimoniais-list')
                        <a class="dropdown-item" href="{{ route('products.index') }}">Tipo de Bens Patrimoniais</a>
                        @endcan
                    </div>
                </li>

                @can('benspatrimoniais-list')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Bens <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('benspatrimoniais-list')
                        <a class="dropdown-item" href="{{ route('benspatrimoniais.index') }}">Listar Materiais</a>
                        @endcan

                        @can('entradas-list')
                        <a class="dropdown-item" href="{{ route('entradas.index') }}">Entradas de Materiais</a>
                        @endcan

                        @can('saidas-list')
                        <a class="dropdown-item" href="{{ route('saidas.index') }}">Saídas (Baixa de Materiais)</a>
                        @endcan

                        @can('estoque-list')
                        <a class="dropdown-item" href="{{ route('estoque.index') }}">Estoque (Inventário) </a>
                        @endcan
                    </div>
                </li>
                @endcan

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}<span
                            class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="users/{{Auth::user()->id}}/edit">Editar Perfil <i
                                class="far fa-id-card ml-1"></i></a>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Sair
                            <i class="fas fa-power-off"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>