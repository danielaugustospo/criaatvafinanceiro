@extends('layouts.app')


@section('content')
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.html5.min.js"></script> -->

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
        //this calculates values automatically
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
        // var result3 = (((parseFloat(num3) * 100 - parseFloat(num2) * 100) / 100) * -1);
        if (!isNaN(result)) {
            // document.getElementById('sum').value = result;
            document.getElementById('subt').value = lucro;
            document.getElementById('despesa').value = despesa;
            document.getElementById('receita').value = receita;

            // document.getElementById('recmenosdesp').value = result3;
        }
    }
</script>



<div class="row d-flex justify-content-center mb-3 pt-2 text-lg-center" style="background-color: lightslategray; color:white;">
    <h4 for="" class="col-sm-2" style="color: gold;">
        Valor OS: R${{ $ordemdeservico->valorTotalOrdemdeServico }}
    </h4>

    <h5 for="" class="col-sm-2">Quantidade de Despesas:
        @foreach($qtdDespesas as $numeroDespesas)
        {{$numeroDespesas->numerodespesas}}
        @endforeach
    </h5>



    <h5 for="" class="col-sm-2">Quantidade de Receitas:
        @foreach($qtdReceitas as $numeroReceitas)
        {{$numeroReceitas->numeroreceitas}}
        @endforeach
    </h5>
    <form name="form1" method="post" action="">
        <input class="form-control" type="hidden" name="num1" id="num1" value="{{ $ordemdeservico->valorTotalOrdemdeServico }}" readonly />
        <table>
            @foreach($totalreceitas as $valorreceita)
            <input type="hidden" name="" value="{{$valorreceita->totalreceita}}">
            @endforeach
            @foreach($totaldespesas as $valordespesa)
            <input type="hidden" name="" value="{{$valordespesa->totaldespesa}}">


            <tr>
                <td style="color:darkorange;">Despesa:</td>
                <td>
                    <input class="form-control" type="hidden" name="num2" id="num2" value="{{$valordespesa->totaldespesa}}" readonly />
                    <input class="form-control" type="text" name="despesa" id="despesa" readonly />
                </td>
            </tr>
            @endforeach
            <tr>
                <td style="color:aqua;">Receita:</td>
                @foreach($totalreceitas as $valorreceita)

                <td>
                    <input class="form-control" type="hidden" name="num3" id="num3" value="{{$valorreceita->totalreceita}}" readonly />
                    <input class="form-control" type="text" name="receita" id="receita" readonly />
                </td>
                @endforeach

            </tr>
            <tr>
                <td style="color:chartreuse;">Lucro:</td>
                <td><input class="form-control" type="text" name="subt" id="subt" readonly /></td>
            </tr>

        </table>
    </form>

</div>



<div class="form-group row">
    <label for="nomeFormaPagamento" class="col-sm-2 col-form-label">Forma de Pagamento</label>
    <div class="col-sm-4">
        @foreach($formapagamento as $pg)
        <label class="form-control">{{ $pg->nomeFormaPagamento }}</label>
        @endforeach

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
    <div class="col-sm-6">
        <label class="col-sm-4 form-control">{{ $ordemdeservico->dataVendaOrdemdeServico }}</label>
    </div>

    <label for="valorTotalOrdemdeServico" class="col-sm-2 col-form-label">Valor do Projeto</label>
    <div class="col-sm-2">
        <label class="form-control">{{ $ordemdeservico->valorTotalOrdemdeServico }}</label>

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



<hr />
<br>

<h2 class="text-center">Despesas associadas a esta OS:</h2>


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
                "zeroRecords": "Nothing found - sorry",
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
<h2 class="text-center">Receitas associadas a esta OS:</h2>



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
                "zeroRecords": "Nothing found - sorry",
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







<!-- <script>
    $(document).ready(function() {


        $("#receitaModel").DataTable({
            serverSide: true,
            ajax: "{{ route('tabelareceita') }}",

            columns: [{
                    name: 'id'
                },
                {
                    name: 'idosreceita'
                },
                {
                    name: 'valorreceita'
                },
                {
                    name: 'pagoreceita'
                },
                {
                    name: 'contareceita'
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nada localizado",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "A consulta não retornou nenhum resultado",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Pesquisar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",
                },
            },


        });



        $('#receitaModel tbody').on('click', '#visualizar', function() {
            var data = table.row($(this).parents('tr')).data();
            location.href = "receita/" + data[0];
        });
        $('#receitaModel tbody').on('click', '#editar', function() {
            var data = table.row($(this).parents('tr')).data();
            location.href = "receita/" + data[0] + "/edit";
        });


    });
</script>


<div class="container">
    <table id="receitaModel" class="table table-bordered table-striped">
        <thead class="thead-dark">

            <tr>
                <input type="text" id="idDaOS" name="idDaOS" value="{{ $ordemdeservico->id }}">

                <th>Id</th>
                <th>OS Receita</th>
                <th>Id OS</th>
                <th>Descrição Despesa</th>
                <th>Conta Receita</th>
                <th>Ações</th>
            </tr>

        </thead>
    </table>
</div> -->

<hr />
<br>

<h2 class="text-center">Tabela Percentual desta OS:</h2>


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


        $("#tabelaPercentualPorOS").DataTable({
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nothing found - sorry",
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

        // var filter1 = createFilter(table, [0, 1]);
        // filter1.appendTo("body");
    });
</script>





<!--

<script>
    $(document).ready(function() {


        $("#tabelapercentual").DataTable({
            serverSide: true,
            ajax: "{{ route('tabelapercentualajax') }}",

            columns: [{
                    name: 'id'
                },
                {
                    name: 'nometabelapercentual'
                },
                {
                    name: 'percentualtabelapercentual'
                },
                {
                    name: 'pgtabelapercentual'
                },
                {
                    name: 'idostabelapercentual'
                },
                {
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nothing found - sorry",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Pesquisar",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",
                },
            },

        });



        var table = $('#tabelapercentual').DataTable();


        $('#tabelapercentual tbody').on('click', '#visualizar', function() {
            var data = table.row($(this).parents('tr')).data();
            location.href = "tabelapercentual/" + data[0];
        });
        $('#tabelapercentual tbody').on('click', '#editar', function() {
            var data = table.row($(this).parents('tr')).data();
            location.href = "tabelapercentual/" + data[0] + "/edit";
        });



    });
</script>


<div class="container">
    <table id="tabelapercentual" class="table table-bordered table-striped">
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
    </table>
</div> -->



 
@endsection
