<?php 
    $intervaloCelulas = "A1:F1"; 
    // $rotaapi = "apiordemdeservicorecebidas";
    $rotaapi = "apientradaporcontabancaria";
    
    $titulo  = "Entrada Por Conta Bancária";
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
                            datapagamentoreceita: { type: "date"},
                            idosreceita: { type: "string"},
                            descricaoreceita: { type: "string"},
                            nomeFormaPagamento: { type: "string"},
                            conta: { type: "string"},
                        }
                    },
                },

                group: {
                    field: "conta", aggregates: [
                        { field: "conta", aggregate: "count" },
                        { field: "valorreceita", aggregate: "sum" } 
                    ]
                },
                aggregate: [
                { field: "conta", aggregate: "count" },
                { field: "valorreceita", aggregate: "sum" }],

            },
                      
            columns: [
                { field: "datapagamentoreceita", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "idosreceita", title: "N° OS", filterable: true, width: 60 },
                { field: "descricaoreceita", title: "Receita", filterable: true, width: 100 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 120 },
                { field: "valorreceita", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total na conta: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "conta", title: "Conta", filterable: true, width: 100 },
            ],
            <?php echo $__env->make('layouts/helpersview/finaltabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('layouts/filtradata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</script>


<?php else: ?>  
<?php echo $__env->make('layouts/helpersview/finalnaoautorizado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/relatorio/entradaporcontabancaria/index.blade.php ENDPATH**/ ?>