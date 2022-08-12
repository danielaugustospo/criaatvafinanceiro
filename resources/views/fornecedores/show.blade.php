@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Fornecedor {{ $fornecedor->nomeFornecedor }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('fornecedores.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('fornecedores.destroy',$fornecedor->id) }}" method="POST">
                    @can('fornecedor-edit')
                        <a class="btn btn-primary" href="{{ route('fornecedores.edit',$fornecedor->id) }}">Editar</a>
                        {{-- <a class="btn btn-primary" onclick="alert('Em breve')">Editar</a> --}}
                    @endcan

                    @csrf
                    {{-- @method('DELETE')
                    @can('fornecedor-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan --}}
                </form>

        </div>
    </div>
</div>



{!! Form::model($fornecedor, ['method' => 'PATCH','route' => ['fornecedores.update', $fornecedor->id] ]) !!}

@include('fornecedores/campos')


 
@endsection
