<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada">Material</label>
    <div class="col-sm-7">
        
        @if (isset($saidas))
        <input type="text" class="form-control inputAumentado" name="idbenspatrimoniais" placeholder="Material" maxlength="100" value="{{ $saidas->estoque->bensPatrimoniais->nomeBensPatrimoniais }}" readonly>
        @else
        <select class="selecionaComInput form-control" style="height: 200px !important" name="idbenspatrimoniais" id="codbarras">
            <option value="" data-max-quantity="">Selecione...</option>
            @foreach ($listaInventario as $itensestoque)
            <option value="{{ $itensestoque->idbenspatrimoniais }}" data-max-quantity="{{ $itensestoque->quantidade }}">
                {{ $itensestoque->nomeBensPatrimoniais }} &nbsp; | TOTAL NO ESTOQUE: &nbsp; {{ $itensestoque->quantidade }}
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
            {{ Form::text('quantidade_saida', isset($saidas->quantidade_saida) ? $saidas->quantidade_saida : null, [
                'id' => 'quantidade_saida', // Adiciona um id para manipulação via JavaScript
                'maxlength' => 7,
                'step' => 1,
                'class' => 'form-control col-sm-5',
                'onfocusout' => 'javascript: if (this.value < 1) this.value = 1; if (this.value.length >= 7) this.value = 1000000;',
                'oninput' => 'javascript: this.value = this.value.replace(/[^0-9]/g, "");',
                (isset($saidas) ? 'readonly' : '') // Adiciona 'readonly' se $saidas estiver definido
            ]) }}
            
        @if(!isset($saidas))<span class="text-danger">TOTAL NO ESTOQUE: <span id="maxQuantity"></span></span>@endif
        </div>
        <label for="dataretornoretiradasaida" class="col-sm-1 col-form-label text-danger">Previsão Retorno</label>
        @if(!isset($saidas))
            <button tabindex="0" class="btn btn-sm btn-danger popoverButton" role="button" data-toggle="popover" data-trigger="focus" title="O que significa isso?" data-content="A previsão de retorno indica que este item deve voltar ao estoque em algum momento. Informe a data nesse campo para que o item apareça na opção de itens a devolver."><i class="fas fa-info-circle"></i>
            </button>     
        @endif   
        <div class="col-sm-2">
            <input type="date" class="form-control" name="dataretornoretiradasaida" id="dataretornoretiradasaida" placeholder="Data de Retorno Saída" maxlength="20" @if (isset($saidas)) value="{{ $saidas->datapararetorno }}" readonly @else value="" @endif>
        </div>
    </div>
</div>

    <div class="form-group row">
        <label for="descricaosaida" class="col-sm-2 col-form-label">Descrição da Saída</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="descricaosaida" placeholder="Descrição da Saída" maxlength="50" @if (isset($saidas)) value="{{ $saidas->descricaosaida }}" readonly @endif>

            {{-- {!! Form::text('descricaosaida', '', ['placeholder' => 'Descrição da Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricaosaida']) !!} --}}
        </div>
    </div>



    <div class="form-group row">
        <label for="portadorsaida" class="col-sm-2 col-form-label">Portador Saída</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="portadorsaida" id="portadorsaida" placeholder="Portador Saída" maxlength="50" @if (isset($saidas)) value="{{ $saidas->portador }}" readonly @endif>

            {{-- {!! Form::text('portadorsaida', '', ['placeholder' => 'Portador Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!} --}}
        </div>
        <label for="ordemdeservico" class="col-sm-2 col-form-label">Ordem de Serviço</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="ordemdeservico" id="ordemdeservico" placeholder="OS" maxlength="50" @if (isset($saidas)) value="{{ $saidas->ordemdeservico }}" readonly @endif>

            {{-- {!! Form::text('ordemdeservico', '', ['placeholder' => 'OS', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'ordemdeservico']) !!} --}}
        </div>
    </div>

    <div class="form-group row">
        <label for="datapararetiradasaida" class="col-sm-2 col-form-label">Data Agendada P/ Retirada</label>
        <div class="col-sm-2">
            <input type="date" class="form-control" name="datapararetiradasaida" id="datapararetiradasaida" placeholder="Data Para Retirada" maxlength="20" @if (isset($saidas)) value="{{ $saidas->datapararetirada }}" readonly @else value="{{ date('Y-m-d') }}" @endif>

            {{-- {!! Form::date('datapararetiradasaida',  date("Y-m-d"), ['placeholder' => 'Data Para Retirada', 'class' => 'form-control', 'id' => 'datapararetiradasaida']) !!} --}}
        </div>
        <label for="dataretiradasaida" class="col-sm-2 col-form-label">Data Efetiva da Retirada</label>
        <div class="col-sm-2">
            <input type="date" class="form-control" name="dataretiradasaida" id="dataretiradasaida" placeholder="Data da Retirada Saída" maxlength="20" @if (isset($saidas)) value="{{ $saidas->dataretirada }}" readonly @else value="{{ date('Y-m-d') }}" @endif>

            {{-- {!! Form::date('dataretiradasaida',  date("Y-m-d"), ['placeholder' => 'Data da Retirada Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!} --}}
        </div>

    </div>

    <div class="form-group row">
        <label for="ocorrencia" class="col-sm-2 col-form-label">Ocorrências</label>
        <div class="col-sm-12">
            <textarea placeholder="Ocorrências" class="form-control col-sm-12" maxlength="100" id="ocorrencia" name="ocorrencia" cols="50" rows="10" @if (isset($saidas)) readonly @endif>@if (isset($saidas)) {{ $saidas->ocorrencia }}  @endif</textarea>

            {{-- {!! Form::textarea('ocorrencia', '', ['placeholder' => 'Ocorrências', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'id' => 'ocorrencia']) !!} --}}
        </div>
    </div>


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