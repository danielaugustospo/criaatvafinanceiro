<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada" style="color:red;">Código de Barras *</label>
    <div class="col-sm-7">

                @if (isset($propriedadesEntradas)) 
                    <input type="text" class="form-control" name="codbarras" placeholder="Cod Barras" maxlength="100" value="{{ $propriedadesEntradas->codbarras }}" readonly>
                @else
                    <select class="selecionaComInput  form-control" style="height: 200px !important" name="codbarras" id="codbarras"> 
                        <option value="">Selecione...</option>
                        @foreach ($listaInventarioaDevolver as $itensadevolver)
                            <option value="{{ $itensadevolver->id }}">
                                {{ $itensadevolver->codbarras }} &nbsp; - &nbsp; {{ $itensadevolver->nomematerial }}
                            </option>
                        @endforeach
                    </select>
                @endif
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