<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 

class CategoriaController extends Controller
{
    public function guardar(){
        $cat = new App\Categoria; 
        var_dump($cat->nombre);die; 
        $cat->nombre = "Deportes"; 
        $cat->save(); 
      //  return back()->with(''); 
    }

    public function mostrar_categorias(){
        $categorias = App\Categoria::all();
        return view('prueba', compact('categorias')); 
    }
}
