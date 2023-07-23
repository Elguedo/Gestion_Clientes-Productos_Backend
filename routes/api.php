<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;


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
Route::get('/users' ,   'App\Http\Controllers\UserController@index');
Route::get('/users/{id}' ,   'App\Http\Controllers\UserController@getone');
Route::post('/users',   'App\Http\Controllers\UserController@store');
Route::put('/users/{id}',   'App\Http\Controllers\UserController@update');
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');
Route::post('/login', 'App\Http\Controllers\UserController@login');


 