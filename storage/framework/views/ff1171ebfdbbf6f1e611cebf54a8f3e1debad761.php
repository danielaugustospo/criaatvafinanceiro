<?php $__env->startSection('content'); ?>
<label  class="col-sm-12 text-center col-form-label" style="color:red;">Aviso: Todos os campos são de preenchimento obrigatório!</label>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Receitas</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo e(route('receita.index')); ?>"> Voltar</a>
        </div>
    </div>
</div>


<?php echo $__env->make('layouts/helpersview/mensagemRetorno', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<?php echo Form::open(array('route' => 'receita.store','method'=>'POST')); ?>



<?php echo $__env->make('receita/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<input type="hidden" name="idosreceita" value="CRIAATVA">
<?php echo Form::submit('Salvar', ['class' => 'btn btn-success']);; ?>

<?php echo Form::close(); ?>







<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/receita/create.blade.php ENDPATH**/ ?>