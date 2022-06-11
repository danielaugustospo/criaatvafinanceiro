<script>
    function getDomain() {
        return document.querySelector('base').href;
    }

    function chamaPrevencaodeClique(e) {
        $('#buscarCC').attr('disabled', 'disabled');
        form.submit();
    }

    function verificaPreenchimento(e) {
        var pegaId = document.getElementById("id").value;
        if (pegaId != null && pegaId != '') {
            document.getElementById("formFiltraDespesa").setAttribute("action", "{{ route('displaydespesas') }}");
            form.submit();

        } else {
            var pegadespesas = document.getElementById("despesas").value;
            var pegadtinicio = document.getElementById("dtinicio").value;
            var pegadtfim = document.getElementById("dtfim").value;
            var pegacoddespesa = document.getElementById("coddespesa").value;
            var pegafornecedor = document.getElementById("fornecedor").value;
            var pegaordemservico = document.getElementById("ordemservico").value;
            if (
                (pegadespesas == null || pegadespesas == '') &&
                (pegadtinicio == null || pegadtinicio == '') &&
                (pegadtfim == null || pegadtfim == '') &&
                (pegacoddespesa == null || pegacoddespesa == '') &&
                (pegafornecedor == null || pegafornecedor == '') &&
                (pegaordemservico == null || pegaordemservico == '')

            ) {
                alert("Preencha ao menos um campo e tente novamente");
            } else {
                document.getElementById("formFiltraDespesa").setAttribute("action", "{{ route('displaydespesas') }}");
                form.submit();
            }
        }

    }

    $(document).ready(function() {

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

        $(".padraoReal").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ".",
            allowMinus: false,
            // prefix: 'R$ ',            
            digits: 2,
            digitsOptional: true,
            rightAlign: true,
            unmaskAsNumber: true,
            removeMaskOnSubmit: true
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

    $(document).ready(function() {
        $(".padraoRealEdicao").inputmask('currency', {
            "autoUnmask": true,
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

    function abreModalDespesas(param) {
        // console.log(param);
        $('.modaldepesas').modal('toggle');
        document.getElementById("tpRel").value = param;

        // $('#myModal').modal('show');
        // $('#exampleModal').modal('hide');
    }
</script>


<script type="x/kendo-template" id="page-template"><div class="page-template">
      <div class="header">
        <div style="float: right">Página #: pageNum # de #: totalPages #</div>
        <img src="{{ env('ASSET_URL') }}img/logoPRETO-criaatvaPRETOWHITE.png" width="80" alt="" srcset="">

        Relatório de #: document.title # 
      </div>
      <div class="watermark">CRIAATVA</div>
      {{-- <div class="footer">
        Página #: pageNum # de #: totalPages #
      </div> --}}
    </div>
</script>
