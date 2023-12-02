<div id="informacoes" class="d-flex justify-content-center">

    @if ($codbarras == '' && $descricaosaida == '' && $nomeBensPatrimoniais == '' && $portador == '' && $ordemdeservico == '' && $dataretiradainicial == '' && $dataretiradafinal == '' && $datapararetornoinicial == '' && $datapararetornofinal == ''  && $dataprevistaretornoinicial == '' && $dataprevistaretornofinal == '')
        <label class="pr-2" style="color: red;"><b>Não há filtros previamente selecionados</b></label>
    @else
        <label class="pr-2" style="color: red;"><b>Filtros:</b></label>
    @endif
    
    @if ($codbarras != '')
        <label class="fontenormal"><b>Cód Barras:</b> {{ $codbarras }} &nbsp; </label>
    @endif
    @if ($descricaosaida != '')
        <label class="fontenormal"><b>Descrição:</b> {{ $descricaosaida }} &nbsp; </label>
    @endif
    @if ($nomeBensPatrimoniais != '')
        <label class="fontenormal"><b>Material:</b> {{ $nomeBensPatrimoniais }} &nbsp; </label>
    @endif
    @if ($portador != '')
        <label class="fontenormal"><b>Portador:</b> {{ $portador }} &nbsp; </label>
    @endif
    @if ($ordemdeservico != '')
        <label class="fontenormal"><b>OS:</b> {{ $ordemdeservico }} &nbsp; </label>
    @endif

    @if ($dataretiradainicial != '')
        <label class="fontenormal"><b>Data Retirada Inicial:</b> {{ date('d/m/Y', strtotime($dataretiradainicial)) }} &nbsp; </label>
    @endif
    @if ($dataretiradafinal != '')
        <label class="fontenormal"><b>Data Retirada Final:</b> {{ date('d/m/Y', strtotime($dataretiradafinal)) }} &nbsp; </label>
    @endif
    @if ($datapararetornoinicial != '')
        <label class="fontenormal"><b>Data P/ Retorno Inicial:</b> {{ date('d/m/Y', strtotime($datapararetornoinicial)) }} &nbsp; </label>
    @endif
    @if ($datapararetornofinal != '')
        <label class="fontenormal"><b>Data P/ Retorno Final:</b> {{ date('d/m/Y', strtotime($datapararetornofinal)) }} &nbsp; </label>
    @endif
    @if ($dataprevistaretornoinicial != '')
        <label class="fontenormal"><b>Data Prevista P/ Retorno Inicial:</b> {{ date('d/m/Y', strtotime($dataprevistaretornoinicial)) }} &nbsp; </label>
    @endif
    @if ($dataprevistaretornofinal != '')
        <label class="fontenormal"><b>Data Prevista P/ Retorno Final:</b> {{ date('d/m/Y', strtotime($dataprevistaretornofinal)) }} &nbsp; </label>
    @endif






</div>
