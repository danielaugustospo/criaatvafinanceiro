<head>
    <meta charset="utf-8">
    <title>Relatórios</title>
</head>

@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">CENTRAL de Relatórios</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<hr>
{{-- @include('despesas/filtroindex') --}}
<div class="row">
    <div class="divCategoria col-sm-5">
        <h2 class="text-center">Receitas</h2>
        <label class="text-center  row" for="">Faturamento Por Cliente &nbsp;     <a href="fatporcliente?p=s">Acesse Aqui</a></label>
        <label class="text-center  row" for="">Entradas por Conta Bancária &nbsp; <a href="entradaporcontabancaria">Acesse Aqui</a></label>
        <label class="text-center  row" for="">Entradas de Receitas Recebidas &nbsp; <a href="entradasdereceitasrecebidas">Acesse Aqui</a></label>
        <label class="text-center  row" for="">Contas a Receber        &nbsp;     <a href="contasAReceber">Acesse Aqui</a></label>
        <label class="text-center row" for="">Ordem de Serviço Recebidas (Analítico)  &nbsp; <a href="ordemdeservicorecebidas">Acesse Aqui</a></label>
        <label class="text-center row" for="">Ordem de Serviço Recebidas Por Cliente  &nbsp; <a href="osrecebidasporcliente">Acesse Aqui</a></label>
        <label class="text-center row" for="">A Receber Por Cliente  &nbsp;         <a href="areceberporcliente">Acesse Aqui</a></label>
        <label class="text-center row" for="">A Receber Por OS      &nbsp;          <a href="areceberporos">Acesse Aqui</a></label>

    </div>
    <div class="col-sm-1"></div>
    <div class="divCategoria col-sm-5">
        <h2 class="text-center">Despesas</h2>
        <label class="text-center row" for="">Despesas por Conta Bancária &nbsp; <a href="despesaspagasporcontabancaria">Acesse Aqui</a></label>
        <label class="text-center row" for="">Despesas Por OS             &nbsp; <a href="despesasporos">Acesse Aqui</a></label>
        <label class="text-center row" for="">Despesas Sintética por OS   &nbsp; <a href="despesassinteticaporos">Acesse Aqui</a></label>
        <label class="text-center row" for="">Despesas por Cliente (Analítico)  &nbsp; <a href="despesasporclienteanalitico">Acesse Aqui</a></label>
        <label class="text-center row" for="">Contas Pagas por Grupo      &nbsp; <a href="contaspagasporgrupo">Acesse Aqui</a></label>
        <label class="text-center row" for="">Reembolso                   &nbsp; <a href="reembolso">Acesse Aqui</a></label>
        <label class="text-center row" for="">Contas a Pagar              &nbsp; <a href="contasapagarporgrupo">Acesse Aqui</a></label>
        <label class="text-center row" for="">Contas a Identificar        &nbsp; <a href="contasaidentificar">Acesse Aqui</a></label>
        <label class="text-center row" for="">Fornecedor                  &nbsp; <a href="fornecedor">Acesse Aqui</a></label>
        <label class="text-center row" for="">Despesas Por OS - Planilha  &nbsp; <a href="despesasporosplanilha">Acesse Aqui</a></label>
        <label class="text-center row" for="">Pró-Labore                  &nbsp; <a href="prolabore">Pró-Labore</a></label>
    </div>
</div>
<label class="text-center row" for="">Relatório OS Cadastradas  &nbsp; <a href="oscadastradas">Acesse Aqui</a></label>
@endsection


<style>
    .divCategoria {
        -webkit-box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0); 
        box-shadow: 0px 10px 13px -7px #000000, 5px 5px 15px 5px rgba(0,0,0,0);
}
label {
    margin: 0px !important;
}

</style>