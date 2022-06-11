<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada" style="color:red;">Código de Barras *</label>
    <div class="col-sm-7">
        {{-- {!! Form::text('codbarras', '', ['placeholder' => 'Código de Barras', 'class' => 'form-control inputAumentado', 'maxlength' => '30']) !!} --}}
        <select class="selecionaComInput  form-control" style="height: 200px !important" name="codbarras"
            id="codbarras">
            <option value="">Selecione...</option>
            @foreach ($listaInventarioaDevolver as $itensadevolver)
                <option value="{{ $itensadevolver->id }}">{{ $itensadevolver->codbarras }} &nbsp; - &nbsp; {{ $itensadevolver->nomematerial }}</option>
            @endforeach
        </select>
    </div>
</div>
{{-- <div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label labelEvidenciada">Material</label>
    <div class="col-sm-7">

        <select class="selecionaComInput  form-control" style="height: 200px !important" name="idbenspatrimoniais"
            id="descricaoMaterial">
            <option>Selecione...</option>
            @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-3" id="telaCadastrarMateriais">
        <button type="button" onclick="recarregaDescricaoMaterial()" class="btn btn-dark"><i
                class="fas fa-sync"></i></i></button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i
                class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
    </div>

</div> --}}



<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-7">
        {!! Form::text('descricaoentrada', '', ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>



<div class="form-group row">
    <label for="quemdevolveu" class="col-sm-2 col-form-label">Quem devolveu</label>
    <div class="col-sm-6">
        {!! Form::text('quemdevolveu', '', ['placeholder' => 'Quem devolveu', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'quemdevolveu']) !!}
    </div>

    <label for="dtdevolucao" class="col-sm-2 col-form-label">Data de Retorno</label>
    <div class="col-sm-2">
        
        {!! Form::date('dtdevolucao', date("Y-m-d"), ['placeholder' => 'Data de Retorno', 'class' => 'form-control',  'id' => 'dtdevolucao']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="ocorrenciadevolucao" class="col-sm-2 col-form-label">Ocorrências</label>
    <div class="col-sm-12">
        {!! Form::textarea('ocorrenciadevolucao', '', ['placeholder' => 'Ocorrências', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'id' => 'ocorrenciadevolucao']) !!}
    </div>
</div>
{!! Form::hidden('valorunitarioentrada', '0', ['placeholder' => 'Valor Unitário', 'class' => 'form-control', 'maxlength' => '2']) !!}
{!! Form::hidden('qtdeEntrada', '1', ['placeholder' => 'Quantidade', 'class' => 'form-control', 'maxlength' => '2']) !!}