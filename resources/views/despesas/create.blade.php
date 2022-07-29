@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            @isset($paginaModal)
            @else
                <div class="pull-left">
                    <h2>Cadastro de Despesas</h2>
                </div>
            @endisset
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('despesas.index') }}"> Voltar</a>
            </div>
        </div>
    </div>

    @include('layouts/helpersview/mensagemRetorno')

    {!! Form::open(['route' => 'despesas.store', 'method' => 'POST', 'id' => 'criaDespesas']) !!}

    @include('despesas/formulario/campos')

    <!-- Seção Despesas -->
    {!! Form::hidden('idAlteracaoUsuario', '', [
        'placeholder' => 'Preencha este campo',
        'class' => 'form-control',
        'maxlength' => '5',
    ]) !!}
    {!! Form::hidden('idAutor', Auth::user()->id, [
        'placeholder' => 'Preencha este campo',
        'class' => 'form-control',
        'maxlength' => '5',
    ]) !!}

    <input type="hidden" name="tpRetorno" id="tpRetorno" value="" />
    {{-- <input type="submit" style="display:none;" class="btn btn-success" name="btnSalvar" value="Salvar" /> --}}
    <input type="button" class="btn btn-success" id="btnSalvareVisualizar" value="Salvar e Visualizar"
        onclick="alteraRetornoCadastroDespesa(retorno = 'visualiza');" />
    <input type="button" class="btn btn-success" id="btnSalvareNovo" value="Salvar e Lançar Nova Despesa"
        onclick="alteraRetornoCadastroDespesa(retorno = 'novo');" />

    {!! Form::close() !!}
@endsection
