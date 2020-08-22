<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 
class ProductoController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function producto($id=0){
        return view('producto',compact('id'));
    }

    public function guardar(Request $r){
        $this->validar($r); 
       try {
           $p = new App\Producto; 
           $p->nombre = $r->nombre; 
           $p->id_categoria = $r->id_categoria; 
           $p->descripcion = $r->descripcion;
           $archivo = $r->file('Image');
           $p->imagen = $archivo->getClientOriginalName();
           $archivo->move('images',$p->imagen); 
           $p->stock = $r->stock; 
           $p->precio = $r->precio; 
           $p->vendidos = 0; 
           $p->save();
           $msj = "Creo un nuevo producto con exitó!"; 
           return view('admin', compact('msj')); 
       } catch (Exception $e) {
          throw new Exception("Error Processing Request", 1);
          
       }
    }

    public function mostrar_productos(){
        $productos = App\Producto::all();
        return view ('admin', compact('productos'));
    }

    public function mostrar_producto_x_categoria(Request $r){
        $view= $r->view;
        $id_categoria = intval($r->input('select'));
        $productos = App\Producto::where('id_categoria', $id_categoria)->get();
        $categorias = App\Categoria::all();
        $result = compact('productos', 'categorias'); 
        return view ($view, compact('result'));
    }

    public function eliminar($id){
        $p = App\Producto::findOrFail($id);
        $p->delete();
        $msj = "Se eliminó un producto con exitó!"; 
        return view('admin', compact('msj')); 
    }

    public function editar_producto($id=0){
        if($id<1){
            return back()->with('msj',"El link no debe alterarlo!"); 
        }
        $p = App\Producto::findOrFail($id); 
        return view('producto_editar', compact('p')); 
    }
    public function update(Request $r, $id=0){
        $this->validar($r);
       // $ruta = 'images/'.$r->imagenAux; 
        $p = App\Producto::findOrFail($id);
        $p->nombre = $r->nombre; 
        $p->id_categoria = $r->id_categoria; 
        $p->descripcion = $r->descripcion;
        $archivo = $r->file('Image');
        $p->imagen = $archivo->getClientOriginalName();
        $archivo->move('images',$p->imagen); 
        $p->stock = $r->stock; 
        $p->precio = $r->precio; 
        $p->vendidos = 0; 
        $p->save();
        $msj = "Se editó un nuevo producto con exitó!"; 
        return view('admin', compact('msj')); 
    }

    public function validar(Request $r){
        $r->validate([
            'id_categoria' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'Image' => 'required',
            'stock' => 'required',
            'precio' => 'required'
       ]);
       if($r->id_categoria<1){
           return back()->with('msj',"El link no debe alterarlo!, por favor regrese a la página principal!"); 
       }
    }

    
}
