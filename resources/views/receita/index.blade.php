@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Gerenciamento de Receitas Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('receita-create')
            <a class="btn btn-success" href="{{ route('receita.create') }}"> Criar Novo Cadastro de Receita</a>
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


    $("#receitaModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelareceita') }}",

        columns: [
            { name: 'id' },
            { name: 'idosreceita' },
            { name: 'valorreceita' },
            { name: 'pagoreceita' },
            { name: 'contareceita' },
            { name: 'action', orderable: false, searchable:false},

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
            "next":"Próximo",
        },
    },

    });


    var table = $('#receitaModel').DataTable();


     $('#receitaModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "receita/"+data[0];
    } );
     $('#receitaModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "receita/"+ data[0] + "/edit";
    } );


});
</script>


<div class="container">
        <table id="receitaModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>Id</th>
                    <th>OS Receita</th>
                    <th>Valor</th>
                    <th>Pago</th>
                    <th>Conta Receita</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>



 
@endsection
