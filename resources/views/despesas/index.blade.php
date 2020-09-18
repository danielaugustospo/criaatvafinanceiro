@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Despesas Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('despesa-create')
            <a class="btn btn-success" href="{{ route('despesas.create') }}"> Criar Novo Cadastro de Despesas</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<script>


$(document).ready(function(){


    $("#despesaModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabeladespesa') }}",

        columns: [
            { name: 'id' },
            { name: 'idCodigoDespesas' },
            { name: 'idOS' },
            { name: 'descricaoDespesa' },
            { name: 'action', orderable: false, searchable:false},

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
            "next":"Próximo",
        },
    },

    });


    var table = $('#despesaModel').DataTable();


     $('#despesaModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "despesas/"+data[0];
    } );
     $('#despesaModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "despesas/"+ data[0] + "/edit";
    } );


});
</script>


<div class="container">
        <table id="despesaModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>Id</th>
                    <th>Código Despesas</th>
                    <th>Id OS</th>
                    <th>Descrição Despesa</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>




<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
