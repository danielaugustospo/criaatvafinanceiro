@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Contas Bancárias</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contas.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')




{!! Form::open(array('route' => 'contas.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeBanco" class="col-sm-2 col-form-label">Apelido da Conta</label>
    <div class="col-sm-2">
        {!! Form::text('apelidoConta', '', ['placeholder' => 'Apelido da Conta', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="codigoBanco" class="col-sm-2 col-form-label">Nome da Conta</label>
    <div class="col-sm-10">
        {!! Form::text('nomeConta', '', ['placeholder' => 'Nome Conta', 'class' => 'form-control', 'maxlength' => '20', 'id' => 'nomeConta']) !!}
    </div>
</div>

{{-- <div class="form-group row">
    <label for="codigoBanco" class="col-sm-2 col-form-label">Selcione o Banco</label>
       <select class="selecionaComInput col-sm-10 form-control " name="idBanco" id="idBanco">
            @foreach ($banco as $dadosBanco)
                <option value="{{ $dadosBanco->id }}"> {{ $dadosBanco->codigoBanco }}   |  {{ $dadosBanco->nomeBanco }}</option>
            @endforeach

        </select>
</div> --}}

{!! Form::hidden('ativoConta', '1', ['placeholder' => 'Ativo ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoConta']) !!}
{!! Form::hidden('excluidoConta', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoConta']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

 




@endsection
