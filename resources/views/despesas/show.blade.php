@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Despesa {{ $despesa->descricaoDespesa }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('despesas.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('despesas.destroy',$despesa->id) }}" method="POST">
                @can('despesa-edit')
                <a class="btn btn-primary" href="{{ route('despesas.edit',$despesa->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('despesa-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>

        </div>
    </div>
</div>


{!! Form::model($despesa, ['method' => 'PATCH','route' => ['despesas.update', $despesa->id]]) !!}

@include('despesas/campos')


@endsection