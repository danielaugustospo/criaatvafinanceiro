<?php $__env->startSection('content'); ?>
<?php echo Form::model($ordemdeservico, ['method' => 'PATCH','route' => ['ordemdeservicos.update', $ordemdeservico->id]]); ?>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Dados da OS: <?php echo e($ordemdeservico->id); ?> - <?php echo e($ordemdeservico->eventoOrdemdeServico); ?></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-danger" href="<?php echo e(route('ordemdeservicos.index')); ?>"> Voltar</a>
            <a class="btn btn-success" href="<?php echo e(route('ordemdeservicos.show',$ordemdeservico->id)); ?>">Financeiro</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</div>

<?php $contadorReceitas =  count($receitasPorOS); 
    $readonlyOrNo = " ";
    $disabledOrNo = " ";
?>

<?php echo $__env->make('layouts/helpersview/mensagemRetorno', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('ordemdeservicos/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<input type="hidden" id="valorProjetoOrdemdeServico" class="form-control" name="valorProjetoOrdemdeServico" value="<?php echo e($ordemdeservico->valorProjetoOrdemdeServico); ?>" placeholder="Preencha o preço real" /><br>

<?php echo Form::hidden('dataOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']); ?>


<?php echo Form::hidden('servicoOrdemdeServico', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']); ?>


<?php echo Form::hidden('dataExclusaoOrdemdeServico', '00', ['placeholder' => 'Data Exclusão', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'dataExclusaoOrdemdeServico']); ?>

<?php echo Form::hidden('ativoOrdemdeServico', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']); ?>

<?php echo Form::hidden('excluidoOrdemdeServico', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']); ?>



<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

<?php echo Form::close(); ?>


 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/ordemdeservicos/edit.blade.php ENDPATH**/ ?>