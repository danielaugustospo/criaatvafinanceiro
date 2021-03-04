@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Forma de Pagamento: <b>{{ $formapagamento->nomeFormaPagamento }}</b></h2>
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
            <strong>Ativo (Visível no Sistema):</strong>
            @if ( $formapagamento->ativoFormaPagamento == '1')
                Sim    
            @else
                Não
            @endif
        </div>
    </div>
</div>

 
@endsection
