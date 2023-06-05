transport: {
    read: {
        @if (isset($despesas))
            url: "{{ $rotaapi }}?despesas={{ $despesas }}&valor={{ $valor }}&dtinicio={{ $dtinicio }}&dtfim={{ $dtfim }}&coddespesa={{ $coddespesa }}&grupodespesa={{ $grupodespesa }}&fornecedor={{ $fornecedor }}&ordemservico={{ $ordemservico }}&conta={{ $conta }}&notafiscal={{ $notafiscal }}&cliente={{ $cliente }}&fixavariavel={{ $fixavariavel }}&pago={{ $pago }}&idSalvo={{ $idSalvo }}&idUser={{ $idUser }}&dtiniciolancamento={{ $dtiniciolancamento }}&dtfimlancamento={{ $dtfimlancamento }}&formaPagamento={{ $formaPagamento }}@if(isset($rel))&rel={{ $rel }} @endif @if(isset($reembolso))&reembolso={{$reembolso}}@endif",
        @else
            url: "{{ $rotaapi }}",
        @endif
        dataType: "json"
    },

    parameterMap: function(options, operation) {
        if (operation !== "read" && options.models) {
            return {
                models: kendo.stringify(options.models)
            };
        }
    }
},