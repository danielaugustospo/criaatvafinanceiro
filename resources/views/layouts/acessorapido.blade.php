<style>
    h5,
    .card-text,
    .card-headernew {
        color: white;
    }

    .acessarMinusculo {
        text-transform: lowercase !important;
    }
</style>
<div style=" display: none;">

    {{ $acessarA = 'A' }}
    {{ $acessar = 'cessar' }}
    <!-- {{ $acessarArea = 'Acessar área de ' }} -->
    {{ $acessarArea = ' ' }}
    {{ $titulo1 = 'Ordem de Serviços' }}
    {{ $titulo2 = 'Conta Corrente' }}
    {{ $titulo3 = 'Relatórios' }}
    {{ $titulo4 = 'Clientes' }}
    {{ $titulo5 = 'Fornecedores' }}
    {{ $titulo6 = 'Funcionários' }}
</div>
    @can('ordemdeservico-list')
        <div class="d-flex justify-content-around mt-3">

            <a href="{{ route('ordemdeservicos.index') }}">
                <div class="card text-white bg-dark mb-3"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">
                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4">{{ $titulo1 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12 ">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>
                        </div>

                        <div class="col-sm-5 pb-2">
                            <img src="img/clipboard.png" style="width: 70%;" alt="">
                        </div>
                    </div>
            </a>

        </div>
    @endcan

    @can('visualiza-contacorrente')
        <div class="card text-white bg-dark mb-3 ml-1 mr-1"
            style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">
            <!-- Button trigger modal -->
            {{-- <button type="button" data-toggle="modal" data-target="#exampleModalCenter"> --}}
            <a data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter"
                style="cursor: pointer;">
                <div class="card-headernew d-flex justify-content-center">
                    <h4 class="pt-4">{{ $titulo2 }}</h4>
                </div>
                <div class="card-body mt-1"></div>
                <div class="row col-sm-12">
                    <div class="col-sm-7 row">
                        <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                    </div>
                    <div class="col-sm-5">
                        <img src="img/credit-card.png" style="width: 70%;" alt="">
                    </div>
                </div>
                {{-- </button> --}}
            </a>
        </div>
    @endcan
    @can('visualiza-relatoriogeral')
        <div class="card text-white bg-dark mb-3"
            style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

            <a href="relatorio">

                <div class="card-headernew d-flex justify-content-center">
                    <h4 class="pt-4">{{ $titulo3 }}</h4>
                </div>
                <div class="card-body mt-1"></div>
                <div class="row col-sm-12">
                    <div class="col-sm-7 row">
                        <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                    </div>
                    <div class="col-sm-5">
                        <img src="img/report.png" style="width: 70%;" alt="">
                    </div>
                </div>
            </a>
        </div>
    
    @endcan
</div>


@can('cliente-list')
    <div class="d-flex justify-content-around mt-3">

        <a href="{{ route('clientes.index') }}">

            <div class="card text-white bg-dark mb-3"
                style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">
                <div class="card-headernew d-flex justify-content-center">
                    <h4 class="pt-4">{{ $titulo4 }}</h4>
                </div>
                <div class="card-body mt-1"></div>

                <div class="row col-sm-12">
                    <div class="col-sm-7 row">
                        <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                    </div>
                    <div class="col-sm-5">
                        <img src="img/crm.png" style="width: 70%;" alt="">
                    </div>
                </div>
        </a>
    </div>
@endcan
@can('fornecedor-list')
    <div class="card text-white bg-dark mb-3 ml-1 mr-1"
        style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

        <a href="{{ route('fornecedores.index') }}">

            <div class="card-headernew d-flex justify-content-center">
                <h4 class="pt-4">{{ $titulo5 }}</h5>
            </div>
            <div class="card-body mt-1"></div>

            <div class="row col-sm-12">
                <div class="col-sm-7 row">
                    <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                </div>
                <div class="col-sm-5">
                    <img src="img/help.png" style="width: 70%;" alt="">
                </div>
            </div>
        </a>
    </div>
@endcan
@can('funcionario-list')
    <div class="card text-white bg-dark mb-3"
        style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

        <a href="{{ route('funcionarios.index') }}">

            <div class="card-headernew d-flex justify-content-center">
                <h4 class="pt-4">{{ $titulo6 }}</h4>
            </div>
            <div class="card-body mt-1"></div>

            <div class="row col-sm-12">
                <div class="col-sm-7 row">
                    <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                </div>
                <div class="col-sm-5">
                    <img src="img/working-man.png" style="width: 70%;" alt="">
                </div>
            </div>
        </a>
    </div>
@endcan


</div>
