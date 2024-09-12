@php $relatorioKendoGrid = true; @endphp
<head>
  <meta charset="utf-8"> 
  <title>Bens Patrimoniais</title>
</head>
@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 class="text-center">Bens Patrimoniais / Cadastro de Materiais</h2>
    </div>
      {{-- @can('benspatrimoniais-create')
      <a class="btn btn-success" href="{{ route('benspatrimoniais.create') }}"> Adicionar item</a>
      @endcan

      @can('entradas-list')
        <a class="btn btn-dark" href="{{ route('entradas.index') }}">Entrada </a>
      @endcan

      @can('saidas-list')
        <a class="btn btn-dark" href="{{ route('saidas.index') }}">Saídas (Baixa de Materiais)</a>
      @endcan

      @can('estoque-list')
        <a class="btn btn-success" href="{{ route('estoque.index') }}">Estoque (Inventário) </a>
      @endcan --}}

      <div class="form-row d-flex justify-content-center">
        
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastroModal">
          <i class="fa fa-plus-circle" aria-hidden="true"></i>Cadastro de Materiais (MODAL)
        </button>
        <a href="{{ route('estoque.index') }}"  class="btn btn-secondary"><i class="fa fa-list" aria-hidden="true"></i> Estoque (Inventário) </a>
        <a href="{{ route('benspatrimoniais.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> CADASTRO DE MATERIAIS (ANTIGO)</a>

      
      <!-- Modal -->
      <div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content ">
                  <div class="modal-header">
                      <h5 class="modal-title" id="cadastroModalLabel">Cadastro de Materiais</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" onclick="recarrega();">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <iframe src="https://v2{{$_SERVER['SERVER_NAME']}}/catalogoFrame" frameborder="0" width="100%" height="600px"></iframe>
                  </div>
              </div>
          </div>
      </div>
      

    </div>

      {{-- @include('layouts/exibeFiltro') --}}

    {{-- </div> --}}
  </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<hr class="m-1">

<div id="filter-menu"></div>

<div id="grid"></div>

