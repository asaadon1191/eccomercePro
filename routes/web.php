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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('Home/allProducts','Users\OrdersController@allProducts')->name('all.products.users');



Route::prefix('cart')->group(function()
    {
        Route::get('/show','Users\OrdersController@showCartPage')->name('show.cart.page');
        Route::get('/store/{product}','Users\OrdersController@addToCart')->name('store.cart');
        Route::get('/delete/item/{product}','Users\OrdersController@deletePro')->name('delete.cart');
        Route::put('/update/item/{product}','Users\OrdersController@updatePro')->name('update.cart');
    });



Route::middleware('auth')->prefix('products')->namespace('Users')->group(function()
{
    Route::get('/','ProductsController@index')->name('products');
    Route::get('/create','ProductsController@create')->name('products.create');
    Route::post('/store','ProductsController@store')->name('products.store');
    Route::get('/show/{id}','ProductsController@show')->name('products.show');
    Route::get('/edit/{id}','ProductsController@edit')->name('products.edit');
    Route::post('/update/{id}','ProductsController@update')->name('products.update');
    Route::get('/delete/{id}','ProductsController@delete')->name('products.delete');

    Route::prefix('checkOut')->group(function()
    {
        Route::get('/checkOut/{totalPrice}','OrdersController@checkOut')->name('cart.checkOut');
        Route::post('/storeOrder/{totalPrice}','OrdersController@storeOrder')->name('storeOrder.cart');
        Route::get('/order/index','OrdersController@index')->name('index.orders');
    });

});