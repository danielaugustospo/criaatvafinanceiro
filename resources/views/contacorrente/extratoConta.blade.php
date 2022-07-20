@php 
    $intervaloCelulas = "A1:G1"; 
    // $rotaapi = "apiextratocontarelatorio";
    $titulo  = "Conta Corrente";
    $campodata = 'dtoperacao';
    $contaSelecionada = $contaSelecionada; 
    $datainicial = $datainicial;
    $datafinal = $datafinal;
    $conta          = $conta;
    $saldoInicial   = $saldoInicial;
    $saldoFinal     = $saldoFinal;
    $contacorrente     = 1;
    $relatorioKendoGrid = true;

    $urlContaCorrente = route('apiextratocontarelatorio');

@endphp
<head>
    <meta charset="utf-8">
    <title>{{$titulo}}</title>
</head>

@extends('layouts.app')

@section('content')
@can('visualiza-contacorrente')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            @php if($contaSelecionada == ""): echo "<label class='text-center' style='color:red;'>AVISO: Conta não informada. Relatório não pode ser gerado. Tente novamente a partir da página inicial</label>"; endif; @endphp

            <h2 class="text-center"> <img src="img/credit-card.png" style="width: 50px;" alt="">{{$titulo}}</h2>
        </div>
    </div>
</div>
 <a  class="d-flex justify-content-center" data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter" style="cursor: pointer; color: red;"><i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

{{-- @include('despesas/filtroindex') --}}

<div id="filter-menu"></div>
<br /><br />
<div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;" >
       
    <div id="informacoes" class="d-flex justify-content-center" >
        <label class="fontenormal">Conta: <b style="color: red;"> {{$conta}}  </b> - Período 
            @php 
            $numberFormatter = new \NumberFormatter('pt-BR',\NumberFormatter::CURRENCY); 
            echo '<b style="color: red;"> '. date("d/m/Y", strtotime($datainicial)) .' </b>' . " até " . '<b style="color: red;">' . date("d/m/Y", strtotime($datafinal)) . ' </b>'; 
            setlocale(LC_MONETARY, 'pt_BR');
            echo ' - Saldo Inicial:  <b style="color: red;">' . $numberFormatter->format($saldoInicial) .'</b>';
            echo ' - Saldo Final:    <b style="color: red;">' . $numberFormatter->format($saldoFinal)  .'</b>';
            @endphp 
        </label>
    </div>
</div>

<script>

    @include('layouts/helpersview/iniciotabela')
    pageable: true,
            dataSource: {
                data: data,
                pageSize: 50,
                schema: {
                    model: {
                        fields: {
                            dtoperacao: { type: "date" },
                            valorreceita: { type: "number" },
                            saldo: { type: "number" },
                            conta: { type: "string" },
                        }
                    },
                },

                group: {
                    field: "conta", aggregates: [
                        { field: "conta", aggregate: "count" },
                        { field: "valorreceita", aggregate: "sum" },
                        // { field: "saldoinicial", aggregate: "sum" },
                    ]
                },
                aggregate: [{ field: "conta", aggregate: "count" },
                { field: "valorreceita", aggregate: "sum" }],
                sort: [
                    // sort by "category" in descending order and then by "name" in ascending order
                    { field: "dtoperacao", dir: "asc" },
                    // { field: "name", dir: "asc" }
                ],

            },

            columns: [
                { field: "id", title: "ID", filterable: true, width: 80 },
                { field: "dtoperacao", title: "Data",  format: "{0:dd/MM/yyyy}", width: 80  , filterable: false},
                { field: "historico", title: "Histórico", filterable: true, width: 180  },
                { field: "nomeFormaPagamento", title: "Forma PG", filterable: true,  width: 100  },
                // { field: "conta", title: "Conta", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                // { field: "vencimento", title: "Vencimento", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                { field: "valorreceita", title: "Valor", filterable: true,  width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Mov.: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                
                // Retirada solicitada pelo Nelio dia 30/04/2022
                { field: "saldo", title: "Saldo", filterable: true,  width: 80, decimals: 2, aggregates: ["sum"], format: '{0:0.00}', groupHeaderColumnTemplate: '@php $numberFormatter = new \NumberFormatter('pt-BR',\NumberFormatter::CURRENCY); echo ' SALDO INICIAL:' . $numberFormatter->format($saldoInicial); @endphp', footerTemplate: '@php echo ' SALDO FINAL:' . $numberFormatter->format($saldoFinal); @endphp' },
                
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



@endsection  