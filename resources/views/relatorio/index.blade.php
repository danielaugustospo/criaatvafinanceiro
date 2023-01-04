@can('visualiza-relatoriogeral')

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
<div class="row  justify-content-center">
    <div class="divCategoria jumbotron col-sm-5 mb-5">
        <h4 class="text-center">Receitas</h4>
        {{-- <a href="areceberporcliente">           <label class="text-center fontenormal row" for="">A Receber por Cliente/Data  &nbsp;    </label></a> --}}
        <!-- <a href="areceberporos">                <label class="text-center fontenormal row" for="">A Receber por OS &nbsp; </label></a> -->
        <a href="contasAReceber">               <label class="text-center fontenormal row" for="">Contas a Receber &nbsp;</label></a>
        <a href="entradasdereceitasrecebidas">  <label class="text-center fontenormal row" for="">Entradas de Receitas Recebidas  &nbsp;</label></a>    
        <a href="entradaporcontabancaria">      <label class="text-center fontenormal row" for="">Entradas por Conta Bancária&nbsp;</label></a>
        <a href="fatporcliente?p=s">            <label class="text-center fontenormal row" for="">Faturamento por Cliente &nbsp;</label></a>
        <a href="notasemitidas">                <label class="text-center fontenormal row" for="">Notas Emitidas - FORNECEDOR &nbsp; </label></a>
        <a href="notasficaisemitidascriaatva">  <label class="text-center fontenormal row" for="">Notas Emitidas - CRIAATVA &nbsp; </label></a>
        <!-- <a href="ordemdeservicorecebidas">      <label class="text-center fontenormal row" for="">Ordem de Serviço Recebidas (Analítico)  &nbsp;</label></a> -->   
        <a href="osrecebidasporcliente">        <label class="text-center fontenormal row" for="">OS Recebidas por Cliente  &nbsp; </label></a>    

    </div>
    <div class="col-sm-1"></div>
    <div class="divCategoria jumbotron col-sm-5 mb-2">
        <h4 class="text-center">Despesas</h4>
        <a onclick="abreModalDespesas(param = 'contasapagarporgrupo');" 
        href="#"> <label class="text-center fontenormal row" for="">Contas a Pagar              &nbsp; </label></a>
        
        {{-- <a href="contasaidentificar">                   <label class="text-center fontenormal row" for="">Contas a Identificar        &nbsp; </label></a> --}}

        <a onclick="abreModalDespesas(param = 'contaspagasporgrupo');"
        href="#">  <label class="text-center fontenormal row" for="">Contas Pagas Por Despesa/Grupo      &nbsp; </label></a>

        <a onclick="abreModalDespesas(param = 'despesasfixavariavel');"
        href="#"> <label class="text-center fontenormal row" for="">Fixas/Variáveis             &nbsp; </label></a>
        
        <a onclick="abreModalDespesas(param = 'fornecedor');"
        href="#">  <label class="text-center fontenormal row" for="">Fornecedor                  &nbsp; </label></a>
        
        <a onclick="abreModalDespesas(param = 'notafiscalfornecedor');" 
        href="#">  <label class="text-center fontenormal row" for="">Nota Fiscal (Fornecedor)    &nbsp; </label></a>
        
        <a  onclick="abreModalDespesas(param = 'pclienteanalitico');"
        href="#"> <label class="text-center fontenormal row" for="">Por Cliente (Analítico)     &nbsp; </label></a>
        
        <a onclick="abreModalDespesas(param = 'despesaspagasporcontabancaria');"
        href="#">  <label class="text-center fontenormal row" for="">Por Conta Bancária          &nbsp; </label></a>
        
        <a onclick="abreModalDespesas(param = 'despesasporos');"
        href="#"> <label class="text-center fontenormal row" for="">Por OS                      &nbsp; </label></a>
        
        <a onclick="abreModalDespesas(param = 'despesasporosplanilha');"
        href="#"> <label class="text-center fontenormal row" for="">Por OS - Planilha           &nbsp; </label></a>
        
        {{-- <a onclick="abreModalDespesas(param = 'prolabore');"
        href="#"> <label class="text-center fontenormal row" for="">Pró-Labore                  &nbsp; </label></a> --}}
        
        <a onclick="abreModalDespesas(param = 'reembolso');"
        href="#"> <label class="text-center fontenormal row" for="">Reembolso                   &nbsp; </label></a>
        
        <a onclick="abreModalDespesas(param= 'despesassinteticaporos');" 
        href="#">               <label class="text-center fontenormal row" for="">Sintética por OS (%)          &nbsp; </label></a>
    </div>
</div>

<div class="row  justify-content-center mt-5">

<div class="divCategoria jumbotron col-sm-5 mb-2">
<h4 class="text-center">Ordem de Serviço</h4>
    <a href="oscadastradas"><label class="text-center fontenormal row" for="">Relatório OS Cadastradas  &nbsp; </label></a>
</div>

<div class="col-sm-1"></div>

<div class="divCategoria jumbotron col-sm-5 mb-2">
    <h4 class="text-center">Fechamento</h4>
    {{-- <a  class="d-flex justify-content-center" data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter" style="cursor: pointer; color: red;"><i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a> --}}
    <a href="#" data-toggle="modal" onclick="alteraRotaFormularioFluxo(relatorio = 'analitico');" data-target="#exampleModalCenter"><label class="text-center fontenormal row"  for="">Fluxo de Caixa Analítico (antigo) &nbsp; </label></a>
    <a href="#" data-toggle="modal" onclick="alteraRotaFormularioFluxo(relatorio = 'sintetico');" data-target="#exampleModalCenter"><label class="text-center fontenormal row"  for="">Fluxo de Caixa Sintético &nbsp; </label></a>
    <a href="fechamentofinal"><label class="text-center fontenormal row" for="">Relatório Fechamento Final  &nbsp; </label></a>
    </div>
</div>



<style>
    .divCategoria {

        padding: 2rem 1rem;
        margin-bottom: 2rem;
        background-color: #e9ecef;
        border-radius: 0.3rem;

        -webkit-box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.5); 
        box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.5);
    }
    label {
        margin: 0px !important;
    }

    h4 {
        font-weight: bold;
    }

</style>
@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection