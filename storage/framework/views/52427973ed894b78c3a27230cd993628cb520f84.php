<?php $__env->startSection('content'); ?>


<?php  
    if($message = Session::get('paginaModal')){
        $paginaModal = true;
    }
?>
        

<?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php elseif($message = Session::get('error')): ?>
        <div class="alert alert-danger">
            <p><?php echo e($message); ?></p>
        </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Despesa ID <?php echo e($despesa->id); ?> - 
                <?php if($despesa->ehcompra == 0 || $despesa->insereestoque == 0): ?>  
                    <?php echo e($despesa->descricaoDespesa); ?> 
                <?php elseif($despesa->ehcompra == 1 && ($despesa->insereestoque == 1 || $despesa->insereestoque == null)): ?>  
                    <?php $__currentLoopData = $listaBensPatrimoniais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bempatrimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($bempatrimonial->id  == $despesa->descricaoDespesa): ?> 
                            <?php echo e($bempatrimonial->nomeBensPatrimoniais); ?> 
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?> </h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" data-toggle="modal" data-target=".modaldepesas" style="color: white; cursor:pointer;" > Pesquisar Outra Despesa</a>

            <hr />
            <br>
            <form action="<?php echo e(route('despesas.destroy',$despesa->id)); ?>" method="POST">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('despesa-edit')): ?>
                <a class="btn btn-primary" href="<?php echo e(route('despesas.edit',$despesa->id)); ?>">Editar</a>
                <?php endif; ?>

                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('despesa-delete')): ?>
                <button type="submit" class="btn btn-danger">Excluir</button>
                <?php endif; ?>
            </form>

        </div>
    </div>
</div>

<?php echo Form::model($despesa, ['method' => 'PATCH','route' => ['despesas.update', $despesa->id]]); ?>


<?php echo $__env->make('despesas/formulario/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/despesas/show.blade.php ENDPATH**/ ?>