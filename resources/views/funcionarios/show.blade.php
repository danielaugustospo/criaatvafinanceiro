@extends('layouts.app')


@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="col-lg-12 d-flex justify-content-between">
            <h2> Dados Prestador de Serviço Daniel Augusto</h2>
            <img src="../storage/fotosFuncionarios/{{ $funcionario->fotoFuncionario }}" style="height: 200;" alt="" srcset="">

        </div>


        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
            <hr>
            <br>
            <form action="{{ route('funcionarios.edit',$funcionario->id) }}" method="POST">
                <a class="btn btn-primary" href="{{ route('funcionarios.edit',$funcionario->id) }}">Editar</a>

                <input type="hidden" name="_token" value="4biFdpfiCrtgtFw1Fy2Qw6mMD7UyFoAul3j3r88Y"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-danger">Excluir</button>
            </form>

        </div>
    </div>
</div>


{!! Form::model($funcionario,  ['method' => 'PATCH','route' => ['funcionarios.update', $funcionario->id], 'enctype' => 'multipart/form-data']) !!}

@include('funcionarios/campos')

{!! Form::hidden('ativoFuncionario', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativoFuncionario', 'maxlength' => '11']) !!}
{!! Form::hidden('excluidoFuncionario', '0', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'excluidoFuncionario', 'maxlength' => '11']) !!}

<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
</div>

<!-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!} -->
{!! Form::close() !!}




@endsection