<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth; 
class CompraController extends Controller
{
    
    public function pagar_productos(){
        
        $carros = App\Carro::where('id_usuario',Auth::user()->id)->get();
        if(isset($carros[0])){
            foreach ($carros as $c) {
                $p =  App\Producto::findOrFail($c->id_producto); 
                $this->guardar_compra($p,$c); 
                $c->delete(); 
            }
        }else{
            return redirect()->route('cliente'); 
        }
    }

    public function guardar_compra($p, $car){
        $c = new App\Compra; 
        $c->id_usuario = Auth::user()->id; 
        $c->nombre = $p->nombre; 
        $c->imagen = $p->imagen; 
        $c->cantidad = $car->cantidad; 
        $c->descripcion = $p->descripcion; 
        $c->precio = $p->precio;
        $c->costo = $car->valor; 
        $c->save();
        $p->stock = $p->stock - $car->cantidad; 
        $p->vendidos = $p->vendidos + $car->cantidad; 
        $p->save();         
    }
    
    public function get_date(){
        date_default_timezone_set("America/Costa_Rica"); 
        $fecha = Date("d-m-Y");
        $hora = Date(" h:i a");
        $fe = $fecha.$hora;
        return $fe;
    }

    public function mostrar_compras(){
        $compras = App\Compra::where('id_usuario', Auth::user()->id)->get(); 
        return view('principal', compact('compras')); 
    }
    public function mostrar_orden($id= 0){
        $compra = App\Compra::findOrFail($id); 
        return view('orden', compact('compra')); 
    }

    public function ver_orden_x_fecha(Request $r){
        $compras = App\Compra::whereDate('created_at', $r->fecha)->get();
        return view('principal', compact('compras')); 
    }

    public function eliminar_compra($id=0){
        $c = App\Compra::findOrFail($id);
        $c->delete();
        $msj = "Elimino con exitó la compra del registro"; 
        return view('principal', compact('msj'));
    }
}
 