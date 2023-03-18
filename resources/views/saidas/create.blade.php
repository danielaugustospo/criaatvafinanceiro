@extends('layouts.app')

@section('content')
@include('estoque/script')
@include('estoque/estilo')
@php $titulo = 'Cadastro de Saídas'; $rotavoltar = 'saidas.index'; @endphp


@include('layouts/helpersview/iniciorelatorio')

{{-- @include('layouts/helpersview/mensagemRetorno') --}}


{!! Form::open(array('route' => 'saidas.store','method'=>'POST','id'=>'formEstoqueCoringa')) !!}

@include('saidas/campos')

{!! Form::hidden('excluidosaida', '0', ['placeholder' => 'Excluído Saída', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidosaida']) !!}
<input type="hidden" name="tpRetorno" id="tpRetorno" value="">


@include('layouts/helpersview/botoes/submit')

{!! Form::close() !!}

@endsection
