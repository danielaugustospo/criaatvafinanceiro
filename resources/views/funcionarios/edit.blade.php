@extends('layouts.app')


@section('content')

<script>
    $(function() {
        // Pré-visualização de várias imagens no navegador
        var visualizacaoImagens = function(input, lugarParaInserirVisualizacaoDeImagem) {

            if (input.files) {
                var quantImagens = input.files.length;

                for (i = 0; i < quantImagens; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img class="miniatura">')).attr('src', event.target.result).appendTo(lugarParaInserirVisualizacaoDeImagem);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#fotoFuncionario').on('change', function() {
            visualizacaoImagens(this, 'div.galeria');
        });
    });
</script>
<style>
    .miniatura {
        height: 200px;
        width: 130px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
    }
</style>

<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
</div>
<hr>
<br>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados do Usuário {{$funcionario->nomeFuncionario}}</h2>
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

{!! Form::model($funcionario,  ['method' => 'PATCH','route' => ['funcionarios.update', $funcionario->id], 'enctype' => 'multipart/form-data']) !!}

<div class="form-group row col-lg-12 mt-4">

    <div class="col-lg-4 d-flex justify-content-between">
        <label class="col-sm-3 col-form-label pr-2">Foto Atual </label>
        <img src="../../storage/fotosFuncionarios/{{$funcionario->fotoFuncionario}}" style="height: 200;" alt="" srcset="">
    </div>
    <div class="col-lg-8 d-flex justify-content-end">

        <label class="col-sm-3 col-form-label pr-2">Alterar Foto</label>

        <div class="galeria"></div>
        <input type="file" class="form-control-file btn btn-secondary col-sm-6" id="fotoFuncionario" name="fotoFuncionario">
    </div>
</div>


@include('funcionarios/campos')

{!! Form::hidden('ativoFuncionario', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativoFuncionario', 'maxlength' => '11']) !!}
{!! Form::hidden('excluidoFuncionario', null, ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'excluidoFuncionario', 'maxlength' => '11']) !!}

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
</div>
{!! Form::close() !!}


@endsection