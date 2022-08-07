<?php echo $__env->make('layouts/modal/includesmodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($mensagem)): ?>
<div class="alert alert-success" role="alert">
    <p><?php echo e($mensagem); ?></p>
</div>
<?php endif; ?>

<?php echo Form::open(array('route' => 'cadastrocodigodespesa','method'=>'POST')); ?>

<?php echo Form::submit('Salvar', ['class' => 'btn btn-success']); ?>


<!-- <div class="form-group row">
    <label for="idGrupoCodigoDespesa" class="col-sm-2 col-form-label">Código da Despesa</label>
    <div class="col-sm-2">
        <?php echo Form::text('idGrupoCodigoDespesa', '', ['placeholder' => 'Código Despesa', 'class' => 'form-control', 'maxlength' => '20']); ?>


    </div>
</div> -->
<div class="form-group row">
    <label for="despesaCodigoDespesa" class="col-sm-2 col-form-label">Tipo de Despesa</label>
    <div class="col-sm-10">
        <?php echo Form::text('despesaCodigoDespesa', '', ['placeholder' => 'Tipo de Despesa', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'despesaCodigoDespesa']); ?>

    </div>
</div>
<div class="form-group row">
    <label for="idGrupoCodigoDespesa" class=" col-sm-2 col-form-label">Selecione o Grupo</label>
    <div class="col-sm-10">
        <!-- <?php echo Form::text('despesaCodigoDespesa', '', ['placeholder' => 'Tipo de Despesa', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'despesaCodigoDespesa']); ?> -->
        <select name="idGrupoCodigoDespesa" id="idGrupoCodigoDespesa" class="selecionaComInput" style="position: absolute !important;
        overflow: visible !important;">
        <?php $__currentLoopData = $listaGrupoDespesas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupoDespesa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($grupoDespesa->id); ?>">Código: <?php echo e($grupoDespesa->id); ?> - Grupo: <?php echo e($grupoDespesa->grupoDespesa); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<?php echo $__env->make('despesas/criagrupodespesa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<input type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" value="Adicionar Grupo Despesa" style="cursor: pointer;">

<?php echo Form::hidden('ativoCodigoDespesa', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoCodigoDespesa']); ?>

<?php echo Form::hidden('excluidoCodigoDespesa', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoCodigoDespesa']); ?>


<?php echo Form::submit('Salvar', ['class' => 'btn btn-success']);; ?>

<?php echo Form::close(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/codigodespesas/camposmodal.blade.php ENDPATH**/ ?>