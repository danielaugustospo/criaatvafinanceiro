@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da OS: {{ $ordemdeservico->clienteOrdemdeServico }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
        </div>
    </div>
</div>


<div class="form-group row">
    <label for="nomeFormaPagamento" class="col-sm-2 col-form-label">Forma de Pagamento</label>
    <div class="col-sm-4">
        <label class="form-control">{{ $ordemdeservico->nomeFormaPagamento }}</label>
    </div>
    <label for="idClienteOrdemdeServico" class="col-sm-1 col-form-label">Cliente</label>
    <div class="col-sm-5">

        <label class="form-control">
            @foreach ($cliente as $listaCliente)

            {{ $listaCliente->nomeCliente }}
            @endforeach
        </label>


    </div>
</div>



<div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Data Venda</label>
    <div class="col-sm-2">
        <label class="form-control">{{ $ordemdeservico->dataVendaOrdemdeServico }}</label>
    </div>
    <label for="dataOrdemdeServico" class="col-sm-2 col-form-label">Data Ordem de Serviço</label>
    <div class="col-sm-2">
        <label class="form-control">{{ $ordemdeservico->dataOrdemdeServico }}</label>

    </div>
    <label for="dataCriacaoOrdemdeServico" class="col-sm-1 col-form-label">Data Criação</label>
    <div class="col-sm-3">
        <label class="form-control">{{ $ordemdeservico->dataCriacaoOrdemdeServico }}</label>

    </div>
</div>


<div class="form-group row">
    <label for="valorTotalOrdemdeServico" class="col-sm-2 col-form-label">Valor Total</label>
    <div class="col-sm-2">
        <label class="form-control">{{ $ordemdeservico->valorTotalOrdemdeServico }}</label>

    </div>
    <label for="valorProjetoOrdemdeServico" class="col-sm-1 col-form-label">Valor Projeto</label>
    <div class="col-sm-2">
        <label class="form-control">{{ $ordemdeservico->valorProjetoOrdemdeServico }}</label>

    </div>
    <label for="valorOrdemdeServico" class="col-sm-2 col-form-label">Valor Ordem de Serviço</label>
    <div class="col-sm-3">
        <label class="form-control">{{ $ordemdeservico->valorOrdemdeServico }}</label>

    </div>
</div>



<div class="form-group row">
    <label for="clienteOrdemdeServico" class="col-sm-2 col-form-label">Nome da Ordem de Serviços</label>
    <div class="col-sm-10">
        <label class="form-control">{{ $ordemdeservico->clienteOrdemdeServico }}</label>

    </div>
</div>
<div class="form-group row">
    <label for="eventoOrdemdeServico" class="col-sm-2 col-form-label">Evento</label>
    <div class="col-sm-10">
        <label class="form-control">{{ $ordemdeservico->eventoOrdemdeServico }}</label>

    </div>
</div>
<div class="form-group row">
    <label for="servicoOrdemdeServico" class="col-sm-2 col-form-label">Serviço</label>
    <div class="col-sm-10">
        <label class="form-control">{{ $ordemdeservico->servicoOrdemdeServico }}</label>

    </div>
</div>
<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label">Observação</label>
    <div class="col-sm-10">
        <label class="form-control">{{ $ordemdeservico->obsOrdemdeServico }}</label>

    </div>
</div>



<hr>


<h2 class="text-center">Despesas associadas a esta OS:</h2>

<table class="table table-bordered mt-2">

    <tr class="trTituloTabela">
        <th class="thTituloTabela">Id</th>
        <th class="thTituloTabela">Nome Despesa</th>
        <th class="thTituloTabela">N° OS</th>
        <th class="thTituloTabela" width="280px">Ação</th>
    </tr>
    @foreach ($despesaPorOS as $listaDespesa)
    <tr>
        <td>{{ $listaDespesa->id }}</td>
        <td>{{ $listaDespesa->descricaoDespesa }}</td>
        <td>{{ $listaDespesa->idOS }}</td>
        <td>
            <form action="{{ route('despesas.destroy',$listaDespesa->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('despesas.show',$listaDespesa->id) }}">Visualizar</a>
                @can('despesa-edit')
                <a class="btn btn-primary" href="{{ route('despesas.edit',$listaDespesa->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('despesa-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach

</table>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
