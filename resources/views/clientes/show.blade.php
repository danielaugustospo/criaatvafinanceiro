@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Cliente: <b>{{ $cliente->nomeCliente }}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                @can('cliente-edit')
                    <a class="btn btn-primary" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>
                @endcan
                @csrf
                @method('DELETE')
                @can('cliente-delete')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>

        </div>
    </div>
</div>


{!! Form::model($cliente, ['method' => 'PATCH','route' => ['clientes.update', $cliente->id] ]) !!}

@include('clientes/campos')


    {!! Form::hidden('ativoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '10']) !!}
    {!! Form::hidden('excluidoCliente', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'readonly', 'maxlength' => '10']) !!}


    <!-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!} -->
    {!! Form::close() !!}


     
    @endsection
