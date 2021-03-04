@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Inventário N°: <b>{{ $estoque->id }}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('estoque.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('estoque.destroy',$estoque->id) }}" method="POST">
                @can('estoque-edit')
                <a class="btn btn-primary" href="{{ route('estoque.edit',$estoque->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('estoque-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>


        </div>
    </div>
</div>

{!! Form::model($estoque, ['method' => 'PATCH','route' => ['estoque.update', $estoque->id]]) !!}

<div class="form-group row">
    <label for="nomeestoque" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
        {!! Form::text('nomeestoque', null, ['placeholder' => 'Nome', 'class' => 'form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="descricaoestoque" class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        {!! Form::text('descricaoestoque', null, ['placeholder' => 'Descrição', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricaoestoque', 'readonly']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label mr-3">Bem Patrimonial</label>
    
        <select class="selecionaComInput form-control col-sm-9" name="idbenspatrimoniais" id="idbenspatrimoniais" disabled>
            @foreach ($bempatrimonial as $bensPatrimoniais)

            <option value="{{ $bensPatrimoniais->id }}">{{ $bensPatrimoniais->nomeBensPatrimoniais }}</option>
            @endforeach

        </select>
    
</div>

{!! Form::hidden('ativadoestoque', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'ativadoestoque']) !!}
{!! Form::hidden('excluidoestoque', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'excluidoestoque']) !!}
 
@endsection
