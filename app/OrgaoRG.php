<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Orgaorg extends Model
{

    protected $table = 'orgaorg';
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'nome',
    'estadoOrgaoRG',
    'ativoOrgaoRG',
    'excluidoOrgaoRG'
    ];

    public static function laratablesCustomAction($orgaosrgModel)
    {
        return view('orgaosrg.action', compact('orgaosrgModel'))->render();
    }


}
