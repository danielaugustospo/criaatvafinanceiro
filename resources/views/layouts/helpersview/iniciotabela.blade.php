$.LoadingOverlay("show", {
    image       : "",
    progress    : true
});

    var dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                @if(isset($urlCompleta))               
                    url: "{{$urlCompleta}}",
                @elseif(isset($rotaapi))
                    url: "{{ route($rotaapi)}}",
                @elseif(isset($urlCompletaComPeriodos))
                    url: "{{ $urlCompletaComPeriodos}}?datainicial={{$datainicial}}&datafinal={{$datafinal}}",
                @elseif(isset($urlContaCorrente))
                    url: "{{ $urlContaCorrente}}?conta={{$contaSelecionada}}&datainicial={{$datainicial}}&datafinal={{$datafinal}}",
                @endif
                dataType: "json"
            },
        },
    });


    //Se não houver essa declaração, ele retorna erro dizendo que não encontrou o metodo e não exporta o pdf
    var detailColsVisibility = {};

    dataSource.fetch().then(function () {
        var data = dataSource.data();

        // initialize a Kendo Grid with the returned data from the server.
        $("#grid").kendoGrid({
            toolbar: ["excel", "pdf"],
            excel: {
                fileName: "Relatório de " + document.title + ".xlsx",
                allPages: true
                // proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
                // filterable: true
            },
            excelExport: function (e) {

                var sheet = e.workbook.sheets[0];
                @if(isset($contacorrente))
                    for (var rowIndex = 1; rowIndex < sheet.rows.length; rowIndex++) {
                        if (rowIndex < (sheet.rows.length - 1)) {
                            var row = sheet.rows[rowIndex];
                            for (var cellIndex = 5; cellIndex < row.cells.length; cellIndex ++) {
                                if(row.cells[cellIndex].value != sheet.rows[1].cells[5].value){
                                    row.cells[cellIndex].format = "[Blue]#,##0.00_);[Red]-#,##0.00_);0.0;";
                                }
                            }
                        }
                    }
                @endif
                
                sheet.frozenRows = 1;
                @if(isset($intervaloCelulas)) sheet.mergedCells = ["{{$intervaloCelulas}}"]; @else ["A1:F1"]; @endif
                sheet.name = "Relatorio_de_" + document.title + " -  CRIAATVA";
                
                var myHeaders = [{
                    value: "Relatório de " + document.title,
                    textAlign: "center",
                    background: "black",
                    color: "#ffffff"
                }];
                

                {{-- console.log(e.workbook); --}}
                sheet.rows.splice(0, 0, { cells: myHeaders, type: "header", height: 20 });
                var columns = e.workbook.sheets[0].columns;
                columns.forEach(function(column){
                  delete column.width;
                  column.autoWidth = true;
                });
            },

            pdf: {
                fileName: "Relatório de " + document.title + ".pdf",

                allPages: true,
                avoidLinks: true,
                paperSize: "A4",
                margin: { top: "3.5cm", left: "0.15cm", right: "0.15cm", bottom: "0.5cm" },
                
                @if(isset($orientacao)) landscape: true, @else landscape: true, @endif
                
                repeatHeaders: false,
                template: $("#page-template").html(),
                scale: 0.7
            },
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
            height: 550,
            pageable: {
                pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                numeric: false
            },

