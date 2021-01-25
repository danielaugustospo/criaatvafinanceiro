@extends('layouts.app')

@section('content')

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

                    Bem Vindo, {{Auth::user()->name}}!

                </div>

            </div>

        </div>

    </div>

</div>
    @include('layouts/acessorapido')
@endsection
 


