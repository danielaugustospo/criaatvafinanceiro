@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Contas a Receber</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('receita-create')
            <a class="btn btn-success" href="{{ route('receita.create') }}">Cadastrar Receita</a>
            @endcan
            @include('layouts/exibeFiltro')
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<hr>
@include('contacorrente/filtroindex')


<table id="data-table" class="table table-bordered data-table">
    <thead>
        <tr>
            <th class="text-center">Data</th>
            <th class="text-center">OS</th>
            <th class="text-center">Cliente</th>
            <th class="text-center">Evento</th>
            <th width="text-center" class="noExport">Valor a Receber</th>
            <th width="text-center" class="noExport">Conta</th>
            <th width="text-center" class="noExport">NF</th>
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
        $('input[name=buscaCliente]').val('');
        $('input[name=buscaEvento]').val('');
        $('input[name=buscaValor]').val('');
        $('input[name=buscaConta]').val('');
        $('input[name=buscaNF]').val('');
        $('input[name=buscaDataInicio]').val('');
        $('input[name=buscaDataFim]').val('');
        $('input[name=pesquisar]').click();
    });
    var table = $('#data-table').DataTable({

                ajax: {
                    url: "{{ route('tabelaContasAReceber') }}",
                    data: function(d) {
                            d.buscaData         = $('.buscaData').val(),
                            d.buscaOS           = $('.buscaOS').val(),
                            d.buscaCliente      = $('.buscaCliente').val(),
                            d.buscaEvento       = $('.buscaEvento').val(),
                            d.buscaValor        = $('.buscaValor').val(),
                            d.buscaConta        = $('.buscaConta').val(),
                            d.buscaNF           = $('.buscaNF').val(),
                            d.buscaDataInicio   = $('.buscaDataInicio').val();
                            d.buscaDataFim      = $('.buscaDataFim').val();

                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'vencimento',
                        name: 'vencimento',
                        render: $.fn.dataTable.render.moment('DD/MM/YYYY')
                    },
                    {
                        data: 'idOS',
                        name: 'idOS'
                    },
                    {
                        data: 'nomeCliente',
                        name: 'nomeCliente'
                    },
                    {
                        data: 'evento',
                        name: 'evento'
                    },
                    {
                        data: 'preco',
                        name: 'preco',
                        render: $.fn.dataTable.render.number('.', ',', 2)
                    },
                    {
                        data: 'agencia',
                        name: 'agencia'
                    },
                    {
                        data: 'notaFiscal',
                        name: 'notaFiscal'
                    }
                ],

                @include('layouts/includeTabela')


                $("#pesquisar").click(function() {
                    table.draw();
                    // preventDefault();
                });
</script>

@endsection