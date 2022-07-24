{{-- <div class="form-group row" style="box-shadow: 25px 2px 25px 1px; padding-top: 20px; padding-bottom: 20px;">
    <h5 for="descricaoDespesa" style="color: red;" class="col-sm-1 "><b>É Compra?</b></h5>

    <div class="col-sm-1 mt-2">
        @if (Request::path() == 'despesas/create')
            <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou" />
                SIM</label> <br />
            <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" /> NÃO</label>
        @endif
        @isset($despesa)
            <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou"
                    {{ $variavelDisabledNaView }} @if ($despesa->ehcompra == 1) checked @endif /> SIM</label> <br />
            <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou"
                    {{ $variavelDisabledNaView }} @if ($despesa->ehcompra == 0) checked @endif /> NÃO</label>
        @endisset
    </div>

    <div class="form-group row" id="telaCompraParcelada">
        <h5 for="descricaoDespesa" style="color: red;" class="col-sm-3 mr-5"><b>Compra Parcelada?</b></h5>
        <div class="col-sm-2 mt-2">
            <label for="parcelada" class="mr-2 ml-2"><input type="radio" value="S" name="compraparcelada"
                    @if (isset($despesa)) disabled @endif id="parcelada" /> SIM</label> <br />
            <label for="naoparcelada" class="ml-2"><input type="radio" value="N" name="compraparcelada"
                    @if (isset($despesa)) disabled checked @endif id="naoparcelada" /> NÃO</label>
        </div>
    </div>

    <div class="form-group row" id="telaInsereEstoque">
        <h5 style="color: red;" class="col-sm-4 mr-5"><b>Inserir compra no estoque?</b></h5>
        <div class="col-sm-2 mt-2">
            @if (Request::path() == 'despesas/create')
                <label class="ml-2"> <input type="radio" value="0" name="inserirestoque"
                        id="naoinserirestoque" /> NÃO</label>
                <label class="mr-2 ml-2"> <input type="radio" value="1" name="inserirestoque"
                        id="inserirestoque" /> SIM</label> <br />
            @endif
            @isset($despesa)
                <label class="ml-2"> <input type="radio" value="0" name="inserirestoque" id="naoinserirestoque"
                        disabled @if ($despesa->insereestoque == 0) checked @endif /> NÃO</label>
                <label class="mr-2 ml-2"> <input type="radio" value="1" name="inserirestoque" id="inserirestoque"
                        disabled @if ($despesa->insereestoque == 1 || $despesa->insereestoque == null) checked @endif /> SIM</label> <br />
            @endisset
        </div>
    </div>
</div> --}}


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <div class="jumbotron sombreamento">
                <h5 for="descricaoDespesa" style="color: red;"><b>É Compra?</b></h5>
                @if (Request::path() == 'despesas/create')
                    <label for="comprou" class="mr-2"><input type="radio" value="S" name="a"
                            id="comprou" />
                        SIM</label> <br />
                    <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou" />
                        NÃO</label>
                @endif
                @isset($despesa)
                    <label for="comprou" class="mr-2"><input type="radio" value="S" name="a" id="comprou"
                            {{ $variavelDisabledNaView }} @if ($despesa->ehcompra == 1) checked @endif /> SIM</label>
                    <br />
                    <label for="naocomprou"><input type="radio" value="N" name="a" id="naocomprou"
                            {{ $variavelDisabledNaView }} @if ($despesa->ehcompra == 0) checked @endif /> NÃO</label>
                @endisset
            </div>

        </div>
        {{-- Compra Parcelada --}}
        <div class="col-md-3">
            <div class="jumbotron sombreamento" id="telaCompraParcelada">

                <h5 for="descricaoDespesa" style="color: red;"><b>Compra Parcelada?</b></h5>
                <label for="parcelada" class="mr-2 ml-2"><input type="radio" value="S"
                        name="compraparcelada" @if (isset($despesa)) disabled @endif id="parcelada" />
                    SIM</label> <br />
                <label for="naoparcelada" class="ml-2"><input type="radio" value="N"
                        name="compraparcelada" @if (isset($despesa)) disabled checked @endif
                        id="naoparcelada" /> NÃO</label>

            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron sombreamento" id="telaInsereEstoque">

                <h5 style="color: red;"><b>Lançar no estoque?</b></h5>
                    @if (Request::path() == 'despesas/create')
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="inserirestoque"
                            id="inserirestoque" /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="inserirestoque"
                                id="naoinserirestoque" /> NÃO</label>
                    @endif
                    @isset($despesa)
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="inserirestoque" id="inserirestoque"
                            disabled @if ($despesa->insereestoque == 1 || $despesa->insereestoque == null) checked @endif /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="inserirestoque" id="naoinserirestoque"
                                disabled @if ($despesa->insereestoque == 0) checked @endif /> NÃO</label>
                    @endisset
            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron sombreamento"  id="telaUnicaDespesa">

                <h5 style="color: red;"><b>Única Despesa?</b></h5>
                    @if (Request::path() == 'despesas/create')
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="unicadespesa"
                            id="unicadespesa" /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="unicadespesa"
                                id="naounicadespesa" /> NÃO</label>
                    @endif
                    @isset($despesa)
                    <label class="mr-2 ml-2"> <input type="radio" value="1" name="unicadespesa" id="unicadespesa"
                            disabled  checked /> SIM</label> <br />
                        <label class="ml-2"> <input type="radio" value="0" name="unicadespesa" id="naounicadespesa"
                                disabled  /> NÃO</label>
                    @endisset
            </div>

        </div>
    </div>
</div>
