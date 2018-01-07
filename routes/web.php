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

    Route::prefix('/users')->name('users.')->middleware('admin')->group(function(){
        Route::get('/', 'UserController@index')->name('index');
        Route::put('/', 'UserController@store')->name('store');
        Route::get('/create', 'UserController@create')->name('create');
        Route::get('/{user}', 'UserController@show')->name('show');
        Route::delete('/{user}', 'UserController@destroy')->name('destroy');
        Route::get('/{user}/edit', 'UserController@edit')->name('edit');
        Route::patch('/{user}/edit', 'UserController@update')->name('update');
    });

    Route::prefix('/books')->name('books.')->group(function(){
       Route::get('/create', 'BookController@create')->name('create');
       Route::put('/create', 'BookController@store')->name('store');
       Route::get('/{book}/edit', 'BookController@edit')->name('edit');
       Route::patch('/{book}/edit', 'BookController@update')->name('update');
       Route::delete('/{book}', 'BookController@destroy')->name('destroy');
    });

    Route::prefix('/articles')->name('articles.')->group(function(){
        Route::get('/create', 'ArticleController@create')->name('create');
        Route::put('/create', 'ArticleController@store')->name('store');
        Route::get('/{article}/edit', 'ArticleController@edit')->name('edit');
        Route::patch('/{article}/edit', 'ArticleController@update')->name('update');
        Route::delete('/{article}', 'ArticleController@destroy')->name('destroy');
    });
});

Route::name('articles.')->group(function(){
    Route::get('/articles', 'ArticleController@index')->name('index');
    Route::get('/{book}/{article}', 'ArticleController@show')->name('show');
});

Route::name('books.')->group(function(){
    Route::get('/books', 'BookController@index')->name('index');
    Route::get('/{book}', 'BookController@show')->name('show');
});
