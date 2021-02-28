@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Tabela Percentual {{$tabelapercentual->nometabelapercentual}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tabelapercentual.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Ops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


{!! Form::model($tabelapercentual, ['method' => 'PATCH','route' => ['tabelapercentual.update', $tabelapercentual->id]]) !!}
<div class="form-group row">
    <label for="nometabelapercentual" class="col-sm-2 col-form-label">Nome do Favorecido</label>
    <div class="col-sm-10">
        {!! Form::text('nometabelapercentual', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

    </div>
</div>
<div class="form-group row">
    <label for="percentualtabelapercentual" class="col-sm-2 col-form-label">Percentual</label>
    <div class="col-sm-2">
        {!! Form::text('percentualtabelapercentual', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'percentualtabelapercentual']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row">
    <label for="pgtabelapercentual" class="col-sm-2 col-form-label">Pago</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('pgtabelapercentual', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'pgtabelapercentual']) !!} -->
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
        <select name="pgtabelapercentual" id="pgtabelapercentual" style="padding:4px;" class="form-control">
            <option value="S" {{$tabelapercentual->pgtabelapercentual == 'S'?' selected':''}}>Sim</option>
            <option value="N" {{$tabelapercentual->pgtabelapercentual == 'N'?' selected':''}}>Não</option>
        </select>
    </div>

    <label for="idostabelapercentual" class="col-sm-2 col-form-label">Id OS</label>
    <div class="col-sm-5 mb-3">
    <select name="idostabelapercentual" id="idostabelapercentual" class="selecionaComInput col-sm-12">
        @foreach ($listaOS as $idOS)
        <option value="{{$idOS->id}}">
            Código da OS: {{$idOS->id}} - Evento: {{$idOS->eventoOrdemdeServico}}
        </option>
        @endforeach
    </select>

</div>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>


{!! Form::close() !!}

 
@endsection
