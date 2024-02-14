<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\StatusEnumPedidoCompra;
use MongoDB\Client as MongoClient;
use MongoDB\Driver\Query;
use MongoDB\Collection;

class PedidoCompra extends Model
{
    protected $table = 'pedidocompra';

    use Notifiable;
    use HasRoles;

    protected $casts = [
        'created_at'            => 'datetime:Y-m-d',
        'ped_dt_aprovacao'      => 'datetime:Y-m-d h:i:s',
        'ped_dt_finalizacao'    => 'datetime:Y-m-d h:i:s'
     ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id',
        'ped_os',
        'ped_data',
        'ped_nomecomprador',
        'ped_usrsolicitante',
        'ped_fornecedor',
        'ped_descprod',
        'ped_valortotal',
        'ped_cartaodecredito',
        'ped_formapag',
        'ped_pix',
        'ped_favorecido',
        'ped_boleto',
        'ped_banco',
        'ped_conta',
        'ped_agenciaconta',
        'ped_tipoconta',
        'ped_numcartao',
        'ped_vzscartao',
        'ped_precounit',
        'ped_qtd',
        'ped_observacao',
        'ped_notafiscal',
        'ped_aprovado',
        'ped_contaaprovada',
        'ped_exigaprov',
        'ped_excluidopedido',
        'ped_novanotificacao',
        'ped_periodofaturado',
        'ped_reembolsado',
        'ped_cpfcnpj',
        'observacoes_solicitante',
        'ped_pago',
        'ped_observacao_revisao',
        'ped_usr_aprovador',
        'ped_dt_aprovacao',
        'ped_usr_finalizador',
        'ped_dt_finalizacao',
        'nf_exigencia',
        'info_financeira'
    ];

    public function solicitante()
    {
        return $this->belongsTo(User::class, 'ped_usrsolicitante', 'id');
    }

    public function aprovador()
    {
        return $this->belongsTo(User::class, 'ped_usr_aprovador', 'id');
    }

    public function finalizador()
    {
        return $this->belongsTo(User::class, 'ped_usr_finalizador', 'id');
    }

    public function listaPedidos($id, $aprovado, $notificado)
    {
        $stringQuery = "SELECT p.id, ped_os, ped_data, ped_descprod,
        f.razaosocialFornecedor, u.name as solicitante, c.nomeConta as conta,
        ped_contaaprovada, ped_nomecomprador, ap.name as 'nomeaprovador', fin.name as 'nomefinalizador',
        comprador.razaosocialFornecedor AS nomecomp,
        CASE 
        WHEN ped_pago = 0 THEN 'A Lançar'
        WHEN ped_pago = 1 THEN 'Lançado'
        ELSE 'A Lançar' END as pago, 
    
        CASE 
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_NAO_APROVADO . " THEN 'Não'
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_APROVADO . " THEN 'Aprovado'
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_AGUARDANDO_APROVACAO . " THEN 'Aguard. Avaliação'
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_REVISADO . " THEN 'Aprovado e Finalizado'
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_CANCELADO . " THEN 'Cancelado'

        ELSE 'Indefinido' END as status 
            
        FROM pedidocompra p
        LEFT JOIN fornecedores f ON p.ped_fornecedor = f.id 
        LEFT JOIN users u ON  p.ped_usrsolicitante = u.id
        LEFT JOIN conta c ON p.ped_contaaprovada = c.id
        LEFT JOIN fornecedores comprador ON p.ped_nomecomprador = comprador.id
        LEFT JOIN users ap ON p.ped_usr_aprovador  = ap.id
        LEFT JOIN users fin ON p.ped_usr_finalizador  = fin.id   


        WHERE ped_excluidopedido = 0 ";


        if ($id) {
            $stringQuery .= " AND u.id = " . $id;
        }

        
        if ((!is_null($aprovado)) &&  (($aprovado ==  StatusEnumPedidoCompra::PEDIDO_NAO_APROVADO ) || ($aprovado ==  StatusEnumPedidoCompra::PEDIDO_APROVADO ) || ($aprovado == StatusEnumPedidoCompra::PEDIDO_AGUARDANDO_APROVACAO ) || ($aprovado == StatusEnumPedidoCompra::PEDIDO_REVISADO ))) {
            // if($aprovado == '1'){
                //     $stringQuery .= " AND (ped_aprovado = 4 or ped_aprovado = " . $aprovado . ") ";
                // }else{
                    $stringQuery .= " AND ped_aprovado = " . $aprovado;
            // }
        }
        if ((!is_null($notificado)) && (($notificado ==  StatusEnumPedidoCompra::PEDIDO_NAO_APROVADO ) || ($notificado ==  StatusEnumPedidoCompra::PEDIDO_APROVADO ))) {
            $stringQuery .= " AND ped_novanotificacao = " . $notificado . " order by p.id desc ";
        }
        
        return $stringQuery;
        
    }

