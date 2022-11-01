@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Nota/Recibo: <b>{{ $notasrecibos->nfrecibo }}</b></h2>
        </div>
        <div class="pull-right mb-3">
            <a class="btn btn-primary" href="{{ route('notasrecibos.index') }}"> Voltar</a>
        </div>
        <hr>
        <form action="{{ route('notasrecibos.destroy',$notasrecibos->id) }}" method="POST">
            @can('notasrecibos-edit')
                <a class="btn btn-primary" href="{{ route('notasrecibos.edit',$notasrecibos->id) }}">Editar</a>
            @endcan

            @csrf
            @method('DELETE')
            @can('notasrecibos-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
            @endcan
        </form>

    </div>
</div>


{!! Form::model($notasrecibos, ['method' => 'PATCH','route' => ['notasrecibos.update', $notasrecibos->id]]) !!}

@include('notasrecibos/campos')

{!! Form::close() !!}

@endsection
