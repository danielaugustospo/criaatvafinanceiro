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
    <div class="divCategoria col-sm-5">
        <h4 class="text-center">Receitas</h4>
        <a href="areceberporcliente">           <label class="text-center fontenormal row" for="">A Receber por Cliente/Data  &nbsp;    </label></a>
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
    <div class="divCategoria col-sm-5">
        <h4 class="text-center">Despesas</h4>
        <a href="contasapagarporgrupo">             <label class="text-center fontenormal row" for="">Contas a Pagar              &nbsp; </label></a>
        <a href="contasaidentificar">               <label class="text-center fontenormal row" for="">Contas a Identificar        &nbsp; </label></a>
        <a href="contaspagasporgrupo">              <label class="text-center fontenormal row" for="">Contas Pagas por Grupo      &nbsp; </label></a>
        <a href="despesasfixavariavel">             <label class="text-center fontenormal row" for="">Fixas/Variáveis             &nbsp; </label></a>
        <a href="fornecedor">                       <label class="text-center fontenormal row" for="">Fornecedor                  &nbsp; </label></a>
        <a href="notafiscalfornecedor">             <label class="text-center fontenormal row" for="">Nota Fiscal (Fornecedor)                &nbsp; </label></a>
        <a href="despesasporclienteanalitico">      <label class="text-center fontenormal row" for="">Por Cliente (Analítico)     &nbsp; </label></a>
        <a href="despesaspagasporcontabancaria">    <label class="text-center fontenormal row" for="">Por Conta Bancária          &nbsp; </label></a>
        <a href="despesasporos">                    <label class="text-center fontenormal row" for="">Por OS                      &nbsp; </label></a>
        <a href="despesasporosplanilha">            <label class="text-center fontenormal row" for="">Por OS - Planilha           &nbsp; </label></a>
        <a href="prolabore">                        <label class="text-center fontenormal row" for="">Pró-Labore                  &nbsp; </label></a>
        <a href="reembolso">                        <label class="text-center fontenormal row" for="">Reembolso                   &nbsp; </label></a>
        <a href="despesassinteticaporos">           <label class="text-center fontenormal row" for="">Sintética por OS            &nbsp; </label></a>
    </div>
</div>
<div class="row  justify-content-center mt-5">

<div class="divCategoria col-sm-5">
<h4 class="text-center">Ordem de Serviço</h4>
    <a href="oscadastradas"><label class="text-center fontenormal row" for="">Relatório OS Cadastradas  &nbsp; </label></a>
</div>

<div class="col-sm-1"></div>

<div class="divCategoria col-sm-5">
    <h4 class="text-center">Fechamento</h4>
    {{-- <a  class="d-flex justify-content-center" data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter" style="cursor: pointer; color: red;"><i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a> --}}
    <a href="#" data-toggle="modal" onclick="alteraRotaFormularioFluxo();" data-target="#exampleModalCenter"><label class="text-center fontenormal row"  for="">Fluxo de Caixa  &nbsp; </label></a>
    <a href="fechamentofinal"><label class="text-center fontenormal row" for="">Relatório Fechamento Final  &nbsp; </label></a>
    </div>
</div>
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