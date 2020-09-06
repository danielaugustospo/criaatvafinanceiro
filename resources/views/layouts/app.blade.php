<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gerenciamento Financeiro - Criaatva') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous" ></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <script src="{{ asset('js/viacep.js') }}" defer></script>
    <script src="{{ asset('js/funcionarios/validafavorecido.js') }}" defer></script>
    <!-- <script src="{{ asset('js/inputmask5x/dist/inputmask.js') }}"></script> -->
    <script src="{{ asset('js/inputmask5x/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask5x/dist/bindings/inputmask.binding.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                    Criaatva
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
                        @else

                        <!-- @can('usuario-list') -->
                        <li><a class="nav-link" href="{{ route('users.index') }}">Usuários</a></li>
                        <!-- @endcan -->
                        @can('ordemdeservico-list')
                        <li><a class="nav-link" href="{{ route('ordemdeservicos.index') }}">OS</a></li>
                        @endcan
                        @can('despesa-list')
                        <li><a class="nav-link" href="{{ route('despesas.index') }}">Despesas</a></li>
                        @endcan
                        @can('verba-list')
                        <li><a class="nav-link" href="{{ route('verbas.index') }}">Verbas</a></li>
                        @endcan
                        @can('fornecedor-list')
                        <li><a class="nav-link" href="{{ route('fornecedores.index') }}">Fornecedores</a></li>
                        @endcan
                        @can('cliente-list')
                        <li><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
                        @endcan
                        @can('saidas-list')
                        <li><a class="nav-link" href="{{ route('saidas.index') }}">Saídas</a></li>
                        @endcan
                        @can('entradas-list')
                        <li><a class="nav-link" href="{{ route('entradas.index') }}">Entradas</a></li>
                        @endcan
                        @can('estoque-list')
                        <li><a class="nav-link" href="{{ route('estoque.index') }}">Estoque</a></li>
                        @endcan
                        @can('funcionario-list')
                        <li><a class="nav-link" href="{{ route('funcionarios.index') }}">Funcionários</a></li>
                        @endcan
                        @can('benspatrimoniais-list')
                        <li><a class="nav-link" href="{{ route('benspatrimoniais.index') }}">Bens Patrimoniais</a></li>
                        @endcan


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Configurações <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @can('banco-list')
                                <a class="dropdown-item" href="{{ route('bancos.index') }}">Bancos</a>
                                @endcan
                                @can('formapagamento-list')
                                <a class="dropdown-item" href="{{ route('formapagamentos.index') }}">Formas de Pagamento</a>
                                @endcan

                                <a class="dropdown-item" href="{{ route('contas.index') }}">Contas</a>

                                @can('codigodespesa-list')
                                <a class="dropdown-item" href="{{ route('codigodespesas.index') }}">Código Despesas</a>
                                @endcan
                                @can('role-list')
                                <a class="dropdown-item" href="{{ route('roles.index') }}">Regras</a>
                                @endcan
                                @can('orgaorg-list')
                                <a class="dropdown-item" href="{{ route('orgaosrg.index') }}">Órgãos RG</a>
                                @endcan

                                <a class="dropdown-item" href="{{ route('products.index') }}">Tipo de Bens Patrimoniais</a>

                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>


                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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


        <main class="py-4" style="background-image: url(http://www.estatisticasegura.com.br/wp-content/uploads/2017/07/BACKGROUND-TOP.jpg);">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
