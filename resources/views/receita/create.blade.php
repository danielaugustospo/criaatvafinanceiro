@extends('layouts.app')

@section('content')
<label  class="col-sm-12 text-center col-form-label" style="color:red;">Aviso: Todos os campos são de preenchimento obrigatório!</label>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Receitas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('receita.index') }}"> Voltar</a>
        </div>
    </div>
</div>

@include('layouts/helpersview/mensagemRetorno')

{!! Form::open(array('route' => 'receita.store','method'=>'POST', 'id' => 'manipulaReceitas')) !!}

@include('receita/campos')
<input type="hidden" name="idosreceita" value="CRIAATVA">

{{-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!} --}}
<input type="button" class="btn btn-success" id="btnSalvar" value="Salvar" onclick="alteraRetornoCadastroDespesa(retorno = 'novo');" />
{!! Form::close() !!}






@endsection