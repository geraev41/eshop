<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth; 
class CompraController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    /**
     * Busca los productos que hayan agregado al carro, los busca y los pasa al estado de pagados
     * se devuelve a la vista de cliente
     */
    public function pagar_productos(){
        $carros = App\Carro::where('id_usuario',Auth::user()->id)->get();
        if(isset($carros[0])){
            foreach ($carros as $c) {
                $p =  App\Producto::findOrFail($c->id_producto); 
                $this->guardar_compra($p,$c); 
                $c->delete(); 
            }
            return redirect()->route('cliente'); 
        }else{
            return redirect()->route('cliente'); 
        }
    }
    /**
     *  @param $p producto a cancelar
     * @param $car carrito con los productos y datis
     * Guarda la compra que se va a cancelar
     */
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
    /**
     * Muestra las compras realizadas, por usuario
     */
    public function mostrar_compras(){
        $compras = App\Compra::where('id_usuario', Auth::user()->id)->get(); 
        return view('principal', compact('compras')); 
    }

    /**
     * @param $id de la compra que se realizo
     */
    public function mostrar_orden($id= 0){
        $compra = App\Compra::findOrFail($id); 
        return view('orden', compact('compra')); 
    }

    /**
     * @param $r, es el request cuando se dio click
     * busca la orden por fecha
     */
    public function ver_orden_x_fecha(Request $r){
        $compras = App\Compra::whereDate('created_at', $r->fecha)->get();
        return view('principal', compact('compras')); 
    }
    /**
     * @param id de las compra que se va eliminar
     * elimina una compra en especifico
     */
    public function eliminar_compra($id=0){
        $c = App\Compra::findOrFail($id);
        $c->delete();
        $msj = "Elimino con exitó la compra del registro"; 
        return view('principal', compact('msj'));
    }
    /**
     * Hace un calculo de las ganancias obtenidas por las compras de los clientes
     */
    public function ganancias(){
        $compras = App\Compra::all();
        $total = 0;
        foreach($compras as $c){
            $total = $total + $c->costo; 
        }
        return view('admin', compact('total')); 
    }
}
 