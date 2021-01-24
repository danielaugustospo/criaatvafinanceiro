<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gerenciamento Financeiro - Criaatva') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}



    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous" ></script>  --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('js/viacep.js') }}" defer></script>
    <script src="{{ asset('js/funcionarios/validafavorecido.js') }}" defer></script>
    {{-- <script src="{{ asset('js/inputmask5x/dist/inputmask.js') }}"></script> --}}
    <script src="{{ asset('js/inputmask5x/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask5x/dist/bindings/inputmask.binding.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />

    <script>
        $(document).ready(function() {
            $(".padraoReal").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });
        });

        $(document).ready(function($) {
            $(".selecionaComInput").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

        $("#nomeFormaPagamento").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });

        $("#idClienteOrdemdeServico").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });

        $("#idCodigoDespesas").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });

        $("#idFormaPagamento").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });

        $("#idFormaPagamentoReceita").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });

        $("#conta").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });

        $("#contaReceita").select2()({
            placeholder: 'Selecione uma opção',
            dropdownParent: $('#myModal'),
        });

        $("#totalPrecoReal").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#totalPrecoCliente").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#lucro").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#valorEstornado").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#precoReal").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#precoCliente").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#valorTotalOrdemdeServico").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#valorProjetoOrdemdeServico").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#valorOrdemdeServico").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });

        $("#valorreceita").inputmask('decimal', {
            'alias': 'numeric',
            // 'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            // 'prefix': 'R$ ',
            'placeholder': ''
        });
    });


    </script>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body style="background-image: url(http://www.estatisticasegura.com.br/wp-content/uploads/2017/07/BACKGROUND-TOP.jpg);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                OS <span class="caret"></span>
                            </a>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Despesas <span class="caret"></span>
                            </a>
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
                                Bens Patrimoniais <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @can('benspatrimoniais-list')
                                <a class="dropdown-item" href="{{ route('benspatrimoniais.index') }}">Listar Materiais</a>
                                @endcan
                                @can('entradas-list')
                                <a class="dropdown-item" href="{{ route('entradas.index') }}">Entradas</a>
                                @endcan

                                @can('saidas-list')
                                <a class="dropdown-item" href="{{ route('saidas.index') }}">Saídas</a>
                                @endcan

                            </div>
                        </li>

                        <!-- @can('ordemdeservico-list')
                        <li><a class="nav-link" href="{{ route('ordemdeservicos.index') }}">OS</a></li>
                        @endcan
                        @can('despesa-list')
                        <li><a class="nav-link" href="{{ route('despesas.index') }}">Despesas</a></li>
                        @endcan
                        @can('receita-list')
                        <li><a class="nav-link" href="{{ route('receita.index') }}">Receitas</a></li>
                        @endcan
                        @can('tabelapercentual-list')
                        <li><a class="nav-link" href="{{ route('tabelapercentual.index') }}">Tabela Percentual</a></li>
                        @endcan -->
                        <!-- @can('verba-list')
                        <li><a class="nav-link" href="{{ route('verbas.index') }}">Verbas</a></li>
                        @endcan -->
                        @can('fornecedor-list')
                        <li><a class="nav-link" href="{{ route('fornecedores.index') }}">Fornecedores</a></li>
                        @endcan
                        @can('cliente-list')
                        <li><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
                        @endcan
                        <!-- @can('saidas-list')
                        <li><a class="nav-link" href="{{ route('saidas.index') }}">Saídas</a></li>
                        @endcan
                        @can('entradas-list')
                        <li><a class="nav-link" href="{{ route('entradas.index') }}">Entradas</a></li>
                        @endcan -->
                        @can('estoque-list')
                        <li><a class="nav-link" href="{{ route('estoque.index') }}">Estoque</a></li>
                        @endcan
                        @can('funcionario-list')
                        <li><a class="nav-link" href="{{ route('funcionarios.index') }}">Funcionários</a></li>
                        @endcan
                        <!-- @can('benspatrimoniais-list')
                        <li><a class="nav-link" href="{{ route('benspatrimoniais.index') }}">Bens Patrimoniais</a></li>
                        @endcan -->


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


        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    <div class="footer fixed-bottom" style="background-color: black;">
        <p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>

    </div>
</body>

</html>
