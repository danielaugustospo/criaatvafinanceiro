<?php echo $__env->make('layouts/modal/includesmodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container panel panel-default pt-2 pb-2">

    <?php if(isset($mensagem)): ?>
    <div class="alert alert-success" role="alert">
        <p><?php echo e($mensagem); ?></p>
    </div>
    <?php endif; ?>
    <?php echo Form::open(array('route' => 'salvarmodalgrupodespesa','method'=>'POST')); ?>


    <div class="form-group row">
        <label for="grupoDespesa" class="col-sm-2 col-form-label">Nome do Grupo</label>
        <div class="col-sm-10">
            <?php echo Form::text('grupoDespesa', '', ['placeholder' => 'Grupo', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'grupoDespesa']); ?>

        </div>

        <?php echo Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']); ?>

        <?php echo Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']); ?>


    </div>
    <button class="btn btn-success" id="submit">Salvar</button>

    <?php echo Form::close(); ?>


</div><?php /**PATH /var/www/clients/client2/web4/web/resources/views/grupodespesas/campos.blade.php ENDPATH**/ ?>