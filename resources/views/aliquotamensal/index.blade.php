@php $legadoDatatables = 1; @endphp
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Cadastrar Alíquota Mensal</h2>
        </div>
        <div class="d-flex justify-content-between pull-right">
            @can('aliquotamensal-create')
            <a class="btn btn-success" href="{{ route('aliquotamensal.create') }}"> Cadastrar Alíquota Mensal</a>
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
@include('aliquotamensal/filtroindex')


<table class="table table-bordered data-table">
        <thead>
            <tr>
                <th class="text-center">Conta</th>
                <th class="text-center">Mês/Ano</th>
                <th class="text-center">DAS Sem Fator</th>
                <th class="text-center">ISS Sem Fator</th>
                <th class="text-center">Recibo Sem Fator</th>
                <th class="text-center">DAS Com Fator</th>
                <th class="text-center">ISS Com Fator</th>
                <th class="text-center">Recibo Com Fator</th>

                <th width="100px" class="noExport">Ações</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

<script type="text/javascript">


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
        $('input[name=idconta]').val('');
        $('input[name=mes]').val('');
        $('input[name=dasSemFatorR]').val('');
        $('input[name=issSemFatorR]').val('');
        $('input[name=reciboSemFatorR]').val('');
        $('input[name=dasComFatorR]').val('');
        $('input[name=issComFatorR]').val('');
        $('input[name=reciboComFatorR]').val('');
        $('input[name=pesquisar]').click();
    })

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, 200, -1], ['5 resultados' , '10  resultados', '25  resultados', '50  resultados', '100  resultados', '200  resultados', "Listar Tudo"]],
        

        "language": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix": "",
            "sSearch": "Procurar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            },
            "buttons": {
            "copy": "Copiar",
            "csv": "Exportar em CSV",
            "excel": "Exportar para Excel (.xlsx)",
            "pdf": "Salvar em PDF",
            "print": "Imprimir",
            "pageLength": "Exibir por página" 
            }
        },

        ajax: {
            url: "{{ route('aliquotamensal.index') }}",
            data: function(d) {
                d.idconta           = $('.idconta').val(),
                d.mes               = $('.mes').val(),
                d.dasSemFatorR      = $('.dasSemFatorR').val(),
                d.issSemFatorR      = $('.issSemFatorR').val(),
                d.reciboSemFatorR   = $('.reciboSemFatorR').val(),
                d.dasComFatorR      = $('.dasComFatorR').val(),
                d.issComFatorR      = $('.issComFatorR').val(),
                d.reciboComFatorR   = $('.reciboComFatorR').val(),
                d.search            = $('input[type="search"]').val()
            }
        },

        columns: [
            {
                data: 'idconta',
                name: 'idconta'
            },
            {
                data: 'mes',
                name: 'mes'
            },
            {
                data: 'dasSemFatorR',
                name: 'dasSemFatorR',
                render: $.fn.dataTable.render.number('.', ',', 5)

            },
            {
                data: 'issSemFatorR',
                name: 'issSemFatorR',
                render: $.fn.dataTable.render.number('.', ',', 5)

            },
            {
                data: 'reciboSemFatorR',
                name: 'reciboSemFatorR',
                render: $.fn.dataTable.render.number('.', ',', 5)

            },
            {
                data: 'dasComFatorR',
                name: 'dasComFatorR',
                render: $.fn.dataTable.render.number('.', ',', 5)

            },
            {
                data: 'issComFatorR',
                name: 'issComFatorR',
                render: $.fn.dataTable.render.number('.', ',', 5)

            },
            {
                data: 'reciboComFatorR',
                name: 'reciboComFatorR',
                render: $.fn.dataTable.render.number('.', ',', 5)

            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                exportOptions: {
                visible: false
                },
            },
        ],
        dom: 'Bfrtip',
        buttons: [{
            extend: 'pageLength', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },{
            extend: 'copy', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'csv', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'excel', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'pdf', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    },
                },
                {
            extend: 'print', 
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }
        ],


    });

    $("#pesquisar").click(function() {
        table.draw();
    });
</script>


 
@endsection
