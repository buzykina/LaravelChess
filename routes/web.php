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
    return view('pages.index');
});

Route::get('/home', function () {
    return view('pages.index');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/profile/{id?}', function ($id = null) {
    if($id == null)
    {
        return view('pages.noaccess');
    }
    return view('pages.profile',['id' => $id]);
});

Route::get('/admin', function () {
    return view('pages.profile');
});

Route::get('/rules', function () {
    return view('pages.rules');
});


Route::get('/test', function () {
    return view('included.chat');
});