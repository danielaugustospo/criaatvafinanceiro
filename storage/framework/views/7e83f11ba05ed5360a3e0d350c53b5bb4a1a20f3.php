<?php $__env->startSection('content'); ?>


<?php if(isset($mensagemErro)): ?>
<div class="text-center alert alert-danger">
    <p><?php echo e($mensagemErro); ?></p>
</div>
<?php endif; ?>
<?php if(isset($mensagemExito)): ?>
<div class="text-center alert alert-success">
    <p><?php echo e($mensagemExito); ?></p>
</div>
<?php endif; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 class="text-center"> Acesso Rápido</h3></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <label for=""> Bem Vindo, <?php echo e(Auth::user()->name); ?>!</label>

                </div>

            </div>

        </div>

    </div>

</div>
    <?php echo $__env->make('layouts/acessorapido', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
 



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/home.blade.php ENDPATH**/ ?>