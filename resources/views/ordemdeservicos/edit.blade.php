@extends('layouts.app')


@section('content')
{!! Form::model($ordemdeservico, ['method' => 'PATCH','route' => ['ordemdeservicos.update', $ordemdeservico->id]]) !!}

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da OS: {{$ordemdeservico->id}} - {{ $ordemdeservico->eventoOrdemdeServico }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-danger" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
            <a class="btn btn-success" href="{{ route('ordemdeservicos.show',$ordemdeservico->id) }}">Financeiro</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</div>

<?php $contadorReceitas =  count($receitasPorOS); 
    $readonlyOrNo = " ";
    $disabledOrNo = " ";
?>

@include('layouts/helpersview/mensagemRetorno')

@include('ordemdeservicos/campos')


<input type="hidden" id="valorProjetoOrdemdeServico" class="form-control" name="valorProjetoOrdemdeServico" value="{{$ordemdeservico->valorProjetoOrdemdeServico}}" placeholder="Preencha o preço real" /><br>

{!! Form::hidden('dataOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

{!! Form::hidden('servicoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

{!! Form::hidden('dataExclusaoOrdemdeServico', '00', ['placeholder' => 'Data Exclusão', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'dataExclusaoOrdemdeServico']) !!}
{!! Form::hidden('ativoOrdemdeServico', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']) !!}
{!! Form::hidden('excluidoOrdemdeServico', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']) !!}


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

{!! Form::close() !!}

 
@endsection
