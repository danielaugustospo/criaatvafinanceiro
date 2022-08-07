<!-- Modal -->
<div class="modal fade <?php if(isset($chamadaCadastroModal)): ?> <?php echo e($chamadaCadastroModal); ?> <?php endif; ?>" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">
              <?php if(isset($tituloCadastroModal)): ?> <?php echo e($tituloCadastroModal); ?> <?php endif; ?>
        </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

            <iframe class="modal-body" src="<?php echo e(url('/'. $rotaCadastroModal )); ?>" id="<?php echo e($idFrame); ?>" frameborder="0" style="height: 60vh;">
            </iframe>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
</div>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/modal/cadastro.blade.php ENDPATH**/ ?>