@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Item <b>{{ $estoque->bensPatrimoniais->nomeBensPatrimoniais }}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('estoque.index') }}"> Voltar</a>
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


{!! Form::model($estoque, ['method' => 'PATCH','route' => ['estoque.update', $estoque->id]]) !!}
<div class="form-group row">
    <label for="nomematerial" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        {!! Form::text('nomematerial', null, ['placeholder' => 'Nome', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="descricao" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricao', null, ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricao']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label mr-3">Bem Patrimonial</label>
    
        <select class="selecionaComInput form-control col-sm-9" name="idbenspatrimoniais" id="idbenspatrimoniais">
            @foreach ($bempatrimonial as $bensPatrimoniais)

            <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
            @endforeach

        </select>
    
</div>

{!! Form::hidden('ativadoestoque', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'ativadoestoque']) !!}
{!! Form::hidden('excluidoestoque', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'excluidoestoque']) !!}



    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

 
@endsection
