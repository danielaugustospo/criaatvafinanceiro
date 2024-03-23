<div id="informacoes" class="d-flex justify-content-center">
   
    @if (($receita == '')
    && ($valorreceita == '')
    && ($dtinicio == '')
    && ($dtfim == '')
    && ($ordemservico == '')
    && ($contareceita == '')
    && ($nfreceita == '')
    && ($clienteExibicao == '')
    && ($pagoreceita == ''))
        <label class="pr-2" style="color: red;"><b>Não há filtros previamente selecionados</b></label>
    @else
        <label class="pr-2" style="color: red;"><b>Filtros:</b></label>
    @endif  
   
    @if ($receita != '')
        <label class="fontenormal"><b>Receita:</b> {{ $receita }} &nbsp; </label>
    @endif
    @if ($valorreceita != '')
        <label class="fontenormal"><b>Valor:</b> {{ $numberFormatter->format($valorreceita) }} &nbsp; </label>
    @endif
    @if ($dtinicio != '')
        <label class="fontenormal"><b>Data Inicial:</b> {{ date('d/m/Y', strtotime($dtinicio)) }} &nbsp; </label>
    @endif
    @if ($dtfim != '')
        <label class="fontenormal"><b>Data Final:</b> {{ date('d/m/Y', strtotime($dtfim)) }} &nbsp; </label>
    @endif

    @if ($ordemservico != '')
        <label class="fontenormal"><b>Ordem de Serviço:</b> {{ $ordemservico }} &nbsp; </label>
    @endif
    @if ($contareceita != '')
        <label class="fontenormal"><b>Conta:</b> {{ $contareceita }} &nbsp; </label>
    @endif
    @if ($nfreceita != '')
        <label class="fontenormal"><b>Nota Fiscal:</b> {{ $nfreceita }} &nbsp; </label>
    @endif
    @if ($clienteExibicao != '')
        <label class="fontenormal"><b>Cliente:</b> {{ $clienteExibicao }} &nbsp; </label>
    @endif
    @if ($pagoreceita != '')
        <label class="fontenormal"><b>Pago:</b> {{ $pagoreceita }} &nbsp; </label>
    @endif

</div>
