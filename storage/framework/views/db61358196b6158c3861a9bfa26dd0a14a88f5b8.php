<script>
    $(document).ready(function() {
        $(".selecionaComInput").select2();
    });

    function chamaPrevencaodeClique(e) {
        $('#buscarCC').attr('disabled', 'disabled');
        form.submit();
    }

    $(document).ready(function($) {

        $(document).off('keydown');
        $(document).keydown(function(e) {
            if (e.keyCode == 13) {
                console.log('Botão enter desabilitado');
                return false;
            }
        });

        jQuery('.campo-moeda')
            .maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });

        $(".campo-aliquota").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: "",
            allowMinus: false,
            // prefix: 'R$ ',            
            digits: 5,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true,
            removeMaskOnSubmit: true
        });

    });

    function abreModalDespesas(param) {
        $('.modaldepesas').modal('toggle');
        document.getElementById("tpRel").value = param;
    }
</script>


<script type="x/kendo-template" id="page-template"><div class="page-template">
      <div class="header">
        <div style="float: right">Página #: pageNum # de #: totalPages #</div>
        <img src="<?php echo e(env('ASSET_URL')); ?>img/logoPRETO-criaatvaPRETOWHITE.png" width="80" alt="" srcset="">

        Relatório de #: document.title # 
      </div>
      <div class="watermark">CRIAATVA</div>
      
    </div></script>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/scripts.blade.php ENDPATH**/ ?>