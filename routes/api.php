<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login','ApiLoginController@login');

Route::prefix('/products')->group(function () {
    Route::get('/', 'ProductController@index');
    Route::get('/{id}', 'ProductController@show');
    Route::post('/', 'ProductController@store');
    Route::put('/{id}', 'ProductController@update');
    Route::patch('/{id}', 'ProductController@hidden');
    Route::delete('/{id}', 'ProductController@destroy');
    Route::get('/category/{category_id}', 'ProductController@getByCategory');
});
