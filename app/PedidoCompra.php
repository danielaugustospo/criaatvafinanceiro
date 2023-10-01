<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\StatusEnumPedidoCompra;

class PedidoCompra extends Model
{
    protected $table = 'pedidocompra';

    use Notifiable;
    use HasRoles;


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
    ];


    public function listaPedidos($id, $aprovado, $notificado)
    {
        $stringQuery = "SELECT p.id, ped_os, ped_data, ped_descprod, 
        f.razaosocialFornecedor, u.name as solicitante, 
        ped_contaaprovada, ped_nomecomprador,
        comprador.nomecomp,
        CASE 
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_NAO_APROVADO . " THEN 'Não'
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_APROVADO . " THEN 'Sim'
        WHEN ped_aprovado = " . StatusEnumPedidoCompra::PEDIDO_AGUARDANDO_APROVACAO . " THEN 'Aguard. Avaliação'
        ELSE 'Indefinido' END as status 
        
        FROM pedidocompra p, fornecedores f, users u,
        (select id as idcomp, razaosocialFornecedor nomecomp from fornecedores forn) as comprador
               
        WHERE f.id = ped_fornecedor and u.id = ped_usrsolicitante and comprador.idcomp = ped_nomecomprador";


        if ($id) {
            $stringQuery .= " AND u.id = " . $id;
        }

        if ((!is_null($aprovado)) &&  (($aprovado ==  StatusEnumPedidoCompra::PEDIDO_NAO_APROVADO ) || ($aprovado ==  StatusEnumPedidoCompra::PEDIDO_APROVADO ) || ($aprovado == StatusEnumPedidoCompra::PEDIDO_AGUARDANDO_APROVACAO ))) {
            $stringQuery .= " AND ped_aprovado = " . $aprovado;
        }
        if ((!is_null($notificado)) && (($notificado ==  StatusEnumPedidoCompra::PEDIDO_NAO_APROVADO ) || ($notificado ==  StatusEnumPedidoCompra::PEDIDO_APROVADO ))) {
            $stringQuery .= " AND ped_novanotificacao = " . $notificado;
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
        updated_at                      = '$pedido->data'
        WHERE id                        = '$pedido->id'";

        return $stringQuery;
    }
}
