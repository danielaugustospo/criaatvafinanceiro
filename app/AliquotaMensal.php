<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AliquotaMensal extends Model
{

    protected $table = 'aliquotamensal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idconta',
        'mes',
        'dasSemFatorR',
        'issSemFatorR',
        'reciboSemFatorR',
        'dasComFatorR',
        'issComFatorR',
        'reciboComFatorR',
        ];
}
