@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Receita Id: {{ $receita->id }} - OS Associada: {{ $receita->idosreceita }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('receita.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('receita.destroy',$receita->id) }}" method="POST">
                @can('receita-edit')
                <a class="btn btn-primary" href="{{ route('receita.edit',$receita->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('receita-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>

        </div>
    </div>
</div>


{!! Form::model($receita, ['method' => 'PATCH','route' => ['receita.update', $receita->id]]) !!}

@include('receita/campos')


{!! Form::close() !!}



 
@endsection
