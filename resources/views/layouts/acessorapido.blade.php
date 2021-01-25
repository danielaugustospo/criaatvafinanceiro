<style>
    h5, .card-text, .card-headernew {
        color:white;
    }
 </style>   
<div style=" display: none;">
    {{$acessar = "Acessar"}}
    {{$acessarArea = "Acessar área de "}}
    {{$titulo1 = "Ordem de Serviços"}}
    {{$titulo2 = "Contas"}}
    {{$titulo3 = "Relatórios"}}
    {{$titulo4 = "Clientes"}}
    {{$titulo5 = "Fornecedores"}}
    {{$titulo6 = "Funcionários"}}
</div>
<div class="d-flex justify-content-around mt-3">
    @can('ordemdeservico-list')  

    <a href="{{ route('ordemdeservicos.index') }}">
    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-headernew d-flex justify-content-center">{{$titulo1}}</div>
        <div class="card-body">
            <p class="card-text">{{ $acessarArea }} {{$titulo1}}</p>
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-6">
                <h5 class="card-title">{{$acessar}}</h5>

            </div>
            <div class="col-sm-6">
                <img src="img/clipboard.png" style="width: 70%;" alt="">
            </div>
        </div>
    </a>
    @endcan

    </div>
    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        @can('conta-list')  

        <a href="{{ route('contas.index') }}">

        <div class="card-headernew d-flex justify-content-center">{{$titulo2}}</div>
        <div class="card-body">
            <p class="card-text">{{ $acessarArea }}  {{$titulo2}}</p>
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-6">
                <h5 class="card-title">{{$acessar}}</h5>

            </div>
            <div class="col-sm-6">
                <img src="img/credit-card.png" style="width: 70%;" alt="">
            </div>
        </div>
    </a>
@endcan
    </div>
    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        @can('conta-list')  

        <a href="#" onclick="alert('Funcionalidade em desenvolvimento!');">

        <div class="card-headernew d-flex justify-content-center">{{$titulo3}}</div>
        <div class="card-body">
            <p class="card-text">{{ $acessarArea }} {{$titulo3}}</p>
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-6">
                <h5 class="card-title">{{$acessar}}</h5>

            </div>
            <div class="col-sm-6">
                <img src="img/report.png" style="width: 70%;" alt="">
            </div>
        </div>
    </a>
    @endcan
    </div>


</div>


<div class="d-flex justify-content-around mt-3">
    @can('cliente-list')  

    <a href="{{ route('clientes.index') }}">

    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-headernew d-flex justify-content-center">{{$titulo4}}</div>
        <div class="card-body">
            <p class="card-text">{{ $acessarArea }}  {{$titulo4}}</p>
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-6">
                <h5 class="card-title">{{$acessar}}</h5>

            </div>
            <div class="col-sm-6">
                <img src="img/crm.png" style="width: 70%;" alt="">
            </div>
        </div>
    </a>
    @endcan
    </div>
    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        @can('fornecedor-list')  

        <a href="{{ route('fornecedores.index') }}">

        <div class="card-headernew d-flex justify-content-center">{{$titulo5}}</div>
        <div class="card-body">
            <p class="card-text">{{ $acessarArea }}  {{$titulo5}}</p>
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-6">
                <h5 class="card-title">{{$acessar}}</h5>

            </div>
            <div class="col-sm-6">
                <img src="img/help.png" style="width: 70%;" alt="">
            </div>
        </div>
    </a>
    @endcan
    </div>
    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        @can('funcionario-list')  

        <a href="{{ route('funcionarios.index') }}">

        <div class="card-headernew d-flex justify-content-center">{{$titulo6}}</div>
        <div class="card-body">
            <p class="card-text">{{ $acessarArea }}  {{$titulo6}}</p>
        </div>
        <div class="row col-sm-12">
            <div class="col-sm-6">
                <h5 class="card-title">{{$acessar}}</h5>

            </div>
            <div class="col-sm-6">
                <img src="img/working-man.png" style="width: 70%;" alt="">
            </div>
        </div>
    </a>
    @endcan
    </div>


</div>