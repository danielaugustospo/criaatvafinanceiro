@php 
    $intervaloCelulas = "A1:F1"; 
    // $rotaapi = "apiextratocontarelatorio";
    $titulo  = "Fluxo de Caixa Sintético";
    $campodata = 'dtoperacao';
    $contaSelecionada = $contaSelecionada; 
    $datainicial      = $datainicial;
    $datafinal        = '0';
    $relatorioKendoGrid = true;
    // $conta            = $conta;
    // $saldoInicial     = $saldoInicial;
    // $saldoFinal       = $saldoFinal;
    // $contacorrente    = 1;

    $urlContaCorrente = route('apifluxodecaixa');

@endphp


<head>
    <meta charset="utf-8">
    <title>{{$titulo}}</title>
</head>

@extends('layouts.app')

@section('content')
@can('relatorio-list')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            @php if($contaSelecionada == ""): echo "<label class='text-center' style='color:red;'>AVISO: Conta não informada. Relatório não pode ser gerado. Tente novamente a partir da página inicial</label>"; endif; @endphp

            <h2 class="text-center"><img src="img/transfer.png" style="width: 50px;" alt=""> {{$titulo}}</h2>
        </div>
    </div>
</div>
 <a  class="d-flex justify-content-center" data-toggle="modal" data-target="#exampleModalCenter" style="cursor: pointer; color: red;"><i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif



<div class="container">
    <table class="table table-bordered table-sm table-dark">
        <tr>Fluxo - Mês XPTO</tr>
        <tr><td colspan="2">Contas</td><td>Valor</td>  </tr>
        <tr><td>XPTO</td><td>C1</td><td>R$50</td>  </tr>
        <tr><td>XPTO2</td><td>C2</td><td>R$45</td>  </tr>
        <tr><td>XPTO3</td><td>C3</td><td>R$34</td>  </tr>
        <tr><td>XPTO4</td><td>C4</td><td>R$52</td>  </tr>
    </table>

    <table class="table table-bordered table-sm table-dark">
        <tr>Resumo Final</tr>
        <tr><td>XPTO </td>  <td>R$50</td>  </tr>
        <tr><td>XPTO2</td>  <td>R$45</td>  </tr>
        <tr><td>XPTO3</td>  <td>R$34</td>  </tr>
        <tr><td>XPTO4</td>  <td>R$52</td>  </tr>
        <tr><td>Saldo Contas</td>  <td>R$5221</td>  </tr>
        <tr><td>Total</td>  <td>R$4252</td>  </tr>
        <tr><td>A Pagar</td>  <td>R$5243</td>  </tr>
        <tr><td>Saldo</td>  <td>R$2043</td>  </tr>
    </table>
    <table class="table table-bordered table-sm table-dark">
        <tr>A Receber</tr>
        <tr><td>Cliente</td>  <td>Data</td><td>Valor/NF</td><td>Liquído</td><td>Recebido</td><td>NF</td><td>OS</td><td>Conta</td>  </tr>
        <tr><td>Ifood</td>  <td>20/04</td><td>120.000,00</td><td></td><td></td><td>306</td><td>325</td><td>C1</td>  </tr>
        <tr><td>Ótima</td>  <td>20/04</td><td>120.000,00</td><td></td><td></td><td>306</td><td>325</td><td>C3</td>  </tr>
        <tr><td>Riggar</td> <td>20/04</td><td>120.000,00</td><td></td><td></td><td>306</td><td>325</td><td>C2</td>  </tr>
        <tr class="bg-primary"><td colspan="2">A Receber</td><td>360.000,00</td></tr>
    </table>
</div>


{{-- @include('despesas/filtroindex') --}}

<div id="filter-menu"></div>
<br /><br />
<div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;" >
       
    <div id="informacoes" class="d-flex justify-content-center" style="color: red;">
        CONTA:  - PERÍODO 
        @php 
        // echo date("d/m/Y", strtotime($datainicial)) . " até " . date("d/m/Y", strtotime($datafinal)); 
        // setlocale(LC_MONETARY, 'pt_BR');
        // echo ' SALDO INICIAL:' . money_format('%.2n', $saldoInicial);
        // echo ' SALDO FINAL:' . money_format('%.2n', $saldoFinal);
        @endphp 
    </div>
</div>

<script>

    @include('layouts/helpersview/iniciotabela')
@can('visualiza-relatoriogeral')
    pageable: true,
            dataSource: {
                data: data,
                pageSize: 50,
                schema: {
                    model: {
                        fields: {
                            dtoperacao: { type: "date" },
                            primeiromes: { type: "number" },
                            segundomes: { type: "number" },
                            terceiromes: { type: "number" },
                            // saldo: { type: "number" },
                            conta: { type: "string" },
                        }
                    },
                },

                group: {
                    field: "conta", aggregates: [
                        { field: "conta", aggregate: "count" },
                        { field: "primeiromes", aggregate: "sum" },
                        { field: "segundomes", aggregate: "sum" },
                        { field: "terceiromes", aggregate: "sum" },
                        // { field: "saldoinicial", aggregate: "sum" },
                    ]
                },
                aggregate: [{ field: "conta", aggregate: "count" },
                { field: "primeiromes", aggregate: "sum" },
                { field: "segundomes", aggregate: "sum" },
                { field: "terceiromes", aggregate: "sum" },
            ],
                sort: [
                    // sort by "category" in descending order and then by "name" in ascending order
                    { field: "dtoperacao", dir: "asc" },
                    // { field: "name", dir: "asc" }
                ],

            },

            columns: [
                // { field: "id", title: "ID", filterable: true, width: 50 },
                { field: "dtoperacao", title: "Dia",  format: "{0:dd/MM/yyyy}", width: 100  , filterable: false},
                { field: "historico", title: "Histórico", filterable: true, width: 500  },
                { field: "primeiromes", title: "Primeiro Mês", filterable: true,    width: 150,decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Movimentações: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "segundomes", title: "Segundo Mês", filterable:   true,      width: 150,decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Movimentações: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "terceiromes", title: "Terceiro Mês", filterable: true,    width: 150,decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Movimentações: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                // { field: "conta", title: "Conta", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                // { field: "vencimento", title: "Vencimento", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                // { field: "valorreceita", title: "Valor", filterable: true,  width: 250, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Movimentações: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                // { field: "saldo", title: "Saldo Após", filterable: true,  width: 250, decimals: 2, aggregates: ["sum"], format: '{0:0.00}', groupHeaderColumnTemplate: '@php  // echo ' SALDO INICIAL:' . money_format('%.2n', $saldoInicial); @endphp', footerTemplate: '@php // echo ' SALDO FINAL:' . money_format('%.2n', $saldoFinal); @endphp' },
                // { field: "notaFiscal", title: "Nota Fiscal", filterable: true, width: 100 },
            ],

            @include('layouts/helpersview/finaltabela')
           
</script>

@else
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Não Autorizado</h2>
        </div>
    </div>
</div>
@endcan

@else  
@include('layouts/helpersview/finalnaoautorizado')
@endcan
@endsection  