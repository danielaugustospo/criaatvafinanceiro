<?php 
    if(!isset($campodata)){
        $campodata = 'created_at';
    }
?>
function betweenFilter(args) {
    var filterCell = args.element.parents(".k-filtercell");

    filterCell.empty();
    filterCell.html('<label style="width: 0px;">De: <input class="start-date"/></label>' + '<label class="pt-3"> <br><br> Até: ' + '<input  class="end-date"/></label>');

    $(".start-date", filterCell).kendoDatePicker({
        change: function (e) {
            var startDate = e.sender.value(),
                endDate = $("input.end-date", filterCell).data("kendoDatePicker").value(),
                dataSource = $("#grid").data("kendoGrid").dataSource;

            if (startDate & endDate) {
                var filter = { logic: "and", filters: [] };
                filter.filters.push({ field: "<?php echo e($campodata); ?>", operator: "gte", value: startDate });
                filter.filters.push({ field: "<?php echo e($campodata); ?>", operator: "lte", value: endDate });
                dataSource.filter(filter);
                var pegaApelidoConta = $("#grid").data("kendoGrid").dataSource.data()[0].conta;
                var dataPrimeiroPeriodo = dataSource._filter.filters[0].value;
                var dataSegundoPeriodo = dataSource._filter.filters[1].value;

                dataUmFormatoAmericano = dataPrimeiroPeriodo.toISOString().substring(0, 10);
                dataUm = dataUmFormatoAmericano.split("-").reverse().join("/");

                dataDoisFormatoAmericano = dataSegundoPeriodo.toISOString().substring(0, 10);
                dataDois = dataDoisFormatoAmericano.split("-").reverse().join("/");

            }
        }
    });
    $(".end-date", filterCell).kendoDatePicker({
        change: function (e) {
            var startDate = $("input.start-date", filterCell).data("kendoDatePicker").value(),
                endDate = e.sender.value(),
                dataSource = $("#grid").data("kendoGrid").dataSource;

            if (startDate & endDate) {
                var filter = { logic: "and", filters: [] };
                filter.filters.push({ field: "<?php echo e($campodata); ?>", operator: "gte", value: startDate });
                filter.filters.push({ field: "<?php echo e($campodata); ?>", operator: "lte", value: endDate });
                dataSource.filter(filter);

                var pegaApelidoConta = $("#grid").data("kendoGrid").dataSource.data()[0].conta;
                var dataPrimeiroPeriodo = dataSource._filter.filters[0].value;
                var dataSegundoPeriodo = dataSource._filter.filters[1].value;

                dataUmFormatoAmericano = dataPrimeiroPeriodo.toISOString().substring(0, 10);
                dataUm = dataUmFormatoAmericano.split("-").reverse().join("/");

                dataDoisFormatoAmericano = dataSegundoPeriodo.toISOString().substring(0, 10);
                dataDois = dataDoisFormatoAmericano.split("-").reverse().join("/");




            }


        }
    });

}

<?php if(isset($campodata2)){   ?> 
    function segundoFiltroPeriodo(args) {
        var filterCell = args.element.parents(".k-filtercell");
    
        filterCell.empty();
        filterCell.html('<label style="width: 0px;">De: <input class="start-date"/></label>' + '<label class="pt-3"> <br><br> Até: ' + '<input  class="end-date"/></label>');
    
        $(".start-date", filterCell).kendoDatePicker({
            change: function (e) {
                var startDate = e.sender.value(),
                    endDate = $("input.end-date", filterCell).data("kendoDatePicker").value(),
                    dataSource = $("#grid").data("kendoGrid").dataSource;
    
                if (startDate & endDate) {
                    var filter = { logic: "and", filters: [] };
                    filter.filters.push({ field: "<?php echo e($campodata2); ?>", operator: "gte", value: startDate });
                    filter.filters.push({ field: "<?php echo e($campodata2); ?>", operator: "lte", value: endDate });
                    dataSource.filter(filter);
                }
            }
        });
        $(".end-date", filterCell).kendoDatePicker({
            change: function (e) {
                var startDate = $("input.start-date", filterCell).data("kendoDatePicker").value(),
                    endDate = e.sender.value(),
                    dataSource = $("#grid").data("kendoGrid").dataSource;
    
                if (startDate & endDate) {
                    var filter = { logic: "and", filters: [] };
                    filter.filters.push({ field: "<?php echo e($campodata2); ?>", operator: "gte", value: startDate });
                    filter.filters.push({ field: "<?php echo e($campodata2); ?>", operator: "lte", value: endDate });
                    dataSource.filter(filter);
                }
            }
        });
    
    }
<?php } ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/filtradata.blade.php ENDPATH**/ ?>