<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function showLoginForm(){
        return view('login');
    }

    public function login(){
        $credenciales=   $this->validate(request(),[
            'username'=>'required',
            'password'=>'required'
        ]);
        if(Auth::attempt($credenciales)){
            $user = Auth::user();
            if($user->tipo == "cl"){
                return redirect()->route('cliente');
            }elseif($user->tipo == "ad"){
                return redirect()->route('admin');
            }
        }
        return redirect()->route('login');

    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
