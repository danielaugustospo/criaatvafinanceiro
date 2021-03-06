<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Conta extends Model
{

    protected $table = 'conta';

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'apelidoConta',
    'nomeConta',
    'ativoConta',
    'excluidoConta',

    ];


    public static function laratablesCustomAction($contasModel)
    {
        return view('contas.action', compact('contasModel'))->render();
    }

}
