@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Usuário {{$orgaorg->nomeFuncionario}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('orgaosrg.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
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

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
