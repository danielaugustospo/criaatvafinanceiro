<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Banco extends Model
{

    protected $table = 'banco';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'nomeBanco',
    'codigoBanco',
    'ativoBanco',
    'excluidoBanco',

    ];

    public static function laratablesCustomAction($bancos)
    {
        return view('bancos.action', compact('bancos'))->render();
    }

}
