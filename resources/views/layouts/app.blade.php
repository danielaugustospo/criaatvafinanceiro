<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gerenciamento Financeiro - Criaatva') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.2/dist/sweetalert2.css"
    integrity="sha256-J0OGsqasA5LpAKCLu3AR0kX7iLsr/NLEx8rVRB+iSH0=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.2/dist/sweetalert2.all.min.js"
    integrity="sha256-wLk4yXmqQvDv8x5C501KgoVtR2yHYUpOKspL/KpR+/8=" crossorigin="anonymous"></script>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" /> --}}

    @include('layouts/include')
    @include('layouts/scripts')
    @include('layouts/estilo')

</head>



<body style="background-image: url('{{ config('app.url') }}/img/BACKGROUND-TOP.jpg');">
    <div id="app">

        @isset($paginaModal)
        @else
            @include('layouts/navbar')
        @endisset
        <main class="py-4" style="margin-bottom: 50px;">
            <div class="m-2 justify-content-center">
                @yield('content')
            </div>
        </main>
    </div>
    @isset($paginaModal)
    @else
        <div class="footer fixed-bottom" style="background-color: black;">
            <p class="text-center text-primary"><small>Desenvolvido por DanielTECH -
                    @php// function getVersion(){  $hash = exec("git rev-list --tags --max-count=1"); return exec("git describe --tags $hash"); } echo getVersion();
                    @endphp
                </small></p>
        </div>
    @endisset
</body>

</html>
