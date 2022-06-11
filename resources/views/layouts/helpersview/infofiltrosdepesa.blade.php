<div id="informacoes" class="d-flex justify-content-center">
    <label class="pr-2" style="color: red;">Filtros:</label>
    @if ($despesas != '')
        <label><b>Despesa:</b> {{ $despesas }} &nbsp; </label>
    @endif
    @if ($valor != '')
        <label><b>Valor:</b> {{ $numberFormatter->format($valor) }} &nbsp; </label>
    @endif
    @if ($dtinicio != '')
        <label><b>Data Inicial:</b> {{ date('d/m/Y', strtotime($dtinicio)) }} &nbsp; </label>
    @endif
    @if ($dtfim != '')
        <label><b>Data Final:</b> {{ date('d/m/Y', strtotime($dtfim)) }} &nbsp; </label>
    @endif
    @if ($coddespesa != '')
        <label><b>Cód de Despesa:</b> {{ $coddespesa }} &nbsp; </label>
    @endif
    @if ($fornecedor != '')
        <label><b>Fornecedor:</b> {{ $fornecedor }} &nbsp; </label>
    @endif
    @if ($ordemservico != '')
        <label><b>Ordem de Serviço:</b> {{ $ordemservico }} &nbsp; </label>
    @endif
    @if ($conta != '')
        <label><b>Conta:</b> {{ $conta }} &nbsp; </label>
    @endif
    @if ($notafiscal != '')
        <label><b>Nota Fiscal:</b> {{ $notafiscal }} &nbsp; </label>
    @endif
    @if ($cliente != '')
        <label><b>Cliente:</b> {{ $cliente }} &nbsp; </label>
    @endif
    @if ($fixavariavel != '')
        <label><b>Fixa ou Variável:</b> {{ $fixavariavel }} &nbsp; </label>
    @endif
    @if ($pago != '')
        <label><b>Pago:</b> {{ $pago }} &nbsp; </label>
    @endif

</div>