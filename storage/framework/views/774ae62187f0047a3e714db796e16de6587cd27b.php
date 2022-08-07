


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <div class="jumbotron sombreamento">
                <h5 for="descricaoDespesa" style="color: red;"><b>É Compra?</b></h5>
                <?php if(Request::path() == 'despesas/create'): ?>
                    <label for="comprou" class="mr-2"><input type="radio" value="S" name="a"
                            id="comprou" />
                        SIM</label> <br />
                    <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" />
                        NÃO</label>
                <?php endif; ?>
                <?php if(isset($despesa)): ?>
                    <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou"
                            <?php echo e($variavelDisabledNaView); ?> <?php if($despesa->ehcompra == 1): ?> checked <?php endif; ?> /> SIM</label>
                    <br />
                    <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou"
                            <?php echo e($variavelDisabledNaView); ?> <?php if($despesa->ehcompra == 0): ?> checked <?php endif; ?> /> NÃO</label>
                <?php endif; ?>
            </div>

        </div>
        
        <div class="col-md-3">
            <div class="jumbotron sombreamento" id="telaCompraParcelada">

                <h5 for="descricaoDespesa" style="color: red;"><b>Compra Parcelada?</b></h5>
                <label for="parcelada" class="mr-2 ml-2"><input type="radio" value="S"
                        name="compraparcelada" <?php if(isset($despesa)): ?> disabled <?php endif; ?> id="parcelada" />
                    SIM</label> <br />
                <label for="naoparcelada" class="ml-2"><input type="radio" value="N"
                        name="compraparcelada" <?php if(isset($despesa)): ?> disabled checked <?php endif; ?>
                        id="naoparcelada" /> NÃO</label>

            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron sombreamento" id="telaInsereEstoque">

                <h5 style="color: red;"><b>Lançar no estoque?</b></h5>
                    <?php if(Request::path() == 'despesas/create'): ?>
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="inserirestoque"
                            id="inserirestoque" /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="inserirestoque"
                                id="naoinserirestoque" /> NÃO</label>
                    <?php endif; ?>
                    <?php if(isset($despesa)): ?>
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="inserirestoque" id="inserirestoque"
                            disabled <?php if($despesa->insereestoque == 1 || $despesa->insereestoque == null): ?> checked <?php endif; ?> /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="inserirestoque" id="naoinserirestoque"
                                disabled <?php if($despesa->insereestoque == 0): ?> checked <?php endif; ?> /> NÃO</label>
                    <?php endif; ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron sombreamento"  id="telaUnicaDespesa">

                <h5 style="color: red;"><b>Única Despesa?</b></h5>
                    <?php if(Request::path() == 'despesas/create'): ?>
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="unicadespesa"
                            id="unicadespesa" /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="unicadespesa"
                                id="naounicadespesa" /> NÃO</label>
                    <?php endif; ?>
                    <?php if(isset($despesa)): ?>
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="unicadespesa" id="unicadespesa"
                            disabled  checked /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="unicadespesa" id="naounicadespesa"
                                disabled  /> NÃO</label>
                    <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/despesas/formulario/perguntaslancamento.blade.php ENDPATH**/ ?>