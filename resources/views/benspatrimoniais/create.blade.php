@extends('layouts.app')
@section('content')
@include('estoque/script')
@include('estoque/estilo')

@php
    $titulo = 'Cadastro de Material';
    $rotavoltar = 'benspatrimoniais.index';
@endphp

    @include('layouts/helpersview/iniciorelatorio')



    {!! Form::open(['route' => 'benspatrimoniais.store', 'method' => 'POST']) !!}

    <div class="form-group row">
        <label for="nomeBensPatrimoniais" class="col-sm-2 col-form-label">Nome do Material </label>
        <div class="col-sm-6">
            {!! Form::text('nomeBensPatrimoniais', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
        </div>
        <label for="qtdestoqueminimo" class="col-sm-1 col-form-label">Estoque Mínimo</label>
        <div class="col-sm-1">
            <input type="number" class="form-control" name="qtdestoqueminimo" id="qtdestoqueminimo">
        </div>
    </div>

    <div class="form-group row">
        <label for="idTipoBensPatrimoniais" class="col-sm-2 col-form-label">Tipo</label>
        <div class="col-sm-6">
            <select name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais" class="selecionaComInput form-control">
                @if (!isset($benspatrimoniais->idTipoBensPatrimoniais))
                <option selected>Selecione</option>
                @endif
                @foreach ($listaTiposBensPatrimoniais as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-4">
            <button type="button" onclick="recarregaTipoMaterial()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></i></button>

            <input type="button" class="btn btn-primary" data-toggle="modal" data-target=".tipomaterial"
                value="Cadastrar Novo Tipo" style="cursor: pointer;">
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
    @include('despesas/cadastratipomaterial')



    {!! Form::hidden('statusbenspatrimoniais', '1', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'statusbenspatrimoniais', 'maxlength' => '100']) !!}
    {!! Form::hidden('descricaoBensPatrimoniais', '0', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'descricaoBensPatrimoniais', 'maxlength' => '100']) !!}


    {!! Form::hidden('ativadoBensPatrimoniais', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativadoBensPatrimoniais', 'maxlength' => '1']) !!}
    {!! Form::hidden('excluidoBensPatrimoniais', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'id' => 'excluidoBensPatrimoniais', 'maxlength' => '1']) !!}

    {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@endsection
