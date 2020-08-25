<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 

class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    /**
     * Retorna una vista donde se crean categorias 
     */
    public function crear(){
        return view('categoria');
    }
    /**
     * @param r el request donde se obtienen los datos
     * guarda una categoria
     */
    public function guardar(Request $r){
        $r->validate([
            'categoria'=>'required'
        ]);
        $cat = new App\Categoria; 
        $cat->nombre = $r->categoria; 
        $cat->save(); 
        return back()->with('mensaje','Categoria guardada con exitó'); 
    }

    /**
     * @param view nombre de la vista a la que va retornar los datos
     */
    public function mostrar_categorias($view=0){
        if($view === 0){
            return redirect('/');
        }
        $categorias = App\Categoria::all();
        $result = compact('categorias');
        return view($view, compact('result')); 
    }
    /**
     * @param id de la categoria a editar
     * edita los datos de una categoria
     */
    public function editar_categoria($id){
        $cat = App\Categoria::findOrFail($id);
        return view ('categoria_editar', compact('cat')); 
    }

    public function update(Request $r, $id){
        $notaUpdate = App\Categoria::findOrFail($id);
        $notaUpdate->nombre = $r->categoria; 
        $notaUpdate->save();
        $msj = "Actualizado con exitó una categoria";
       // return back();
       return view('admin', compact('msj')); 
    }
    /**
     * @param id de la categoria a eliminar
     * elimina una categoria
     */
    public function eliminar_categoria($id){
        $cat = App\Categoria::findOrFail($id);
        $pr = App\Producto::where('id_categoria', $id)->get();
        $msj = "No puede eliminar categorias con productos asociados";
        if(isset($pr[0])){
            return view('admin', compact('msj')); 
        }else{
            $cat->delete();
            $msj = "Eliminado con exitó";
        }
        return view('admin',compact('msj')); 
    }
}
