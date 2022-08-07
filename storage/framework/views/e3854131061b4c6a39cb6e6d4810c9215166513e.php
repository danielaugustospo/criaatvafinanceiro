<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apicontasareceber";
    $titulo  = "Contas a Receber";
    $campodata = 'datapagamentoreceita';
    $relatorioKendoGrid = true;

?>

<head>
    <meta charset="utf-8">
    <title><?php echo e($titulo); ?></title>
</head>



<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Relatório de <?php echo e($titulo); ?></h2>
        </div>
    </div>
</div>

<?php if($message = Session::get('success')): ?>
<div class="alert alert-success">
    <p><?php echo e($message); ?></p>
</div>
<?php endif; ?>

<hr>

<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>

<script>
    
    <?php echo $__env->make('layouts/helpersview/iniciotabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('visualiza-relatoriogeral')): ?>

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            valorreceita: { type: "number" },
                            razaosocialCliente: { type: "string" },
                            datapagamentoreceita: { type: "date" },
                        }
                    },
                },

                group: {
                    field: "razaosocialCliente", aggregates: [
                        { field: "razaosocialCliente", aggregate: "count" },
                        { field: "valorreceita", aggregate: "sum" },
                    ]
                },
                aggregate: [{ field: "razaosocialCliente", aggregate: "count" },
                { field: "valorreceita", aggregate: "sum" }],
            },

            columns: [
                { field: "idOS", title: "OS", filterable: true, width: 100 },
                // { field: "idOS", title: "ID", filterable: true, width: 50 },
                { field: "datapagamentoreceita", title: "Data", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" , filterable: { cell: { template: betweenFilter}} },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 100 },
                // { field: "nomeBensPatrimoniais", title: "Bens Patrimoniais", filterable: true, width: 100 },
                { field: "valorreceita", title: "Valor a Receber", filterable: true, width: 100, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Subtotal: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "conta", title: "Conta", filterable: true, width: 100 },
                { field: "nfreceita", title: "Nota Fiscal", filterable: true, width: 100 }
            ],
            <?php echo $__env->make('layouts/helpersview/finaltabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts/filtradata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</script>

<?php else: ?>  
<?php echo $__env->make('layouts/helpersview/finalnaoautorizado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/contacorrente/contasAReceber.blade.php ENDPATH**/ ?>