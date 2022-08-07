<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="id" id="id">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaFuncionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionarios): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($funcionarios->id); ?>"><?php echo e($funcionarios->id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label for="" class="col-sm-2">CPF</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple" name="cpfFuncionario" id="cpfFuncionario">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaFuncionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionarios): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($funcionarios->cpfFuncionario); ?>"><?php echo e($funcionarios->cpfFuncionario); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label for="" class="col-sm-1">Nome</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="nomeFuncionario" id="nomeFuncionario">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaFuncionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionarios): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($funcionarios->nomeFuncionario); ?>"><?php echo e($funcionarios->nomeFuncionario); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">Celular</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="celularFuncionario" id="celularFuncionario">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaFuncionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionarios): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($funcionarios->celularFuncionario); ?>"><?php echo e($funcionarios->celularFuncionario); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <label for="" class="col-sm-2">Email</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="emailFuncionario" id="emailFuncionario">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaFuncionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionarios): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($funcionarios->emailFuncionario); ?>"><?php echo e($funcionarios->emailFuncionario); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            </div>
            <div class="row mt-3">
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/funcionarios/filtroindex.blade.php ENDPATH**/ ?>