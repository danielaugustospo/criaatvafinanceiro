@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Cliente {{ $cliente->nomeCliente }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Voltar</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $cliente->nomeCliente }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Contato:</strong>
            {{ $cliente->contatoCliente }}
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
