@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Despesas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('despesas.index') }}"> Voltar</a>
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


{!! Form::open(array('route' => 'despesas.store','method'=>'POST')) !!}

@include('despesas/campos')

<!-- Seção Despesas -->
{!! Form::hidden('idAlteracaoUsuario', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '5']) !!}
{!! Form::hidden('idAutor', Auth::user()->id, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '5']) !!}
{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}




@endsection