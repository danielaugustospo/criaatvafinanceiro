<?php
    $titulo  = "Faturamento por Cliente";
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

            <div class="d-flex justify-content-center">
                <label for="">Exibindo filtros para:</label>
                <?php
                if ($_SERVER['QUERY_STRING'] == 'p=s'):
                    $complementorota = 'S';
                    echo ' <span class="badge badge-primary"><label class="pt-1">Pago</label></span>';
                    echo '<label class="pl-2"><a href="fatporcliente?p=n"> Alterar para Não Pago</a></label>';
                elseif ($_SERVER['QUERY_STRING'] == 'p=n'):
                    $complementorota = 'N';
                    echo ' <span class="badge badge-danger"><label class="pt-1">Não Pago</label></span>';
                    echo '<label class="pl-2"><a href="fatporcliente?p=s"> Alterar para Pago</a></label>';
                else:
                    $complementorota = null;
                endif;
                ?>
            </div>

        </div>
    </div>
<?php
    $intervaloCelulas = "A1:H1"; 
    $urlCompleta = route('apifaturamentoporcliente')."?a=".$complementorota;

    $campodata = 'datapagamentoreceita';
?>


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
                                valortotal: {
                                    type: "number"
                                },
                                valorrecebido: {
                                    type: "number"
                                },
                                porcentagemOS: {
                                    type: "number"
                                },
                                razaosocialCliente: {
                                    type: "string"
                                },
                                datapagamentoreceita: {
                                    type: "date"
                                },

                            }
                        },
                    },
                    group: [{field: "razaosocialCliente", aggregate: "count"}],

                    aggregate: [{
                            field: "razaosocialCliente",
                            aggregate: "count"
                        },
                        {
                            field: "valortotal",
                            aggregate: "sum"
                        },
                        {
                            field: "valorrecebido",
                            aggregate: "sum"
                        },
                        {
                            field: "porcentagemOS",
                            aggregate: "sum"
                        }
                    ],
                },

                columns: [
                    { field: "razaosocialCliente", title: "Cliente", aggregates: ["count"], filterable: true, width: 150},
                    { field: "datapagamentoreceita", title: "Data", filterable: true, width: 100,format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                    { field: "valortotal", title: "Valor Total", filterable: true, width: 180, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') # ", format: '{0:0.00}'},
                    // { field: "valorrecebido", title: "Valor Recebido", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total: #: kendo.toString(sum, 'c', 'pt-BR') # ", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') # ", format: '{0:0.00}' },

                    // { field: "porcentagemOS", title: "Perc(%)", filterable: true, width: 20,  format: '{0:0.00}'}
                    { field: "porcentagemOS", title: "Perc(%)", width: 180, template:template }
                ],

                <?php echo $__env->make('layouts/helpersview/finaltabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                function template(data){
                    var grid = $('#grid').data('kendoGrid');
                    
                    // var valorPorcentagem = 100*(+data.porcentagemOS)/grid.dataSource.aggregates().porcentagemOS.sum + ' %';
                    var valorPorcentagem = 100 * (+data.valortotal) / grid.dataSource.aggregates().valortotal.sum;
                    valorPorcentagem = parseFloat(valorPorcentagem).toFixed(2)+"%";
                    return  valorPorcentagem;
                }
                <?php echo $__env->make('layouts/filtradata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </script>


<?php else: ?>  
<?php echo $__env->make('layouts/helpersview/finalnaoautorizado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/relatorio/fatporcliente/index.blade.php ENDPATH**/ ?>