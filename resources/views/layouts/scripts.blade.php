
<script>
 function getDomain() {
    return document.querySelector('base').href;
}       

    $(document).ready(function() {
   
    jQuery('.campo-moeda')
      .maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: false
  });

    $(".padraoReal").inputmask( 'currency',{"autoUnmask": true,
                    radixPoint:",",
                    groupSeparator: ".",
                    allowMinus: false,
                    // prefix: 'R$ ',            
                    digits: 2,
                    digitsOptional: true,
                    rightAlign: true,
                    unmaskAsNumber: true,
                    removeMaskOnSubmit: true
        });
    $(".campo-aliquota").inputmask( 'currency',{"autoUnmask": true,
                    radixPoint:",",
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
            // $(".padraoReal").inputmask('decimal', {
            //     // 'rightAlign': false,                
            //     'alias': 'numeric',
            //     'groupSeparator': '.',
            //     'autoGroup': false,
            //     'digits': 2,
            //     'radixPoint': ",",
            //     'digitsOptional': false,
            //     'allowMinus': false,
            //     // 'prefix': 'R$ ',
            //     'placeholder': '0',
            // });
        $(document).ready(function() {
            $(".padraoRealEdicao").inputmask('currency',{"autoUnmask": true,
            // radixPoint:",",
            // groupSeparator: ".",
            allowMinus: false,
            prefix: 'R$ ',            
            // digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
            });
        });

        $(document).ready(function($) {
            $(".selecionaComInput").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#id").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#nomeFormaPagamento").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#idClienteOrdemdeServico").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#despesaCodigoDespesas").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#idFormaPagamento").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#idFormaPagamentoReceita").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#conta").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#contaReceita").select2()({
                placeholder: 'Selecione uma opção',
                dropdownParent: $('#myModal'),
            });

            $("#totalPrecoReal").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });

            $("#totalPrecoCliente").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });

            $("#lucro").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });

            $("#valorEstornado").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });

            $("#precoReal").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });

            $("#precoCliente").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });


            $("#valorProjetoOrdemdeServico").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });

            $("#valorOrdemdeServico").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });

            $("#valorreceita").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'prefix': 'R$ ',
                'placeholder': ''
            });
        });

</script>

 
<script type="x/kendo-template" id="page-template">
  
    <div class="page-template">
      <div class="header">
        <div style="float: right">Página #: pageNum # de #: totalPages #</div>
        <img src="{{ env('ASSET_URL') }}img/logoPRETO-criaatvaPRETOWHITE.png" width="80" alt="" srcset="">

        Relatório de #: document.title # 
      </div>
      <div class="watermark">CRIAATVA</div>
      <div class="footer">
        Página #: pageNum # de #: totalPages #
      </div>
    </div>
  </script>