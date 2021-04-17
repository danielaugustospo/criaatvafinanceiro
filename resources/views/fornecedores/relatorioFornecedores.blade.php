@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Relatório de Fornecedores</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('fornecedor-create')
            <a class="btn btn-success" href="{{ route('fornecedores.create') }}">Cadastrar Fornecedor</a>
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
@include('fornecedores/filtrorelatorio')


<table id="data-table" class="table table-bordered data-table">
    <thead>
        <tr>
            <th class="text-center">OS</th>
            <th class="text-center">Nome Evento</th>
            <th class="text-center">Despesa</th>
            <th class="text-center">Nome Fantasia</th>
            <th class="text-center">Razão Social</th>
            <th class="text-center">Registro</th>
            <th class="text-center">Vencimento</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Pago</th>
            {{-- <th class="text-center">Banco</th>
            <th class="text-center">N° Conta</th>
            <th class="text-center">Agência</th>
            <th class="text-center">Chave Pix 1</th>
            <th class="text-center">Chave Pix 2</th> --}}

            {{-- <th width="100px" class="noExport">Ações</th> --}}
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script type="text/javascript">
    @include('layouts/daterange')


$('#btnReveal').hide();

$('#btnReveal').on('click', function () {
    $('#areaTabela').show('#div_BuscaPersonalizada');
    $('#btnReveal').hide();
    $('#btnEsconde').show();
    $('#div_BuscaPersonalizada').show();
})

$('#btnEsconde').on('click', function () {
    $('#areaTabela').hide('#div_BuscaPersonalizada');
    $('#btnEsconde').hide();
    $('#btnReveal').show();

    $('input[name=buscaIdOS]').val('');
    $('input[name=buscaEventoOrdemdeServico]').val('');
    $('input[name=buscaDescricaoDespesa]').val('');
    $('input[name=buscaNomeFornecedor]').val('');
    $('input[name=buscaRazaosocialFornecedor]').val('');
    $('input[name=buscaNRegistro]').val('');
    $('input[name=buscaVencimento]').val('');
    $('input[name=buscaPrecoReal]').val('');
    $('input[name=buscaPago]').val('');
    // $('input[name=nrcontaFornecedor]').val('');
    // $('input[name=agenciaFornecedor]').val('');
    // $('input[name=chavePix1Fornecedor]').val('');
    // $('input[name=chavePix2Fornecedor]').val('');
    // $('input[name=bancoFornecedor]').val('');
    $('input[name=pesquisar]').click();
})

var table = $('#data-table').DataTable({

    ajax: {
        url: "{{ route('tabelaRelatorioFornecedores') }}",
        data: function(d) {
                d.idOS                    = $('.buscaIdOS').val(),
                d.eventoOrdemdeServico    = $('.buscaEventoOrdemdeServico').val(),
                d.descricaoDespesa        = $('.buscaDescricaoDespesa').val(),
                d.nomeFornecedor          = $('.buscaNomeFornecedor').val(),
                d.razaosocialFornecedor   = $('.buscaRazaosocialFornecedor').val(),
                d.nRegistro               = $('.buscaNRegistro').val(),
                d.vencimento              = $('.buscaVencimento').val(),
                d.precoReal               = $('.buscaPrecoReal').val(),
                d.pago                    = $('.buscaPago').val(),
        //         // d.bancoFornecedor       = $('#bancoFornecedor').val(),
        //         // d.nrcontaFornecedor     = $('#nrcontaFornecedor').val(),
        //         // d.agenciaFornecedor     = $('#agenciaFornecedor').val(),
        //         // d.chavePix1Fornecedor   = $('#chavePix1Fornecedor').val(),
        //         // d.chavePix2Fornecedor   = $('#chavePix2Fornecedor').val(),
                d.search                = $('input[type="search"]').val()
        }
    },

    columns: [
        {
            data: 'idOS',
            name: 'idOS'
        },
        {
            data: 'eventoOrdemdeServico',
            name: 'eventoOrdemdeServico'
        },
        {
            data: 'descricaoDespesa',
            name: 'descricaoDespesa'
        },
        {
            data: 'nomeFornecedor',
            name: 'nomeFornecedor'
        },
        {
            data: 'razaosocialFornecedor',
            name: 'razaosocialFornecedor'
        },
        {
            data: 'nRegistro',
            name: 'nRegistro'
        },
        {
            data: 'vencimento',
            name: 'vencimento',
            render: $.fn.dataTable.render.moment('DD/MM/YYYY')
        },
        {
            data: 'precoReal',
            name: 'precoReal',
            render: $.fn.dataTable.render.number('.', ',', 2)
        },
        {
            data: 'pago',
            name: 'pago'
        }
        // {
        //     data: 'bancoFornecedor',
        //     name: 'bancoFornecedor'
        // },
        // {
        //     data: 'nrcontaFornecedor',
        //     name: 'nrcontaFornecedor'
        // },
        // {
        //     data: 'agenciaFornecedor',
        //     name: 'agenciaFornecedor'
        // },
        // {
        //     data: 'chavePix1Fornecedor',
        //     name: 'chavePix1Fornecedor'
        // },
        // {
        //     data: 'chavePix2Fornecedor',
        //     name: 'chavePix2Fornecedor'
        // },
        // {
        //     data: 'action',
        //     name: 'action',
        //     orderable: false,
        //     searchable: false,
        //     exportOptions: {
        //     visible: false
        //     },
        // },
    ],

    @include('layouts/includeTabela')


$("#pesquisar").click(function() {
    table.draw();
});
</script>


@endsection
