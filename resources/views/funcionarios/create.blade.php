@extends('layouts.app')


@section('content')

<div class="col-lg-12 margin-tb">
    <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
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

{!! Form::open(array('route' => 'funcionarios.store','method'=>'POST', 'enctype'=>'multipart/form-data' )) !!}
<div class="form-group row col-lg-12 mt-4">
    <h2 class="col-lg-4 pl-0">Cadastro de Funcionário</h2>
    <div class="col-lg-8 d-flex justify-content-end">
        <label class="col-sm-3 col-form-label pr-2">Cadastrar Foto</label>
        <input type="file" class="form-control-file btn btn-secondary col-sm-6" name="fotoFuncionario" name="fotoFuncionario">
    </div>
</div>

@include('funcionarios/campos')

{!! Form::hidden('ativoFuncionario', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativoFuncionario', 'maxlength' => '11']) !!}
{!! Form::hidden('excluidoFuncionario', '0', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'excluidoFuncionario', 'maxlength' => '11']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

@endsection