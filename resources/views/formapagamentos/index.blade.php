@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gerenciamento de Formas de Pagamento Cadastradas</h2>
        </div>
        <div class="pull-right">
            @can('formapagamento-create')
            <a class="btn btn-success" href="{{ route('formapagamentos.create') }}"> Criar Novo Cadastro de Formas de Pagamento</a>
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


    $("#formaPagamentoModel").DataTable({
        serverSide: true,
        ajax: "{{ route('tabelaformapagamento') }}",

        columns: [
            { name: 'id' },
            { name: 'nomeFormaPagamento' },
            { name: 'ativoFormaPagamento' },
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



    var table = $('#formaPagamentoModel').DataTable();


     $('#formaPagamentoModel tbody').on( 'click', '#visualizar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "formapagamentos/"+data[0];
    } );
     $('#formaPagamentoModel tbody').on( 'click', '#editar', function () {
        var data = table.row( $(this).parents('tr') ).data();
        location.href = "formapagamentos/"+ data[0] + "/edit";
    } );



});
</script>


<div class="container">
        <table id="formaPagamentoModel" class="table table-bordered table-striped">
            <thead class="thead-dark">

            <tr>
                    <th>Id</th>
                    <th>Nome Forma Pagamento</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>

            </thead>
        </table>
    </div>






<!--
<table class="table table-bordered mt-2">

<tr class="trTituloTabela">
            <th class="thTituloTabela">Id</th>
            <th class="thTituloTabela">Nome Forma de Pagamento</th>
            <th class="thTituloTabela">Ativo ?</th>
            <th class="thTituloTabela" width="280px">Ação</th>
        </tr>
        @foreach ($data as $formadepagamento)

        <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $formadepagamento->nomeFormaPagamento }}</td>
	        <td>{{ $formadepagamento->ativoFormaPagamento }}</td>
	        <td>
                <form action="{{ route('formapagamentos.destroy',$formadepagamento->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('formapagamentos.show',$formadepagamento->id) }}">Visualizar</a>
                    @can('formapagamento-edit')
                        <a class="btn btn-primary" href="{{ route('formapagamentos.edit',$formadepagamento->id) }}">Editar</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('formapagamento-delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    @endcan
                </form>
	        </td>
	    </tr>
        @endforeach

    </table> -->

 
@endsection
