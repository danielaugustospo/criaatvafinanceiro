@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Conta: <b>{{$conta->nomeConta}}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contas.index') }}"> Voltar</a>
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


{!! Form::model($conta, ['method' => 'PATCH','route' => ['contas.update', $conta->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <strong>Apelido Conta:</strong>

            <div class="form-group">
                {!! Form::text('apelidoConta', null, array('placeholder' => 'Agência','class' => 'col-sm-2 form-control')) !!}
            </div>
        
        <div class="form-group">
            <strong>Nome Conta:</strong>
            {!! Form::text('nomeConta', null, array('placeholder' => 'Número Conta','class' => 'form-control')) !!}
        </div>
    </div>
    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Banco:</strong>
            <select class="selecionaComInput form-control" name="idBanco" id="idBanco">
                    @foreach ($todososbancos as $listabancos)
                <option value="{{$listabancos->id}}">
                    {{$listabancos->nomeBanco}}
                </option>
                @endforeach

            </select>

        </div>
    </div> --}}




    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

 
@endsection
