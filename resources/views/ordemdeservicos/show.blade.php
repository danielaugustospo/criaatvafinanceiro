@extends('layouts.app')

@section('content')
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<style>
    .shadowDiv {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .5) !important;
    }
</style>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da OS: {{ $ordemdeservico->id }} </h2>

        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
            <hr />
            <br>
            <form action="{{ route('ordemdeservicos.destroy',$ordemdeservico->id) }}" method="POST">
                @can('ordemdeservico-edit')
                <a class="btn btn-primary" href="{{ route('ordemdeservicos.edit',$ordemdeservico->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('ordemdeservico-delete')
                <button type="submit" class="btn btn-danger">Excluir</button>
                @endcan
            </form>

        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        sum();
        $("#num1, #num2").on("keydown keyup", function() {
            sum();
        });
    });

    function formatarValor(valor) {
        return valor.toLocaleString('pt-BR', {
            minimumFractionDigits: 2
        });
    }

    function sum() {

        var num1 = document.getElementById('num1').value;
        var num2 = document.getElementById('num2').value;
        var num3 = document.getElementById('num3').value;
        var result = (parseFloat(num1) * 100 + parseFloat(num2) * 100) / 100;
        var result1 = (((parseFloat(num2) * 100 - parseFloat(num1) * 100) / 100) * -1);


        var receita = (formatarValor(parseFloat(num3)));
        var despesa = (formatarValor(parseFloat(num2)));
        var lucro = (formatarValor(result1));
        if (!isNaN(result)) {
            document.getElementById('subt').value = lucro;
            document.getElementById('despesa').value = despesa;
            document.getElementById('receita').value = receita;

        }
    }
</script>
<h3 class="text-center">Resumo Financeiro</h3>

{{-- <div class="shadow-lg p-3 mb-5 bg-white rounded" style="background-color: lightslategray; color:white;"> --}}
<div class="shadowDiv p-3 mb-5 bg-white rounded row d-flex justify-content-center  pt-2 text-lg-center" style="background-color: black !important; color:white;">

    <form name="form1" method="post" action="">
        <div class="row">

            <div class="shadowDiv bg-white rounded col-sm-5 p-2 mr-3" style="background-color: white !important;">
                <input class="form-control" type="hidden" name="num1" id="num1" value="{{ $ordemdeservico->valorOrdemdeServico }}" readonly />

                <div class="row">
                    <label class="btn badge-primary col-sm-4 mr-2" style="cursor: unset;">Receita</label>
                    <input class="form-control col-sm-4 mr-2" style="text-align:center;" type="text" value="{{$totalreceitas}}" readonly />
                    <label class="btn badge-primary col-sm-3" style="cursor: unset;">{{ $porcentagemReceita }} %</label>
                </div>
                <div class="row ">
                    <label class="btn badge-danger col-sm-4 mr-2" style="cursor: unset;">Despesa:</label>
                    <input class="form-control col-sm-4 mr-2" style="text-align:center;" type="text" value="{{$totaldespesas}}" readonly />
                    <label class="btn badge-danger col-sm-3" style="cursor: unset;">{{ $porcentagemDespesa }} %</label>
                </div>
                <div class="row">
                    <label class="btn badge-success col-sm-4 mr-2" style="cursor: unset;">Lucro</label>
                    <input class="form-control col-sm-4 mr-2" style="text-align:center;" type="text" value="{{ $lucro }}" readonly />
                    <label class="btn badge-success col-sm-3" style="cursor: unset;">{{ $porcentagemLucro }} %</label>
                </div>
            </div>

            <div class="shadowDiv bg-white rounded col-sm-5 p-2 ml-2" style="background-color: white !important;">
                <input class="form-control" type="hidden" name="num1" id="num1" value="{{ $ordemdeservico->valorOrdemdeServico }}" readonly />

                <div class="row">
                    <label class="btn badge-primary col-sm-4 mr-2" style="cursor: unset;">A Receber</label>
                    <input class="form-control col-sm-4 mr-2" style="text-align:center;" type="text" value="{{$totalreceitasAPagar}}" readonly />
                    <label class="btn badge-primary col-sm-3" style="cursor: unset;">{{ $porcentagemReceitaAPagar }} %</label>
                </div>
                <div class="row ">
                    <label class="btn badge-danger col-sm-4 mr-2" style="cursor: unset;">A Pagar</label>
                    <input class="form-control col-sm-4 mr-2" style="text-align:center;" type="text" value="{{$totaldespesasAPagar}}" readonly />
                    <label class="btn badge-danger col-sm-3" style="cursor: unset;">{{ $porcentagemDespesaAPagar }} %</label>
                </div>
                {{-- <div class="row">
                    <label class="btn badge-success col-sm-4 mr-2" style="cursor: unset;">Lucro</label>
                    <input class="form-control col-sm-4 mr-2" style="text-align:center;" type="text" value="{{ $lucro }}" readonly />
                    <label class="btn badge-success col-sm-3" style="cursor: unset;">{{ $porcentagemLucro }} %</label>
                </div> --}}
            </div>
        </div>

