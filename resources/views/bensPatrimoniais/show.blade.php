@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Bem Patrimonial {{ $benspatrimoniais->nomeBensPatrimoniais }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('benspatrimoniais.index') }}"> Voltar</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $benspatrimoniais->nomeBensPatrimoniais }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Descrição:</strong>
            {{ $benspatrimoniais->descricaoBensPatrimoniais }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tipo Bem Patrimonial:</strong>
            {{ $benspatrimoniais->idTipoBensPatrimoniais }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Status Bem Patrimonial:</strong>
            @if ( $benspatrimoniais->statusbenspatrimoniais  = 1)
            Disponivel
            @elseif ( $benspatrimoniais->statusbenspatrimoniais  = 2)
            Em Uso
            @elseif ( $benspatrimoniais->statusbenspatrimoniais  = 3)
            Manutenção
            @endif

        </div>
    </div>
</div>


@endsection
