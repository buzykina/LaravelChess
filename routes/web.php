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

Route::get('/', 'PagesController@index');

Route::get('/home', 'PagesController@index');

Route::get('/login', 'PagesController@login');
Route::get('/register', 'PagesController@register');


Route::get('/profile','PagesController@profile');

Route::get('/admin', function () {
    return view('pages.profile');
});

Route::get('/rules', 'PagesController@rules');


Route::get('/test', function () {
    return view('included.chat');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
