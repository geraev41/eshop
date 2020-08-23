<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 
use Auth; 
class CarroController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function cambiar($id= 0){
        if($id<1){
            return redirect()->route('cliente');
        }
        $carro = App\Carro::findOrFail($id);
        $p = App\Producto::findOrFail($carro->id_producto); 
        $result = compact('carro', 'p');
        return view('cantidad_requerida', compact('result')); 
    }

    public function guardar_producto_en_carro($id_producto){
        $c = new App\Carro;
        $p =  App\Producto::findOrFail($id_producto);
        $c->id_usuario= Auth::user()->id;
        $c->id_producto= $id_producto;
        $c->cantidad = 1;
        $c->valor = $p->precio * $c->cantidad;
        $c->save(); 
        $msj = "Se agrego un producto al carrito!";
        return redirect()->route('cliente');
     //   return view('principal', compact('msj')); 
    }

    public function update(Request $r, $id=0){
        $c = App\Carro::findOrFail($id); 
        $p =  App\Producto::findOrFail($c->id_producto);
        $c->cantidad = $r->cantidad; 
        $c->valor = $p->precio * $c->cantidad;
        $c->save(); 
        $msj = "Actualización de producto en carro, con exito!";
        return redirect()->route('cliente');
      //  return view('principal', compact('msj')); 
    }

    public function eliminar_producto_en_carro($id){
        $p = App\Carro::findOrFail($id);
        $p->delete(); 
        $msj = "Eliminado producto de carro";
        return redirect()->route('cliente');

       // return view('principal', compact('msj')); 
    }

    public function productos_en_carro(){
        $carro= App\Carro::where('id_usuario', Auth::user()->id)->get();
        $pros = array();
        foreach($carro as $c){
            $p = App\Producto::findOrFail($c->id_producto);
            array_push($pros, $p);
        }
        $result = compact('carro', 'pros');
        return view('principal', compact('result')); 
    }

   
}
