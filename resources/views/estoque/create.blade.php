@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Estoque</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('estoque.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'estoque.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeestoque" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        {!! Form::text('nomeestoque', '', ['placeholder' => 'Nome', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="descricaoestoque" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoestoque', '', ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricaoestoque']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label mr-3">Bem Patrimonial</label>
    
        <select class="selecionaComInput form-control col-sm-9" name="idbenspatrimoniais" id="idbenspatrimoniais">
            @foreach ($listaBensPatrimoniais as $bensPatrimoniais)

            <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
            @endforeach

        </select>
    
</div>

{!! Form::hidden('ativadoestoque', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'ativadoestoque']) !!}
{!! Form::hidden('excluidoestoque', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'excluidoestoque']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}






@endsection
