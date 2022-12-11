function sum(input) {

    if (toString.call(input) !== "[object Array]")
        return false;

    var total = 0;
    for (var i = 0; i < input.length; i++) {
        if (isNaN(input[i])) {
            continue;
        }
        total += Number(input[i]);
    }
    return total;
}

function alertaErros(texto, contadorErros) {
    if (contadorErros > 0) {

        var span = document.createElement("span");
        span.innerHTML = texto;

        Swal.fire({
            icon: 'error',
            html: span,
            title: 'Validações Necessárias',
            footer: 'Restam  ' + contadorErros + ' pendentes.'
        })
    }
    return contadorErros;
}

function validaFormulario() {
    contadorErros = 0;
    contadorDatasDiferentesAnoAtual = 0;
    var ehcompra = document.querySelector('input[name=a]:checked')?.value;

    fornecedor = $('.selecionaFornecedor').val();
    formapagamento = $('.idFormaPagamento').val();
    conta = $('.conta').val();
    precoReal = $('.precoReal').val();
    despesaCodigoDespesas = $('#despesaCodigoDespesas').val();
    texto = '';
    textoData = '';

    /* ---------------------------------------------------
        VERIFICAÇÃO DE DATA - EM ANDAMENTO - 26/06/2022
    ----------------------------------------------------*/
    vencimento      = document.getElementsByName("vencimento")[0].value;
    datavale        = document.getElementsByName("datavale")[0].value;
    dataDaCompra    = document.getElementsByName("dataDaCompra")[0].value;
    dataDoTrabalho  = document.getElementsByName("dataDoTrabalho")[0].value;

    anovencimento       = new Date(vencimento).getFullYear();
    anodatavale         = new Date(datavale).getFullYear();
    anodataDaCompra     = new Date(dataDaCompra).getFullYear();
    anodataDoTrabalho   = new Date(dataDoTrabalho).getFullYear();

    var dataAtual = new Date();
    const anoAtual = dataAtual.getFullYear();

    @if($modoSandbox->ativo == '0' || $modoSandbox->ativo == 0)
    function addHours(numOfHours, date = new Date()) {
        date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
        return date;
    }
    vencimentoNovo = addHours(26.999, new Date(vencimento));

    if (vencimentoNovo < dataAtual) {
        texto = texto +
        '<span class="badge badge-danger">Operação Proibida</span><label class="fontenormal pl-2">Data de Vencimento menor do que a data atual</label></br>';
        alertaErros(texto, contadorErros++);
    }
    @endif

    //Verifica se não o campo compra foi informado
    if ((ehcompra != "N") && (ehcompra != "S")) {
        texto =
            '<span class="badge badge-warning">Marcar</span><label class="fontenormal pl-2">Se é compra ou não</label></br>'; contadorErros++;
    }

    if (anovencimento < 2000 || anovencimento > 2099) {
        texto = texto +
            '<span class="badge badge-danger">Alterar</span><label class="fontenormal pl-2">Data de Vencimento Inválida (ano ' +
            anovencimento + ')</label></br>'; contadorErros++;
    } else if ((anovencimento > 2000) && (anovencimento < 2099) && (anovencimento != anoAtual)) {
        textoData = textoData +
            '<span class="badge badge-warning">Atenção</span><label class="fontenormal pl-2">Data de Vencimento com ano ' +
            anovencimento + '</label></br>'; contadorDatasDiferentesAnoAtual++;
    }
    if (anodatavale < 2000 || anodatavale > 2099) {
        texto = texto +
            '<span class="badge badge-danger">Alterar</span><label class="fontenormal pl-2">Data do Vale Inválida (ano ' +
            anodatavale + ')</label></br>'; contadorErros++;
    } else if ((anodatavale > 2000) && (anodatavale < 2099) && (anodatavale != anoAtual)) {
        textoData = textoData +
            '<span class="badge badge-warning">Atenção</span><label class="fontenormal pl-2">Data do Vale com ano ' +
            anodatavale + '</label></br>'; contadorDatasDiferentesAnoAtual++;
    }

    if (anodataDaCompra < 2000 || anodataDaCompra > 2099) {
        texto = texto +
            '<span class="badge badge-danger">Alterar</span><label class="fontenormal pl-2">Data da Compra Inválida  (ano ' +
            anodataDaCompra + ')</label></br>'; contadorErros++;
    } 
    else if ((anodataDaCompra > 2000) && (anodataDaCompra < 2099) && (anodataDaCompra != anoAtual)) {
        textoData = textoData +
            '<span class="badge badge-warning">Atenção</span><label class="fontenormal pl-2">Data da Compra com ano ' +
            anodataDaCompra + '</label></br>'; contadorDatasDiferentesAnoAtual++;
    }

    if (anodataDoTrabalho < 2000 || anodataDoTrabalho > 2099) {
        texto = texto +
            '<span class="badge badge-danger">Alterar</span><label class="fontenormal pl-2">Data do Trabalho Inválida  (ano ' +
            anodataDoTrabalho + ')</label></br>';
        contadorErros++;
    } else if ((anodataDoTrabalho > 2000) && (anodataDoTrabalho < 2099) && (anodataDoTrabalho != anoAtual)) {
        textoData = textoData +
            '<span class="badge badge-warning">Atenção</span><label class="fontenormal pl-2">Data do Trabalho com ano ' +
            anodataDoTrabalho + '</label></br>'; contadorDatasDiferentesAnoAtual++;
    }

    resultadoFormulario = validadorAdicional(despesaCodigoDespesas, texto, contadorErros, formapagamento, conta,
        despesaFixa, ehcompra, fornecedor, precoReal, contadorDatasDiferentesAnoAtual, anoAtual, vencimento, dataAtual);

    return resultadoFormulario;
}


