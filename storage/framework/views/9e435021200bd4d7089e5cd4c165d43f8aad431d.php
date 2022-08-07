<?php $__env->startSection('content'); ?>

<div class="col-lg-12 margin-tb">
    <a class="btn btn-primary" href="<?php echo e(route('funcionarios.index')); ?>"> Voltar</a>
</div>

<?php echo $__env->make('layouts/helpersview/mensagemRetorno', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo Form::open(array('route' => 'funcionarios.store','method'=>'POST', 'enctype'=>'multipart/form-data' )); ?>

<div class="form-group row col-lg-12 mt-4">
    <h2 class="col-lg-4 pl-0">Cadastro de Funcionário</h2>
    <div class="col-lg-8 d-flex justify-content-end">
        <label class="col-sm-3 col-form-label pr-2">Cadastrar Foto</label>
        <input type="file" class="form-control-file btn btn-secondary col-sm-6" name="fotoFuncionario" name="fotoFuncionario">
    </div>
</div>

<?php echo $__env->make('funcionarios/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo Form::hidden('ativoFuncionario', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativoFuncionario', 'maxlength' => '11']); ?>

<?php echo Form::hidden('excluidoFuncionario', '0', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'excluidoFuncionario', 'maxlength' => '11']); ?>



<?php echo Form::submit('Salvar', ['class' => 'btn btn-success']);; ?>

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/funcionarios/create.blade.php ENDPATH**/ ?>