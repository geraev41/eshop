<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 

class UserController extends Controller
{
    public function index(){
        return view('login');
    }


    public function registro(){
        return view('signup'); 
    }

    public function guardar(Request $request){
        $request->validate([
            'nombre'=> 'required',
            'cedula'=> 'required',
            'email'=> 'required',
            'telefono'=> 'required',
            'direcion'=> 'required',
            'username'=> 'required',
            'password'=> 'required',
        ]); 

        $nuevoUser = new App\User; 
        $nuevoUser->nombre = $request->nombre; 
        $nuevoUser->cedula = $request->cedula; 
        $nuevoUser->email = $request->email; 
        $nuevoUser->telefono = $request->telefono; 
        $nuevoUser->direcion = $request->direcion; 
        $nuevoUser->username = $request->username; 
        $nuevoUser->password = $request->password; 
        $nuevoUser->tipo = "cl";
        $nuevoUser->save(); 
    }

    public function admin(){
        return view('admin');
    }

    public function mostrar_clientes(){
        $users = App\User::where('tipo','cl')->get();
        return view('admin', compact('users')); 
    }
}
