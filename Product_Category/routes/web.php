<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 
Route::get('/products/{category}/category' , 'SearchController@searchProductByCategory');

Route::get('/products' , 'ProductsController@index');
//
Route::get('/products/create', 'ProductsController@create');
Route::post('/products/create','ProductsController@store');

Route::get('/products/{product}' , 'ProductsController@destroy');
////////////////////////////////////////////////





