<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App; 

class UserController extends Controller
{
    public function signup(){
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
        ]); 
        $nuevoUser = App\User; 
    }
}
