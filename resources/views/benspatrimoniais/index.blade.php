<head>
  <meta charset="utf-8"> 
  <title>Bens Patrimoniais</title>
</head>
@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 class="text-center">Bens Patrimoniais / Catálogo de Materiais</h2>
    </div>
    <div class="d-flex justify-content-between pull-right">
      @can('benspatrimoniais-create')
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
      @endcan

      {{-- @include('layouts/exibeFiltro') --}}

    </div>
  </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<hr>
{{-- @include('benspatrimoniais/filtroindex') --}}


<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>

<script>

  var dataSource = new kendo.data.DataSource({
    transport: {
      read: {
        url: "{{ route('apibenspatrimoniais') }}",
        dataType: "json"
      },
    },
  });

  dataSource.fetch().then(function () {
    var data = dataSource.data();

    // initialize a Kendo Grid with the returned data from the server.
    $("#grid").kendoGrid({
      toolbar: ["excel", "pdf"],
      excel: {
        fileName: "Relatório de " + document.title + ".xlsx",
        // proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
        // filterable: true
      },
      excelExport: function(e){

      var sheet = e.workbook.sheets[0];
      sheet.frozenRows = 1;
      sheet.mergedCells = ["A1:C1"];
      sheet.name = "Relatorio de " + document.title + " -  CRIAATVA";

      var myHeaders = [{
        value:"Relatório de " + document.title,
        textAlign: "center",
        background:"black",
        color:"#ffffff"
      }];

      sheet.rows.splice(0, 0, { cells: myHeaders, type: "header", height: 70});
      },

      pdf: {
        fileName: "Relatório de " + document.title + ".pdf",

        allPages: true,
        avoidLinks: true,
        paperSize: "A4",
        margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "1cm" },
        landscape: true,
        repeatHeaders: true,
        template: $("#page-template").html(),
        scale: 0.8
      },
      dataSource: {
        data: data,
        pageSize: 15,

      },
      height: 550,
      filterable: true,
      sortable: true,
      resizable: true,
      // responsible: true,
      pageable: {
        pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
        numeric: false
      },
      columns: [
        { field: "id", title: "ID", filterable: true, width: 30 },
        { field: "nomeBensPatrimoniais", title: "Nome", filterable: true, width: 200 },
        { field: "descricaoBensPatrimoniais", title: "Descrição", filterable: true, width: 100 },

        {
          command: [{
            name: "Visualizar",
            click: function (e) {
              e.preventDefault();
              var tr = $(e.target).closest("tr"); // get the current table row (tr)
              var data = this.dataItem(tr);
              window.location.href = location.href + '/' + data.id;
            }
          }],
          width: 50,
          exportable: false,
        },
        {
          command: [{
            name: "Editar",
            click: function (e) {
              e.preventDefault();
              var tr = $(e.target).closest("tr"); // get the current table row (tr)
              var data = this.dataItem(tr);
              window.location.href = location.href + '/' + data.id + '/edit';
            }
          }],
          width: 40,
          exportable: false,
        },
      ],


    });
  });
</script>

@endsection