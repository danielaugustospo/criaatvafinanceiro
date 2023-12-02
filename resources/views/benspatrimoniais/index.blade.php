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
      <h2 class="text-center">Bens Patrimoniais / Catálogo de Materiais</h2>
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
        
        <a href="{{ route('benspatrimoniais.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> CATALOGAR MATERIAL</a>
        <a href="{{ route('estoque.index') }}"  class="btn btn-secondary"><i class="fa fa-list" aria-hidden="true"></i> Estoque (Inventário) </a>


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
        for (var rowIndex = 0; rowIndex < sheet.rows.length; rowIndex++) {
          var row = sheet.rows[rowIndex];
          for (var cellIndex = 0; cellIndex < row.cells.length; cellIndex ++) {              
            var cell =row.cells[cellIndex];
            if(cell.value && cell.value.toString().indexOf("<br />") >= 0){
              cell.value = cell.value.replace("<br />", " ");   
              cell.wrap = true;
            }
          }
        }        
        sheet.frozenRows = 2;
        sheet.mergedCells = ["A1:G1"];
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
      
      dataSource: {
        data: data,
        pageSize: 100,

      },
      height: '65%',
      filterable: {
          extra: false,
          mode: "row"
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
        { field: "estante", title: "Estante", filterable: true, width: '150' },
        { field: "prateleira", title: "Prateleira", filterable: true, width: '150' },
        { field: "qtdestoqueminimo", title: "Estoque<br />Mínimo", filterable: true, width: '150' },
        { field: "tipo.name", title: "Tipo", filterable: true, width: '150' },
        {
            field: "unidademedida.nomeunidade",
            title: "Unidade",
            filterable: true,
            width: '150',
            template: "#= unidademedida && unidademedida.nomeunidade ? unidademedida.nomeunidade : '' #"
        },


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
          width: '100',
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
          width: '100',
          exportable: false,
        },
      ],


    });
  });
</script>

@endsection