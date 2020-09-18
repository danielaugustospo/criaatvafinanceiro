@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Forma de Pagamento {{ $formapagamento->nomeFormaPagamento }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('formapagamentos.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('formapagamentos.destroy',$formapagamento->id) }}" method="POST">
                    @can('formapagamento-edit')
                        <a class="btn btn-primary" href="{{ route('formapagamentos.edit',$formapagamento->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('formapagamento-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Forma de Pagamento:</strong>
            {{ $formapagamento->nomeFormaPagamento }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Ativo?:</strong>
            {{ $formapagamento->ativoFormaPagamento }}
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
