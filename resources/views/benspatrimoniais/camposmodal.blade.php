@include('layouts/modal/includesmodal')

@if (isset($mensagem))
    <div class="alert alert-success" role="alert">
        <p>{{ $mensagem }}</p>
    </div>
@endif


{!! Form::open(['route' => 'cadastromateriais', 'method' => 'POST']) !!}
{!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}

<div class="form-group row">
    <label for="nomeBensPatrimoniais" class="col-sm-2 col-form-label">Descrição do Material </label>
    <div class="col-sm-10">
        {!! Form::text('nomeBensPatrimoniais', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="qtdestoqueminimo" class="col-sm-2 col-form-label">Estoque Mínimo</label>
    <div class="col-sm-5">
        <input type="number" class="form-control" name="qtdestoqueminimo" id="qtdestoqueminimo">
    </div>
</div>

<div class="form-group row">
    <label for="idTipoBensPatrimoniais" class="col-sm-1 col-form-label">Tipo</label>
    <div class="col-sm-10">
        <select name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais" class="selecionaComInput form-control">
            @foreach ($listaTiposBensPatrimoniais as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="unidademedida" class="col-sm-2 col-form-label">Unidade</label>
    <div class="col-sm-6">
        <select name="unidademedida" id="unidademedida" class="selecionaComInput form-control">
            @if (!isset($benspatrimoniais->unidademedida))
            <option selected>Selecione</option>
            @endif
            @foreach ($listaUnidadeMedida as $unidade)
                <option value="{{ $unidade->id }}">{{ $unidade->sigla }} | {{ $unidade->nomeunidade }} </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="estante" class="col-sm-2 col-form-label">Estante</label>
    <div class="col-sm-6">
        {!! Form::text('estante', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="unidademedida" class="col-sm-2 col-form-label">Prateleira</label>
    <div class="col-sm-6">
        {!! Form::text('prateleira', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>

<input type="button" class="btn btn-primary" data-toggle="modal" data-target=".tipomaterial"
    value="Cadastrar Novo Tipo" style="cursor: pointer;">
@include('despesas/cadastratipomaterial')



{!! Form::hidden('statusbenspatrimoniais', '1', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'statusbenspatrimoniais', 'maxlength' => '100']) !!}
{!! Form::hidden('descricaoBensPatrimoniais', '0', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'descricaoBensPatrimoniais', 'maxlength' => '100']) !!}


{!! Form::hidden('ativadoBensPatrimoniais', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativadoBensPatrimoniais', 'maxlength' => '1']) !!}
{!! Form::hidden('excluidoBensPatrimoniais', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'id' => 'excluidoBensPatrimoniais', 'maxlength' => '1']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}
