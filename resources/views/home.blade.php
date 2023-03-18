@extends('layouts.app')

@section('content')


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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 class="text-center"> Acesso Rápido</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <label for=""> Bem Vindo, {{Auth::user()->name}}!</label>

                </div>

            </div>

        </div>

    </div>

</div>
    @include('layouts/acessorapido')
@endsection
 


