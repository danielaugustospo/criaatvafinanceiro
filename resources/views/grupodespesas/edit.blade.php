@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Grupo de Despesas {{$grupodespesa->grupoDespesa}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('grupodespesas.index') }}"> Voltar</a>
        </div>
    </div>
</div>
<hr>


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

<div class="col-sm-2 pl-0 pr-0">
  <select name="ativoDespesa" id="ativoDespesa" class="selecionaComInput form-control col-sm-12  js-example-basic-multiple">
      <option value="0" {{$grupodespesa->ativoDespesa == '0'?' selected':''}}>Não</option>
      <option value="1" {{$grupodespesa->ativoDespesa == '1'?' selected':''}}>Sim</option>
  </select>
</div>
</div>

{!! Form::hidden('excluidoDespesa', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1']) !!}


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

 
@endsection
