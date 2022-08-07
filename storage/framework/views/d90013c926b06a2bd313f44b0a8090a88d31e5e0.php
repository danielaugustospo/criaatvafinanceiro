<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="col-lg-12 d-flex justify-content-between">
            <h2> Dados Funcionário Daniel Augusto</h2>
            <img src="../storage/fotosFuncionarios/<?php echo e($funcionario->fotoFuncionario); ?>" style="height: 200;" alt="" srcset="">

        </div>


        <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo e(route('funcionarios.index')); ?>"> Voltar</a>
            <hr>
            <br>
            <form action="<?php echo e(route('funcionarios.edit',$funcionario->id)); ?>" method="POST">
                <a class="btn btn-primary" href="<?php echo e(route('funcionarios.edit',$funcionario->id)); ?>">Editar</a>

                <input type="hidden" name="_token" value="4biFdpfiCrtgtFw1Fy2Qw6mMD7UyFoAul3j3r88Y"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-danger">Excluir</button>
            </form>

        </div>
    </div>
</div>


<?php echo Form::model($funcionario,  ['method' => 'PATCH','route' => ['funcionarios.update', $funcionario->id], 'enctype' => 'multipart/form-data']); ?>


<?php echo $__env->make('funcionarios/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo Form::hidden('ativoFuncionario', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativoFuncionario', 'maxlength' => '11']); ?>

<?php echo Form::hidden('excluidoFuncionario', '0', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'excluidoFuncionario', 'maxlength' => '11']); ?>


<div class="pull-right">
    <a class="btn btn-primary" href="<?php echo e(route('funcionarios.index')); ?>"> Voltar</a>
</div>

<!-- <?php echo Form::submit('Salvar', ['class' => 'btn btn-success']);; ?> -->
<?php echo Form::close(); ?>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/funcionarios/show.blade.php ENDPATH**/ ?>