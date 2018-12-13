<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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


Route::get('/chessinit/{id}', 'ChessInitController@index');