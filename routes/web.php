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

Route::get('/', function () {
    return redirect ('/home');
});

Route::get('/keluar',function (){
    \auth::logout();

    return redirect('/login');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/supplier', 'Supplier_controller@index');

    Route::get('/supplier/add', 'Supplier_controller@add');
    Route::post('/supplier/add', 'Supplier_controller@store');

    Route::get('/supplier/{id}','Supplier_controller@edit');
    Route::put('/supplier/{id}','Supplier_controller@update');

    Route::delete('/supplier/{id}','Supplier_controller@delete');
    Route::delete('myproductsDeleteAll', 'Supplier_Controller@deleteAll');

    //route untuk produk by Aditya Oktaviana
    Route::get('/produk','produk_controller@index');
    Route::get('/produk/detail/{id}','produk_controller@detail');

    Route::get('/produk/add','produk_controller@add');
    Route::post('/produk/add','produk_controller@store');

    Route::get('/produk/{id}','produk_controller@edit');
    Route::put('/produk/{id}','produk_controller@update');

    Route::delete('/produk/{id}','produk_controller@delete');
    Route::delete('myproductsDeleteAll', 'produk_Controller@deleteAll');

    // Route Untuk Purchase Order By Aditya Oktaviana
    Route::get('po/add','Po_controller@add');
    Route::get('po/produk/{supplier}','Po_controller@get_produk');
    Route::post('po/add','Po_controller@store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
