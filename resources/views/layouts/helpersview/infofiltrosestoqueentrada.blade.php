<div id="informacoes" class="d-flex justify-content-center">

    @if ($codbarras == '' && $nomeBensPatrimoniais == '' && $descricaoentrada == '' && $dtinicio == '' && $dtfim == '')
        <label class="pr-2" style="color: red;"><b>Não há filtros previamente selecionados</b></label>
    @else
        <label class="pr-2" style="color: red;"><b>Filtros:</b></label>
    @endif

    @if ($codbarras != '')
        <label class="fontenormal"><b>Cód Barras:</b> {{ $codbarras }} &nbsp; </label>
    @endif
    @if ($nomeBensPatrimoniais != '')
        <label class="fontenormal"><b>Material:</b> {{ $nomeBensPatrimoniais }} &nbsp; </label>
    @endif
    @if ($descricaoentrada != '')
        <label class="fontenormal"><b>Descrição:</b> {{ $descricaoentrada }} &nbsp; </label>
    @endif
    @if ($tipoEntrada != '')
        <label class="fontenormal"><b>Tipo Entrada:</b> {{ $tipoEntrada }} &nbsp; </label>
    @endif
    @if ($dtinicio != '')
        <label class="fontenormal"><b>Data Inicial:</b> {{ date('d/m/Y', strtotime($dtinicio)) }} &nbsp; </label>
    @endif
    @if ($dtfim != '')
        <label class="fontenormal"><b>Data Final:</b> {{ date('d/m/Y', strtotime($dtfim)) }} &nbsp; </label>
    @endif

</div>
