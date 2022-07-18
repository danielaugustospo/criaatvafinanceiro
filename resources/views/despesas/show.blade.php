@extends('layouts.app')
@section('content')


@php  
    if($message = Session::get('paginaModal')){
        $paginaModal = true;
    }
@endphp
        

@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
@endif

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Despesa ID {{ $despesa->id }} - 
                @if ($despesa->ehcompra == 0 || $despesa->insereestoque == 0)  {{$despesa->descricaoDespesa }} 
                    @elseif (($despesa->ehcompra == 1) && ($despesa->insereestoque == 1) && ($despesa->insereestoque == null))  
                        @foreach ($listaBensPatrimoniais as $bempatrimonial)
                            @if($bempatrimonial->id  == $despesa->descricaoDespesa) 
                                {{$bempatrimonial->nomeBensPatrimoniais}} 
                            @endif
                        @endforeach
                @endif </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" data-toggle="modal" data-target=".modaldepesas" style="color: white; cursor:pointer;" > Pesquisar Outra Despesa</a>

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