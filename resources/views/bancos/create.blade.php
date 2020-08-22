<script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous">
    </script>
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Funcionário</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('bancos.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'bancos.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeBanco" class="col-sm-2 col-form-label">Nome Completo do Banco</label>
    <div class="col-sm-10">
        {!! Form::text('nomeBanco', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="codigoBanco" class="col-sm-2 col-form-label">Código Banco</label>
    <div class="col-sm-2">
        {!! Form::text('codigoBanco', '', ['placeholder' => 'Código Banco', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'codigoBanco']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>




@endsection
