@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Retirada: {{$saidas->codbarras}} - {{$listaSaidas[0]->nomeBensPatrimoniais}}
            </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('saidas.index') }}"> Voltar</a>
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


{!! Form::model($saidas, ['method' => 'PATCH','route' => ['saidas.update', $saidas->id]]) !!}

<div class="form-group row">
    <label for="nomeBanco" class="col-sm-2 col-form-label">Nome da Saída</label>
    <div class="col-sm-10">
        {!! Form::text('nomesaida', null, ['placeholder' => 'Informe um nome para identificar esta saída', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="descricaosaida" class="col-sm-2 col-form-label">Descrição da Saída</label>
    <div class="col-sm-10">
        {!! Form::text('descricaosaida', null, ['placeholder' => 'Descrição da Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricaosaida']) !!}
    </div>
</div>

{{-- <div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Bem Patrimonial</label>
    <div class="col-sm-10">
            <select name="idbenspatrimoniais" id="idbenspatrimoniais"  class="selecionaComInput form-control">
                @foreach ($bensPatrimoniais as $bemPatrimonial)
                    <option value=" {{$bemPatrimonial->id}} ">{{$bemPatrimonial->nomeBensPatrimoniais}}</option>
                @endforeach
        </select>
    </div>
</div> --}}

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Portador Saída</label>
    <div class="col-sm-10">
        {!! Form::text('portadorsaida', null, ['placeholder' => 'Portador Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data Para Retirada</label>
    <div class="col-sm-2">
        {!! Form::date('datapararetiradasaida', null, ['placeholder' => 'Data Para Retirada', 'class' => 'form-control', 'id' => 'datapararetiradasaida']) !!}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data da Retirada Saída</label>
    <div class="col-sm-2">
        {!! Form::date('dataretiradasaida', null, ['placeholder' => 'Data da Retirada Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data de Retorno Saída</label>
    <div class="col-sm-2">
        {!! Form::date('dataretornoretiradasaida', null, ['placeholder' => 'Data de Retorno Saída', 'class' => 'form-control',  'id' => 'dataretornoretiradasaida']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Ocorrências</label>
    <div class="col-sm-12">
        {!! Form::textarea('ocorrencia', null, ['placeholder' => 'Ocorrências', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'id' => 'ocorrencia']) !!}
    </div>
</div>


{!! Form::hidden('excluidosaida', null, ['placeholder' => 'Excluído Saída', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidosaida']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}


 
@endsection
