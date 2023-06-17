@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Código/Grupo: <b>{{$codigodespesa->despesaCodigoDespesa}}<b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('codigodespesas.index') }}"> Voltar</a>
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


{!! Form::model($codigodespesa, ['method' => 'PATCH','route' => ['codigodespesas.update', $codigodespesa->id]]) !!}
<div class="form-group row">
    <label for="idGrupoCodigoDespesa" class="col-sm-2 col-form-label">Grupo de Despesa</label>
    <div class="col-sm-2">
        <select name="idGrupoCodigoDespesa" id="idGrupoCodigoDespesa" class="selecionaComInput form-control">
            <option value="" selected disabled>Selecione...</option>
            @foreach ($listaGrupoDespesas as $grupo)
                <option value="{{ $grupo->id }}"
                    @if (isset($codigodespesa)) @if ($codigodespesa->idGrupoCodigoDespesa == $grupo->id) selected @endif @endif>{{ $grupo->grupoDespesa }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="despesaCodigoDespesa" class="col-sm-2 col-form-label">Código de Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('despesaCodigoDespesa', null, ['placeholder' => 'Código de Despesa', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'despesaCodigoDespesa']) !!}
    </div>
</div>

{!! Form::hidden('ativoCodigoDespesa', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoCodigoDespesa']) !!}
{!! Form::hidden('excluidoCodigoDespesa', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoCodigoDespesa']) !!}


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

 
@endsection
