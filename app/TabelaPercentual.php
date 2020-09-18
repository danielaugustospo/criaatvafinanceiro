<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class TabelaPercentual extends Model
{

    protected $table = 'tabelapercentual';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'nometabelapercentual',
    'percentualtabelapercentual',
    'pgtabelapercentual',
    'idostabelapercentual',

    ];

    public static function laratablesCustomAction($tabelapercentual)
    {
        return view('tabelapercentual.action', compact('tabelapercentual'))->render();
    }



}
