@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Entrada: <b>{{$entradas->descricaoentrada}}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('entradas.index') }}"> Voltar</a>
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


{!! Form::model($entradas, ['method' => 'PATCH','route' => ['entradas.update', $entradas->id]]) !!}

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Bem Patrimonial</label>
        <select class="selecionaComInput form-control col-sm-10 js-example-basic-multiple pr-1" name="idbenspatrimoniais" id="descricaoBensPatrimoniais">
            @foreach ($selectBensPatrimoniais as $bensPatrimoniais)
                <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
            @endforeach
        </select>
</div>
<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoentrada', null, ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>


<div class="form-group row">
    <label for="valorunitarioentrada" class="col-sm-2 col-form-label">Valor Unitário Entrada</label>
    <div class="col-sm-2">
        {!! Form::text('valorunitarioentrada', null, ['placeholder' => 'Valor Unitário', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="qtdeEntrada" class="col-sm-2 col-form-label">Quantidade</label>
    <div class="col-sm-2">
        {!! Form::number('qtdeEntrada', null, ['placeholder' => 'Quantidade', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>

{!! Form::hidden('ativoentrada', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoentrada']) !!}
{!! Form::hidden('excluidoentrada', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoentrada']) !!}


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</div>
{!! Form::close() !!}

 
@endsection
