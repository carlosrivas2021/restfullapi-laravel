<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/','MiControlador@index');
//Route::get('/',"VehiculoController@showall");

Route::resource('fabricantes','FabricanteController');
Route::resource('vehiculos','VehiculoController',['only'=>['index','show']]);
Route::resource('fabricantes.vehiculos','FabricanteVehiculoController',['except'=>['show']]);