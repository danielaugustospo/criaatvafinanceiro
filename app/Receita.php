<?php

namespace App;

use App\Http\Controllers\OrdemdeServicoController;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use App\OrdemdeServico;



class Receita extends Model
{

    protected $table = 'receita';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'idformapagamentoreceita',
        'datapagamentoreceita',
        'dataemissaoreceita',
        'valorreceita',
        'pagoreceita',
        'contareceita',
        'registroreceita',
        'emissaoreceita',
        'nfreceita',
        'idosreceita',

    ];




// return $query->select(DB::raw('count(b.customer_id) as total_trans'))
//             ->leftJoin('trans as b', 'b.customer_id', 'customer.id')
//             ->groupBy('customer.id');

// public static function validaAsParadas() {
//     $id = 57;
//     return $id;
// }

    // public static function laratablesQueryConditions($query)
    // {

    //     return $query->where('idosreceita', '57');
    // }

    public function listaReceitas($id){
        $ordemdeservico = OrdemdeServico::find($id);

        $query = DB::select('select distinct * from receita  where  idosreceita = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        return $query;
    }

    public static function condicoesCustomizadas($query,$id)
    {
        $ordemdeservico = OrdemdeServico::find($id);

        $query = DB::select('select distinct * from receita  where  idosreceita = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        return $query;

        // return $query->where('idosreceita', '57');
    }

    public static function laratablesCustomAction($receitaModel)
    {

        return view('receita.action', compact('receitaModel'))->render();
    }

}