</div>
{{-- </div> --}}

<div class="shadowDiv p-3 mb-5 bg-white rounded pt-2 text-lg-center" style="background-color: white !important; color:black;">

{{-- <div class="form-group row"> --}}
    {{-- <label for="nomeFormaPagamento" class="col-sm-2 col-form-label">Forma de Pagamento</label>
    <div class="col-sm-4">
        @foreach($formapagamento as $pg)
        <label class="form-control">{{ $pg->nomeFormaPagamento }}</label>
    @endforeach

</div> --}}
<div class="form-group row">
<label for="idClienteOrdemdeServico" class="col-sm-2 col-form-label">Cliente</label>
<div class="col-sm-6">
    <label class="form-control">
        @foreach ($cliente as $listaCliente)
            {{ $listaCliente->razaosocialCliente }}
        @endforeach
    </label>

</div>
</div>



<div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Data Venda</label>
    <div class="col-sm-6">
        <label class="col-sm-4 form-control">{{ $ordemdeservico->created_at->format('d/m/Y') }}</label>
    </div>

    <label for="valorOrdemdeServico" class="col-sm-2 col-form-label">Valor do Projeto</label>
    <div class="col-sm-2">
        <label class="form-control">{{ $totalOS }}</label>

    </div>
</div>

<div class="form-group row">
    <label for="eventoOrdemdeServico" class="col-sm-2 col-form-label">Evento</label>
    <div class="col-sm-10">
        <label class="form-control">{{ $ordemdeservico->eventoOrdemdeServico }}</label>

    </div>
</div>

<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label">Observação</label>
    <div class="col-sm-10">
        <label class="form-control">{{ $ordemdeservico->obsOrdemdeServico }}</label>

    </div>
</div>
</div>


<hr />
<br>

<h2 class="text-center">Despesas</h2>


<table id="tabelaDespesaPorOS" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Código Despesas</th>
            <th>Id OS</th>
            <th>Descrição Despesa</th>
            <th width="280px">Ação</th>
        </tr>
    </thead>





    @foreach ($despesaPorOS as $tabeladespesa)

    <tr>
        <td>{{ $tabeladespesa->id }}</td>
        <td>{{ $tabeladespesa->idCodigoDespesas }}</td>
        <td>{{ $tabeladespesa->idOS }}</td>
        <td>{{ $tabeladespesa->descricaoDespesa }}</td>
        <td>
            <form action="{{ route('despesas.destroy',$tabeladespesa->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('despesas.show',$tabeladespesa->id) }}">Visualizar</a>
                @can('despesa-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('despesas.edit',$tabeladespesa->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('despesa-delete')
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach

</table>

<script>
    function createFilter(table, columns) {
        // var input = $('<input type="text"/>').on("keyup", function() {
        //     table.draw();
        // });

        $.fn.dataTable.ext.search.push(function(
            settings,
            searchData,
            index,
            rowData,
            counter
        ) {
            var val = input.val().toLowerCase();

            for (var i = 0, ien = columns.length; i < ien; i++) {
                if (searchData[columns[i]].toLowerCase().indexOf(val) !== -1) {
                    return true;
                }
            }

            return false;
        });

        return input;
    }

    $(document).ready(function() {


        $("#tabelaDespesaPorOS").DataTable({
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nenhum dado cadastrado",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Pesquisar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",
                },
            },
        })


        var table = $("#tabelaDespesaPorOS").DataTable();

        // var filter1 = createFilter(table, [0, 1]);
        // filter1.appendTo("body");
    });
