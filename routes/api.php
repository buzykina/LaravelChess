<?php

use Illuminate\Http\Request;

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
	//foreach ($request as $gg) {
		//$gg = (DB::table('users')->where('id',$gg->userid)->get())->name;
		
	//}
    return $request;
});

Route::post('/chat', function(Request $request) {
	DB::table('chat')->insert([
	['message' => $request->input('message'), 'userid' => $request->input('userid'),'created_at' => date('Y-m-d H:i:s')]
	]);
});


Route::get('/chessinit/{id}', 'ChessInitController@index');