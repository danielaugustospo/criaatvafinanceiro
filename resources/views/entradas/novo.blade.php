<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada">Código de Barras</label>
    <div class="col-sm-7">
        {!! Form::text('codbarras', '', ['placeholder' => 'Código de Barras', 'class' => 'form-control inputAumentado', 'maxlength' => '30']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label labelEvidenciada">Material</label>
    <div class="col-sm-7">

        <select class="selecionaComInput  form-control" style="height: 200px !important" name="idbenspatrimoniais"
            id="descricaoMaterial">
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

</div>



<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-7">
        {!! Form::text('descricaoentrada', '', ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>



{{-- <div class="form-group row">
    <label for="qtdeEntrada" class="col-sm-2 col-form-label">Quantidade</label>
    <div class="col-sm-2">
        {!! Form::number('qtdeEntrada', '', ['placeholder' => 'Quantidade', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div> --}}
{!! Form::hidden('valorunitarioentrada', '0', ['placeholder' => 'Valor Unitário', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('qtdeEntrada', '1', ['placeholder' => 'Quantidade', 'class' => 'form-control', 'maxlength' => '100']) !!}
