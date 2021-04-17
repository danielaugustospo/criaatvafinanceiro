@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Consulta de Extrato</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            <div class="col-sm-6">
            @can('receita-create')
            <a class="btn btn-success" href="{{ route('receita.create') }}">Cadastrar Receita</a>
            <a class="btn btn-dark" href="{{ route('despesas.create') }}">Cadastrar Despesa</a>
            @endcan
        </div>
            @include('layouts/exibeFiltro')
        </div>
    </div>
</div>

<style>
    .green {
        background-color: rgb(207, 241, 248);
        color: rgb(12, 95, 109) !important;
    }
    .red {
        background-color: rgb(248, 215, 215) !important;
        color: rgb(151, 13, 13);
    }
    .trTabela {
        background-color: slategray;
    }

</style>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<hr>
@include('contacorrente/filtroextrato')


<table id="data-table" class="table table-bordered data-table">
    <thead>
        <tr class="trTabela">
            <th class="text-center">Data</th>
            <th class="text-center">Conta</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Descrição</th>
            {{-- <th width="100px" class="noExport">Ações</th> --}}
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    @include('layouts/daterange')


    $('#btnReveal').hide();

    $('#btnReveal').on('click', function() {
        $('#areaTabela').show('#div_BuscaPersonalizada');
        $('#btnReveal').hide();
        $('#btnEsconde').show();
        $('#div_BuscaPersonalizada').show();
    });

    $('#btnEsconde').on('click', function() {
        $('#areaTabela').hide('#div_BuscaPersonalizada');
        $('#btnEsconde').hide();
        $('#btnReveal').show();
        
        $('input[name=buscaData]').val('');
        $('input[name=buscaOS]').val('');
        // $('input[name=buscaCliente]').val('');
        // $('input[name=buscaEvento]').val('');
        $('input[name=buscaValor]').val('');
        $('input[name=buscaConta]').val('');
        // $('input[name=buscaNF]').val('');
        $('input[name=buscaDataInicio]').val('');
        $('input[name=buscaDataFim]').val('');
        $('input[name=pesquisar]').click();
    });
    var table = $('#data-table').DataTable({
        
        "createdRow": function( row, data, dataIndex, cells ) {
            var valor = 0;
            if ( data.pagoreceita == "S" ) {
                $(row).addClass( 'green' );
                // console.log(data.valorreceita);
            }
            else if ( data.pagoreceita == "1" ) {
                $(row).addClass( 'red' );
            }
        },


        ajax: {
                    url: "{{ route('tabelaExtratoConta') }}",
                    data: function(d) {
                             d.buscaData         = $('.buscaData').val(),
                             d.buscaOS           = $('.buscaOS').val(),
                    //         d.buscaCliente      = $('.buscaCliente').val(),
                    //         d.buscaEvento       = $('.buscaEvento').val(),
                             d.buscaValor        = $('.buscaValor').val(),
                             d.buscaConta        = $('.buscaConta').val(),
                    //         d.buscaNF           = $('.buscaNF').val(),
                             d.buscaDataInicio   = $('.buscaDataInicio').val();
                             d.buscaDataFim      = $('.buscaDataFim').val();

                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'datapagamentoreceita',
                        name: 'datapagamentoreceita',
                        render: $.fn.dataTable.render.moment('DD/MM/YYYY'),
                    },
                    {
                        data: 'agenciaConta',
                        name: 'agenciaConta'
                    },
                    {
                        data: 'valorreceita',
                        name: 'valorreceita',
                        render: $.fn.dataTable.render.number( '.', ',', 2)
                    },
                    {
                        data: 'descricaoReceita',
                        name: 'descricaoReceita',
                        render: $.fn.dataTable.render.number( '.', ',', 2)
                    }
                    // ,
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false,
                    //     exportOptions: {
                    //     visible: false
                    //     },
                    // }

                ],
                columnDefs: [
                    { className: 'text-right', targets: 2  },
                    { className: 'text-center', targets: '_all'  }
                ],


                @include('layouts/includeTabela')


                $("#pesquisar").click(function() {
                    table.draw();
                    // preventDefault();
                });
</script>

@endsection