@php 
    $intervaloCelulas = "A1:F1"; 
    // $rotaapi = "apiextratocontarelatorio";
    $titulo  = "Conta Corrente";
    $campodata = 'dtoperacao';
    $contaSelecionada = $contaSelecionada; 
    $datainicial = $datainicial;
    $datafinal = $datafinal;

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
 <a  class="d-flex justify-content-center" data-toggle="modal" data-target="#exampleModalCenter" style="cursor: pointer; color: red;"><i class="fas fa-sync" ></i>Acessar Outra Conta</a>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

{{-- @include('despesas/filtroindex') --}}

<div id="filter-menu"></div>
<br /><br />
<div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;" >
       
    <div id="informacoes" class="d-flex justify-content-center">
        CONTA - PERÍODO @php echo date("d/m/Y", strtotime($datainicial)) . " até " . date("d/m/Y", strtotime($datafinal)) @endphp ATÉ {{$datafinal}} - SALDO INICIAL - SALDO FINAL 
    </div>
</div>

<script>

    @include('layouts/helpersview/iniciotabela')
    // pageable: false,
            dataSource: {
                data: data,
                // pageSize: 10000000,
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
                // { field: "id", title: "ID", filterable: true, width: 50 },
                { field: "dtoperacao", title: "Data", width: 100, format: "{0:dd/MM/yyyy}", filterable: false},
                { field: "historico", title: "Histórico", filterable: true, width: 200 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 100 },
                // { field: "conta", title: "Conta", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                // { field: "vencimento", title: "Vencimento", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                { field: "valorreceita", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Movimentações: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "saldo", title: "Saldo Após", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], format: '{0:0.00}' },
                // { field: "notaFiscal", title: "Nota Fiscal", filterable: true, width: 100 },
            ],

            @include('layouts/helpersview/finaltabela')
            @include('layouts/filtradata')
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