@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Tabela Percentual {{ $tabelapercentual->nometabelapercentual }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tabelapercentual.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('tabelapercentual.destroy',$tabelapercentual->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('tabelapercentual-edit')
                        <a class="btn btn-primary" href="{{ route('tabelapercentual.edit',$tabelapercentual->id) }}">Editar</a>
                    @endcan
                    @can('tabelapercentual-delete')
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
            {{ $tabelapercentual->nometabelapercentual }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Percentual:</strong>
            {{ $tabelapercentual->percentualtabelapercentual }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Pago:</strong>
            {{ $tabelapercentual->pgtabelapercentual }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Id OS:</strong>
            {{ $tabelapercentual->idostabelapercentual }}
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
