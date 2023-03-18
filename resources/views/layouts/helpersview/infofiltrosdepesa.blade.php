@php 
    $numberFormatter = new \NumberFormatter('pt-BR',\NumberFormatter::CURRENCY); 
    setlocale(LC_MONETARY, 'pt_BR');
@endphp
<div id="informacoes" class="d-flex justify-content-center">

    @if ($despesas == '' && $valor == '' && $dtinicio == '' && $dtfim == '' && $coddespesa == '' && $fornecedor == '' && $ordemservico == '' && $conta == '' && $notafiscal == '' && $cliente == '' && $fixavariavel == '' && $pago == ''&& $dtiniciolancamento == '' && $dtfimlancamento == '')
        <label class="pr-2" style="color: red;"><b>Não há filtros previamente selecionados</b></label>
    @else
        <label class="pr-2" style="color: red;"><b>Filtros:</b></label>
    @endif

    @if ($despesas != '')
        <label class="fontenormal"><b>Despesa:</b> {{ $despesas }} &nbsp; </label>
    @endif
    @if ($valor != '')
        <label class="fontenormal"><b>Valor:</b> {{ $numberFormatter->format($valor) }} &nbsp; </label>
    @endif
    @if ($dtinicio != '')
        <label class="fontenormal"><b>Data Inicial:</b> {{ date('d/m/Y', strtotime($dtinicio)) }} &nbsp; </label>
    @endif
    @if ($dtfim != '')
        <label class="fontenormal"><b>Data Final:</b> {{ date('d/m/Y', strtotime($dtfim)) }} &nbsp; </label>
    @endif
    @if ($coddespesa != '')
        <label class="fontenormal"><b>Cód de Despesa:</b> {{ $coddespesa }} &nbsp; </label>
    @endif
    @if ($fornecedor != '')
        <label class="fontenormal"><b>Fornecedor:</b> {{ $fornecedor }} &nbsp; </label>
    @endif
    @if ($ordemservico != '')
        <label class="fontenormal"><b>Ordem de Serviço:</b> {{ $ordemservico }} &nbsp; </label>
    @endif
    @if ($conta != '')
        <label class="fontenormal"><b>Conta:</b> {{ $conta }} &nbsp; </label>
    @endif
    @if ($notafiscal != '')
        <label class="fontenormal"><b>Nota Fiscal:</b> {{ $notafiscal }} &nbsp; </label>
    @endif
    @if ($cliente != '')
        <label class="fontenormal"><b>Cliente:</b> {{ $cliente }} &nbsp; </label>
    @endif
    @if ($fixavariavel != '')
        <label class="fontenormal"><b>Fixa ou Variável:</b> {{ $fixavariavel }} &nbsp; </label>
    @endif
    @if ($pago != '')
        <label class="fontenormal"><b>Pago:</b> {{ $pago }} &nbsp; </label>
    @endif
    @if ($dtiniciolancamento != '')
    <label class="fontenormal"><b>Dt Lançamento Inicial:</b> {{ date('d/m/Y', strtotime($dtiniciolancamento)) }} &nbsp; </label>
    @endif
    @if ($dtfimlancamento != '')
        <label class="fontenormal"><b>Dt Lançamento Final:</b> {{ date('d/m/Y', strtotime($dtfimlancamento)) }} &nbsp; </label>
    @endif




</div>
