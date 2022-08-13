<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada">Código de Barras</label>
    <div class="col-sm-7">
        @if (isset($saidas))
            <input type="text" class="form-control inputAumentado" name="codbarras" placeholder="Cod Barras" maxlength="100"
                value="{{ $saidas->codbarras }}" readonly>
        @else
            <select class="selecionaComInput  form-control" style="height: 200px !important" name="codbarras"
                id="codbarras">
                <option value="">Selecione...</option>
                @foreach ($listaInventario as $itensestoque)
                    <option value="{{ $itensestoque->codbarras }}">
                        {{ $itensestoque->codbarras }} &nbsp; | &nbsp; {{ $itensestoque->nomeBensPatrimoniais }}
                    </option>
                @endforeach
            </select>
        @endif
        {{-- {!! Form::text('codbarras', '', ['placeholder' => 'Código de Barras', 'class' => 'form-control inputAumentado', 'maxlength' => '30']) !!} --}}

    </div>
</div>

<div class="form-group row">
    <label for="descricaosaida" class="col-sm-2 col-form-label">Descrição da Saída</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="descricaosaida" placeholder="Descrição da Saída" maxlength="50"
            @if (isset($saidas)) value="{{ $saidas->descricaosaida }}" readonly @endif>

        {{-- {!! Form::text('descricaosaida', '', ['placeholder' => 'Descrição da Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricaosaida']) !!} --}}
    </div>
</div>

{{-- <div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label" style="color: red;">Material</label>
    <div class="col-sm-7">
        <select name="idbenspatrimoniais" id="descricaoMaterial" class="selecionaComInput form-control"
            @if (isset($saidas)) disabled @endif>
            @foreach ($listaBensPatrimoniais as $bemPatrimonial)
                <option value=" {{ $bemPatrimonial->id }} "
                    @if (isset($saidas)) @if ($saidas->idbenspatrimoniais == $bemPatrimonial->id)
                                selected @endif
                    @endif>
                    {{ $bemPatrimonial->nomeBensPatrimoniais }}
                </option>
            @endforeach
        </select>
    </div>
    @if (Request::path() == 'entradas/create')
        <div class="col-sm-3" id="telaCadastrarMateriais">
            <button type="button" onclick="recarregaDescricaoMaterial()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i
                    class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
        </div>
    @endif
</div> --}}

<div class="form-group row">
    <label for="portadorsaida" class="col-sm-2 col-form-label">Portador Saída</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="portadorsaida" id="portadorsaida" placeholder="Portador Saída"
            maxlength="50" @if (isset($saidas)) value="{{ $saidas->portador }}" readonly @endif>

        {{-- {!! Form::text('portadorsaida', '', ['placeholder' => 'Portador Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!} --}}
    </div>
    <label for="ordemdeservico" class="col-sm-2 col-form-label">Ordem de Serviço</label>
    <div class="col-sm-2">
        <input type="text" class="form-control" name="ordemdeservico" id="ordemdeservico" placeholder="OS"
            maxlength="50" @if (isset($saidas)) value="{{ $saidas->ordemdeservico }}" readonly @endif>

        {{-- {!! Form::text('ordemdeservico', '', ['placeholder' => 'OS', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'ordemdeservico']) !!} --}}
    </div>
</div>

<div class="form-group row">
    <label for="datapararetiradasaida" class="col-sm-2 col-form-label">Data Agendada P/ Retirada</label>
    <div class="col-sm-2">
        <input type="date" class="form-control" name="datapararetiradasaida" id="datapararetiradasaida"
            placeholder="Data Para Retirada" maxlength="20"
            @if (isset($saidas)) value="{{ $saidas->datapararetirada }}" readonly @else value="{{ date('Y-m-d') }}" @endif>

        {{-- {!! Form::date('datapararetiradasaida',  date("Y-m-d"), ['placeholder' => 'Data Para Retirada', 'class' => 'form-control', 'id' => 'datapararetiradasaida']) !!} --}}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data da Retirada</label>
    <div class="col-sm-2">
        <input type="date" class="form-control" name="dataretiradasaida" id="dataretiradasaida"
            placeholder="Data da Retirada Saída" maxlength="20"
            @if (isset($saidas)) value="{{ $saidas->dataretirada }}" readonly @else value="{{ date('Y-m-d') }}" @endif>

        {{-- {!! Form::date('dataretiradasaida',  date("Y-m-d"), ['placeholder' => 'Data da Retirada Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!} --}}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data Prevista de Retorno</label>
    <div class="col-sm-2">
        <input type="date" class="form-control" name="dataretornoretiradasaida" id="dataretornoretiradasaida"
            placeholder="Data de Retorno Saída" maxlength="20"
            @if (isset($saidas)) value="{{ $saidas->datapararetorno }}" readonly @else value="{{ date('Y-m-d') }}" @endif>

        {{-- {!! Form::date('dataretornoretiradasaida', '', ['placeholder' => 'Data de Retorno Saída', 'class' => 'form-control',  'id' => 'dataretornoretiradasaida']) !!} --}}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Ocorrências</label>
    <div class="col-sm-12">
        <textarea placeholder="Ocorrências" class="form-control col-sm-12" maxlength="100" id="ocorrenciasaida"
            name="ocorrenciasaida" cols="50" rows="10"
            @if (isset($saidas)) value="{{ $saidas->ocorrenciasaida }}" readonly @endif></textarea>

        {{-- {!! Form::textarea('ocorrenciasaida', '', ['placeholder' => 'Ocorrências', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'id' => 'ocorrenciasaida']) !!} --}}
    </div>
</div>
