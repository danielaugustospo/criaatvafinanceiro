
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Banco</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('bancos.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'bancos.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeBanco" class="col-sm-2 col-form-label">Nome Completo do Banco</label>
    <div class="col-sm-10">
        {!! Form::text('nomeBanco', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Prestador de Serviço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="codigoBanco" class="col-sm-2 col-form-label">Código Banco</label>
    <div class="col-sm-2">
        {!! Form::text('codigoBanco', '', ['placeholder' => 'Código Banco', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'codigoBanco']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>

{!! Form::hidden('ativoBanco', '1', ['placeholder' => 'Ativo Banco', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoBanco']) !!}
{!! Form::hidden('excluidoBanco', '0', ['placeholder' => 'Excluído Banco', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoBanco']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

 




@endsection
