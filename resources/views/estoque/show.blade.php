@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados Conta {{ $conta->numeroConta }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contas.index') }}"> Voltar</a>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Número Conta:</strong>
            {{ $conta->numeroConta }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Agência:</strong>
            {{ $conta->agenciaConta }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome Banco:</strong>
            {{ $conta->nomeBanco }}
        </div>
    </div>


</div>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
