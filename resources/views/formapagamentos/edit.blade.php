@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da Forma de Pagamento {{$formapagamento->nomeFormaPagamento}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('formapagamentos.index') }}"> Voltar</a>
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


{!! Form::model($formapagamento, ['method' => 'PATCH','route' => ['formapagamentos.update', $formapagamento->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome da Forma de Pagamento:</strong>
            {!! Form::text('nomeFormaPagamento', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
        </div>
    </div>

    {!! Form::hidden('ativoFormaPagamento', null, ['placeholder' => 'Ativo?', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoFormaPagamento']) !!}
    {!! Form::hidden('excluidoFormaPagamento', null, ['placeholder' => 'Excluído?', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoFormaPagamento']) !!}

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
