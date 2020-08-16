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

Route::get('/','UserController@index')->name('login'); 
Route::get('/administrador','UserController@admin')->name('admin'); 

Route::get('/categoria','CategoriaController@crear')->name('crear_categoria'); 
Route::post('/','CategoriaController@guardar')->name('guardar_categoria'); 
Route::get('/','CategoriaController@mostrar')->name('guardar_categoria'); 





//Route::get('/', 'CategoriaController@mostrar_categorias')->name('guardar'); 
Route::get('/Registro', 'UserController@registro')->name('registro_usuario'); 

Route::post('/Salvar', 'UserController@guardar')->name('guardar'); 

