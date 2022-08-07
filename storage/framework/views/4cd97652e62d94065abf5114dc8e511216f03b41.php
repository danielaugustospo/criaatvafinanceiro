<div class="container shadowDiv mb-5 rounded" style="background-color: lightslategray !important; color:white;" id="container">

    
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="group-row">

                <label for="" class="col-sm-1">N° OS</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaId" name="id" id="id">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaOrdemDeServicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordemDeServicos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ordemDeServicos->id); ?>"><?php echo e($ordemDeServicos->id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label for="" class="col-sm-2">Cliente</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaCliente" name="idClienteOrdemdeServico" id="idClienteOrdemdeServico">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaOrdemDeServicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordemDeServicos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ordemDeServicos->idClienteOrdemdeServico); ?>"><?php echo e($ordemDeServicos->razaosocialCliente); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            </div>
            <div class="group-row">
                <label for="" class="col-sm-1">Evento</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple buscaEvento" name="eventoOrdemdeServico" id="eventoOrdemdeServico">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaOrdemDeServicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordemDeServicos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ordemDeServicos->eventoOrdemdeServico); ?>"><?php echo e($ordemDeServicos->eventoOrdemdeServico); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label for="" class="col-sm-2">Valor Projeto</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple buscaValor" name="valorOrdemdeServico" id="valorOrdemdeServico">
                    <option value="">Listar todos</option>
                    <?php $__currentLoopData = $listaOrdemDeServicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordemDeServicos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ordemDeServicos->valorOrdemdeServico); ?>"><?php echo e($ordemDeServicos->valorOrdemdeServico); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
    </div>
    <br>
</div><?php /**PATH /var/www/clients/client2/web4/web/resources/views/ordemdeservicos/filtroindex.blade.php ENDPATH**/ ?>