</script>

<hr />
<br>
<h2 class="text-center">Receitas</h2>



<table id="tabelaReceitaPorOS" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>OS Receita</th>
            <th>Valor</th>
            <th>Pago</th>
            <th>Conta</th>
            <th width="280px">Ação</th>
        </tr>
    </thead>



    @foreach ($receitasPorOS as $tabelareceita)

    <tr>
        <td>{{ $tabelareceita->id }}</td>
        <td>{{ $tabelareceita->idosreceita }}</td>
        <td>{{ $tabelareceita->valorreceita }}</td>
        <td>{{ $tabelareceita->pagoreceita }}</td>
        <td>{{ $tabelareceita->contareceita }}</td>
        <td>
            <form action="{{ route('receita.destroy',$tabelareceita->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('receita.show',$tabelareceita->id) }}">Visualizar</a>
                @can('receita-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('receita.edit',$tabelareceita->id) }}">Editar</a>
                @endcan

                @csrf
                @method('DELETE')
                @can('receita-delete')
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach

</table>

<script>
    function createFilter(table, columns) {
        // var input = $('<input type="text"/>').on("keyup", function() {
        //     table.draw();
        // });

        $.fn.dataTable.ext.search.push(function(
            settings,
            searchData,
            index,
            rowData,
            counter
        ) {
            var val = input.val().toLowerCase();

            for (var i = 0, ien = columns.length; i < ien; i++) {
                if (searchData[columns[i]].toLowerCase().indexOf(val) !== -1) {
                    return true;
                }
            }

            return false;
        });

        return input;
    }

    $(document).ready(function() {


        $("#tabelaReceitaPorOS").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nenhum dado cadastrado",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Pesquisar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",
                },
            },
        })


        var table = $("#tabelaReceitaPorOS").DataTable();

        // var filter1 = createFilter(table, [0, 1]);
        // filter1.appendTo("body");
    });
</script>







<hr />
<br>


{{-- Tabela Percentual sendo comentada em  24/04/2021 a pedido do Nélio em reunião no dia 17/04/2021
<h2 class="text-center">Tabela Percentual</h2>


<table id="tabelaPercentualPorOS" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nome Parte</th>
            <th>Percentual</th>
            <th>Pago</th>
            <th>Id OS</th>
            <th>Ações</th>
        </tr>
    </thead>


    @foreach ($percentualPorOS as $tabelapercentual)

    <tr>
        <td>{{ $tabelapercentual->id }}</td>
<td>{{ $tabelapercentual->nometabelapercentual }}</td>
<td>{{ $tabelapercentual->percentualtabelapercentual }}</td>
<td>{{ $tabelapercentual->pgtabelapercentual }}</td>
<td>{{ $tabelapercentual->idostabelapercentual }}</td>
<td>
    <form action="{{ route('tabelapercentual.destroy',$tabelapercentual->id) }}" method="POST">
        <a class="btn btn-info btn-sm" href="{{ route('tabelapercentual.show',$tabelapercentual->id) }}">Visualizar</a>
        @can('tabelapercentual-edit')
        <a class="btn btn-primary btn-sm" href="{{ route('tabelapercentual.edit',$tabelapercentual->id) }}">Editar</a>
        @endcan

        @csrf
        @method('DELETE')
        @can('tabelapercentual-delete')
        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
        @endcan
    </form>
</td>
</tr>
@endforeach

</table>
--}}
<script>
    function createFilter(table, columns) {

        $.fn.dataTable.ext.search.push(function(
            settings,
            searchData,
            index,
            rowData,
            counter
        ) {
            var val = input.val().toLowerCase();

            for (var i = 0, ien = columns.length; i < ien; i++) {
                if (searchData[columns[i]].toLowerCase().indexOf(val) !== -1) {
                    return true;
                }
            }

            return false;
        });

        return input;
    }

    $(document).ready(function() {


        $("#tabelaPercentualPorOS").DataTable({
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nenhum dado cadastrado",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Pesquisar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",
                },
            },
        })


        var table = $("#tabelaPercentualPorOS").DataTable();

    });
</script>









@endsection