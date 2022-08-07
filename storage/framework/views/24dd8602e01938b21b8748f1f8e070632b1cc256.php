<?php //use App\Providers\AppServiceProvider;
?>

<nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
    <?php echo $__env->yieldContent('nav'); ?>
    <div class="container" style="max-width: fit-content !important;">
        <a href="<?php echo e(route('home')); ?>" class="mr-3"> <i class="fas fa-home" style="color: white;"></i></a>
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>" style="color:white;">
            Criaatva
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>

            <ul class="navbar-nav ml-auto">
                <?php if(auth()->guard()->guest()): ?>
                    <li><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ordemdeservico-list')): ?>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                OS <span class="caret"></span>
                            </a>
                        <?php endif; ?>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ordemdeservico-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('ordemdeservicos.index')); ?>">Consultar</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ordemdeservico-create')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('ordemdeservicos.create')); ?>">Cadastrar</a>
                            <?php endif; ?>

                            
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('despesa-list')): ?>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Despesas <span class="caret"></span>
                            </a>
                        <?php elseif (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('despesa-create')): ?>
                            
                            <a class="nav-link" href="<?php echo e(route('despesas.create')); ?>">Cadastrar Despesas</a>
                        <?php endif; ?>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('despesa-list')): ?>
                                
                                <a class="dropdown-item" data-toggle="modal" data-target=".modaldepesas"
                                    style="cursor:pointer;">Pesquisar por despesa</a>
                                <a onclick="abreModalDespesas(param = 'pesquisadespesascompleto');" class="dropdown-item"
                                    href="#" style="cursor:pointer; color:red;">Pesquisar Despesas (completo)</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('despesa-create')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('despesas.create')); ?>">Cadastrar</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('codigodespesa-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('codigodespesas.index')); ?>">Código Despesas</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('grupodespesa-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('grupodespesas.index')); ?>">Grupo Despesas</a>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('receita-list')): ?>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Receitas <span class="caret"></span>
                            </a>
                        <?php endif; ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('receita-list')): ?>
                                <a class="dropdown-item" data-toggle="modal" data-target=".modalreceita"
                                    style="cursor:pointer;">Pesquisar por receita</a>

                                
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('receita-create')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('receita.create')); ?>">Cadastrar</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('visualiza-relatoriogeral')): ?>
                            <a class="nav-link" href="<?php echo e(route('relatorio.index')); ?>" role="button">
                                Relatórios <span class="caret"></span>
                            </a>
                        <?php endif; ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('entradas-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('resumofinanceiro')); ?>">Resumo Financeiro</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    

                    <li class="nav-item dropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fornecedor-list')): ?>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Forn. <span class="caret"></span>
                            </a>
                        <?php endif; ?>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fornecedor-create')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('fornecedores.create')); ?>">Cadastrar</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fornecedor-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('fornecedores.index')); ?>">Consultar</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cliente-list')): ?>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Clientes <span class="caret"></span>
                            </a>
                        <?php endif; ?>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cliente-create')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('clientes.create')); ?>">Cadastrar</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cliente-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('clientes.index')); ?>">Consultar</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('funcionario-list')): ?>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Funcionários <span class="caret"></span>
                            </a>
                        <?php endif; ?>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('funcionario-create')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('funcionarios.create')); ?>">Cadastrar</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('funcionario-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('funcionarios.index')); ?>">Consultar</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notasrecibos-list')): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Notas/Alíquotas <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notasrecibos-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('notasrecibos.index')); ?>">Consultar
                                        Notas/Recibos</a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notasrecibos-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('aliquotamensal.index')); ?>">Alíquotas Mensais</a>
                                <?php endif; ?>

                            </div>
                        </li>
                    <?php endif; ?>


                    <li class="nav-item dropdown">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuario-list')): ?>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Conf. <span class="caret"></span>
                            </a>
                        <?php endif; ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('usuario-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('users.index')); ?>">Usuários</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('banco-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('bancos.index')); ?>">Bancos</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('formapagamento-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('formapagamentos.index')); ?>">Formas de Pagamento</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('conta-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('contas.index')); ?>">Contas</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('codigodespesa-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('codigodespesas.index')); ?>">Código Despesas</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('roles.index')); ?>">Regras</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orgaorg-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('orgaosrg.index')); ?>">Órgãos RG</a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('benspatrimoniais-list')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('products.index')); ?>">Tipo de Bens Patrimoniais</a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('benspatrimoniais-list')): ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Bens <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('benspatrimoniais-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('benspatrimoniais.index')); ?>">Catálogo de
                                        Materiais</a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('entradas-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('entradas.index')); ?>">Entradas de Materiais</a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('saidas-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('saidas.index')); ?>">Saídas (Baixa de Materiais)</a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('estoque-list')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('estoque.index')); ?>">Estoque (Inventário) </a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            v-pre><?php echo e(Auth::user()->name); ?><span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="users/<?php echo e(Auth::user()->id); ?>/edit">Editar Perfil <i
                                    class="far fa-id-card ml-1"></i></a>

                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                Sair
                                <i class="fas fa-power-off"></i>
                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="formFiltraPeriodoMonetario" onsubmit="return chamaPrevencaodeClique(event)"
                method="get">
                <?php echo csrf_field(); ?>

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color:black;">Selecione o período e
                        conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="row ml-2">
                        <label>Conta</label>
                        <select name="conta" id="conta" class="selecionaComInput col-sm-12"
                            style="width:440px;" required>
                            <option disabled selected>Selecione...</option>
                            <?php $__currentLoopData = $listaContas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($contas->id); ?>"><?php echo e($contas->apelidoConta); ?> -
                                    <?php echo e($contas->nomeConta); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <label class="ml-2 mt-2">Período</label>
                    <div class="row">

                        <input type="date" required class="form-control col-sm-5 ml-4 mr-1" name="datainicial"
                            id="datainicial">
                        <input type="date" required class="form-control col-sm-5 " name="datafinal"
                            id="datafinal">
                        <input type="hidden" value="" name="modorelatorio" id="modorelatorio">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" id="buscarCC" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php echo $__env->make('layouts/modal/modalpesquisadespesas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts/modal/modalpesquisareceita', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<script>
    function alteraRotaFormularioCC() {
        document.getElementById("formFiltraPeriodoMonetario").setAttribute("action", "<?php echo e(route('extratoConta')); ?>");
    }

    function alteraRotaFormularioFluxo(relatorio) {
        if (relatorio === 'sintetico') {
            document.getElementById("modorelatorio").value = "sintetico";
        }
        if (relatorio === 'analitico') {
            document.getElementById("modorelatorio").value = 'analitico';

        }
        document.getElementById("formFiltraPeriodoMonetario").setAttribute("action", "<?php echo e(route('fluxodecaixa')); ?>");
        document.getElementById("datafinal").style.visibility = "hidden";
        document.getElementById("datafinal").removeAttribute("required");
    }
</script>



<datalist id="datalistIdReceita">
    <?php $__currentLoopData = $listaReceitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($receitas->id); ?>"><?php echo e($receitas->id); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>

<datalist id="datalistDescricaoReceita">
    <?php $__currentLoopData = $listaReceitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($receitas->descricaoreceita); ?>"><?php echo e($receitas->descricaoreceita); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>








<datalist id="datalistIdDespesa">
    <?php $__currentLoopData = $listaDespesas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $despesas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($despesas->id); ?>"><?php echo e($despesas->id); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>

<datalist id="datalistDescricaoDespesa">
    <?php $__currentLoopData = $listaDespesas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $despesas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($despesas->descricaoDespesa); ?>"><?php echo e($despesas->descricaoDespesa); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>

<datalist id="datalistOrdemServico">
    <?php $__currentLoopData = $pegaidOS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordemdeservico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($ordemdeservico->id); ?>"><?php echo e($ordemdeservico->id); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</datalist>

<datalist id="datalistFornecedor">
    <?php $__currentLoopData = $listaFornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedores): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($fornecedores->razaosocialFornecedor); ?>"><?php echo e($fornecedores->razaosocialFornecedor); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>

<datalist id="datalistCodDespesa">
    <?php $__currentLoopData = $listaCodigoDespesa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coddespesa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($coddespesa->despesaCodigoDespesa); ?>"><?php echo e($coddespesa->despesaCodigoDespesa); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>
<datalist id="datalistContas">
    <?php $__currentLoopData = $listaContas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($conta->apelidoConta); ?>"><?php echo e($conta->nomeConta); ?> - <?php echo e($conta->apelidoConta); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>

<datalist id="datalistCliente">
    <?php $__currentLoopData = $listaClientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->razaosocialCliente); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>