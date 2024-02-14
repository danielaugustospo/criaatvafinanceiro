<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AuditLog extends Eloquent
{
    protected $fillable = [
        'id',
        'user_id',
        'action',
        'model',
        'before',
        'after',
        'dirty'
    ];
    protected $connection = 'mongodb';
    // outros atributos e métodos...
}
