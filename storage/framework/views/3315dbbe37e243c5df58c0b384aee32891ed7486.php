<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "apiconsultaos";
    $titulo  = "OS Cadastradas";
    $campodata = 'dataCriacaoOrdemdeServico';
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
                            dataCriacaoOrdemdeServico: { type: "date" },
                            id: {type: "number"},
                            razaosocialCliente: {type: "string"}
                        }
                    },
            },
            // group: [{field: "razaosocialCliente", aggregate: "count"}],

                aggregate: [
                    { field: "id", aggregate: "count" },
                    { field: "razaosocialCliente", aggregate: "count" },
                   
                    ]
                },
            columns: [
                { field: "id", title: "N° OS", filterable: true, width: 25, aggregates: ["count"], footerTemplate: "Total de OS:  #=count#" },
                { field: "dataCriacaoOrdemdeServico", title: "Data", filterable: true, width: 25, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "razaosocialCliente", title: "Cliente", filterable: true, width: 50 },
                { field: "eventoOrdemdeServico", title: "Evento", filterable: true, width: 50 }
            ],
            <?php echo $__env->make('layouts/helpersview/finaltabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts/filtradata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</script>


<?php else: ?>  
<?php echo $__env->make('layouts/helpersview/finalnaoautorizado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/relatorio/oscadastradas/index.blade.php ENDPATH**/ ?>