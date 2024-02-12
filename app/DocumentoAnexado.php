<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoAnexado extends Model
{
    use HasFactory;

    protected $table = 'documentos_anexados';

    protected $fillable = [
        'documento_anexado',
        'enum_entidade',
        'id_entidade',
    ];

    // Relacionamento com o modelo PedidoCompra
    public function pedidoCompra()
    {
        return $this->belongsTo(PedidoCompra::class, 'id_entidade');
    }

}
