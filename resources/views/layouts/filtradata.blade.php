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
                filter.filters.push({ field: "{{ $campodata }}", operator: "gte", value: startDate });
                filter.filters.push({ field: "{{ $campodata }}", operator: "lte", value: endDate });
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
                filter.filters.push({ field: "{{ $campodata }}", operator: "gte", value: startDate });
                filter.filters.push({ field: "{{ $campodata }}", operator: "lte", value: endDate });
                dataSource.filter(filter);
            }
        }
    });

}