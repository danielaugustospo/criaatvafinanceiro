@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Usuário {{$funcionario->nomeFuncionario}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
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


{!! Form::model($funcionario, ['method' => 'PATCH','route' => ['funcionarios.update', $funcionario->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nomeFuncionario', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('emailFuncionario', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Banco:</strong>
            <!-- {!! Form::text('bancoFuncionario', null, array('placeholder' => '','class' => 'form-control')) !!} -->
            <select class="form-control">
            @foreach ($bancoselecionado as $banco)
                <option value="{{$banco->codigoBanco}}">{{$banco->nomeBanco}}</option>
            @endforeach  
            @foreach ($banconaoselecionado as $banco)
                <option value="{{$banco->codigoBanco}}">{{$banco->nomeBanco}}</option>
            @endforeach  


            </select>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
