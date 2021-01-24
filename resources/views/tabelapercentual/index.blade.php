@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Tabelas Porcentuais Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('tabelapercentual-create')
            <a class="btn btn-success" href="{{ route('tabelapercentual.create') }}"> Criar Novo Cadastro de Tabelas Porcentuais</a>
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


    $("#tabelapercentual").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelapercentualajax') }}",

        columns: [
            { name: 'id' },
            { name: 'nometabelapercentual' },
            { name: 'percentualtabelapercentual' },
            { name: 'pgtabelapercentual' },
            { name: 'idostabelapercentual' },
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



    var table = $('#tabelapercentual').DataTable();


     $('#tabelapercentual tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "tabelapercentual/"+data[0];
    } );
     $('#tabelapercentual tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "tabelapercentual/"+ data[0] + "/edit";
    } );



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
    </div>



 
@endsection
