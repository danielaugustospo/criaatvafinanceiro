<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gerenciamento Financeiro - Criaatva') }}</title>

    @include('layouts/include')
    @include('layouts/scripts')
    @include('layouts/estilo')
    
</head>

<body style="background-image: url('../img/BACKGROUND-TOP.jpg');">
    <div id="app">
        @include('layouts/navbar')
        <main class="py-4" style="margin-bottom: 50px;">
            <div class="m-2 justify-content-center" >
                @yield('content')
            </div>
        </main>
    </div>
    <div class="footer fixed-bottom" style="background-color: black;">
        <p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
    </div>
</body>

</html>