<script>
  @if (isset($paginaModal))
  @else
      $.LoadingOverlay("show", {
          image: "",
          progress: true
      });
  @endif

  $(document).ready(function() {
    var dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                url: "{{ route('apibenspatrimoniais') }}",
                dataType: "json",
                type: "GET"
            },
            parameterMap: function(options, operation) {
                if (operation !== "read" && options.models) {
                    return {
                        models: kendo.stringify(options.models)
                    };
                }
            }
        },
        pageSize: 30,
    });

    dataSource.fetch().then(function() {
        var data = dataSource.data();
        $("#grid").kendoGrid({
            toolbar: ["excel", "pdf"],
            excel: {
                fileName: "Relatório de " + document.title + ".xlsx",
            },
            excelExport: function(e) {
                var sheet = e.workbook.sheets[0];
                for (var rowIndex = 0; rowIndex < sheet.rows.length; rowIndex++) {
                    var row = sheet.rows[rowIndex];
                    for (var cellIndex = 0; cellIndex < row.cells.length; cellIndex ++) {              
                        var cell = row.cells[cellIndex];
                        if(cell.value && cell.value.toString().indexOf("<br />") >= 0){
                            cell.value = cell.value.replace("<br />", " ");   
                            cell.wrap = true;
                        }
                    }
                }        
                sheet.frozenRows = 2;
                sheet.mergedCells = ["A1:H1"];
                sheet.name = "Relatorio de " + document.title + " -  CRIAATVA";

                var myHeaders = [{
                    value:"Relatório de " + document.title,
                    textAlign: "center",
                    background:"black",
                    color:"#ffffff"
                }];

                sheet.rows.splice(0, 0, { cells: myHeaders, type: "header", height: 30});
            },
            pdf: {
                fileName: "Relatório de " + document.title + ".pdf",
                allPages: true,
                avoidLinks: true,
                paperSize: "A4",
                margin: { top: "3cm", left: "1cm", right: "1cm", bottom: "1cm" },
                landscape: true,
                repeatHeaders: true,
                template: $("#page-template").html(),
                scale: 0.6
            },
            dataSource: dataSource,
            height: '500px',
            filterable: {
                extra: false,
                mode: "row",
                operators: {
                    string: {
                        contains: "Contém",
                        doesnotcontain: "Não contém",
                        eq: "Igual a",
                        neq: "Diferente de"
                    }
                }
            },
            sortable: true,
            resizable: true,
            scrollable: true,
            groupable: true,
            columnMenu: true,
            responsible: true,
            reorderable: true,
            width: 'auto',
            pageable: {
                pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                numeric: false
            },
            columns: [
                { field: "id", title: "ID", filterable: true, width: '130' },
                { field: "nomeBensPatrimoniais", title: "Nome", filterable: true, width: '270' },
                { field: "estante", title: "Setor", filterable: true, width: '150' },
                { field: "prateleira", title: "Local", filterable: true, width: '150' },
                { field: "qtdestoqueminimo", title: "Estoque<br />Mínimo", filterable: true, width: '150' },
                { 
                    field: "quantidadeEmEstoque", 
                    title: "Quantidade em<br />Estoque", 
                    filterable: true, 
                    width: '150',
                    template: function(dataItem) {
                        if(dataItem.quantidadeEmEstoque < dataItem.qtdestoqueminimo) {
                            return '<span style="color:red;">' + dataItem.quantidadeEmEstoque + '</span>';
                        }
                        return dataItem.quantidadeEmEstoque;
                    }
                },
                { field: "tipo.name", 
                  title: "Tipo", 
                  filterable: true, 
                  width: '150',
                  template: "#= tipo && tipo.name ? tipo.name : '' #",
                  filterable: {
                      cell: {
                          showOperators: false,
                          operator: "contains"
                      }
                  }
                },
                {
                    field: "unidademedida.nomeunidade",
                    title: "Unidade",
                    filterable: true,
                    width: '150',
                    template: "#= unidademedida && unidademedida.nomeunidade ? unidademedida.nomeunidade : '' #",
                    filterable: {
                        cell: {
                            showOperators: false,
                            operator: "contains"
                        }
                    }
                },
                {
                    command: [{
                        name: "Visualizar",
                        click: function (e) {
                            e.preventDefault();
                            var tr = $(e.target).closest("tr"); 
                            var data = this.dataItem(tr);
                            window.location.href = location.href + '/' + data.id;
                        }
                    }],
                    width: '100',
                    exportable: false,
                },
                {
                    command: [{
                        name: "Editar",
                        click: function (e) {
                            e.preventDefault();
                            var tr = $(e.target).closest("tr"); 
                            var data = this.dataItem(tr);
                            window.location.href = location.href + '/' + data.id + '/edit';
                        }
                    }],
                    width: '100',
                    exportable: false,
                },
            ],
        });
    });
});

@if (!isset($paginaModal))
$(window).on('load', function() {
    var $myDiv = $('#grid');
    if ($myDiv.length === 1) {
        var count = 0;
        var interval = setInterval(function() {
            @if (isset($despesas))
                if (count >= 80) {
            @else
                if (count >= 200) {
            @endif
                clearInterval(interval);
                $('.k-link').eq(0).click();
                console.log('Ordenação Por Grupo Clicado Inicialmente');
                $.LoadingOverlay("hide");
                return;
            }
            count += 10;
            $.LoadingOverlay("progress", count);
        }, 300);
    }
});
@endif

function recarrega() {
    $('#grid').data('kendoGrid').dataSource.read();
    $('#grid').data('kendoGrid').refresh();

    let timerInterval
    Swal.fire({
        title: 'Atualizando tabela!',
        html: 'Fechando mensagem em <b></b> millisegundos.',
        timer: 1500,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('Mensagem fechada pelo temporizador')
        }
    })
    $('iframe').attr('src', $('iframe').attr('src'));
}


</script>

@endsection