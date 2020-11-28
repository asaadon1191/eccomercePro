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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('regster','Api\AuthController@regster')->name('regster');
Route::post('login','Api\AuthController@login')->name('login');




Route::middleware('auth:api')->namespace('Api')->group(function()
{
    Route::resource('products/pro', 'Productscontroller');

    Route::prefix('orders')->group(function()
    {
        Route::post('store','OrdersControllers@store')->name('order.store');
        Route::get('show/{id}','OrdersControllers@show')->name('order.show');
        Route::get('index','OrdersControllers@index')->name('order.index');
        Route::get('update/{id}','OrdersControllers@update')->name('order.update');

        Route::post('store_cart/{id}','CartapiController@store')->name('cartApi.store');
    });
});




