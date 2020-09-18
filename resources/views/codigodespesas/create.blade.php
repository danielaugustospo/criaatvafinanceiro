@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Código de Despesas</h2>
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




{!! Form::open(array('route' => 'codigodespesas.store','method'=>'POST')) !!}

<!-- <div class="form-group row">
    <label for="idGrupoCodigoDespesa" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-2">
        {!! Form::text('idGrupoCodigoDespesa', '', ['placeholder' => 'Código Despesa', 'class' => 'form-control', 'maxlength' => '20']) !!}

    </div>
</div> -->
<div class="form-group row">
    <label for="despesaCodigoDespesa" class="col-sm-2 col-form-label">Tipo de Despesa</label>
    <div class="col-sm-10">
        {!! Form::text('despesaCodigoDespesa', '', ['placeholder' => 'Tipo de Despesa', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'despesaCodigoDespesa']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="idGrupoCodigoDespesa" class=" col-sm-2 col-form-label">Selecione o Grupo</label>
    <div class="col-sm-10">
        <!-- {!! Form::text('despesaCodigoDespesa', '', ['placeholder' => 'Tipo de Despesa', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'despesaCodigoDespesa']) !!} -->
        <select name="idGrupoCodigoDespesa" id="idGrupoCodigoDespesa" class="selecionaComInput">
        @foreach ($grupodespesas as $grupoDespesa)
            <option value="{{ $grupoDespesa->id }}">Código: {{ $grupoDespesa->id }} - Grupo: {{ $grupoDespesa->grupoDespesa }}</option>
        @endforeach
        </select>
    </div>
</div>

{!! Form::hidden('ativoCodigoDespesa', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoCodigoDespesa']) !!}
{!! Form::hidden('excluidoCodigoDespesa', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoCodigoDespesa']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>



@endsection
