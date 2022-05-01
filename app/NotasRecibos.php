<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class NotasRecibos extends Model
{

    protected $table = 'view_notasrecibos';
    public $timestamps = false;

    
    const CREATED_AT = null;
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'Emissao',
        'nfRecibo',
        'OS',
        'Valor',
        'imposto',
        'aliquota',
        
    ];

    
    public static function consultaNotasRecibos()
    {
        $data = DB::select('select * from notasrecibos');
        return array($data);
    }
}
