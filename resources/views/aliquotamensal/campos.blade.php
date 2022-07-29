<style>

    *{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    /* body{
        font-family: Helvetica;
        -webkit-font-smoothing: antialiased;
        background: rgba( 71, 147, 227, 1);
    } */
    
    
    /* Table Styles */
    
    .table-wrapper{
        margin: 10px 70px 70px;
        box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    }
    
    .fl-table {
        border-radius: 5px;
        font-size: 12px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
        background-color: white;
    }
    
    .fl-table td, .fl-table th {
        text-align: center;
        padding: 8px;
    }
    
    .fl-table td {
        border-right: 1px solid #f8f8f8;
        font-size: 12px;
    }
    
    .fl-table thead th {
        color: #ffffff;
        background: #054b67;
    }
    
    
    .fl-table thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }
    
    .fl-table tr:nth-child(even) {
        background: #F8F8F8;
    }
    
    /* Responsive */
    
    
    @media screen and (min-width: 600px) {
            table {
                display: block !important;
                overflow-x: auto !important;
                white-space: nowrap !important;
            }
        }
    </style>
    
    <div class="table-wrapper">

    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">Conta</h5>
        <select class="col-sm-3 form-control" name="idconta" id="idconta">
            <?php if(isset($selectContaSetada)): 
            foreach ($selectContaSetada as $key => $conta) { ?>
                <option value="<?php echo $conta->id; ?>"><?php echo $conta->apelidoConta; ?></option>
            <?php  }   
            else : 
            foreach ($listaContas as $key => $contaProvider) { ?>
                <option value="<?php echo $contaProvider->id; ?>"><?php echo $contaProvider->apelidoConta; ?></option>
            <?php }  endif; ?>
        </select>
    </div>
    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">Mês/Ano</h5>
        <input type="month" class="form-control col-sm-3 campo-aliquota" name="mes" id="mes" required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->mes; else: echo ''; endif ?>" {{$readonlyOuNao}}>
    </div>
    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">DAS Sem Fator</h5>
        <input type="text" class="form-control col-sm-3 campo-aliquota" name="dasSemFatorR" id="dasSemFatorR" required value="@if(isset($dadosaliquotamensal)){{ $dadosaliquotamensal->dasSemFatorR }} @else {{!! '0,0000' !!}} @endif" {{ $readonlyOuNao }}>
    </div>
    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">ISS Sem Fator</h5>
        <input type="text" class="form-control col-sm-3 campo-aliquota" name="issSemFatorR" id="issSemFatorR" required value="@if(isset($dadosaliquotamensal)){{ $dadosaliquotamensal->issSemFatorR }} @else {{!! '0,0000' !!}} @endif" {{ $readonlyOuNao }}>
    </div>
    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">Recibo Sem Fator</h5>
        <input type="text" class="form-control col-sm-3 campo-aliquota" name="reciboSemFatorR" id="reciboSemFatorR" required value="@if(isset($dadosaliquotamensal)){{ $dadosaliquotamensal->reciboSemFatorR }} @else {{!! '0,0000' !!}} @endif" {{ $readonlyOuNao }}>
    </div>
    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">DAS Com Fator</h5>
        <input type="text" class="form-control col-sm-3 campo-aliquota" name="dasComFatorR" id="dasComFatorR" required value="@if(isset($dadosaliquotamensal)){{ $dadosaliquotamensal->dasComFatorR }} @else {{!! '0,0000' !!}} @endif" {{ $readonlyOuNao }}>
    </div>
    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">ISS Com Fator</h5>
        <input type="text" class="form-control col-sm-3 campo-aliquota" name="issComFatorR" id="issComFatorR" required value="@if(isset($dadosaliquotamensal)){{ $dadosaliquotamensal->issComFatorR }} @else {{!! '0,0000' !!}} @endif" {{ $readonlyOuNao }}>
    </div>
    <div class="row d-flex justify-content-center">
        <h5 class="col-sm-3" for="">Recibo Com Fator</h5>
        <input type="text" class="form-control col-sm-3 campo-aliquota" name="reciboComFatorR" id="reciboComFatorR" required value="@if(isset($dadosaliquotamensal)){{ $dadosaliquotamensal->reciboComFatorR }} @else {{!! '0,0000' !!}} @endif" {{ $readonlyOuNao }}>
    </div>
    </div>
 