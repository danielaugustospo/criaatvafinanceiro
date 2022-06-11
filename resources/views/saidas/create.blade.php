@extends('layouts.app')

@section('content')
@include('estoque/script')
@include('estoque/estilo')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Saídas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('saidas.index') }}"> Voltar</a>
        </div>
    </div>
</div>
<hr>


@include('layouts/helpersview/mensagemRetorno')


{!! Form::open(array('route' => 'saidas.store','method'=>'POST','id'=>'formEstoqueCoringa')) !!}


<div class="form-group row">
    <label for="codbarras" class="col-sm-2 col-form-label labelEvidenciada">Código de Barras</label>
    <div class="col-sm-7">
        {!! Form::text('codbarras', '', ['placeholder' => 'Código de Barras', 'class' => 'form-control inputAumentado', 'maxlength' => '30']) !!}

    </div>
</div>

<div class="form-group row">
    <label for="descricaosaida" class="col-sm-2 col-form-label">Descrição da Saída</label>
    <div class="col-sm-10">
        {!! Form::text('descricaosaida', '', ['placeholder' => 'Descrição da Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'descricaosaida']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label" style="color: red;">Material</label>
    <div class="col-sm-7">
            <select name="idbenspatrimoniais" id="descricaoMaterial"  class="selecionaComInput form-control">
                @foreach ($listaBensPatrimoniais as $bemPatrimonial)
                    <option value=" {{$bemPatrimonial->id}} ">{{$bemPatrimonial->nomeBensPatrimoniais}}</option>
                @endforeach
        </select>
    </div>
    <div class="col-sm-3" id="telaCadastrarMateriais">
        <button type="button" onclick="recarregaDescricaoMaterial()" class="btn btn-dark"><i
                class="fas fa-sync"></i></i></button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i
                class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
    </div>
</div>

<div class="form-group row">
    <label for="portadorsaida" class="col-sm-2 col-form-label">Portador Saída</label>
    <div class="col-sm-6">
        {!! Form::text('portadorsaida', '', ['placeholder' => 'Portador Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!}
    </div>
    <label for="ordemdeservico" class="col-sm-2 col-form-label">Ordem de Serviço</label>
    <div class="col-sm-2">
        {!! Form::text('ordemdeservico', '', ['placeholder' => 'OS', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'ordemdeservico']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data Agendada P/ Retirada</label>
    <div class="col-sm-2">
        {!! Form::date('datapararetiradasaida',  date("Y-m-d"), ['placeholder' => 'Data Para Retirada', 'class' => 'form-control', 'id' => 'datapararetiradasaida']) !!}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data da Retirada</label>
    <div class="col-sm-2">
        {!! Form::date('dataretiradasaida',  date("Y-m-d"), ['placeholder' => 'Data da Retirada Saída', 'class' => 'form-control', 'maxlength' => '50', 'id' => 'portadorsaida']) !!}
    </div>
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Data Prevista de Retorno</label>
    <div class="col-sm-2">
        {!! Form::date('dataretornoretiradasaida', '', ['placeholder' => 'Data de Retorno Saída', 'class' => 'form-control',  'id' => 'dataretornoretiradasaida']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idbenspatrimoniais" class="col-sm-2 col-form-label">Ocorrências</label>
    <div class="col-sm-12">
        {!! Form::textarea('ocorrenciasaida', '', ['placeholder' => 'Ocorrências', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'id' => 'ocorrenciasaida']) !!}
    </div>
</div>


{!! Form::hidden('excluidosaida', '0', ['placeholder' => 'Excluído Saída', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidosaida']) !!}


@include('layouts/helpersview/botoes/submit')

{!! Form::close() !!}

@endsection
