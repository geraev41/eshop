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






Route::get('/','UserController@index')->name('login')->middleware('guest'); 
Route::get('/registro','UserController@registro')->name('registro'); 

Route::post('/validar','Auth\LoginController@login')->name('validar_login'); 
Route::post('/salir','Auth\LoginController@logout')->name('salir'); 


Route::get('/ver_clientes','UserController@mostrar_clientes')->name('clientes'); 
Route::get('/administrador','UserController@admin')->name('admin'); 
Route::get('/principal','UserController@cliente')->name('cliente'); 


Route::get('/categoria','CategoriaController@crear')->name('crear_categoria'); 
Route::post('/','CategoriaController@guardar')->name('guardar_categoria'); 
Route::get('/ver_categorias', 'CategoriaController@mostrar_categorias')->name('mostrar_categorias'); 
Route::get('/editar_categoria/{id?}', 'CategoriaController@editar_categoria')->name('editar_categoria');
Route::delete('/eliminar_categoria/{id?}', 'CategoriaController@eliminar_categoria')->name('eliminar_categoria'); 
Route::put('/{id?}', 'CategoriaController@update')->name('update_categoria'); 


Route::get('/producto/{id?}','ProductoController@producto')->name('producto'); 
Route::post('/guardar_producto','ProductoController@guardar')->name('guardar_producto'); 
Route::post('/ver_producto', 'ProductoController@mostrar_producto_x_categoria')->name('cargar_producto'); 
Route::delete('/eliminar_producto/{id?}', 'ProductoController@eliminar')->name('eliminar_producto'); 
Route::get('/editar_producto/{id?}', 'ProductoController@editar_producto')->name('editar_producto'); 
Route::put('/update_producto/{id?}', 'ProductoController@update')->name('update_producto'); 


Route::post('/cw/{id?}', 'CategoriaController@output')->name('consola'); 

Route::get('/agregar/{id?}', 'CarroController@guardar_producto_en_carro')->name('agregar_producto');
Route::delete('/eliminar_de_carro/{id?}', 'CarroController@eliminar_producto_en_carro')->name('eliminar_pr_carro');
Route::get('/productos_en_carro', 'CarroController@productos_en_carro')->name('ver_productos');
Route::get('/modificar_cantidad/{id?}', 'CarroController@cambiar')->name('editar_carro');
Route::put('/update_carro/{id?}', 'CarroController@update')->name('update_carro'); 


Route::get('/pagar', 'CarroController@update')->name('update_carro'); 


Route::get('/Registro', 'UserController@registro')->name('registro_usuario'); 

Route::post('/Salvar', 'UserController@guardar')->name('guardar'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');