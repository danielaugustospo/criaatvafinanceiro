groupExpand: function (e) {
    for (let i = 0; i < e.group.items.length; i++) {
        var expanded = e.group.items[i].value
        e.sender.expandGroup(".k-grouping-row:contains(" + expanded + ")");
    }
},
columnMenu: true,
dataBound: function (e) {
    var grid = this;
    var columns = grid.columns;
    // populate initial columns list if the detailColsVisibility object is empty
    if (Object.getOwnPropertyNames(detailColsVisibility).length == 0) {
        for (var i = 0; i < columns.length; i++) {
            detailColsVisibility[columns[i].field] = !columns[i].hidden;
        }
    }
    else {
        // restore columns visibility state using the stored values
        for (var i = 0; i < columns.length; i++) {
            var column = columns[i];
            if (detailColsVisibility[column.field]) {
                grid.showColumn(column);
            }
            else {
                grid.hideColumn(column);
            }
        }
    }

},
columnHide: function (e) {
    // hide column in all other detail Grids
    showHideAll(false, e.column.field, e.sender.element);
    // store new visibility state of column
    detailColsVisibility[e.column.field] = false;
},
columnShow: function (e) {
    // show column in all other detail Grids
    showHideAll(true, e.column.field, e.sender.element);
    // store new visibility state of column
    detailColsVisibility[e.column.field] = true;
}
});


function showHideAll(show, field, element) {
// find the master Grid element
var parentGridElement = element.parents(".k-grid");
// find all Grid widgets inside the mater Grid element
var detailGrids = parentGridElement.find(".k-grid");
//traverse detail Grids and show/hide the column with the given field name
for (var i = 0; i < detailGrids.length; i++) {
    var grid = $(detailGrids[i]).data("kendoGrid");
    if (show) {
        grid.showColumn(field);
    }
    else {
        grid.hideColumn(field);
    }
}
}

});

$(window).on('load', function(){

    var $myDiv = $('#grid');

    if ( $myDiv.length === 1){

        var count     = 0;
        var interval  = setInterval(function(){
        if (count >= 50) {
            clearInterval(interval);

            var verificador = document.getElementsByClassName('k-link')[0];
        
            if(verificador != null){
                $('.k-link')[0].click();
                console.log('Ordenação Por Grupo Clicado Inicialmente');
                $.LoadingOverlay("hide");
            }else{
                var temporizador = setInterval(feedbackCarregamentoRelatorio, 5000);
            }

            function feedbackCarregamentoRelatorio() {
                console.log('Funcionalidade ainda não carregada. Aguarde alguns segundos');
                var verificador = document.getElementsByClassName('k-link')[0];
                if(verificador != null){
                    $('.k-link')[0].click();
                    clearInterval(temporizador);
                    console.log('Ordenação Por Grupo Clicado Inicialmente');
                    $.LoadingOverlay("hide");
                }
            }                          
            return;
        }
        count += 10;
        $.LoadingOverlay("progress", count);
    }, 100);

    }

   
});


