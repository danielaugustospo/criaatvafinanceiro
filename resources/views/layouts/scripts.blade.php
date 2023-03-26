<script>
 
    $(document).ready(function() {
        @if(Auth::user())
                    // var renovaSessao = setTimeout(avisoRenovaSessao, 1500000); //25min
                    var renovaSessao = setInterval(avisoRenovaSessao, 1000 * 60 * 25); // renova a sessão a cada 25 minutos
                    timeout = setTimeout(encerraSessaoSozinho, 1800600); //30min e 01 seg

                    function avisoRenovaSessao() {
                        playNotification(nome = 'notification');
                        Swal.fire({
                            icon:   'info',
                            title:  'Renove a sua sessão',
                            text:   'O seu tempo de acesso expirará em 5 minutos. Para renovar, basta clicar no botão abaixo.',
                            timer:  60000
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.get('renovaSessao', function(data, status) {
                                   
                                    if (data != null || data != undefined) {
                                        clearTimeout(timeout);
                                        // clearTimeout(renovaSessao);
                                        renovaSessao = setInterval(avisoRenovaSessao, 1000 * 60 * 25);
                                        timeout = setTimeout(encerraSessaoSozinho, 1800600);
                                        playNotification(nome = 'success');
                                        Swal.fire({
                                            icon:   'success',
                                            title:  'Sessão restabelecida!',
                                            text:   'Seu tempo de sessão foi renovado. A partir de agora, você tem mais 30 minutos para executar as operações dentro sistema sem necessidade de sair da página. Quando faltarem 5 minutos para finalizar a sua sessão avisaremos novamente.',
                                            timer:  60000
                                        })
                                    }
                                });
                            }
                            else {
                                Swal.fire({
                                        icon:   'error',
                                        title:  'Sessão não renovada!',
                                        text:   'Seu tempo de sessão está acabando e você optou por não renovar. É recomendado salvar quaisquer operações pendentes.',
                                        timer:  60000
                                })
                            }
                        });
                    }
                    
                    function encerraSessaoSozinho() {
                        Swal.fire({
                            icon:   'error',
                            title:  'Sessão Expirada!',
                            text:   'Estaremos lhe redirecionando para a página inicial!',
                            timer:  5000
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
                        function playNotification(nome) {

                            // cria o contexto de áudio
                            var AudioContext = window.AudioContext || window.webkitAudioContext;
                            var audioCtx = new AudioContext();
        
                            // carrega o arquivo de áudio
                            var audioElement = new Audio(nome+'.mp3');
                            var track = audioCtx.createMediaElementSource(audioElement);
        
                            // cria um ganho para controlar o volume do áudio
                            var gainNode = audioCtx.createGain();
                            track.connect(gainNode);
                            gainNode.connect(audioCtx.destination);
                            gainNode.gain.value = 0.5; // define o volume para 50%
        
                            // reproduz o áudio
                            audioElement.play();
                        }
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
