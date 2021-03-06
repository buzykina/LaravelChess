<?php

use Illuminate\Http\Request;
use App\Events\eventTrigger;

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


Route::get('/admin', function () {
    return view('pages.profile');
});

Route::get('/test', function () {
    return view('included.chat');
});

Route::get('/test2', function () {
    return view('included.chess.chess');
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
Route::get('pdfview','ItemController@pdfview');
Route::get('/pdfview/pdf','ItemController@pdfconversion');
Route::get('/rules', function () {
    return view('pages.rules');
});
Route::post('/rules', function(Request $request){
	$id = Auth::id();
	if(!$id){
		abort(404);
	}
	return App::call('App\Http\Controllers\RulesController@update',['request'=>$request]);
});
Route::post('/delete', function(Request $request){
    $uer=Auth::user();
    if(!$uer){
        dd($uer);
    }
    DB::table('users')->where('id',$uer->id)->delete();
    return redirect('/login');
});


Route::get('/delete/{id}', function($id){
    $uer=Auth::user();
    if(!$uer || $uer->admin!=1){
        abort(404);
    }
    DB::table('users')->where('id',$id)->delete();
    return redirect('/profile');
});

Route::get('profile', function () {
    return view('pages.profile');
    // Only authenticated users may enter...
})->middleware('auth');

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');




















Route::get('/start/{id}',function ($id){
	event(new eventTrigger($id,0));
});
Route::get('/move/{id}',function ($id){
	event(new eventTrigger($id,1));
});



