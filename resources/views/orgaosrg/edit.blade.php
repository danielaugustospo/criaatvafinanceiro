@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Órgão Emissor: <b>{{$orgaorg->nome}}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('orgaosrg.index') }}"> Voltar</a>
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


{!! Form::model($orgaorg, ['method' => 'PATCH','route' => ['orgaosrg.update', $orgaorg->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome Completo do Órgão:</strong>
            {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control', 'maxlength' => '100')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Unidade Federativa (Estado):</strong>
            {!! Form::text('estadoOrgaoRG', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>

    
    {!! Form::hidden('ativoOrgaoRG', null, array('placeholder' => 'Ativo','class' => 'form-control')) !!}
    {!! Form::hidden('excluidoOrgaoRG', null, array('placeholder' => 'Excluido','class' => 'form-control')) !!}
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</div>
{!! Form::close() !!}

 
@endsection
