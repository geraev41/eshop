<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class CompraController extends Controller
{
    
    public function pagar_productos(){
        $carros = App\Carro::where('id_usuario',Auth::user()->id)->get();
        foreach ($carros as $c) {
          $p =  App\Producto::findOrFail($c->id_producto); 
          guardar_compra($p,$c); 
          $c->delete(); 
        }
       
    }

    public function guardar_compra($p, $car){
        $c = new App\Compra; 
        $c->id_cliente = Auth::user()->id; 
        $c->nombre = $p->nombre; 
        $c->imagen = $p->imagen; 
        $c->fecha_compra = get_date();
        $c->cantidad = $car->cantidad; 
        $c->descripcion = $p->descripcion; 
        $c->precio = $p->precio;
        $c->costo = $car->valor; 
        $c->save();
    }
    
    public function get_date(){
        date_default_timezone_set("America/Costa_Rica"); 
        $fecha = Date("d-m-Y");
        $hora = Date(" h:i a");
        $fe = $fecha.$hora;
        return $fe;
    }

}
