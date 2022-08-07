<?php echo Form::model($despesa, ['method' => 'PATCH', 'route' => ['despesas.update', $despesa->id]]); ?>


    <button type="submit" class="btn btn-primary mt-1">Salvar</button>

<?php echo $__env->make('despesas/formulario/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
<?php echo Form::hidden('id', $despesa->id, ['class' => 'form-control', 'maxlength' => '500']); ?>

<?php echo Form::hidden('idAlteracaoUsuario', Auth::user()->id, [
    'placeholder' => 'Preencha este campo',
    'class' => 'form-control',
    'maxlength' => '5',
]); ?>


<?php echo Form::close(); ?>

<?php /**PATH /var/www/clients/client2/web4/web/resources/views/despesas/updateform.blade.php ENDPATH**/ ?>