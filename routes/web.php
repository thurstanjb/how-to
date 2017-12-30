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



use Illuminate\Support\Facades\Auth;

Auth::routes();


Route::get('/', 'MainController@index')->name('index');

Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/home', 'AdminController@index')->name('home');

    Route::prefix('/users')->name('users.')->group(function(){
        Route::get('/', 'UserController@index')->name('index');
        Route::put('/', 'UserController@store')->name('store');
        Route::get('/create', 'UserController@create')->name('create');
        Route::get('/{user}', 'UserController@show')->name('show');
        Route::delete('/{user}', 'UserController@destroy')->name('destroy');
        Route::get('/{user}/edit', 'UserController@edit')->name('edit');
        Route::patch('/{user}/edit', 'UserController@update')->name('update');
    });
});
