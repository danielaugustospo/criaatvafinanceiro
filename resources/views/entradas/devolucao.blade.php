<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada" style="color:red;">Material *</label>
    <div class="col-sm-7">

                @if (isset($propriedadesEntradas)) 


                    <input type="text" class="form-control" name="codbarras" placeholder="Cod Barras" maxlength="100" value="{{ $propriedadesEntradas->descricaoentrada }}" readonly>
                @else
                    <select class="selecionaComInput  form-control" style="height: 200px !important" name="idbenspatrimoniais" id="codbarras"> 
                        <option value="">Selecione...</option>

                        @foreach ($listaInventarioaDevolver->groupBy('estoque.idbenspatrimoniais') as $idEstoque => $itensadevolverGrouped)
                            @php

                                if(is_null($itensadevolverGrouped->sum('total_devolvido'))){
                                    $totalQuantidade = $itensadevolverGrouped->sum('quantidade_saida');
                                }else {
                                    $totalQuantidade = (($itensadevolverGrouped->sum('quantidade_saida')) - ($itensadevolverGrouped->sum('total_devolvido')));
                                }
                            @endphp
                            <option value="{{ $itensadevolverGrouped[0]->estoque->idbenspatrimoniais }}" data-max-quantity="{{ $totalQuantidade }}">
                                {{ $itensadevolverGrouped[0]->estoque->bensPatrimoniais->nomeBensPatrimoniais }} (Total na rua: {{ $totalQuantidade }})
                            </option>
                        @endforeach
                
                    </select>

                @endif
    </div>
</div>



<div class="">
    <div class="form-group row" id="telaQuantidadeMateriais">

        {{ Form::label('quantidadeLabel', 'Quantidade', ['class' => 'col-sm-2 col-form-label']) }}
        <div class="col-sm-4">
            {{ Form::text('quantidade_retorno', isset($propriedadesEntradas->quantidade_entrada) ? $propriedadesEntradas->quantidade_entrada : null, [
                'id' => 'quantidade_retorno', // Adiciona um id para manipulação via JavaScript
                'maxlength' => 7,
                'step' => 1,
                'class' => 'form-control col-sm-5',
                'onfocusout' => 'javascript: if (this.value < 1) this.value = 1; if (this.value.length >= 7) this.value = 1000000;',
                'oninput' => 'javascript: this.value = this.value.replace(/[^0-9]/g, "");',
                (isset($propriedadesEntradas->id) ? 'readonly' : '') // Adiciona 'readonly' se $saidas estiver definido
            ]) }}
            
        @if(!isset($propriedadesEntradas))<span class="text-danger">TOTAL NA RUA: <span id="maxQuantity"></span></span>@endif
        </div>

    </div>
</div>

<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-7">
        {{-- {!! Form::text('descricaoentrada', '', ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '100']) !!} --}}
        <input type="text" class="form-control" name="descricaoentrada" placeholder="Descrição" maxlength="100"
        @if (isset($propriedadesEntradas)) value="{{ $propriedadesEntradas->descricaoentrada }}" readonly @endif>
    </div>
</div>



<div class="form-group row">
    <label for="quemdevolveu" class="col-sm-2 col-form-label">Quem devolveu</label>
    <div class="col-sm-6">
        {{-- {!! Form::text('quemdevolveu', '', ['placeholder' => 'Quem devolveu', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'quemdevolveu']) !!} --}}
        <input type="text" class="form-control" name="quemdevolveu"  id="quemdevolveu" placeholder="Quem Devolveu" maxlength="50"
        @if (isset($propriedadesEntradas)) value="{{ $propriedadesEntradas->quemdevolveu }}" readonly @endif>
    </div>

    <label for="dtdevolucao" class="col-sm-2 col-form-label">Data de Retorno</label>
    <div class="col-sm-2">
        
        {{-- {!! Form::date('dtdevolucao', date("Y-m-d"), ['placeholder' => 'Data de Retorno', 'class' => 'form-control',  'id' => 'dtdevolucao']) !!} --}}
        <input type="date" class="form-control" name="dtdevolucao"  id="dtdevolucao" placeholder="Data de Retorno" maxlength="20"
        @if (isset($propriedadesEntradas)) value="{{ $propriedadesEntradas->dtdevolucao }}" readonly @else value="{{date("Y-m-d")}}" @endif>
    </div>
</div>


{!! Form::hidden('valorunitarioentrada', '0', ['placeholder' => 'Valor Unitário', 'class' => 'form-control', 'maxlength' => '2']) !!}
{!! Form::hidden('qtdeEntrada', '1', ['placeholder' => 'Quantidade', 'class' => 'form-control', 'maxlength' => '2']) !!}



<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Get references to the Select2 element and the span where the maximum quantity will be displayed
        const selectElement = $('#codbarras');
        const maxQuantitySpan = $('#maxQuantity');

        // Add an event listener to the Select2 element to detect changes
        selectElement.on('change', function() {
            // Get the selected option
            const selectedOption = selectElement.select2('data')[0];

            // Get the data attribute "max-quantity" from the selected option
            const maxQuantity = selectedOption.element.getAttribute('data-max-quantity');

            // Update the content of the maxQuantitySpan with the retrieved max quantity
            maxQuantitySpan.text(maxQuantity);
        });
    });
</script>