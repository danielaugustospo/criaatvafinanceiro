@extends('layouts.app')


@section('content')

@include('layouts/helpersview/mensagemRetorno')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edição - Despesa ID {{ $despesa->id }} - 
                @if ($despesa->ehcompra == 0 || $despesa->insereestoque == 0)  {{$despesa->descricaoDespesa }} 
                    @elseif (($despesa->ehcompra == 1) && ($despesa->insereestoque == 1) && ($despesa->insereestoque == null))  
                        @foreach ($listaBensPatrimoniais as $bempatrimonial)
                            @if($bempatrimonial->id  == $despesa->descricaoDespesa) 
                                {{$bempatrimonial->nomeBensPatrimoniais}} 
                            @endif
                        @endforeach
                @endif 
            </h2>

        </div>
        <div class="pull-right">
            <a class="btn btn-primary" data-toggle="modal" data-target=".modaldepesas" style="color: white; cursor:pointer;" > Pesquisar Outra Despesa</a>
        </div>
    </div>
</div>




{!! Form::model($despesa, ['method' => 'PATCH','route' => ['despesas.update', $despesa->id]]) !!}
  
@include('despesas/campos')

 
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
{!! Form::hidden('id', $despesa->id, ['class' => 'form-control', 'maxlength' => '500']) !!}
{!! Form::hidden('idAlteracaoUsuario', Auth::user()->id, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '5']) !!}

{!! Form::close() !!}


@endsection