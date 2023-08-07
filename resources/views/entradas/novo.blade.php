<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada">Código de Barras</label>
    <div class="col-sm-7">
        <input type="text" class="form-control inputAumentado codbarras" name="codbarras" id="codbarras" placeholder="Código de Barras" 
        value="{{ $propriedadesEntradas->estoque->codbarras ?? $novaEntrada }}" readonly>
    </div>
</div>


<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label labelEvidenciada">Material</label>
    <div class="col-sm-5">
        <select class="selecionaComInput form-control" style="height: 200px !important" name="idbenspatrimoniais"
            id="descricaoMaterial" @if (isset($propriedadesEntradas)) disabled @endif onchange="handlePorcionavel()">
            @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                <option value="{{ $bensPatrimoniais->id }}"
                    @if (isset($propriedadesEntradas)) @if ($propriedadesEntradas->idbenspatrimoniais == $bensPatrimoniais->id) selected @endif @endif>
                    {{ $bensPatrimoniais->nomeBensPatrimoniais }}
                </option>
            @endforeach
        </select>
    </div>
    @if (isset($propriedadesEntradas))
    @else
        <div class="col-sm-3" id="telaCadastrarMateriais">
            <button type="button" onclick="recarregaDescricaoMaterial()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i
                    class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
        </div>
    @endif
</div>

@if ($tipoEntrada == 'novo' && (Route::currentRouteName() === 'entradas.create'))
    
<div class="form-group row">
    <label class="col-sm-2 col-form-label">É porcionável?</label>
    <div class="col-sm-7">
        <div class="form-check form-check-inline">
            {{ Form::radio('porcionavel', '1', false, ['class' => 'form-check-input', 'onchange' => 'handlePorcionavel()']) }}
            {{ Form::label('porcionavel', 'Sim', ['class' => 'form-check-label']) }}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::radio('porcionavel', '0', true, ['class' => 'form-check-input', 'onchange' => 'handlePorcionavel()']) }}
            {{ Form::label('porcionavel', 'Não', ['class' => 'form-check-label']) }}
        </div>
    </div>
</div>

<div class="form-group row">
    <div  class="form-group row" id="telaQuantidadeMateriais">

        {{ Form::label('quantidadeLabel', 'Quantidade', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-sm-7">
            {{ Form::text('qtdeEntrada', null, [
                'id' => 'qtdeEntrada', // Adiciona um id para manipulação via JavaScript
                'maxlength' => 7,
                'step' => 1,
                'class' => 'form-control col-sm-3',
                'onfocusout' => 'javascript: if (this.value < 1) this.value = 1; if (this.value.length >= 7) this.value = 1000000;',
                'oninput' => 'javascript: this.value = this.value.replace(/[^0-9]/g, "");',
            ]) }}
        </div>
    </div>
</div>
@endif
@isset($propriedadesEntradas->id)
    
<div class="form-group row">
    <label for="quantidadeShow" class="col-sm-2 col-form-label">Quantidade</label>
    <div class="col-sm-1">
        <input type="text" class="form-control" name="quantidadeShow" placeholder="Quantidade" maxlength="100"
            @if (isset($propriedadesEntradas)) value="{{ $propriedadesEntradas->quantidade_entrada }}" readonly @endif>
    </div>
</div>
@endisset

<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-7">
        <input type="text" class="form-control" name="descricaoentrada" placeholder="Descrição" maxlength="100"
            @if (isset($propriedadesEntradas)) value="{{ $propriedadesEntradas->descricaoentrada }}" readonly @endif>
    </div>
</div>

{!! Form::hidden('valorunitarioentrada', '0', [
    'placeholder' => 'Valor Unitário',
    'class' => 'form-control',
    'maxlength' => '100',
]) !!}

<script>
    function handlePorcionavel() {
        // Obtém o valor do input radio porcionavel
        var porcionavelValue = document.querySelector('input[name="porcionavel"]:checked').value;

        // Obtém o elemento input qtdeEntrada
        var inputQtdeEntrada = document.getElementById('telaQuantidadeMateriais');

        // Verifica se o item é porcionável (valor 1) ou não (valor 0)
        var porcionavel = (porcionavelValue === '1');

        // Oculta ou exibe o input e define o valor conforme porcionável
        if (porcionavel) {
            inputQtdeEntrada.style.display = 'contents';
            inputQtdeEntrada.value = ''; // Limpa o valor para entrada manual
        } else {
            inputQtdeEntrada.style.display = 'none';
            inputQtdeEntrada.value = 1; // Define o valor para 1
        }
    }

    // Executa a função handlePorcionavel ao carregar a página (caso esteja editando algum item)
    document.addEventListener('DOMContentLoaded', handlePorcionavel);
</script>
