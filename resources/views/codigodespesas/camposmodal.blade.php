@include('layouts/modal/includesmodal')

@if (isset($mensagem))
<div class="alert alert-success" role="alert">
    <p>{{ $mensagem }}</p>
</div>
@endif

{!! Form::open(array('route' => 'cadastrocodigodespesa','method'=>'POST')) !!}

<!-- <div class="form-group row">
    <label for="idGrupoCodigoDespesa" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-2">
        {!! Form::text('idGrupoCodigoDespesa', '', ['placeholder' => 'Código Despesa', 'class' => 'form-control', 'maxlength' => '20']) !!}

    </div>
</div> -->
<div class="form-group row">
    <label for="despesaCodigoDespesa" class="col-sm-2 col-form-label">Tipo de Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('despesaCodigoDespesa', '', ['placeholder' => 'Tipo de Despesa', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'despesaCodigoDespesa']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="idGrupoCodigoDespesa" class=" col-sm-2 col-form-label">Selecione o Grupo</label>
    <div class="col-sm-10">
        <!-- {!! Form::text('despesaCodigoDespesa', '', ['placeholder' => 'Tipo de Despesa', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'despesaCodigoDespesa']) !!} -->
        <select name="idGrupoCodigoDespesa" id="idGrupoCodigoDespesa" class="selecionaComInput" style="position: absolute !important;
        overflow: visible !important;">
        @foreach ($listaGrupoDespesas as $grupoDespesa)
            <option value="{{ $grupoDespesa->id }}">Código: {{ $grupoDespesa->id }} - Grupo: {{ $grupoDespesa->grupoDespesa }}</option>
        @endforeach
        </select>
    </div>
</div>

@include('despesas/criagrupodespesa')
<input type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" value="Adicionar Grupo Despesa" style="cursor: pointer;">

{!! Form::hidden('ativoCodigoDespesa', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoCodigoDespesa']) !!}
{!! Form::hidden('excluidoCodigoDespesa', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoCodigoDespesa']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}