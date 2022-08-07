<?php echo $__env->make('layouts/modal/includesmodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($mensagem)): ?>
    <div class="alert alert-success" role="alert">
        <p><?php echo e($mensagem); ?></p>
    </div>
<?php endif; ?>


<?php echo Form::open(['route' => 'cadastromateriais', 'method' => 'POST']); ?>

<?php echo Form::submit('Salvar', ['class' => 'btn btn-success']); ?>


<div class="form-group row">
    <label for="nomeBensPatrimoniais" class="col-sm-2 col-form-label">Descrição do Material </label>
    <div class="col-sm-10">
        <?php echo Form::text('nomeBensPatrimoniais', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']); ?>

    </div>
</div>

<div class="form-group row">
    <label for="qtdestoqueminimo" class="col-sm-2 col-form-label">Estoque Mínimo</label>
    <div class="col-sm-5">
        <input type="number" class="form-control" name="qtdestoqueminimo" id="qtdestoqueminimo">
    </div>
</div>

<div class="form-group row">
    <label for="idTipoBensPatrimoniais" class="col-sm-1 col-form-label">Tipo</label>
    <div class="col-sm-10">
        <select name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais" class="selecionaComInput form-control">
            <?php $__currentLoopData = $listaTiposBensPatrimoniais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tipo->id); ?>"><?php echo e($tipo->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<input type="button" class="btn btn-primary" data-toggle="modal" data-target=".tipomaterial"
    value="Cadastrar Novo Tipo" style="cursor: pointer;">
<?php echo $__env->make('despesas/cadastratipomaterial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php echo Form::hidden('statusbenspatrimoniais', '1', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'statusbenspatrimoniais', 'maxlength' => '100']); ?>

<?php echo Form::hidden('descricaoBensPatrimoniais', '0', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'descricaoBensPatrimoniais', 'maxlength' => '100']); ?>



<?php echo Form::hidden('ativadoBensPatrimoniais', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativadoBensPatrimoniais', 'maxlength' => '1']); ?>

<?php echo Form::hidden('excluidoBensPatrimoniais', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'id' => 'excluidoBensPatrimoniais', 'maxlength' => '1']); ?>


<?php echo Form::submit('Salvar', ['class' => 'btn btn-success']); ?>

<?php echo Form::close(); ?>

<?php /**PATH /var/www/clients/client2/web4/web/resources/views/benspatrimoniais/camposmodal.blade.php ENDPATH**/ ?>