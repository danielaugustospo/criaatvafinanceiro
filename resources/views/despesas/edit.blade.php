@extends('layouts.app')


@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edição - Despesa ID {{ $despesa->id }} - {{ $despesa->descricaoDespesa }}</h2>

        </div>
        <div class="pull-right">
            {{-- <a class="btn btn-primary" href="{{ route('despesas.index') }}"> Voltar</a> --}}
            <a class="btn btn-primary" data-toggle="modal" data-target=".modaldepesas" style="color: white; cursor:pointer;" > Pesquisar Outra Despesa</a>

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


{!! Form::model($despesa, ['method' => 'PATCH','route' => ['despesas.update', $despesa->id]]) !!}
  
@include('despesas/campos')

 

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
{!! Form::hidden('idAlteracaoUsuario', Auth::user()->id, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '5']) !!}

{!! Form::close() !!}


@endsection