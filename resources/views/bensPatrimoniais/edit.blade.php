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


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Ops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


{!! Form::model($benspatrimoniais, ['method' => 'PATCH','route' => ['benspatrimoniais.update', $benspatrimoniais->id]]) !!}
<div class="form-group row">
    <label for="nomeBensPatrimoniais" class="col-sm-2 col-form-label">Nome </label>
    <div class="col-sm-10">
        {!! Form::text('nomeBensPatrimoniais', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeFuncionario" id="nomeFuncionario" placeholder="Nome do Prestador de Serviço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="idTipoBensPatrimoniais" class="col-sm-2 col-form-label">Tipo de Bem Patrimonial</label>
    <div class="col-sm-10">
        <select name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais" class="selecionaComInput form-control">
            @foreach ($tipoBensPatrimoniais as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
            @endforeach
        </select>
        <!-- {!! Form::text('idTipoBensPatrimoniais', '', ['placeholder' => 'Tipo de Bem Patrimonial', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'idTipoBensPatrimoniais','onblur' =>'pesquisacep(this.value)']) !!} -->
        <!-- <input type="text" class="form-control" id="descricaoBensPatrimoniais" placeholder="Endereço"> -->
    </div>

</div>
<div class="form-group row">
    <label for="statusbenspatrimoniais" class="col-sm-2 col-form-label">Status do Bem Patrimonial</label>
    <div class="col-sm-2">
        <select class="form-control" name="statusbenspatrimoniais" id="statusbenspatrimoniais">
            <option value="1">Disponível</option>
            <option value="2">Em Uso</option>
            <option value="3">Manutenção</option>
        </select>
        <!-- <input type="text" class="form-control" id="descricaoBensPatrimoniais" placeholder="Endereço"> -->
    </div>
    <label for="descricaoBensPatrimoniais" class="col-sm-1 col-form-label">Descrição</label>
    <div class="col-sm-7">
        {!! Form::text('descricaoBensPatrimoniais', null, ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'descricaoBensPatrimoniais', 'maxlength' => '100']) !!}
        <!-- <input type="text" class="form-control" id="descricaoBensPatrimoniais" placeholder="Endereço"> -->
    </div>
</div>
<!-- <div class="form-group row ">
    <label for="ativadoBensPatrimoniais" class="col-sm-2 col-form-label">Ativo?</label>
    <div class="col-sm-3"> -->
{!! Form::hidden('ativadoBensPatrimoniais', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativadoBensPatrimoniais', 'maxlength' => '1']) !!}
<!-- <input type="text" class="form-control" id="ativadoBensPatrimoniais" placeholder="Bairro"> -->
<!-- </div> -->
<!-- <label for="excluidoBensPatrimoniais" class="col-sm-2 col-form-label">Excluído</label>
    <div class="col-sm-3"> -->
{!! Form::hidden('excluidoBensPatrimoniais', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'id' => 'excluidoBensPatrimoniais', 'maxlength' => '1']) !!}
<!-- <input type="text" class="form-control" id="excluidoBensPatrimoniais" placeholder="Cidade"> -->
<!-- </div> -->
<!-- </div> -->


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
{!! Form::close() !!}


@endsection