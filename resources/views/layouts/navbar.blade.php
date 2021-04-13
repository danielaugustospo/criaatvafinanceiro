<nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
    @yield('nav') 
    <div class="container">
       <a href="{{ route('home') }}" class="mr-3"> <i class="fas fa-home" style="color: white;"></i></a>
        <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
            Criaatva
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        OS <span class="caret"></span>
                    </a>
                    @endcan

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('ordemdeservico-list')
                        <a class="dropdown-item" href="{{ route('ordemdeservicos.index') }}">OS</a>
                        @endcan
                        @can('despesa-list')
                        <a class="dropdown-item" href="{{ route('despesas.index') }}">Despesas</a>
                        @endcan

                        @can('receita-list')
                        <a class="dropdown-item" href="{{ route('receita.index') }}">Receitas</a>
                        @endcan

                        @can('tabelapercentual-list')
                        <a class="dropdown-item" href="{{ route('tabelapercentual.index') }}">Tabela Percentual</a>
                        @endcan
                    </div>
                </li>

                <li class="nav-item dropdown">
                    @can('despesa-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Despesas <span class="caret"></span>
                    </a>
                    @endcan
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('despesa-list')
                        <a class="dropdown-item" href="{{ route('despesas.index') }}">Despesas</a>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Relatórios <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('conta-list')
                        <a class="dropdown-item" href="{{ route('contasAPagar') }}">Contas a Pagar</a>
                        @endcan
                        @can('conta-list')
                        <a class="dropdown-item" href="{{ route('contasAReceber') }}">Contas a Receber</a>
                        @endcan
                        {{-- @can('conta-list')
                        <a class="dropdown-item" href="{{ route('contacorrente.relatorioFornecedores') }}">Relatório de Fornecedores</a>
                        @endcan --}}
                    </div>
                </li>    

                <li class="nav-item dropdown">
                    @can('conta-list')
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Conta Corrente <span class="caret"></span>
                    </a>
                    @endcan
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('benspatrimoniais-list')
                        <a class="dropdown-item" href="{{ route('benspatrimoniais.index') }}">Saldo das Contas</a>
                        @endcan
                        @can('entradas-list')
                        <a class="dropdown-item" href="{{ route('resumofinanceiro') }}">Resumo Financeiro</a>
                        @endcan
                        @can('entradas-list')
                        <a class="dropdown-item" href="{{ route('extratoConta') }}">Extrato Por Período</a>
                        @endcan
                    </div>
                </li>

                @can('fornecedor-list')
                <li><a class="nav-link" href="{{ route('fornecedores.index') }}">Fornecedores</a></li>
                @endcan
                @can('cliente-list')
                <li><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
                @endcan
                
                @can('funcionario-list')
                <li><a class="nav-link" href="{{ route('funcionarios.index') }}">Funcionários</a></li>
                @endcan

                @can('benspatrimoniais-list')    
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Bens Patrimoniais <span class="caret"></span>
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

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Configurações <span class="caret"></span>
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

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>


                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="users/{{Auth::user()->id}}/edit">Editar Perfil <i class="far fa-id-card ml-1"></i></a>

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