@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Alíquota Mensal: <b>{{ $dadosaliquotamensal->mes }}</b></h2>
        </div>
        <div class="pull-right mb-3">
            <a class="btn btn-primary" href="{{ route('aliquotamensal.index') }}"> Voltar</a>
        </div>
        <hr>
        <form action="{{ route('aliquotamensal.destroy',$dadosaliquotamensal->id) }}" method="POST">
            @can('aliquotamensal-edit')
                <a class="btn btn-primary" href="{{ route('aliquotamensal.edit',$dadosaliquotamensal->id) }}">Editar</a>
            @endcan

            @csrf
            @method('DELETE')
            @can('aliquotamensal-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
            @endcan
        </form>

    </div>
</div>


{!! Form::model($dadosaliquotamensal, ['method' => 'PATCH','route' => ['aliquotamensal.update', $dadosaliquotamensal->id]]) !!}

@include('aliquotamensal/campos')

{!! Form::close() !!}

@endsection
