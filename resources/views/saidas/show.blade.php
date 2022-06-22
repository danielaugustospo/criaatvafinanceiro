@extends('layouts.app')
@section('content')
@include('estoque/script')
@include('estoque/estilo')
@php $titulo = 'Dados da Retirada'; $rotavoltar = 'saidas.index'; @endphp


    @include('layouts/helpersview/iniciorelatorio')


    @include('saidas/campos')
    <input type="hidden" name="tpRetorno" id="tpRetorno" value="">


@endsection
