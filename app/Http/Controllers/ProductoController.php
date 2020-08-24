<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 
use Auth; 
class ProductoController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    /**
     * @param id de la categoria, Retorna una vista para crear un producto
     */
    public function producto($id=0){
        return view('producto',compact('id'));
    }

    /**
     *@param r request que recibe para obtener los datos del producto a guardar
     */
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

    /**
     * Muestra todos los productos
     */
    public function mostrar_productos(){
        $productos = App\Producto::all();
        return view ('admin', compact('productos'));
    }

    /**
     * @param r request para extraer los datos
     * retorna productos a la categoria que corresponda
     * si es cliente se le quitan los productos que ya tiene asociados al carro y los que estan en 0 
     */
    public function mostrar_producto_x_categoria(Request $r){
        $view= $r->view;
        $id_categoria = intval($r->input('select'));
        $productos = App\Producto::where('id_categoria', $id_categoria)->get();
        $categorias = App\Categoria::all();
        if($view === "principal"){
            $productos = $this->productos_sin_asociar($productos); 
        }
        $result = compact('productos', 'categorias'); 
        return view ($view, compact('result'));
    }
    /**
     * @param productos obtenidos por una categoria en especifico
     * devuel nueva lista de productos que se pueden mostrar
     */
    public function productos_sin_asociar($productos){
        $productos_carro= App\Carro::where('id_usuario', Auth::user()->id)->get();
        $newList = array();
        foreach($productos as $p){
            if($this->validar_producto($p, $productos_carro) && $p->stock>0){
                array_push($newList, $p); 
            }
        }
        return $newList; 
    }
    /**
     * @param p producto a validar
     * @param productos_carro productos obtenidos en el carro del usuario
     * busca productos que ya tiene asociados al carrito
     */
    public function validar_producto($p, $productos_carro){
        foreach($productos_carro as $p_carro){
            if($p->id== $p_carro->id_producto){
                return false; 
            }
        }
        return true; 
    }

    /**
     * @param id del producto que se elimina
     * elimina un producto
     */
    public function eliminar($id){
        $p = App\Producto::findOrFail($id);
        $p->delete();
        $msj = "Se eliminó un producto con exitó!"; 
        return view('admin', compact('msj')); 
    }

    /**
     * @param id del producto a editar
     * devuelve una vista donde se va editar con todos los datos correspondiente
     */
    public function editar_producto($id=0){
        if($id<1){
            return back()->with('msj',"El link no debe alterarlo!"); 
        }
        $p = App\Producto::findOrFail($id); 
        return view('producto_editar', compact('p')); 
    }
    /**
     * @param r request con todos los datos
     * @param id del producto
     * edita el producto con los nuevos datos en la base datos
     */
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
        $p->save();
        $msj = "Se editó un nuevo producto con exitó!"; 
        return view('admin', compact('msj')); 
    }
    /**
     * @param r request con los datos
     *valida los datos que no esten vacios
     */
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