    public function atualizaPedidos($pedido)
    {
        $stringQuery = "UPDATE pedidocompra
        SET 
        ped_os                          = '$pedido->ped_os',  
        ped_data                        = '$pedido->ped_data', 
        ped_nomecomprador               = '$pedido->ped_nomecomprador', 
        ped_usrsolicitante              = '$pedido->ped_usrsolicitante', 
        ped_fornecedor                  = '$pedido->ped_fornecedor', 
        ped_descprod                    = '$pedido->ped_descprod', 
        ped_valortotal                  = '$pedido->ped_valortotal', 
        ped_reembolsado                 = '$pedido->ped_reembolsado', 
        ped_formapag                    = '$pedido->ped_formapag', 
        ped_pix                         = '$pedido->ped_pix', 
        ped_favorecido                  = '$pedido->ped_favorecido', 
        ped_boleto                      = '$pedido->ped_boleto', 
        ped_banco                       = '$pedido->ped_banco', 
        ped_conta                       = '$pedido->ped_conta', 
        ped_agenciaconta                = '$pedido->ped_agenciaconta', 
        ped_numcartao                   = '$pedido->ped_numcartao', 
        ped_vzscartao                   = '$pedido->ped_vzscartao', 
        ped_periodofaturado             = '$pedido->ped_periodofaturado', 
        ped_precounit                   = '$pedido->ped_precounit', 
        ped_qtd                         = '$pedido->ped_qtd', 
        ped_observacao                  = '$pedido->ped_observacao', 
        ped_notafiscal                  = '$pedido->ped_notafiscal', 
        ped_aprovado                    = '$pedido->ped_aprovado', 
        ped_contaaprovada               = '$pedido->ped_contaaprovada', 
        ped_exigaprov                   = '$pedido->ped_exigaprov', 
        ped_excluidopedido              = '$pedido->ped_excluidopedido', 
        ped_novanotificacao             = '$pedido->ped_novanotificacao', 
        observacoes_solicitante         = '$pedido->observacoes_solicitante', 
        updated_at                      = '$pedido->data',
        nf_exigencia                    = '$pedido->nf_exigencia',
        info_financeira                 = '$pedido->info_financeira'
        WHERE id                        = '$pedido->id'";

        return $stringQuery;
    }

    public function documentosAnexados()
    {
        return $this->hasMany(DocumentoAnexado::class, 'id_entidade', 'id');
    }


    public static function getAuditLogs($id): array
    {
        $mongoClient = new MongoClient("mongodb://" . env('MONGODB_USERNAME') . ":" . env('MONGODB_PASSWORD') . "@" . env('MONGODB_HOST') . ":" . env('MONGODB_PORT'));
        
        $db = $mongoClient->selectDatabase(env('MONGODB_DATABASE'));
        $collection = $db->selectCollection('audit_logs');
        
        $filter = ['id' => $id];
        $options = [
            'sort' => ['created_at' => -1]
        ];
        
        $cursor = $collection->find($filter, $options);
        
        $auditLogs = [];
        foreach ($cursor as $document) {
            $auditLogs[] = $document;
        }
        
        return $auditLogs;
    }
    

}
