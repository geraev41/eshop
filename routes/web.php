<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  Route::get('/', function () {
//      return view('signup');
//  });

Route::get('/', 'CategoriaController@mostrar_categorias')->name('guardar'); 
Route::get('/Registro', 'UserController@signup')->name('signup'); 
Route::get('/guardar', 'UserController@guardar')->name('guardar'); 

