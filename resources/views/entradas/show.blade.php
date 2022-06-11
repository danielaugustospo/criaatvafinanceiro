@extends('layouts.app')


@section('content')
@include('entradas/script')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Entrada: <b>{{ $entradas->descricaoentrada }}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('entradas.index') }}"> Voltar</a>
        </div>
        <hr>
        <br>
        <form action="{{ route('entradas.destroy',$entradas->id) }}" method="POST">
            @can('entradas-edit')
            <a class="btn btn-primary" href="{{ route('entradas.edit',$entradas->id) }}">Editar</a>
            @endcan

            @csrf
            @method('DELETE')
            @can('entradas-delete')
            <button type="submit" class="btn btn-danger">Excluir</button>
            @endcan
        </form>

    </div>
</div>


{!! Form::model($entradas, ['method' => 'PATCH','route' => ['entradas.update', $entradas->id]]) !!}

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Bem Patrimonial</label>
        <select class="selecionaComInput form-control col-sm-10 js-example-basic-multiple pr-1" name="idbenspatrimoniais" id="descricaoBensPatrimoniais" readonly disabled>
            @foreach ($selectBensPatrimoniais as $bensPatrimoniais)
                <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
            @endforeach
        </select>
</div>
<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoentrada', null, ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>
</div>


<div class="form-group row">
    <label for="valorunitarioentrada" class="col-sm-2 col-form-label">Valor Unitário Entrada</label>
    <div class="col-sm-2">
        {!! Form::text('valorunitarioentrada', null, ['placeholder' => 'Valor Unitário', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="qtdeEntrada" class="col-sm-2 col-form-label">Quantidade</label>
    <div class="col-sm-2">
        {!! Form::number('qtdeEntrada', null, ['placeholder' => 'Quantidade', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}

    </div>
</div>

{!! Form::hidden('ativoentrada', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoentrada']) !!}
{!! Form::hidden('excluidoentrada', null, ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoentrada']) !!}



</div>
{!! Form::close() !!}
 
@endsection
