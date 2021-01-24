@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <hr class="col-sm-5">

        <div class="pull-left">
            <h2 class="text-center">Gerenciamento de Ordem de Serviço</h2>
        </div>
        <hr class="col-sm-5">
        <div class="pull-right">
            @can('ordemdeservico-create')
            <a class="btn btn-success ml-3" href="{{ route('ordemdeservicos.create') }}"> Cadastrar OS</a>
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


    $("#osModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelaOS') }}",

        columns: [
            { name: 'id' },
            { name: 'eventoOrdemdeServico' },
            { name: 'clienteOrdemdeServico' },
            { name: 'action', orderable: false, searchable:false},

        ],
        "language": {
        "lengthMenu": "Exibindo _MENU_ registros por página",
        "zeroRecords": "Nenhum dado cadastrado",
        "info": "Exibindo página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhum registro encontrado",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "Pesquisar Número de OS",
        "paginate": {
            "previous": "Anterior",
            "next":"Próximo",
        },
    },

    });


    var table = $('#osModel').DataTable();


     $('#osModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "ordemdeservicos/"+data[0];
    } );
     $('#osModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "ordemdeservicos/"+ data[0] + "/edit";
    } );


    $('#osModel tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );



});
</script>


<div class="container">
        <table id="osModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>OS n°</th>
                    <th>Nome OS</th>
                    <th>Cliente</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>








 
@endsection
