<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;
use app\Http\Controllers\ClienteController;
use app\Http\Controllers\CompraController;
use app\Http\Controllers\ProductoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Estas rutas en Laravel definen las diferentes acciones que se pueden realizar 
//sobre los usuarios 
//Cada ruta corresponde a un método del controlador 

// localhost:8000/api/users
//Route::get('/users' ,   'App\Http\Controllers\UserController@index');
//Route::get('/users/{id}' ,   'App\Http\Controllers\UserController@getone');
Route::post('/users',   'App\Http\Controllers\UserController@store');
Route::put('/users/{id}',   'App\Http\Controllers\UserController@update');
//Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');
Route::post('/login', 'App\Http\Controllers\UserController@login');


//con esto protejemos las rutas y solo se podran acceder a ellas si me encuentro loguedo 
Route::group(['middleware' => ['auth:api', 'admin']], function () {
Route::get('/clientes' ,   'App\Http\Controllers\ClienteController@index');
Route::get('/clientes/{id}' ,   'App\Http\Controllers\ClienteController@getone');
Route::post('/clientes',   'App\Http\Controllers\ClienteController@store');
Route::put('/clientes/{id}',   'App\Http\Controllers\ClienteController@update');
Route::delete('/clientes/{id}', 'App\Http\Controllers\ClienteController@destroy');


Route::get('/products' ,   'App\Http\Controllers\ProductoController@index');
Route::get('/products/{id}' ,   'App\Http\Controllers\ProductoController@show');
Route::post('/products',   'App\Http\Controllers\ProductoController@store');
Route::put('/products/{codigo}',   'App\Http\Controllers\ProductoController@update');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductoController@destroy');



Route::get('/compras' ,   'App\Http\Controllers\CompraController@getall');
Route::get('/compras/{id}' ,   'App\Http\Controllers\CompraController@getone');
Route::post('/compras',   'App\Http\Controllers\CompraController@create');
Route::put('/compras/{id}',   'App\Http\Controllers\CompraController@update');
Route::delete('/compras/{id}', 'App\Http\Controllers\CompraController@destroy');
});

 