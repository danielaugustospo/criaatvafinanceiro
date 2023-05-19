<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Providers\AppServiceProvider;
use App\Providers\FormatacoesServiceProvider;
use Illuminate\Support\Facades\App;
use App\Classes\Logger;
use App\PedidoCompra;
use Auth;
use Illuminate\Support\Facades\Redirect;


class PedidoCompraController extends Controller
{
    private $Enc;
    private $Logger;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:pedidocompra-list|pedidocompra-create|pedidocompra-edit|pedidocompra-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:pedidocompra-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pedidocompra-edit', ['only' => ['edit', 'update', 'updateAprovacao']]);
        $this->middleware('permission:pedidocompra-delete', ['only' => ['destroy']]);
        $this->middleware('permission:pedidocompra-analise', ['only' => ['analise']]);

        //Importação do Logger
        $this->Logger = new Logger();

        $this->acao =  request()->segment(count(request()->segments()));
        $this->valorInput = null;
        $this->valorSemCadastro = null;


        if ($this->acao == 'create') {
            $this->valorInput = " ";
            $this->valorSemCadastro = "0";
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
        } elseif ($this->acao == 'edit') {
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
        } elseif ($this->acao != 'edit' && $this->acao != 'create') {
            $this->variavelReadOnlyNaView = "readonly";
            $this->variavelDisabledNaView = 'disabled';
        }
    }
    public function index(Request $request)
    {

        $idusuariologado = Auth::id();
        // $idusuariologado = base64_encode($idusuariologado);

        if($request->post('aprovado') != null){
            $aprovado = json_decode($request->post('aprovado'));
            $notificado = json_decode($request->post('notificado'));

            // if($aprovado == 'waiting'): $aprovado = null; $notificado = ''; endif;

            return view('pedidocompra.index', compact('idusuariologado', 'aprovado', 'notificado'));
        }

        return view('pedidocompra.index', compact('idusuariologado'));

    }

    public function create()
    {

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;
        return view('pedidocompra.create', compact('valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }

    public function store(Request $request)
    {
        $pedido = new PedidoCompra();

        $oscriaatva = $request->get('oscriaatva');
        if(isset($oscriaatva)){
            if($oscriaatva == 'EMPRESA GERAL'){
                $pedido->ped_os                     = $oscriaatva;
            }else{
                $pedido->ped_os                     = $request->get('ped_os');
            }
        }else{
            $pedido->ped_os                     = $request->get('ped_os');
        }



        $request->validate([
            'ped_nomecomprador'  => 'required',
            'ped_fornecedor'     => 'required',
            'ped_os'             => 'required',
            'ped_descprod'       => 'required',
            'ped_precounit'      => 'required',
            'ped_qtd'            => 'required',
            'ped_valortotal'     => 'required',
        ],
        [
            'ped_nomecomprador.required'=> 'Nome do Comprador é obrigatório', 
            'ped_fornecedor.required'   => 'Nome do Fornecedor é obrigatório', 
            'ped_os.required'           => 'Informe se a compra é para a CRIAATVA ou para uma OS', 
            'ped_descprod.required'     => 'Informe a descrição', 
            'ped_precounit.required'    => 'Informe o valor unitário', 
            'ped_qtd.required'          => 'Informe a quantidade', 
            'ped_valortotal.required'   => 'Informe o valor total', 

         ]);
         $this->pegaDados($request, $pedido);
         $this->validaDados($request);

        
        // $pedido->ped_os                     = $request->get('ped_os');
        $pedido->ped_data                   = $request->get('ped_data');
        $pedido->ped_nomecomprador          = $request->get('ped_nomecomprador');
        $pedido->ped_usrsolicitante         = $request->get('ped_usrsolicitante');
        $pedido->ped_fornecedor             = $request->get('ped_fornecedor');
        $pedido->ped_descprod               = $request->get('ped_descprod');
        $pedido->ped_valortotal             = $request->get('ped_valortotal');
        $pedido->ped_formapag               = $request->get('ped_formapag');
        $pedido->ped_precounit              = $request->get('ped_precounit');
        $pedido->ped_qtd                    = $request->get('ped_qtd');
        $pedido->ped_observacao             = $request->get('ped_observacao');
        $pedido->ped_notafiscal             = $request->get('ped_notafiscal');
        $pedido->ped_aprovado               = '3';
        $pedido->ped_contaaprovada          = '';
        $pedido->ped_exigaprov              = '';
        $pedido->ped_excluidopedido         = '0';
        $pedido->ped_novanotificacao        = '1';


        $pedido->save();
        $this->logAlteraPedidoCompra($pedido);

        return redirect()->route('pedidocompra.index')
            ->with('success', 'Pedido de compra n° ' . $pedido->id . ' realizado.');
    }

    public function update(Request $request)
    {
        $pedido = new PedidoCompra();

        $oscriaatva = $request->get('oscriaatva');
        if(isset($oscriaatva)){
            if($oscriaatva == 'EMPRESA GERAL'){
                $pedido->ped_os                     = $oscriaatva;
            }else{
                $pedido->ped_os                     = $request->get('ped_os');
            }
        }else{
            $pedido->ped_os                     = $request->get('ped_os');
        }


        $pedido->id                     = $request->get('id');


        $pedido->ped_data                   = $request->get('ped_data');
        $pedido->ped_nomecomprador          = $request->get('ped_nomecomprador');
        $pedido->ped_usrsolicitante         = Auth::id();

        $pedido->ped_fornecedor             = $request->get('ped_fornecedor');
        $pedido->ped_descprod               = $request->get('ped_descprod');
        $pedido->ped_valortotal             = $request->get('ped_valortotal');
        // $pedido->ped_cartaodecredito        = $request->get('ped_cartaodecredito');
        $pedido->ped_formapag               = $request->get('ped_formapag');
        $pedido->ped_periodofaturado        = $request->get('ped_periodofaturado');
        $pedido->ped_pix                    = $request->get('ped_pix');
        $pedido->ped_banco                  = $request->get('ped_banco');
        $pedido->ped_conta                  = $request->get('ped_conta');
        $pedido->ped_agenciaconta           = $request->get('ped_agenciaconta');
        $pedido->ped_cpfcnpj                = $request->get('ped_cpfcnpj');
        $pedido->ped_numcartao              = $request->get('ped_numcartao');
        $pedido->ped_reembolsado            = $request->get('ped_reembolsado');
        $pedido->ped_vzscartao              = $request->get('ped_vzscartao');
        $pedido->ped_precounit              = $request->get('ped_precounit');
        $pedido->ped_qtd                    = $request->get('ped_qtd');
        $pedido->ped_observacao             = $request->get('ped_observacao');
        $pedido->ped_notafiscal             = $request->get('ped_notafiscal');

        $pedido->ped_aprovado           = '3';
        $pedido->ped_contaaprovada      = '';
        $pedido->ped_exigaprov          = '';
        $pedido->ped_excluidopedido     = '0';
        $pedido->ped_novanotificacao    = '1';
        $pedido->data = FormatacoesServiceProvider::getHorarioParaBackend();


        $stringConsulta = $pedido->atualizaPedidos($pedido);
        $dadosAtualizacao = DB::update($stringConsulta);


        $this->logAlteraPedidoCompra($pedido);

        return redirect()->route('pedidocompra.index')
            ->with('success', 'Pedido de compra n° ' . $pedido->id . ' atualizado.');
    }

    public function updateAprovacao(Request $request)
    {

        try{
        $query = "UPDATE pedidocompra SET ";

        if ($request->ped_aprovado != '') {
            $query .= " ped_aprovado= '$request->ped_aprovado',
            ped_novanotificacao = '1'";
        }
        if ($request->ped_contaaprovada != '') {
            $query .= ", ped_contaaprovada= '$request->ped_contaaprovada'";
        }
        if ($request->ped_exigaprov != '') {
            $query .= ", ped_exigaprov= '$request->ped_exigaprov'";
        }
        if ($request->ped_observacao != '') {
            $query .= ", ped_observacao= '$request->ped_observacao'";
        }
        if ($request->ped_excluidopedido != '') {
            $query .= ", ped_excluidopedido= '$request->ped_excluidopedido'";
        }

        DB::update("$query WHERE id= '$request->id'");

        } catch (\Throwable $th) {
            return redirect()->route('pedidocompra.index')
                ->with('alert', 'Não conseguimos processar sua solicitação. Favor, Tente novamente');
        }

        if ($request->ped_aprovado == '1') {
            $this->logValidaPedidoCompra($request);

            return redirect()->route('pedidocompra.index')
                ->with('success', 'Pedido de compra n° ' . $request->id . ' foi aprovado, já notificamos ao solicitante.');
        }

        if ($request->ped_aprovado == '0') {
            $this->logInvalidaPedidoCompra($request);

            return redirect()->route('pedidocompra.index')
                ->with('success', 'Pedido de compra n° ' . $request->id . ' foi reprovado, já notificamos ao solicitante.');
        }
    }

    public function marcaComoLido(Request $request)
    {

        // try{
        $query = "UPDATE pedidocompra SET ";

        if ($request->ped_novanotificacao != '') {
            $query .= " ped_novanotificacao= '$request->ped_novanotificacao'";
        }

        DB::update("$query WHERE id= '$request->id'");

        // return redirect()->route("pedidocompra". $request->id);
        return redirect()->back()->with('message','Notificação removida!');


        // } catch (\Throwable $th) {
        //     return redirect()->route('despesas.index')
        //         ->with('alert', 'Não conseguimos processar sua solicitação. Favor, Tente novamente');
        // }

    }

    public function apipedidocompra(Request $request)
    {

        $aprovado = json_decode($request->post('aprovado'));
        $notificado = json_decode($request->post('notificado'));
        
        // $idusuariologado = json_decode($request->post('id'));
        $idusuariologado = $request->post('id');
        $permissao = json_decode($request->post('permissao'));
        if($permissao == '199'){
            $idusuariologado = null;
        }

        // if ($request->post('aprovado')) = null){
        //     $aprovado = json_decode($request->post('aprovado'));
        // }
        // else{
        //     $aprovado = null;
        // }
        

        $pedidocompra = new PedidoCompra();
        $stringConsulta = $pedidocompra->listaPedidos($idusuariologado, $aprovado, $notificado);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function show(Request $request, $id)
    {

        $pedido = PedidoCompra::find($id);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('pedidocompra.show', compact('pedido', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }

    public function edit($id)
    {
        $pedido = PedidoCompra::find($id);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('pedidocompra.edit', compact('pedido', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }

    public function destroy($id)
    {
        $pedido = new PedidoCompra();

        $pedido->id = PedidoCompra::find($id);
        $pedido->ped_excluidopedido     = 1;

        $pedido->update();
        $this->logExcluiPedidoCompra($pedido);

        return redirect()->route('pedidocompra.index')
            ->with('success', 'Pedido de compra n° ' . $pedido->id . ' cancelado.');
    }

    public function logCadastraPedidoCompra($pedido = null)
    {
        $this->Logger->log('info', 'Cadastrou o pedido de compra ' . $pedido->id);
    }

    public function logAlteraPedidoCompra($pedido = null)
    {
        $this->Logger->log('info', 'Alterou o pedido de compra ' . $pedido->id);
    }

    public function logValidaPedidoCompra($pedido = null)
    {
        $this->Logger->log('info', 'Aprovou o pedido de compra ' . $pedido->id);
    }

    public function logInvalidaPedidoCompra($pedido = null)
    {
        $this->Logger->log('info', 'Reprovou o pedido de compra ' . $pedido->id . ' com o retorno: ' . $pedido->ped_exigaprov);
    }

    public function logExcluiPedidoCompra($pedido = null)
    {
        $this->Logger->log('info', 'Marcou como excluído o pedido de compra ' . $pedido->id);
    }

    public function pegaDados($request, $pedido)
    {
        
        if($request->get('ped_formapag') == 'avista'){
            $pedido->ped_pix                    = $request->get('ped_pix');
            $pedido->ped_banco                  = $request->get('ped_banco');
            $pedido->ped_conta                  = $request->get('ped_conta');
            $pedido->ped_agenciaconta           = $request->get('ped_agenciaconta');   
            $pedido->ped_cpfcnpj                = $request->get('ped_cpfcnpj');   


           
            if($pedido->ped_banco != '180'){
                $request->validate([
                    'ped_cpfcnpj'         => 'required' ],
                [   'ped_cpfcnpj.required'        => 'CPF/CNPJ obrigatório']);
            }

            return $pedido;

            $request->validate([
                // 'ped_pix'           => 'required',
                'ped_banco'         => 'required',
                'ped_conta'         => 'required',
                'ped_agenciaconta'  => 'required',
            ],
            [
                // 'ped_pix.required'          => 'A chave pix é obrigatória', 
                'ped_banco.required'        => 'Nome do Banco é obrigatório', 
                'ped_conta.required'        => 'Informe a conta', 
                'ped_agenciaconta.required' => 'Informe a agência',     
             ]);
        }
        if($request->get('ped_formapag') == 'cred'){
            $pedido->ped_numcartao              = $request->get('ped_numcartao');
            $pedido->ped_vzscartao              = $request->get('ped_vzscartao'); 
            return $pedido;
            
            $request->validate([ 'ped_numcartao'  => 'required', 'ped_vzscartao'  => 'required'] ,
             [  'ped_numcartao.required'=> 'O número final do cartão é obrigatório', 
                'ped_vzscartao.required'=> 'O número de parcelas no cartão é obrigatório']);

        }
        if($request->get('ped_formapag') == 'faturado'){
            $pedido->ped_periodofaturado        = $request->get('ped_periodofaturado');
            return $pedido;

            $request->validate([ 'ped_periodofaturado'  => 'required'] , [ 'ped_periodofaturado.required'=> 'O período faturado é obrigatório']);

        }
        if($request->get('ped_formapag') == 'reembolsado'){
            $pedido->ped_reembolsado            = $request->get('ped_reembolsado');
            $pedido->ped_banco                  = $request->get('ped_banco');
            $pedido->ped_conta                  = $request->get('ped_conta');
            $pedido->ped_agenciaconta           = $request->get('ped_agenciaconta');   
            $pedido->ped_cpfcnpj                = $request->get('ped_cpfcnpj');   

            // Se o Banco for diferente de Itau, validar o CPF/CNPJ
            if($pedido->ped_banco != '180'){
                $request->validate([
                    'ped_cpfcnpj'          => 'required' ],
                [   'ped_cpfcnpj.required' => 'CPF/CNPJ obrigatório']);

            }
            return $pedido;

            $request->validate([ 
                'ped_reembolsado'   => 'required',
                'ped_banco'         => 'required',
                'ped_conta'         => 'required',
                'ped_agenciaconta'  => 'required',
            ], 
            [ 
                'ped_reembolsado.required'  => 'Nome do Reembolsado é obrigatório',
                'ped_banco.required'        => 'Nome do Banco é obrigatório', 
                'ped_conta.required'        => 'Informe a conta', 
                'ped_agenciaconta.required' => 'Informe a agência', 
            ]);
        }
    }
    public function validaDados($request)
    {
        if($request->get('ped_formapag') == 'avista'){

            $request->validate([
                // 'ped_pix'           => 'required',
                'ped_banco'         => 'required',
                'ped_conta'         => 'required',
                'ped_agenciaconta'  => 'required',
            ],
            [
                // 'ped_pix.required'          => 'A chave pix é obrigatória', 
                'ped_banco.required'        => 'Nome do Banco é obrigatório', 
                'ped_conta.required'        => 'Informe a conta', 
                'ped_agenciaconta.required' => 'Informe a agência',     
             ]);
        }
        if($request->get('ped_formapag') == 'cred'){
            
            $request->validate([ 'ped_numcartao'  => 'required', 'ped_vzscartao'  => 'required'] ,
             [  'ped_numcartao.required'=> 'O número final do cartão é obrigatório', 
                'ped_vzscartao.required'=> 'O número de parcelas no cartão é obrigatório']);

        }
        if($request->get('ped_formapag') == 'faturado'){

            $request->validate([ 'ped_periodofaturado'  => 'required'] , [ 'ped_periodofaturado.required'=> 'O período faturado é obrigatório']);

        }
        if($request->get('ped_formapag') == 'reembolsado'){
            $request->validate([ 
                'ped_reembolsado'  => 'required',
                'ped_banco'         => 'required',
                'ped_conta'         => 'required',
                'ped_agenciaconta'  => 'required',
            ], 
            [ 
                'ped_reembolsado.required'=> 'Nome do Reembolsado é obrigatório',
                'ped_banco.required'        => 'Nome do Banco é obrigatório', 
                'ped_conta.required'        => 'Informe a conta', 
                'ped_agenciaconta.required' => 'Informe a agência', 
            ]);
        }
        else{
            $request->validate([ 
                'ped_formapag'  => 'required',
            ], 
            [ 
                'ped_formapag.required'=> 'Informe o tipo da compra',
            ]);
        }
        if ($request->fails()) {
            return Redirect::back()->withErrors($request->errors())->withInput();
        }else{
            return $request;
        }
    }
}
