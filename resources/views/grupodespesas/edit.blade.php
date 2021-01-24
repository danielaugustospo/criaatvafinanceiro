@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Código de Despesas {{$grupodespesa->despesaCodigoDespesa}}</h2>
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


{!! Form::model($grupodespesa, ['method' => 'PATCH','route' => ['grupodespesas.update', $grupodespesa->id]]) !!}
<div class="form-group row">
    <label for="grupoDespesa" class="col-sm-2 col-form-label">Grupo</label>
        {!! Form::text('grupoDespesa', null, ['placeholder' => 'Código Despesa', 'class' => 'form-control col-sm-2', 'maxlength' => '20']) !!}

</div>
<div class="form-group row">

<label for="grupoDespesa" class="col-sm-2 col-form-label">Ativo</label>
{!! Form::text('ativoDespesa', null, ['placeholder' => 'Ativo', 'class' => 'form-control col-sm-2', 'maxlength' => '1']) !!}
</div>

{!! Form::hidden('excluidoDespesa', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1']) !!}


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

 
@endsection
