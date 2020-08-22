@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Conta {{$conta->numeroConta}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contas.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
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
        <div class="form-group">
            <strong>Número Conta:</strong>
            {!! Form::text('numeroConta', null, array('placeholder' => 'Número Conta','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Agência Conta:</strong>
            {!! Form::text('agenciaConta', null, array('placeholder' => 'Agência','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Banco:</strong>
            <select class="form-control" name="idBanco" id="idBanco">
            <!-- @foreach ($banco as $dadosBanco) -->
                @foreach ($todososbancos as $listabancos)

                <!-- <option value="{{$dadosBanco->id}}">
                    {{$dadosBanco->nomeBanco}}
                </option> -->
                <option value="{{$listabancos->id}}">
                    {{$listabancos->nomeBanco}}
                </option>
                @endforeach
            <!-- @endforeach -->

            </select>

        </div>
    </div>




    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
