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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/viacep.js') }}" defer></script>
    <script src="{{ asset('js/funcionarios/validafavorecido.js') }}" defer></script>
    <script src="{{ asset('js/inputmask5x/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask5x/dist/bindings/inputmask.binding.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


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
        @include('layouts/navbar')
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