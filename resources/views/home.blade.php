@extends('layouts.app')

@section('content')

{{-- htdocs/homolog/resources/views/home.blade.php --}}
@if(isset($mensagemErro))
<div class="text-center alert alert-danger">
    <p>{{ $mensagemErro }}</p>
</div>
@endif
@if(isset($mensagemExito))
<div class="text-center alert alert-success">
    <p>{{ $mensagemExito }}</p>
</div>
@endif

<script>
    // Pega os dados da sessão do Laravel e os coloca no cookie
    const userData = @json(session('userData'));
    const token = @json(session('token')); // Se o token já for uma string, não precisa acessar ->token
    const userPermissions = @json(session('userPermissions'));

    if (userData && token) {
        // Armazena os dados no cookie com segurança
        // document.cookie = `userPermissions=${JSON.stringify(userPermissions)}; path=/; domain=.danieltecnologia.com; secure; samesite=strict`;
        
        const compactPermissions = userPermissions.map(permission => permission.name);
        document.cookie = `userPermissions=${JSON.stringify(compactPermissions)}; path=/; domain=.danieltecnologia.com; secure; samesite=strict`;
        
        document.cookie = `userData=${JSON.stringify(userData)}; path=/; domain=.danieltecnologia.com; secure; samesite=strict`;
        document.cookie = `token=${token}; path=/; domain=.danieltecnologia.com; secure; samesite=strict`;

        console.log('Dados de sessão armazenados no cookie:');
        console.log('UserData:', userData);
        console.log('Token:', token);
        console.log('UserPermissions:', userPermissions);
    } else {
        console.error('Erro: Dados de sessão ausentes');
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Acesso Rápido</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <label for=""> Bem Vindo(a), {{ Auth::user()->name }}!</label>

                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.acessorapido')
@endsection
