<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class GrupoDespesa extends Model
{

    protected $table = 'grupodespesas';

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'grupoDespesa',
    'ativoDespesa',
    'excluidoDespesa',

    ];


    public static function laratablesCustomAction($grupoDespesaModel)
    {
        return view('grupodespesas.action', compact('grupoDespesaModel'))->render();
    }
}
