<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Despesa;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categorias = Categoria::all();
        $despesas = Despesa::with('categoria')->get();

        $somaValoresPorCategoria = [];
        $naoAtingiu = [];

        foreach ($categorias as $categoria) {
            $somaValores = Despesa::where('categoria_id', $categoria->id)->sum('valor');
            if($somaValores >= 0.8 * $categoria->value){
                $somaValoresPorCategoria[$categoria->id] = ['nome' => $categoria->nome, 'somaValores' => $somaValores];
            }
            if($somaValores > ($categoria->value - $categoria->valueEconomia)){
                $passou = $somaValores - ($categoria->value - $categoria->valueEconomia);
                $naoAtingiu[$categoria->id] = ['nome' => $categoria->nome, 'passou' => $passou];
            }
        }

        return view('home', ['categorias' => $categorias, 'despesas' => $despesas, 'somaValoresPorCategoria' => $somaValoresPorCategoria, 'naoAtingiu' => $naoAtingiu]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $user->renda = $request->renda;
        
        $user->save();
        
        return redirect()->route('home');
        
    }
    
    //====================================================== Despesas
    public function storeDespesa(Request $request){
        $despesa = new Despesa; 
        $despesa->nome = $request->nomeDespesa;
        $despesa->valor = $request->valorDespesa;
        $despesa->categoria_id = $request->categoria;
        $despesa->save();

        return redirect()->route('home');
    }

    public function destroyDespesa($id){

        Despesa::findOrFail($id)->delete();
        
        return redirect()->route('home');
    }

    //====================================================== Categorias

    public function storeCategoria(Request $request){
        
        $categoria = new Categoria; 
        $categoria->nome = $request->nomecategoria;
        $categoria->value = $request->valorcategoria;
        $categoria->valueEconomia = $request->valoreconomia;
        $categoria->save();

        return redirect()->route('home');
    }

   

    public function updateCategoria(Request $request){

        $categoria = Categoria::findOrFail($request->id);
        $categoria->update(['nome' => $request->editnomecategoria, 'value' => $request->editvalorcategoria, 'valueEconomia' => $request->editvalorEconomia]);
       
        return redirect()->route('home');
    }  

    public function editCategoria($id){
        $categoria = Categoria::findOrFail($id);

        return view('edit', ['categoria' => $categoria]);
    }

    public function destroyCategoria($id){

        Categoria::findOrFail($id)->delete();
        
        return redirect()->route('home');
    }

}
