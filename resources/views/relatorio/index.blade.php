@can('relatorio-list')

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

@include('layouts/helpersview/mensagemRetorno')


<hr>
{{-- @include('despesas/filtroindex') --}}
<div class="row  justify-content-center">
    <div class="divCategoria jumbotron col-sm-5 mb-5">
        <h4 class="text-center">Receitas</h4>
        {{-- <a href="areceberporcliente">           <label class="text-center fontenormal row" for="">A Receber por Cliente/Data  &nbsp;    </label></a> --}}
        <!-- <a href="areceberporos">                <label class="text-center fontenormal row" for="">A Receber por OS &nbsp; </label></a> -->
        @can('rel-contasAReceber')
            <a href="contasAReceber">               <label class="text-center fontenormal row" for="">Contas a Receber &nbsp;</label></a>
        @endcan
        @can('rel-entradasdereceitasrecebidas')
            <a href="entradasdereceitasrecebidas">  <label class="text-center fontenormal row" for="">Entradas de Receitas Recebidas  &nbsp;</label></a>    
        @endcan
        @can('rel-entradaporcontabancaria')
            <a href="entradaporcontabancaria">      <label class="text-center fontenormal row" for="">Entradas por Conta Bancária/NF&nbsp;</label></a>
        @endcan
        @can('rel-fatporcliente')
            <a href="fatporcliente?p=s">            <label class="text-center fontenormal row" for="">Faturamento por Cliente &nbsp;</label></a>
        @endcan
        @can('rel-notasemitidas')
            <a href="notasemitidas">                <label class="text-center fontenormal row" for="">Notas Emitidas - FORNECEDOR &nbsp; </label></a>
        @endcan
        @can('rel-notasficaisemitidascriaatva')
            <a href="notasficaisemitidascriaatva">  <label class="text-center fontenormal row" for="">Notas Emitidas - CRIAATVA &nbsp; </label></a>
        @endcan
        @can('rel-osrecebidasporcliente')
            <a href="osrecebidasporcliente">        <label class="text-center fontenormal row" for="">OS Recebidas por Cliente  &nbsp; </label></a>    
        @endcan
        @can('rel-controleorcamento')
            <a href="controledeorcamento">          <label class="text-center fontenormal row" for="">Controle de Orçamento  &nbsp; </label></a>    
        @endcan
        <!-- <a href="ordemdeservicorecebidas">      <label class="text-center fontenormal row" for="">Ordem de Serviço Recebidas (Analítico)  &nbsp;</label></a> -->   

    </div>
    <div class="col-sm-1"></div>
    <div class="divCategoria jumbotron col-sm-5 mb-2">
        <h4 class="text-center">Despesas</h4>
        @can('rel-contasapagarporgrupo')
            <a onclick="abreModalDespesas(param = 'contasapagarporgrupo');" 
            href="#"> <label class="text-center fontenormal row" for="">Contas a Pagar              &nbsp; </label></a>
        @endcan
        
        {{-- <a href="contasaidentificar">                   <label class="text-center fontenormal row" for="">Contas a Identificar        &nbsp; </label></a> --}}
        @can('rel-contaspagasporgrupo')            
        <a onclick="abreModalDespesas(param = 'contaspagasporgrupo');"
        href="#">  <label class="text-center fontenormal row" for="">Contas Pagas Por Despesa/Grupo      &nbsp; </label></a>
        @endcan

        @can('rel-contaspagasporgrupo')            
        <a onclick="abreModalDespesas(param = 'despesasfixavariavel');"
        href="#"> <label class="text-center fontenormal row" for="">Fixas/Variáveis             &nbsp; </label></a>
        @endcan
        
        @can('rel-fornecedor')            
        <a onclick="abreModalDespesas(param = 'fornecedor');"
        href="#">  <label class="text-center fontenormal row" for="">Fornecedor                  &nbsp; </label></a>
        @endcan
        
        @can('rel-notafiscalfornecedor')            
        <a onclick="abreModalDespesas(param = 'notafiscalfornecedor');" 
        href="#">  <label class="text-center fontenormal row" for="">Nota Fiscal (Fornecedor)    &nbsp; </label></a>
        @endcan
        
        @can('rel-pclienteanalitico')            
        <a  onclick="abreModalDespesas(param = 'pclienteanalitico');"
        href="#"> <label class="text-center fontenormal row" for="">Por Cliente (Analítico)     &nbsp; </label></a>
        @endcan
        
        @can('rel-despesaspagasporcontabancaria')            
        <a onclick="abreModalDespesas(param = 'despesaspagasporcontabancaria');"
        href="#">  <label class="text-center fontenormal row" for="">Por Conta Bancária          &nbsp; </label></a>
        @endcan
        
        @can('rel-despesasporos')            
        <a onclick="abreModalDespesas(param = 'despesasporos');"
        href="#"> <label class="text-center fontenormal row" for="">Por OS                      &nbsp; </label></a>
        @endcan
        
        @can('rel-despesasporosplanilha')            
        <a onclick="abreModalDespesas(param = 'despesasporosplanilha');"
        href="#"> <label class="text-center fontenormal row" for="">Por OS - Planilha           &nbsp; </label></a>
        @endcan
        
        {{-- <a onclick="abreModalDespesas(param = 'prolabore');"
        href="#"> <label class="text-center fontenormal row" for="">Pró-Labore                  &nbsp; </label></a> --}}
        
        @can('rel-reembolso')            
        <a onclick="abreModalDespesas(param = 'reembolso');"
        href="#"> <label class="text-center fontenormal row" for="">Reembolso                   &nbsp; </label></a>
        @endcan
        
        @can('rel-despesassinteticaporos')
        <a onclick="abreModalDespesas(param= 'despesassinteticaporos');" 
        href="#">               <label class="text-center fontenormal row" for="">Sintética por OS (%)          &nbsp; </label></a>            
        @endcan
        
        @can('rel-controleconsumomateriais')
        <a onclick="abreModalDespesas(param= 'controleconsumomaterial');" 
        href="#">               <label class="text-center fontenormal row" for="">Controle de consumo de materiais &nbsp; </label></a>            
        @endcan
    </div>
</div>

<div class="row  justify-content-center mt-5">

<div class="divCategoria jumbotron col-sm-5 mb-2">
<h4 class="text-center">Ordem de Serviço</h4>
    @can('ordemdeservico-show')
    <a href="oscadastradas"><label class="text-center fontenormal row" for="">Relatório OS Cadastradas  &nbsp; </label></a>
    @endcan
</div>

<div class="col-sm-1"></div>

<div class="divCategoria jumbotron col-sm-5 mb-2">
    <h4 class="text-center">Fechamento</h4>
    {{-- <a  class="d-flex justify-content-center" data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter" style="cursor: pointer; color: red;"><i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a> --}}
    @can('visualiza-relatoriogeral')
        <a href="#" data-toggle="modal" onclick="alteraRotaFormularioFluxo(relatorio = 'analitico');" data-target="#exampleModalCenter"><label class="text-center fontenormal row"  for="">Fluxo de Caixa Analítico (antigo) &nbsp; </label></a>
        <a href="#" data-toggle="modal" onclick="alteraRotaFormularioFluxo(relatorio = 'sintetico');" data-target="#exampleModalCenter"><label class="text-center fontenormal row"  for="">Fluxo de Caixa Sintético &nbsp; </label></a>
    @endcan
    @can('rel-fechamentofinal')
    <a href="fechamentofinal"><label class="text-center fontenormal row" for="">Relatório Fechamento Final  &nbsp; </label></a>
    @endcan
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