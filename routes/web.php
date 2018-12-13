<?php

use Illuminate\Http\Request;

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


Route::get('/admin', function () {
    return view('pages.profile');
});

Route::get('/rules', 'PagesController@rules');


Route::get('/test', function () {
    return view('included.chat');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



Route::post('/update', function(Request $request){
	$id = Auth::id();
	if(!$id){
		abort(404);
	}
	return App::call('App\Http\Controllers\UserController@update',['request'=>$request,'id'=>$id]);
	
	/*$uer=Auth::user();
	if(!$uer){
		dd($uer);
	}
	DB::table('users')->where('id',$uer->id)->update([
		'email' => $request->input('email'),
		'name' => $request->input('uname'),
	]);
	return redirect('/profile');*/
});


Route::post('/delete', function(Request $request){
    $uer=Auth::user();
    if(!$uer){
        dd($uer);
    }
    DB::table('users')->where('id',$uer->id)->delete();
    return redirect('/login');
});



Route::get('profile', function () {
    return view('pages.profile');
    // Only authenticated users may enter...
})->middleware('auth');

Auth::routes();
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
//Route::get('/home', 'HomeController@index')->name('home');
