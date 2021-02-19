@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Tipos de Bens Patrimoniais</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Cadastrar Novo Tipo de Bem Patrimonial</a>
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


    $("#tipoBensPatrimoniaisModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelatipobenspatrimoniais') }}",

        columns: [
            { name: 'id' },
            { name: 'name' },
            { name: 'detail' },
            { name: 'ativotipobenspatrimoniais' },
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



    var table = $('#tipoBensPatrimoniaisModel').DataTable();


     $('#tipoBensPatrimoniaisModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "products/"+data[0];
    } );
     $('#tipoBensPatrimoniaisModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "products/"+ data[0] + "/edit";
    } );


});
</script>


<div class="container">
        <table id="tipoBensPatrimoniaisModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Detalhes</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>





    <!-- <table class="table table-bordered mt-2">
        <tr class="trTituloTabela">
            <th class="thTituloTabela">Id</th>
            <th class="thTituloTabela">Nome</th>
            <th class="thTituloTabela">Detalhes</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
	        <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Visualizar</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Editar</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table> -->


    {!! $products->links() !!}

 
@endsection