function validadorAdicional(despesaCodigoDespesas, texto, contadorErros, formapagamento, conta, despesaFixa,
    ehcompra, fornecedor, precoReal, contadorDatasDiferentesAnoAtual, anoAtual, vencimento, dataAtual) {
    if ((despesaCodigoDespesas == '') || (despesaCodigoDespesas == null)) {
        texto = texto +
            '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Informe o código da despesa</label></br>'; contadorErros++;
    }
    if ((formapagamento == 0) || (formapagamento == '') || (formapagamento == null)) {
        texto = texto +
            '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Forma de Pagamento</label></br>'; contadorErros++;
    }

    if ((conta == '') || (conta == null)) {
        texto = texto +
            '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Conta</label></br>'; contadorErros++;
    }
    if ((despesaFixa == '') || (despesaFixa == null)) {
        texto = texto +
            '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Se é uma despesa fixa</label></br>'; contadorErros++;
    }
    if ((fornecedor == 0) || (fornecedor == '') || (fornecedor == null)) {
        texto = texto +
            '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Fornecedor</label></br>'; contadorErros++;
    }

    if ((ehcompra == 1) || (ehcompra == 'S')) {
        //Verifica se é compra

        var compraparcelada = document.querySelector('input[name=compraparcelada]:checked')?.value;
        inserirestoque      = document.querySelector('input[name=inserirestoque]:checked')?.value;
        unicadespesa        = document.querySelector('input[name=unicadespesa]:checked')?.value;

        if ((inserirestoque == '') || (inserirestoque == ' ') || (inserirestoque == null) || (inserirestoque == undefined)) {
            // Opção de inserção no estoque não foi atendida 
            texto = texto +
                '<span class="badge badge-danger">Marcar</span><label class="fontenormal pl-2">Se a compra será inserida no estoque</label></br>'; contadorErros++;

        } else if ((inserirestoque == 1) && (compraparcelada == 'N') && (unicadespesa == '1')) {
            // Opção de inserção no estoque como compra não parcelada e única despesa
            var descricaoDespesaCompra = $('.descricaoDespesaCompra').val();
            
            if ((descricaoDespesaCompra == '') || (descricaoDespesaCompra == null) && (compraparcelada != 'S')) {
                texto = texto +
                    '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Despesa</label></br>';
                contadorErros++;
            }
            if ((vencimento == '') || (vencimento == null) || (vencimento == undefined)) {
                texto = texto +
                    '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Vencimento</label></br>';
                contadorErros++;
            }
        } else if ((inserirestoque == 0) && (compraparcelada == 'N') && (unicadespesa == '1')) {
            // Opção de não inserção no estoque como compra não parcelada e única despesa

            var descricaoDespesaCompra = $('.descricaoDespesaSemEstoque').val();
            
            if ((descricaoDespesaCompra == '') || (descricaoDespesaCompra == null)) {
                texto = texto +
                    '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Despesa</label></br>'; contadorErros++;
            }
            if ((vencimento == '') || (vencimento == null) || (vencimento == undefined)) {
                texto = texto +
                    '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Vencimento</label></br>';
                contadorErros++;
            }
        }
        if ((compraparcelada == 'N') && ((unicadespesa == '') || (unicadespesa == ' ') || (unicadespesa == null) || (unicadespesa == undefined))){
            texto = texto +
            '<span class="badge badge-danger">Marcar</span><label class="fontenormal pl-2">Se a compra é única</label></br>'; contadorErros++;
        }
        if ((compraparcelada == 'N') && (unicadespesa == '0')){
            //Compra não parcelada com várias notas (compra múltipla)

            var data                = [];
            var tabela              = document.getElementById('tabelalistadespesamultipla');
            var descricaoTabela     = tabela.getElementsByClassName('descricaoTabela');
            var valorparcelaTabela  = tabela.getElementsByClassName('valorparcelaTabela');
            var vencimentoTabela    = tabela.getElementsByClassName('vencimentoTabela');


            if (inserirestoque == 1) {
                var descricaoTabela = tabela.getElementsByClassName('descricaoTabela');
            } else if (inserirestoque == 0) {
                var descricaoTabela = tabela.getElementsByClassName('descricaoTabelaSemEstoque');
            }

            for (var i = 0; i < descricaoTabela.length; i++) {
                data.push(descricaoTabela[i].value);
                if ((data[i] == '') || ((data[i] == null))) {
                    texto = texto +
                        '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Informe a despesa na linha ' + sum([i, 1]) + '</label></br>'; contadorErros++;
                }
            }

            for (var i = 0; i < valorparcelaTabela.length; i++) {
                data.push(valorparcelaTabela[i].value);
                if ((valorparcelaTabela[i].value == '') || (valorparcelaTabela[i].value ==
                    ' ') || (
                        valorparcelaTabela[i].value == null) || (valorparcelaTabela[i].value ==
                            undefined)) {

                    texto = texto +
                        '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Informe o valor da despesa na linha ' + sum([i, 1]) + '</label></br>'; contadorErros++;
                }
            }

            for (var i = 0; i < vencimentoTabela.length; i++) {
                data.push(vencimentoTabela[i].value);
                vencimento = vencimentoTabela[i].value;

                @if($modoSandbox->ativo == '0' || $modoSandbox->ativo == 0)
                function addHours(numOfHours, date = new Date()) {
                    date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
                    return date;
                }
                vencimentoNovo = addHours(26.999, new Date(vencimento));
    
                if (vencimentoNovo < dataAtual) {
                    texto = texto +
                    '<span class="badge badge-danger">Operação Proibida</span><label class="fontenormal pl-2">Data de Vencimento menor do que a data atual - linha: ' + sum([i, 1])  +'</label></br>';
                    alertaErros(texto, contadorErros++);
                }
                @endif

                vencimento = parseInt(vencimento.slice(0, 4));

                if ((vencimento < 2000) || (vencimento > 2099)) {
                    texto = texto +
                        '<span class="badge badge-danger">Alterar</span><label class="fontenormal pl-2">Data de Vencimento Inválida (ano ' +
                        vencimento + ') na linha ' +
                        sum([i, 1]) + '</label></br>';
                    contadorErros++;
                } else if ((vencimento > 2000) && (vencimento < 2099) && (vencimento != anoAtual)) {

                    textoData = textoData +
                        '<span class="badge badge-warning">Atenção</span><label class="fontenormal pl-2">Data de Vencimento com ano ' +
                        vencimento + ' na linha ' + sum([i, 1]) + '</label></br>';
                    contadorDatasDiferentesAnoAtual++;
                }
            }

        }

        if ((compraparcelada != 'S') && (compraparcelada != 'N')) {
            texto = texto +
                '<span class="badge badge-warning">Marcar</span><label class="fontenormal pl-2">Se é uma compra parcelada</label></br>'; contadorErros++;
        } else if ((compraparcelada == 'N')  && (unicadespesa == '1')) {
            if ((precoReal == '') || (precoReal == ' ') || (precoReal == null) || (precoReal == undefined)) {
                texto = texto +
                    '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Valor da despesa</label></br>'; contadorErros++;
            }
        } else if (compraparcelada == 'S') {
            //TODO: FAZER AJUSTE PARA PEGAR AS OBRIGATORIEDADES NAS TABELAS

            var tabela = document.getElementById("tabelalistadespesa");


            var data = [];
            var table = document.getElementById('tabelalistadespesa');
            var descricaoTabela = table.getElementsByClassName('descricaoTabela');
            var valorparcelaTabela = table.getElementsByClassName('valorparcelaTabela');
            var vencimentoTabela = table.getElementsByClassName('vencimentoTabela');


            if (inserirestoque == 1) {
                var descricaoTabela = table.getElementsByClassName('descricaoTabela');
            } else if (inserirestoque == 0) {
                var descricaoTabela = table.getElementsByClassName('descricaoTabelaSemEstoque');
            }

            for (var i = 0; i < descricaoTabela.length; i++) {
                data.push(descricaoTabela[i].value);
                if ((data[i] == '') || ((data[i] == null))) {
                    texto = texto +
                        '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Informe a despesa na linha ' +
                        sum([i, 1]) + '</label></br>';
                    contadorErros++;
                }
            }

            for (var i = 0; i < valorparcelaTabela.length; i++) {
                data.push(valorparcelaTabela[i].value);
                if ((valorparcelaTabela[i].value == '') || (valorparcelaTabela[i].value ==
                    ' ') || (
                        valorparcelaTabela[i].value == null) || (valorparcelaTabela[i].value ==
                            undefined)) {

                    texto = texto +
                        '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Informe o valor da parcela na linha ' +
                        sum([i, 1]) + '</label></br>';
                    contadorErros++;
                }
            }

            for (var i = 0; i < vencimentoTabela.length; i++) {
                data.push(vencimentoTabela[i].value);
                vencimento = vencimentoTabela[i].value;


                @if($modoSandbox->ativo == '0' || $modoSandbox->ativo == 0)
                function addHours(numOfHours, date = new Date()) {
                    date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
                    return date;
                }
                vencimentoNovo = addHours(26.999, new Date(vencimento));
    
                if (vencimentoNovo < dataAtual) {
                    texto = texto +
                    '<span class="badge badge-danger">Operação Proibida</span><label class="fontenormal pl-2">Data de Vencimento menor do que a data atual - linha: ' + sum([i, 1])  +'</label></br>';
                    alertaErros(texto, contadorErros++);
                }
                @endif

                vencimento = parseInt(vencimento.slice(0, 4));
                if ((vencimento < 2000) || (vencimento > 2099)) {
                    texto = texto +
                        '<span class="badge badge-danger">Alterar</span><label class="fontenormal pl-2">Data de Vencimento Inválida (ano ' +
                        vencimento + ') na linha ' +
                        sum([i, 1]) + '</label></br>';
                    contadorErros++;
                } else if ((vencimento > 2000) && (vencimento < 2099) && (vencimento != anoAtual)) {

                    textoData = textoData +
                        '<span class="badge badge-warning">Atenção</span><label class="fontenormal pl-2">Data de Vencimento com ano ' +
                        vencimento + ' na linha ' + sum([i, 1]) + '</label></br>';
                    contadorDatasDiferentesAnoAtual++;
                }
            }

        }
    }
    //Verifica se não é compra
    else if ((ehcompra == 0) || (ehcompra == 'N')) {

        var descricaoDespesaCompra = $('.descricaoDespesa').val();
        if(despesaCodigoDespesas == '33'){
            var idFuncionario = $('#idFuncionario').val();
            if ((idFuncionario == '') || (idFuncionario == ' ') || (idFuncionario == null) || (idFuncionario == undefined)) {
                texto = texto +
                    '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Funcionário - Pró Labore</label></br>';
                contadorErros++;
            }
        }

        var compraparcelada = document.querySelector('input[name="descricaoTabela[]"]:checked')?.value;
        if ((precoReal == '') || (precoReal == ' ') || (precoReal == null) || (precoReal == undefined)) {
            texto = texto +
                '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Valor da despesa</label></br>';
            contadorErros++;
        }

        if ((descricaoDespesaCompra == '') || (descricaoDespesaCompra == null)) {
            texto = texto +
                '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Despesa</label></br>';
            contadorErros++;
        }
        if ((vencimento == '') || (vencimento == null) || (vencimento == undefined)) {
            texto = texto +
                '<span class="badge badge-warning">Validar</span><label class="fontenormal pl-2">Vencimento</label></br>';
            contadorErros++;
        }

    }

    if (contadorDatasDiferentesAnoAtual > 0) {
        var areaInformeData = document.createElement("span");
        areaInformeData.innerHTML = textoData;
        Swal.fire({
            title: 'Data informada diferente do ano atual. Confirmar?',
            html: areaInformeData,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmo',
            cancelButtonText: 'Não, irei alterar'
        }).then((result) => {
            if (result.isConfirmed) {
                alertaErros(texto, contadorErros)
            }
        })
    } else {
        if (contadorErros > 0) {
            alertaErros(texto, contadorErros);
        }
    }

    return contadorErros;
}