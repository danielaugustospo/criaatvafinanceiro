<?php
namespace App\Enums;

class StatusEnumPedidoCompra
{
    const PEDIDO_NAO_APROVADO           = 0;
    const PEDIDO_APROVADO               = 1;
    const PEDIDO_AGUARDANDO_APROVACAO   = 3;
    const PEDIDO_REVISADO               = 4;
}
