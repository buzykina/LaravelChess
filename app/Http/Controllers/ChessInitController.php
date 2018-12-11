<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;




class ChessInitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index($id){
		if(!$id){
			return "{}";
		}
		$data = DB::table('chessgame')
			->whereNull('white')
			->orWhereNull('black')
			->get();
			
		if(!($data->first())){
			$jsonLine[] = [
				'white' => $id
			];
			DB::table('chessgame')->insert([
				['white' => $id]
			]);
			$data = json_encode([DB::table('chessgame')->orderBy('id', 'desc')->get()->first()]);
			return $data;
		}
		
		if($data->first()->black){
			DB::table('chessgame')
				->where('id','=',$data->first()->id)
				->whereNotNull('black')
				->update(['white' => $id]);
		}else{
			DB::table('chessgame')
				->where('id','=',$data->first()->id)
				->whereNotNull('white')
				->update(['black' => $id]);
		}
		$data = DB::table('chessgame')->where('id','=',$data->first()->id)->get();
		
		return json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
