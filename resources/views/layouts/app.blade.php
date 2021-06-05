<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gerenciamento Financeiro - Criaatva') }}</title>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">



    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.22/dataRender/datetime.js"></script>
    
    {{-- Exportação Botões Tabela --}}
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />

     <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>     
     <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    <script src="{{ asset('js/viacep.js') }}" defer></script>
    <script src="{{ asset('js/funcionarios/validafavorecido.js') }}" defer></script>
    <script src="{{ asset('js/inputmask5x/dist/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('js/inputmask5x/dist/bindings/inputmask.binding.js') }}"></script>

    {{-- <script src="{{ asset('js/jquery.mask.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <script>
        
    $(document).ready(function() {
   
    jQuery('.campo-moeda')
      .maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: false
  });
    $(".padraoReal").inputmask( 'currency',{"autoUnmask": true,
                    radixPoint:",",
                    groupSeparator: ".",
                    allowMinus: false,
                    // prefix: 'R$ ',            
                    digits: 2,
                    digitsOptional: true,
                    rightAlign: true,
                    unmaskAsNumber: true,
                    removeMaskOnSubmit: true
        });
    });
            // $(".padraoReal").inputmask('decimal', {
            //     // 'rightAlign': false,                
            //     'alias': 'numeric',
            //     'groupSeparator': '.',
            //     'autoGroup': false,
            //     'digits': 2,
            //     'radixPoint': ",",
            //     'digitsOptional': false,
            //     'allowMinus': false,
            //     // 'prefix': 'R$ ',
            //     'placeholder': '0',
            // });
        $(document).ready(function() {
            $(".padraoRealEdicao").inputmask('currency',{"autoUnmask": true,
            // radixPoint:",",
            // groupSeparator: ".",
            allowMinus: false,
            prefix: 'R$ ',            
            // digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
            });
        });

        $(document).ready(function($) {
            $(".selecionaComInput").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#id").select2()({
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
        p,label,h1,h2,h3,h4,h5,th,button,input,select,option,a {
            text-transform: uppercase; 
        }

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
        .shadowDiv {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.5)!important;
        }

         .nav-link,#navbarDropdown {
            color: yellow !important;
            /* background-color: brown;
            background-size: 0.2%; */
        }
    </style>
</head>

<body style="background-image: url(http://www.estatisticasegura.com.br/wp-content/uploads/2017/07/BACKGROUND-TOP.jpg);">
    <div id="app">
        @include('layouts/navbar')
        <main class="py-4">
            <div class="container" >
                @yield('content')
            </div>
        </main>
    </div>
    <div class="footer fixed-bottom" style="background-color: black;">
        <p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
    </div>
</body>

</html>