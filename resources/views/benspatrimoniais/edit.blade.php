@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Bem Patrimonial {{$benspatrimoniais->nomeBensPatrimoniais}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('benspatrimoniais.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')


{!! Form::model($benspatrimoniais, ['method' => 'PATCH','route' => ['benspatrimoniais.update', $benspatrimoniais->id]]) !!}
<div class="form-group row">
    <label for="nomeBensPatrimoniais" class="col-sm-2 col-form-label">Nome </label>
    <div class="col-sm-10">
        {!! Form::text('nomeBensPatrimoniais', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="idTipoBensPatrimoniais" class="col-sm-2 col-form-label">Tipo de Bem Patrimonial</label>
    <div class="col-sm-10">
        <select name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais" class="selecionaComInput form-control">
            @if (!isset($benspatrimoniais->idTipoBensPatrimoniais))
            <option selected>Selecione</option>
            @endif
            @foreach ($tipoBensPatrimoniais as $tipo)
            <option value="{{ $tipo->id }}"  @if (isset($benspatrimoniais) && $benspatrimoniais->idTipoBensPatrimoniais == $tipo->id) selected @endif>{{ $tipo->name }}</option>
            @endforeach
        </select>
        <!-- {!! Form::text('idTipoBensPatrimoniais', '', ['placeholder' => 'Tipo de Bem Patrimonial', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'idTipoBensPatrimoniais','onblur' =>'pesquisacep(this.value)']) !!} -->
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
            <option value="{{ $unidade->id }}" @if (isset($benspatrimoniais) && $benspatrimoniais->unidademedida == $unidade->id) selected @endif>
                {{ $unidade->sigla }} | {{ $unidade->nomeunidade }}
            </option>
            @endforeach

        </select>
    </div>
</div>

<div class="form-group row">
    <label for="estante" class="col-sm-2 col-form-label">Estante</label>
    <div class="col-sm-6">
        {!! Form::text('estante', $benspatrimoniais->estante, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="unidademedida" class="col-sm-2 col-form-label">Prateleira</label>
    <div class="col-sm-6">
        {!! Form::text('prateleira', $benspatrimoniais->prateleira, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">

    <label for="qtdestoqueminimo" class="col-sm-2 col-form-label">Estoque Mínimo</label>
    <div class="col-sm-3">
        {!! Form::text('qtdestoqueminimo', null, ['placeholder' => 'Estoque Mínimo', 'class' => 'form-control', 'id' => 'qtdestoqueminimo', 'maxlength' => '100']) !!}
    </div>
</div>
{!! Form::hidden('descricaoBensPatrimoniais', null, ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'descricaoBensPatrimoniais', 'maxlength' => '100']) !!}
{!! Form::hidden('statusbenspatrimoniais', null, ['placeholder' => 'Status do Bem Patrimonial', 'class' => 'form-control', 'id' => 'statusbenspatrimoniais', 'maxlength' => '100']) !!}
{!! Form::hidden('ativadoBensPatrimoniais', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativadoBensPatrimoniais', 'maxlength' => '1']) !!}
{!! Form::hidden('excluidoBensPatrimoniais', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'id' => 'excluidoBensPatrimoniais', 'maxlength' => '1']) !!}



<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
{!! Form::close() !!}


@endsection