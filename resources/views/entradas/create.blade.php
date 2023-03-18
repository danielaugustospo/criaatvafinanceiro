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
    $rotavoltar = 'entradas.index';

    @endphp

    @include('layouts/helpersview/iniciorelatorio')

    {!! Form::open(['route' => 'entradas.store', 'method' => 'POST', 'id' => 'formEstoqueCoringa']) !!}

    @if ($tipoEntrada == 'novo')
        @include('entradas/novo')
    @elseif ($tipoEntrada == 'devolucao')
        @include('entradas/devolucao')
    @endif
    @include('despesas/cadastramaterial')



    {{-- {!! Form::hidden('qtdeEntrada', '1', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'qtdeEntrada']) !!} --}}
    {!! Form::hidden('excluidoentrada', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoentrada']) !!}
    {!! Form::hidden('metodo', $tipoEntrada, ['maxlength' => '10']) !!}
    <input type="hidden" name="tpRetorno" id="tpRetorno" value="">

    {{-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
    {!! Form::submit('Salvar e Novo', ['class' => 'btn btn-success']) !!} --}}
    @include('layouts/helpersview/botoes/submit')
    {!! Form::close() !!}
@endsection
