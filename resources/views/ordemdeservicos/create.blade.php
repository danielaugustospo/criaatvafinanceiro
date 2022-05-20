@extends('layouts.app')


@section('content')
@extends('ordemdeservicos.estilo')



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Ordem de Serviço</h2>
            <div class="d-flex justify-content-center row">
            <h5>&nbsp; N° &nbsp;</h5>
                <h1 style="margin-top: -10; color: red;">
                      {{ $novaOS }}
                </h1>
            </h5>
        </div>
                      

        </div>

    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')
<hr>

{!! Form::open(array('route' => 'ordemdeservicos.store','method'=>'POST')) !!}
<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
    {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}

</div>

@include('ordemdeservicos/campos')
<input type="hidden" name="idAutor" value="{{Auth::user()->id}}">
{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}

{!! Form::close() !!}




@endsection