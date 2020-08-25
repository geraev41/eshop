<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 
use Auth;

class UserController extends Controller
{
    public function __construct(){
      //  $this->middleware('auth'); 
    }
    /***
     * Muestra el index principal del usuario respectivo
     */
    public function index(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->tipo == "cl"){
                return redirect()->route('cliente');
            }elseif($user->tipo == "ad"){
                return redirect()->route('admin');
            }
        }
        return view('login');
    }
    /** 
     * Devuelve el registro de usuarios
     * */ 
    public function registro(){
        return view('signup'); 
    }

    // public function guardar(Request $request){
    //     $request->validate([
    //         'nombre'=> 'required',
    //         'cedula'=> 'required',
    //         'email'=> 'required',
    //         'telefono'=> 'required',
    //         'direcion'=> 'required',
    //         'username'=> 'required',
    //         'password'=> 'required',
    //     ]); 

    //     $nuevoUser = new App\User; 
    //     $nuevoUser->nombre = $request->nombre; 
    //     $nuevoUser->cedula = $request->cedula; 
    //     $nuevoUser->email = $request->email; 
    //     $nuevoUser->telefono = $request->telefono; 
    //     $nuevoUser->direcion = $request->direcion; 
    //     $nuevoUser->username = $request->username; 
    //     $nuevoUser->password = $request->password; 
    //     $nuevoUser->tipo = "cl";
    //     $nuevoUser->save(); 
    // }
    /**
     * Devuelve la vista admin
     */
    public function admin(){
        return view('admin');
    }
    /**
     * Devuelve la vista cliente
     */
    public function cliente(){
        return view('principal');
    }
    /**
     * Muestra los clientes del sistema al administrador
     */
    public function mostrar_clientes(){
        $users = App\User::where('tipo','cl')->get();
        return view('admin', compact('users')); 
    }

}
