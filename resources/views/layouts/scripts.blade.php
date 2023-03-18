<script>
 
    $(document).ready(function() {
        @if(Auth::user())
                    timeout = setTimeout(encerraSessaoSozinho, 1800600); //30min e 01 seg
                    
                    function encerraSessaoSozinho() {
                        Swal.fire({
                            icon:   'error',
                            title:  'Sessão Expirada!',
                            text:   'Estaremos lhe redirecionando para a página inicial!',
                            timer:  3000
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.replace('/');
                            }
                            else {
                                location.replace('/');
                            }
                        });
                    }
                        // var ultimaAtividade = {{ session('lastActivityTime') }};
                @endif

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
      <div class="header row">
        <div style="float: right">Página #: pageNum # de #: totalPages #</div>
        <img src="{{ env('ASSET_URL') }}img/logoPRETO-criaatvaPRETOWHITE.png" width="80" alt="" srcset="">

        <h3 class="text-center">Relatório de #: document.title # </h3> 
      </div>
      <div class="watermark">CRIAATVA</div>
      {{-- <div class="footer">
        Página #: pageNum # de #: totalPages #
      </div> --}}
    </div>
</script>
