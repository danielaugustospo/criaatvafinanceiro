@extends('layouts.app')
@section('content')
@include('estoque/script')
@include('estoque/estilo')


    @php
    if ($tipoEntrada == 'novo'):
        $titulo = 'Lançamento de Entrada';
    elseif ($tipoEntrada == 'devolucao'):
        $titulo = 'Devolução de Material';
    endif;
    @endphp

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="row pull-left">
                <a class="btn btn-primary" href="{{ route('entradas.index') }}"> Voltar</a>
                <h2 class="pl-5">{{ $titulo }}</h2>
            </div>
            <hr />
        </div>
    </div>


    @include('layouts/helpersview/mensagemRetorno')

    {!! Form::open(['route' => 'entradas.store', 'method' => 'POST', 'id'=>'formEstoqueCoringa']) !!}

    @if ($tipoEntrada == 'novo')
        @include('entradas/novo')
    @elseif ($tipoEntrada == 'devolucao')
        @include('entradas/devolucao')
    @endif
    @include('despesas/cadastramaterial')



    {{-- {!! Form::hidden('qtdeEntrada', '1', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'qtdeEntrada']) !!} --}}
    {!! Form::hidden('excluidoentrada', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoentrada']) !!}
    {!! Form::hidden('metodo', $tipoEntrada, ['maxlength' => '10']) !!}
    <input type="hidden" id="tpRetorno">

    {{-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
    {!! Form::submit('Salvar e Novo', ['class' => 'btn btn-success']) !!} --}}
    @include('layouts/helpersview/botoes/submit')
    {!! Form::close() !!}
@endsection
