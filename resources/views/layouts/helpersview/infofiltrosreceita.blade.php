<div id="informacoes" class="d-flex justify-content-center">
    <label class="pr-2" style="color: red;">Filtros:</label>
    @if ($receita != '')
        <label><b>Receita:</b> {{ $receita }} &nbsp; </label>
    @endif
    @if ($valorreceita != '')
        <label><b>Valor:</b> {{ $numberFormatter->format($valorreceita) }} &nbsp; </label>
    @endif
    @if ($dtinicio != '')
        <label><b>Data Inicial:</b> {{ date('d/m/Y', strtotime($dtinicio)) }} &nbsp; </label>
    @endif
    @if ($dtfim != '')
        <label><b>Data Final:</b> {{ date('d/m/Y', strtotime($dtfim)) }} &nbsp; </label>
    @endif

    @if ($ordemservico != '')
        <label><b>Ordem de Serviço:</b> {{ $ordemservico }} &nbsp; </label>
    @endif
    @if ($contareceita != '')
        <label><b>Conta:</b> {{ $contareceita }} &nbsp; </label>
    @endif
    @if ($nfreceita != '')
        <label><b>Nota Fiscal:</b> {{ $nfreceita }} &nbsp; </label>
    @endif
    @if ($cliente != '')
        <label><b>Cliente:</b> {{ $cliente }} &nbsp; </label>
    @endif
    @if ($pagoreceita != '')
        <label><b>Pago:</b> {{ $pagoreceita }} &nbsp; </label>
    @endif

</div>