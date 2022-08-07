<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <?php if(isset($paginaModal)): ?>
            <?php else: ?>
                <div class="pull-left">
                    <h2>Cadastro de Despesas</h2>
                </div>
            <?php endif; ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo e(route('despesas.index')); ?>"> Voltar</a>
            </div>
        </div>
    </div>

    <?php echo $__env->make('layouts/helpersview/mensagemRetorno', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo Form::open(['route' => 'despesas.store', 'method' => 'POST', 'id' => 'criaDespesas']); ?>


    <?php echo $__env->make('despesas/formulario/campos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Seção Despesas -->
    <?php echo Form::hidden('idAlteracaoUsuario', '', [
        'placeholder' => 'Preencha este campo',
        'class' => 'form-control',
        'maxlength' => '5',
    ]); ?>

    <?php echo Form::hidden('idAutor', Auth::user()->id, [
        'placeholder' => 'Preencha este campo',
        'class' => 'form-control',
        'maxlength' => '5',
    ]); ?>


    <input type="hidden" name="tpRetorno" id="tpRetorno" value="" />
    
    <input type="button" class="btn btn-success" id="btnSalvareVisualizar" value="Salvar e Visualizar"
        onclick="alteraRetornoCadastroDespesa(retorno = 'visualiza');" />
    <input type="button" class="btn btn-success" id="btnSalvareNovo" value="Salvar e Lançar Nova Despesa"
        onclick="alteraRetornoCadastroDespesa(retorno = 'novo');" />

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/despesas/create.blade.php ENDPATH**/ ?>