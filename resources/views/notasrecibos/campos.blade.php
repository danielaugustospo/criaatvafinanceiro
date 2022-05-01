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
            <th class="text-center">Data Emissão</th>
            <th class="text-center">Nota/Recibo</th>
            <th class="text-center">OS</th>
            <th class="text-center">Valor Nota/Recibo</th>
            <th class="text-center">Alíquota</th>
            <th class="text-center">Tipo Alíquota</th>
            <th class="text-center">Valor Imposto</th>
            <th class="text-center">Data Recebimento</th>
            <th width="100px" class="noExport">Ações</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                {{-- $r = (1 == $v) ? 'Yes' : 'No';  --}}
                <td><input type="date" name="dtemissao"     id="dtemissao"      class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->dtemissao; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td><input type="text" name="nfrecibo"      id="nfrecibo"       class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->nfrecibo; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td><input type="text" name="idOS"          id="idOS"           class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->idOS; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td><input type="text" name="valorNfRecibo" id="valorNfRecibo"  class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->valorNfRecibo; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td><input type="text" name="idaliquota"    id="idaliquota"     class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->idaliquota; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td><input type="text" name="tipoaliquota"  id="tipoaliquota"   class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->tipoaliquota; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td><input type="text" name="valorimposto"  id="valorimposto"   class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->valorimposto; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td><input type="date" name="dtRecebimento" id="dtRecebimento"  class="campo-aliquota" value="<?php if(isset($dadosNota)): echo $dadosNota->dtRecebimento; else: echo ''; endif ?>" <?php echo $readonlyOuNao; ?>></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>