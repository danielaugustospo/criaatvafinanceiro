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

    {!! Form::open(['route' => 'ordemdeservicos.store', 'method' => 'POST', 'id' => 'manipulaOS']) !!}
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
        <input type="button" class="btn btn-success" id="btnSalvar" value="Salvar" onclick="alteraRetornoCadastroOS(event, retorno = 'novo');" />

    </div>

    @include('ordemdeservicos/campos')
    <input type="hidden" name="idAutor" value="{{ Auth::user()->id }}">
    {{-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!} --}}
    <input type="button" class="btn btn-success" id="btnSalvar" value="Salvar" onclick="alteraRetornoCadastroOS(event, retorno = 'novo');" />

    {!! Form::close() !!}
@endsection
