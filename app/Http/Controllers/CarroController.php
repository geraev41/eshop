<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 
class CarroController extends Controller
{
    public function cambiar(){
        return view('cantidad_requerida'); 
    }

    public function guardar_producto_en_carro($id_producto,$id_usuario){
        $c = new App\Carro;
        $p =  App\Producto::findOrFail($id_producto);
        $c->id_usuario= $id_usuario;
        $c->id_producto= $id_producto;
        $c->cantidad = 1;
        $c->valor = $p->precio * $p->cantidad;
        $c->save(); 
        $msj = "Se agrego un producto al carrito!";
        return view('principal', compact('msj')); 
    }

    public function editar_producto_en_carro(Request $r, $id=0){
        $c = App\Carro::findOrFail($id); 
        $p =  App\Producto::findOrFail($c->id_producto);
        $c->cantidad = $r->cantidad; 
        $c->valor = $p->precio * $p->cantidad;
        $c->save(); 
        $msj = "Actualización de producto en carro, con exito!";
        return view('principal', compact('msj')); 
    }

    public function eliminar_producto_en_carro($id){
        $p = App\Carro::findOrFail($id);
        $p->delete(); 
        $msj = "Eliminado producto de carro";
        return view('principal', compact('msj')); 
    }

    public function productos_en_carro(){
        $carros = App\Carro::all();
        return view('principal', compact('carros')); 
    }

   
}
