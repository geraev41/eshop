<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 

class CategoriaController extends Controller
{

    public function crear(){
        return view('categoria');
    }

    public function guardar(Request $r){
        $r->validate([
            'categoria'=>'required'
        ]);
        $cat = new App\Categoria; 
        $cat->nombre = $r->categoria; 
        $cat->save(); 
        return back()->with('mensaje','Categoria guardada con exitó'); 
    }

    public function mostrar_categorias(){
        $categorias = App\Categoria::all();
        return view('prueba', compact('categorias')); 
    }
}
