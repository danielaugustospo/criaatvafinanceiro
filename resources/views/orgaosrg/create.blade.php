@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Órgão Emissor de RG</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('orgaosrg.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'orgaosrg.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeBanco" class="col-sm-2 col-form-label">Nome Completo do Órgão</label>
    <div class="col-sm-10">
        {!! Form::text('nome', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeBanco" id="nomeBanco" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="codigoBanco" class="col-sm-2 col-form-label">Unidade Federativa (Estado)</label>
    <div class="col-sm-2">
        {!! Form::text('estadoOrgaoRG', '', ['placeholder' => 'Estado', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'estadoOrgaoRG']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>

{!! Form::hidden('ativoOrgaoRG', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrgaoRG']) !!}
{!! Form::hidden('excluidoOrgaoRG', '0', ['placeholder' => 'Excluido', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrgaoRG']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

 




@endsection
