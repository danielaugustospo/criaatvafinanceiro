<?php echo $__env->make('layouts/modal/includesmodal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container panel panel-default pt-2 pb-2">

    <?php if(isset($mensagem)): ?>
    <div class="alert alert-success" role="alert">
        <p><?php echo e($mensagem); ?></p>
    </div>
    <?php endif; ?>
	

    <form action="<?php echo e(route('cadastrotipomateriais')); ?>" method="POST">
    	<?php echo csrf_field(); ?>


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nome:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Nome" required>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detalhes:</strong>
		        </div>
            </div>
			<input type="hidden" value="0" name="detail" class="form-control" placeholder="Detalhes"/>
            <input type="hidden" value="1" name="ativotipobenspatrimoniais" class="form-control" placeholder="Ativo">
            <input type="hidden" value="0" name="excluidotipobenspatrimoniais" class="form-control" placeholder="Excluido">

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Salvar</button>
		    </div>
		</div>


    </form>

</div><?php /**PATH /var/www/clients/client2/web4/web/resources/views/products/camposmodal.blade.php ENDPATH**/ ?>