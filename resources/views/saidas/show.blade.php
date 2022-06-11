@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Saída n° {{ $saidas->id }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('saidas.index') }}"> Voltar</a>
        <hr>
        <br>
        </div>
        <form action="{{ route('saidas.destroy',$saidas->id) }}" method="POST">
            @can('saidas-edit')
            <a class="btn btn-primary" href="{{ route('saidas.edit',$saidas->id) }}">Editar</a>
            @endcan

            @csrf
            @method('DELETE')
            @can('saidas-delete')
            <button type="submit" class="btn btn-danger">Excluir</button>
            @endcan

    </div>
</div>


{!! Form::model($saidas, ['method' => 'PATCH','route' => ['saidas.update', $saidas->id]]) !!}

<div class="form-group row">
    <label for="nomeBanco" class="col-sm-2 col-form-label">Nome da Saída</label>
    <div class="col-sm-10">
        {!! Form::text('nomesaida', null, ['placeholder' => 'Informe um nome para identificar esta saída', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="descricaosaida" class="col-sm-2 col-form-label">Descrição da Saída</label>
    <div class="col-sm-10">
        {!! Form::text('descricaosaida', null, ['placeholder' => 'Descrição da Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricaosaida', 'readonly']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Bem Patrimonial</label>
    <div class="col-sm-10">
            <select name="idbenspatrimoniais" id="idbenspatrimoniais"  class="selecionaComInput form-control" disabled>
                @foreach ($bensPatrimoniais as $bemPatrimonial)
                    <option value=" {{$bemPatrimonial->id}} ">{{$bemPatrimonial->nomeBensPatrimoniais}}</option>
                @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Portador Saída</label>
    <div class="col-sm-10">
        {!! Form::text('portadorsaida', null, ['placeholder' => 'Portador Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida', 'readonly']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data Para Retirada</label>
    <div class="col-sm-2">
        {!! Form::date('datapararetiradasaida', null, ['placeholder' => 'Data Para Retirada', 'class' => 'form-control', 'id' => 'datapararetiradasaida', 'readonly']) !!}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data da Retirada Saída</label>
    <div class="col-sm-2">
        {!! Form::date('dataretiradasaida', null, ['placeholder' => 'Data da Retirada Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida', 'readonly']) !!}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data de Retorno Saída</label>
    <div class="col-sm-2">
        {!! Form::date('dataretornoretiradasaida', null, ['placeholder' => 'Data de Retorno Saída', 'class' => 'form-control',  'id' => 'dataretornoretiradasaida', 'readonly']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Ocorrências</label>
    <div class="col-sm-12">
        {!! Form::textarea('ocorrenciasaida', null, ['placeholder' => 'Ocorrências', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'id' => 'ocorrenciasaida', 'readonly']) !!}
    </div>
</div>


{!! Form::hidden('excluidosaida', null, ['placeholder' => 'Excluído Saída', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidosaida']) !!}


{{-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!} --}}
{!! Form::close() !!}

 
@endsection
