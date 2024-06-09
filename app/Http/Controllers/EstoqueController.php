<?php


namespace App\Http\Controllers;

use App\BensPatrimoniais;
use App\Estoque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use stdClass;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:estoque-list|estoque-create|estoque-edit|estoque-delete', ['only' => ['index', 'show', 'analiseMaterial', 'inventarioCompras']]);
        $this->middleware('permission:estoque-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:estoque-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:estoque-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Estoque::orderBy('id', 'DESC')->paginate(5);
        return view('estoque.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inventarioCompras(Request $request)
    {

        $data = Estoque::orderBy('id', 'DESC')->paginate(5);
        return view('estoque.inventario_compras', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analiseMaterial(Request $request)
    {
        $data = Estoque::orderBy('id', 'DESC')->paginate(5);
        return view('estoque.analisematerial', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function apiestoque()
    {
        $estoque = Estoque::select('estoque.id', 'estoque.idbenspatrimoniais', 'benspatrimoniais.qtdestoqueminimo', 'benspatrimoniais.estante as setor',
        \DB::raw('(SUM(estoque.quantidade) - benspatrimoniais.qtdestoqueminimo) as analise'), 
        \DB::raw('GREATEST(0, benspatrimoniais.qtdestoqueminimo - SUM(estoque.quantidade)) as compra'), 
        \DB::raw('SUM(estoque.quantidade) as quantidade'), 'estoque.descricao', 'benspatrimoniais.nomeBensPatrimoniais')
        ->leftJoin('benspatrimoniais', 'estoque.idbenspatrimoniais', '=', 'benspatrimoniais.id')
        ->where('estoque.quantidade', '>', 0)
        ->where('ativadoestoque', 1)
        ->whereNull('estoque.deleted_at')
        ->groupBy('estoque.idbenspatrimoniais')
        ->get();

        return $estoque;
    }

    public function apianaliseMaterial()
    {
        $entradas = DB::select('SELECT 
            SUM(x.quantidade_entrada) as quantidade_entrada, x.id_estoque, 
            DATE(COALESCE(dtdevolucao, x.created_at)) AS created_at, b.nomeBensPatrimoniais
                FROM entradas x
            LEFT JOIN estoque AS e ON e.id = x.id_estoque
            LEFT JOIN benspatrimoniais AS b ON b.id = e.idbenspatrimoniais
                GROUP BY id_estoque, DATE(COALESCE(dtdevolucao, x.created_at))
                ORDER BY x.id_estoque;
            ');

        $saidas = DB::select('SELECT 
            SUM(quantidade_saida) as quantidade_saida, x.id_estoque, DATE(x.dataretirada) AS dataretirada, b.nomeBensPatrimoniais
            FROM saidas x
                
            LEFT JOIN estoque AS e ON e.id = x.id_estoque
            LEFT JOIN benspatrimoniais AS b ON b.id = e.idbenspatrimoniais
            GROUP BY id_estoque, DATE(x.dataretirada)
            ORDER BY id_estoque');
    
        // Combinação das entradas e saídas
        $merged = [];
        foreach ($entradas as $entrada) {
            $id_estoque = $entrada->id_estoque;
            $created_at = $entrada->created_at;
    
            if (!isset($merged[$id_estoque][$created_at])) {
                $obj = new stdClass();
                $obj->id_estoque = $id_estoque;
                $obj->created_at = $created_at;
                $obj->quantidade_entrada = $entrada->quantidade_entrada;
                $merged[$id_estoque][$created_at] = $obj;
                $obj->nomeBensPatrimoniais = $entrada->nomeBensPatrimoniais ;

            }
        }
    
        foreach ($saidas as $saida) {
            $id_estoque = $saida->id_estoque;
            $dataretirada = $saida->dataretirada;
    
            if (!isset($merged[$id_estoque][$dataretirada])) {
                $obj = new stdClass();
                $obj->id_estoque = $id_estoque;
                $obj->created_at = $dataretirada;
                $obj->quantidade_saida = $saida->quantidade_saida;
                $obj->nomeBensPatrimoniais = $saida->nomeBensPatrimoniais ;
                $merged[$id_estoque][$dataretirada] = $obj;
            }else{
                $obj = new stdClass();
                $merged[$id_estoque][$dataretirada]->quantidade_saida = $saida->quantidade_saida;
            }
        }
    

        // Transforma a matriz combinada em uma lista de objetos
        $result = [];
        foreach ($merged as $id_estoque => $dates) {
            foreach ($dates as $created_at => $obj) {
                // Verifica se a propriedade quantidade_entrada está definida no objeto
                if (property_exists($obj, 'quantidade_entrada') && property_exists($obj, 'quantidade_saida')) {
                    // Verifica se a quantidade de entrada ou saída é maior que zero
                    if ($obj->quantidade_entrada > 0 || $obj->quantidade_saida > 0) {
                        $result[] = $obj;
                    }
                } elseif (property_exists($obj, 'quantidade_entrada')) {
                    // Se a propriedade quantidade_saida não estiver definida, define como zero
                    $obj->quantidade_saida = 0;
                    // Verifica se a quantidade de entrada é maior que zero
                    if ($obj->quantidade_entrada > 0) {
                        $result[] = $obj;
                    }
                } elseif (property_exists($obj, 'quantidade_saida')) {
                    // Se a propriedade quantidade_entrada não estiver definida, define como zero
                    $obj->quantidade_entrada = 0;
                    // Verifica se a quantidade de saída é maior que zero
                    if ($obj->quantidade_saida > 0) {
                        $result[] = $obj;
                    }
                }
            }
        }
    
        return $result;
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estoque.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'codbarras'                     => 'required|min:3',
            'nomematerial'                  => 'required',
            'descricao'                     => 'required',
            'idbenspatrimoniais'            => 'required',
            'ativadoestoque'                => 'required',
            'excluidoestoque'               => 'required'
        ]);

        Estoque::create($request->all());
        return redirect()->route('estoque.index')
            ->with('success', 'Entrada manual no estoque lançada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estoque = Estoque::with('bensPatrimoniais')->find($id);
        $bempatrimonial = DB::select('SELECT * from benspatrimoniais where ativadobenspatrimoniais = 1 order by id = ' . $estoque->idbenspatrimoniais . ' desc');
        return view('estoque.show', compact('estoque', 'bempatrimonial'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estoque = Estoque::find($id);
        $bempatrimonial = DB::select('SELECT * from benspatrimoniais where ativadobenspatrimoniais = 1 order by id = ' . $estoque->idbenspatrimoniais . ' desc');

        return view('estoque.edit', compact('estoque', 'bempatrimonial'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            // 'codbarras'                     => 'required|min:3',
            // 'nomematerial'                  => 'required',
            // 'descricao'                     => 'required',
            'idbenspatrimoniais'            => 'required',
            'ativadoestoque'                => 'required',
            'excluidoestoque'               => 'required'

        ]);

        $estoque = Estoque::find($id);
        $estoque->nomematerial          = $request->input('nomeestoque');
        // $estoque->codbarras             = $request->input('codbarras');
        $estoque->idbenspatrimoniais    = $request->input('idbenspatrimoniais');
        $estoque->descricao             = $request->input('descricaoestoque');
        $estoque->ativadoestoque        = $request->input('ativadoestoque');
        $estoque->excluidoestoque       = $request->input('excluidoestoque');
        $estoque->save();


        return redirect()->route('estoque.index')
            ->with('success', 'Item do estoque atualizado com sucesso');
    }

    public function verificaSeExisteNoEstoque(Request $request){
        $pesquisa = $request->codbarras; // get data to check

        $temNoEstoque = Estoque::where('codbarras', $pesquisa)->get();
        $contador = $temNoEstoque->count();
        if ($contador > 0){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }
        // if($temNoEstoque){ return true; }
        // else{ return false; }
        
        // passing your where condition to check
        // return $model->where($where)->get()->count() > 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Estoque::find($id)->delete();

        return redirect()->route('estoque.index')
            ->with('success', 'Item do estoque excluído com êxito!');
    }
}
