@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Entradas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('entradas.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')



{!! Form::open(array('route' => 'entradas.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Bem Patrimonial</label>
        <select class="selecionaComInput form-control col-sm-10 js-example-basic-multiple pr-1" name="idbenspatrimoniais" id="descricaoBensPatrimoniais">
            @foreach ($listaBensPatrimoniais as $bensPatrimoniais)
                <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
            @endforeach
        </select>
</div>
<div class="form-group row">
    <label for="descricaoentrada" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoentrada', '', ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>


<div class="form-group row">
    <label for="valorunitarioentrada" class="col-sm-2 col-form-label">Valor Unitário Entrada</label>
    <div class="col-sm-2">
        {!! Form::text('valorunitarioentrada', '', ['placeholder' => 'Valor Unitário', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>

<div class="form-group row">
    <label for="qtdeEntrada" class="col-sm-2 col-form-label">Quantidade</label>
    <div class="col-sm-2">
        {!! Form::number('qtdeEntrada', '', ['placeholder' => 'Quantidade', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>

{{-- {!! Form::hidden('qtdeEntrada', '1', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'qtdeEntrada']) !!} --}}
{!! Form::hidden('ativoentrada', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoentrada']) !!}
{!! Form::hidden('excluidoentrada', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoentrada']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}






@endsection
