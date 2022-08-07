<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts/helpersview/mensagemRetorno', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(isset($paginaModal)): ?>
<?php else: ?>  

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edição - Despesa ID <?php echo e($despesa->id); ?> - 
                <?php if($despesa->ehcompra == 0 || $despesa->insereestoque == 0): ?>  <?php echo e($despesa->descricaoDespesa); ?> 
                    <?php elseif(($despesa->ehcompra == 1) && ($despesa->insereestoque == 1) && ($despesa->insereestoque == null)): ?>  
                        <?php $__currentLoopData = $listaBensPatrimoniais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bempatrimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($bempatrimonial->id  == $despesa->descricaoDespesa): ?> 
                                <?php echo e($bempatrimonial->nomeBensPatrimoniais); ?> 
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?> 
            </h2>

        </div>
        <div class="pull-right">
            <a class="btn btn-primary" data-toggle="modal" data-target=".modaldepesas" style="color: white; cursor:pointer;" > Pesquisar Outra Despesa</a>
        </div>
    </div>
</div>
<?php endif; ?>


<?php echo $__env->make('despesas/updateform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/despesas/edit.blade.php ENDPATH**/ ?>