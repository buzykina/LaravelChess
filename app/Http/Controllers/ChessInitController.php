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
	 
	public function start(Request $request){//say when the game begins
		$id = json_decode($request->getContent(), true);
		$id = $id['id'];
		$data = DB::table('chessgame')   //get all rolls where white and/or black are free
			->where('id',$id)
			->get();
		$arr=array('start' => 1);
		if($data[0]->black && $data[0]->white){
			return json_encode($arr);
		}
		$arr=array('start' => 0);
		return json_encode($arr);
	}
	
    public function index(){//create correct db stuff
		$id = Auth::user()->id;
		if(!$id){//if not logged in
			return "{}";
		}		
		$data = DB::table('chessgame')   //get all rolls where white and/or black are free
			->whereNull('white')
			->orWhereNull('black')
			->get();
		$side=0;
		
		
		if(!($data->first())){//if there isn't a single free result
			$jsonLine[] = [ // the player will become the white player
				'white' => $id
			];
			DB::table('chessgame')->insert([//insert it into the table
				['white' => $id]
			]);
			$data = DB::table('chessgame')->orderBy('id', 'desc')->get()->first();
			
			$arr = array('side' => $side, 'id' => $data->id);
			return json_encode($arr);
		}
		
		
		if($data->first()->black){//if there is a black player
			DB::table('chessgame')
				->where('id','=',$data->first()->id)
				//->where('black','<>',$id)
				->whereNotNull('black')
				->update(['white' => $id]);
			$side=0;
		}else{					//if there is a white player
			DB::table('chessgame')
				->where('id','=',$data->first()->id)
				//->where('white','<>',$id)
				->whereNotNull('white')
				->update(['black' => $id]);
			$side=1;
		}
		
		
		$data = DB::table('chessgame')->where('id','=',$data->first()->id)->get();
		$arr = array('side' => $side, 'id' => $data[0]->id);
		return json_encode($arr);
    }

	
	public function moveGET(Request $request){
		$r = json_decode($request->getContent(), true);
		$pid = Auth::user()->id;
		$id = $r['id'];
		$data = DB::table('moves')   //get all rolls where white and/or black are free
			->where('gameid','=',$id)
			->orderBy('created_at','desc')
			->get();
		if(!$data->first()){
			$arr = array('move' => 0);
			return json_encode($arr);
		}
		$data = $data->first();
		
		$move = 1;
		if($pid == $data->userid){
			$move = 0;
		}
		$arr = array('from' => $data->fromposition, 'to' => $data->toposition, 'move' => $move);
		
		return json_encode($arr);
	}
	
	public function move(Request $request){
		$r = json_decode($request->getContent(), true);
		$id = $r['id'];
		$data = DB::table('chessgame')   //get all rolls where white and/or black are free
			->where('id',$id)
			->get();
		if(!$data->first()){
			abort(404);
		}
		
		
		$pid = Auth::user()->id;
		$from = $r['from'];
		$to = $r['to'];
		//into the database it goes!
		DB::table('moves')->insert(
			['gameid' => $id, 'userid' => $pid, 'fromposition' => $from, 'toposition' => $to, 'created_at' => date('Y-m-d H:i:s')]
		);
		return 200;
		//really no clue
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
