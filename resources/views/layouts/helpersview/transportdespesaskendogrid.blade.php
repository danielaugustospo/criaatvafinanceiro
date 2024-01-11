transport: {
    read: {
        @if (isset($despesas))
            url: "{{ $rotaapi }}?despesas={{ $despesas }}&valor={{ $valor }}&dtinicio={{ $dtinicio }}&dtfim={{ $dtfim }}&coddespesa={{ $coddespesa }}&grupodespesa={{ $grupodespesa }}&fornecedor={{ $fornecedor }}&ordemservico={{ $ordemservico }}&conta={{ $conta }}&notafiscal={{ $notafiscal }}&cliente={{ $cliente }}&fixavariavel={{ $fixavariavel }}&pago={{ $pago }}&idSalvo={{ $idSalvo }}&idUser={{ $idUser }}&dtiniciolancamento={{ $dtiniciolancamento }}&dtfimlancamento={{ $dtfimlancamento }}&formaPagamento={{ $formaPagamento }}@if(isset($rel))&rel={{ $rel }} @endif @if(isset($reembolso))&reembolso={{$reembolso}}@endif",
        @else
            url: "{{ $rotaapi }}",
        @endif
        dataType: "json",
        type: "GET"
    },
    @if (isset($despesas))
        update: {
            url: "/apiupdatedespesas",
            dataType: "jsonp"
        },



        update: {
            url: "/apiupdatedespesas",
            dataType: "jsonp",
            type: "POST",
            beforeSend: function (xhr) {
                
                // Adicione o token CSRF aos cabeçalhos da requisição
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

            },
            complete: function(e) {
                // Lógica a ser executada após a atualização
                if (e.status === 200) {
                    // Se o status for 200, realiza o refresh da tabela
                    dataSource.read();
                    
                    // Show SweetAlert modal for success
                    Swal.fire({
                        title: 'Sucesso',
                        text: 'Atualização realizada com sucesso!',
                        icon: 'success'
                    });
                } else {
                    // Show SweetAlert modal for error
                    Swal.fire({
                        title: 'Erro',
                        text: 'Ocorreu um erro durante a atualização.',
                        icon: 'error'
                    });
                }
            },
            data: function (data) {
                // Adicione o campo 'id' aos dados a serem enviados
                return JSON.stringify({ id: data.id });
            }
        },

    @endif
    parameterMap: function(options, operation) {
        if (operation !== "read" && options.models) {
            return {
                models: kendo.stringify(options.models)
            };
        }
    }
},