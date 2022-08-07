<style>
    h5,
    .card-text,
    .card-headernew {
        color: white;
    }

    .acessarMinusculo {
        text-transform: lowercase !important;
    }
</style>
<div style=" display: none;">

    <?php echo e($acessarA = 'A'); ?>

    <?php echo e($acessar = 'cessar'); ?>

    <!-- <?php echo e($acessarArea = 'Acessar área de '); ?> -->
    <?php echo e($acessarArea = ' '); ?>

    <?php echo e($titulo1 = 'Ordem de Serviços'); ?>

    <?php echo e($titulo2 = 'Conta Corrente'); ?>

    <?php echo e($titulo3 = 'Relatórios'); ?>

    <?php echo e($titulo4 = 'Clientes'); ?>

    <?php echo e($titulo5 = 'Fornecedores'); ?>

    <?php echo e($titulo6 = 'Funcionários'); ?>

</div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ordemdeservico-list')): ?>
        <div class="d-flex justify-content-around mt-3">

            <a href="<?php echo e(route('ordemdeservicos.index')); ?>">
                <div class="card text-white bg-dark mb-3"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">
                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4"><?php echo e($titulo1); ?></h4>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12 ">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>
                        </div>

                        <div class="col-sm-5 pb-2">
                            <img src="img/clipboard.png" style="width: 70%;" alt="">
                        </div>
                    </div>
            </a>

        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('visualiza-contacorrente')): ?>
        <div class="card text-white bg-dark mb-3 ml-1 mr-1"
            style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">
            <!-- Button trigger modal -->
            
            <a data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter"
                style="cursor: pointer;">
                <div class="card-headernew d-flex justify-content-center">
                    <h4 class="pt-4"><?php echo e($titulo2); ?></h4>
                </div>
                <div class="card-body mt-1"></div>
                <div class="row col-sm-12">
                    <div class="col-sm-7 row">
                        <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                    </div>
                    <div class="col-sm-5">
                        <img src="img/credit-card.png" style="width: 70%;" alt="">
                    </div>
                </div>
                
            </a>
        </div>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('visualiza-relatoriogeral')): ?>
        <div class="card text-white bg-dark mb-3"
            style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

            <a href="relatorio">

                <div class="card-headernew d-flex justify-content-center">
                    <h4 class="pt-4"><?php echo e($titulo3); ?></h4>
                </div>
                <div class="card-body mt-1"></div>
                <div class="row col-sm-12">
                    <div class="col-sm-7 row">
                        <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                    </div>
                    <div class="col-sm-5">
                        <img src="img/report.png" style="width: 70%;" alt="">
                    </div>
                </div>
            </a>
        </div>
    
    <?php endif; ?>
</div>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cliente-list')): ?>
    <div class="d-flex justify-content-around mt-3">

        <a href="<?php echo e(route('clientes.index')); ?>">

            <div class="card text-white bg-dark mb-3"
                style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">
                <div class="card-headernew d-flex justify-content-center">
                    <h4 class="pt-4"><?php echo e($titulo4); ?></h4>
                </div>
                <div class="card-body mt-1"></div>

                <div class="row col-sm-12">
                    <div class="col-sm-7 row">
                        <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                    </div>
                    <div class="col-sm-5">
                        <img src="img/crm.png" style="width: 70%;" alt="">
                    </div>
                </div>
        </a>
    </div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fornecedor-list')): ?>
    <div class="card text-white bg-dark mb-3 ml-1 mr-1"
        style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

        <a href="<?php echo e(route('fornecedores.index')); ?>">

            <div class="card-headernew d-flex justify-content-center">
                <h4 class="pt-4"><?php echo e($titulo5); ?></h5>
            </div>
            <div class="card-body mt-1"></div>

            <div class="row col-sm-12">
                <div class="col-sm-7 row">
                    <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                </div>
                <div class="col-sm-5">
                    <img src="img/help.png" style="width: 70%;" alt="">
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('funcionario-list')): ?>
    <div class="card text-white bg-dark mb-3"
        style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

        <a href="<?php echo e(route('funcionarios.index')); ?>">

            <div class="card-headernew d-flex justify-content-center">
                <h4 class="pt-4"><?php echo e($titulo6); ?></h4>
            </div>
            <div class="card-body mt-1"></div>

            <div class="row col-sm-12">
                <div class="col-sm-7 row">
                    <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                </div>
                <div class="col-sm-5">
                    <img src="img/working-man.png" style="width: 70%;" alt="">
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>


</div>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/acessorapido.blade.php ENDPATH**/ ?>