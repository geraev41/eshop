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



//Raíz del proyecto
Route::get('/','UserController@index')->name('login'); 

//Manejo de datos del cliente, registro, login, validaciones y logout
//Route::get('/Registro', 'UserController@registro')->name('registro_usuario'); 
Route::get('/registro','UserController@registro')->name('registro'); 
Route::post('/validar','Auth\LoginController@login')->name('validar_login'); 
Route::post('/salir','Auth\LoginController@logout')->name('salir'); 
Route::get('/ver_clientes','UserController@mostrar_clientes')->name('clientes')->middleware('admin'); 
Route::get('/administrador','UserController@admin')->name('admin')->middleware('admin');
Route::get('/principal','UserController@cliente')->name('cliente')->middleware('cliente'); 

//Manejo de categorias, CRUD completo
Route::get('/categoria','CategoriaController@crear')->name('crear_categoria')->middleware('admin');
Route::post('/','CategoriaController@guardar')->name('guardar_categoria')->middleware('admin');
Route::get('/ver_categorias/{view?}', 'CategoriaController@mostrar_categorias')->name('mostrar_categorias'); 
Route::get('/editar_categoria/{id?}', 'CategoriaController@editar_categoria')->name('editar_categoria')->middleware('admin');
Route::delete('/eliminar_categoria/{id?}', 'CategoriaController@eliminar_categoria')->name('eliminar_categoria')->middleware('admin'); 
Route::put('/{id?}', 'CategoriaController@update')->name('update_categoria')->middleware('admin');

//Manejo de productos, CRUD completo. Manejo de productos por categoria
Route::get('/producto/{id?}','ProductoController@producto')->name('producto')->middleware('admin');
Route::post('/guardar_producto','ProductoController@guardar')->name('guardar_producto')->middleware('admin');
Route::post('/ver_productos', 'ProductoController@mostrar_producto_x_categoria')->name('cargar_producto'); 
Route::delete('/eliminar_producto/{id?}', 'ProductoController@eliminar')->name('eliminar_producto')->middleware('admin');
Route::get('/editar_producto/{id?}', 'ProductoController@editar_producto')->name('editar_producto')->middleware('admin');
Route::put('/update_producto/{id?}', 'ProductoController@update')->name('update_producto')->middleware('admin');

//Manejo de productos en carro de usuario, CRUD completo
Route::get('/agregar/{id?}', 'CarroController@guardar_producto_en_carro')->name('agregar_producto')->middleware('cliente'); 
Route::delete('/eliminar_de_carro/{id?}', 'CarroController@eliminar_producto_en_carro')->name('eliminar_pr_carro')->middleware('cliente'); 
Route::get('/productos_en_carro', 'CarroController@productos_en_carro')->name('ver_productos')->middleware('cliente'); 
Route::get('/modificar_cantidad/{id?}', 'CarroController@cambiar')->name('editar_carro')->middleware('cliente'); 
Route::put('/update_carro/{id?}', 'CarroController@update')->name('update_carro')->middleware('cliente'); 

//Manejo de compras del usuario, Crea, elimina y muestra
Route::get('/pagar', 'CompraController@pagar_productos')->name('pagar_compras')->middleware('cliente'); 
Route::get('/ver_compras', 'CompraController@mostrar_compras')->name('ver_compras')->middleware('cliente'); 
Route::get('/ver_orden/{id?}', 'CompraController@mostrar_orden')->name('ver_orden')->middleware('cliente'); 
Route::post('/ver_orde_fecha', 'CompraController@ver_orden_x_fecha')->name('buscar_fecha')->middleware('cliente'); 
Route::delete('/eliminar_compra/{id?}', 'CompraController@eliminar_compra')->name('eliminar_compra')->middleware('cliente'); 
Route::get('/ganancias', 'CompraController@ganancias')->name('ganancias')->middleware('admin'); 

//Rutas alternas
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');