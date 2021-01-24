@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Grupo de Despesas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('grupodespesas.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'grupodespesas.store','method'=>'POST')) !!}


<div class="form-group row">
    <label for="grupoDespesa" class="col-sm-2 col-form-label">Nome do Grupo</label>
    <div class="col-sm-10">
        {!! Form::text('grupoDespesa', '', ['placeholder' => 'Grupo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>


{!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1']) !!}
{!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

 



@endsection
