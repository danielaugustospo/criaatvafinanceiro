@extends('layouts.app')
@section('content')
@include('estoque/script')
@include('estoque/estilo')


    @php
    if ($tipoEntrada == 'novo'):
        $titulo = 'Dados da Entrada do Item';
    elseif ($tipoEntrada == 'devolucao'):
        $titulo = 'Material Devolvido';
    endif;
    $rotavoltar = 'entradas.index';
    @endphp

    @include('layouts/helpersview/iniciorelatorio')

    @if ($tipoEntrada == 'novo')
        @include('entradas/novo')
    @elseif ($tipoEntrada == 'devolucao')
        @include('entradas/devolucao')
    @endif
    @include('despesas/cadastramaterial')

@endsection
