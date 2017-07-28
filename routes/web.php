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


Route::get('/', 'Cliente\ClienteController@index');
Route::post('add/{id}', 'Cliente\ClienteController@cart');
Route::get('show', 'Cliente\ClienteController@show');
Route::get('borrar/{id}', 'Cliente\ClienteController@destroy');
Route::get('a', 'Cliente\ClienteController@prueba');
Route::post('cotizar', 'Cliente\ClienteController@store');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
