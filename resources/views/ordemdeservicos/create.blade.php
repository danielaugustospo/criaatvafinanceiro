@extends('layouts.app')


@section('content')
@extends('ordemdeservicos.estilo')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Ordem de Serviço</h2>
            <h5>Última OS lançada no sistema: n°
                @foreach ($ultimaOS as $OsPassada)
                {{ $OsPassada->idMaximo }}
                @endforeach
            </h5>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
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


{!! Form::open(array('route' => 'ordemdeservicos.store','method'=>'POST')) !!}

@include('ordemdeservicos/campos')
<input type="hidden" name="idAutor" value="{{Auth::user()->id}}">
{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}




@endsection