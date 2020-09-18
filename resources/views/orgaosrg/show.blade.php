@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados do Orgão Emissor {{ $orgaorg->nome }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('orgaosrg.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('orgaosrg.destroy',$orgaorg->id) }}" method="POST">
                    @can('orgaorg-edit')
                        <a class="btn btn-primary" href="{{ route('orgaosrg.edit',$orgaorg->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('orgaorg-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $orgaorg->nome }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Unidade Federativa:</strong>
            {{ $orgaorg->estadoOrgaoRG }}
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
