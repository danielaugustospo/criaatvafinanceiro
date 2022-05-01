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
        <table class="fl-table">
            <thead>
            <tr>
                <th class="text-center">Conta</th>
                <th class="text-center">Mês/Ano</th>
                <th class="text-center">DAS Sem Fator</th>
                <th class="text-center">ISS Sem Fator</th>
                <th class="text-center">Recibo Sem Fator</th>
                <th class="text-center">DAS Com Fator</th>
                <th class="text-center">ISS Com Fator</th>
                <th class="text-center">Recibo Com Fator</th>
                <th width="100px" class="noExport">Ações</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="idconta" id="idconta">
                            <?php if(isset($selectContaSetada)): 
                            foreach ($selectContaSetada as $key => $conta) { ?>
                                <option value="<?php echo $conta->id; ?>"><?php echo $conta->apelidoConta; ?></option>
                            <?php  }   
                            else : 
                            foreach ($listaContas as $key => $contaProvider) { ?>
                                <option value="<?php echo $contaProvider->id; ?>"><?php echo $contaProvider->apelidoConta; ?></option>
                            <?php }  endif; ?>
                        </select>
                    <td><input type="month" name="mes"              id="mes"                                     required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->mes; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                    <td><input type="text" name="dasSemFatorR"      id="dasSemFatorR"     class="campo-aliquota" required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->dasSemFatorR; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                    <td><input type="text" name="issSemFatorR"      id="issSemFatorR"     class="campo-aliquota" required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->issSemFatorR; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                    <td><input type="text" name="reciboSemFatorR"   id="reciboSemFatorR"  class="campo-aliquota" required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->reciboSemFatorR; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                    <td><input type="text" name="dasComFatorR"      id="dasComFatorR"     class="campo-aliquota" required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->dasComFatorR; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                    <td><input type="text" name="issComFatorR"      id="issComFatorR"     class="campo-aliquota" required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->issComFatorR; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                    <td><input type="text" name="reciboComFatorR"   id="reciboComFatorR"  class="campo-aliquota" required value="<?php if(isset($dadosaliquotamensal)): echo $dadosaliquotamensal->reciboComFatorR; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>