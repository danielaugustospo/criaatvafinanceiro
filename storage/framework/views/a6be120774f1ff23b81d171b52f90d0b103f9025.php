<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Fornecedor</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo e(route('fornecedores.index')); ?>"> Voltar</a>
        </div>
    </div>
</div>


<?php echo $__env->make('layouts/helpersview/mensagemRetorno', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php echo Form::open(array('route' => 'fornecedores.store','method'=>'POST')); ?>


<?php echo $__env->make('fornecedores/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo Form::hidden('ativoFornecedor', '1', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']); ?>

<?php echo Form::hidden('excluidoFornecedor', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']); ?>



<?php echo Form::submit('Salvar', ['class' => 'btn btn-success']);; ?>

<?php echo Form::close(); ?>




<?php $__env->stopSection(); ?>


<style>
    .valido {
        border: 1px solid green;
    }

    .invalido {
        border: 1px solid red;
    }
</style>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/fornecedores/create.blade.php ENDPATH**/ ?>