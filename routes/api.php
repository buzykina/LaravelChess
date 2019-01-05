<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Events\eventTrigger;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/chat', function() {
	$request = DB::table('chat')->get();
	foreach ($request as $gg) {
		$gg->userid = (DB::table('users')->where('id',$gg->userid)->get()->first())->name;
	}
    return $request;
});

Route::post('/chat', function(Request $request) {
    $user = Auth::guard('web')->user();
	$get_result_arr = json_decode($request->getContent(), true);
	DB::table('chat')->insert([
		['message' => $get_result_arr['message'], 'userid' => $user->id,'created_at' => date('Y-m-d H:i:s')]
	]);
});


Route::get('/chessinit', 'ChessInitController@index');
Route::get('/test', function(){
	event(new eventTrigger());
});


Route::post('/chessinit', function(Request $request){
	
	return App::call('App\Http\Controllers\ChessInitController@start',['request'=>$request]);
});


Route::post('/move', function(Request $request){ 
	return App::call('App\Http\Controllers\ChessInitController@move',['request'=>$request]);
});

Route::post('/moveget', function(Request $request){ 
	return App::call('App\Http\Controllers\ChessInitController@moveGET',['request'=>$request]);
});

