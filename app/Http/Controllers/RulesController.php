<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\User;
use App\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class RulesController extends Controller
{
    public function update(Request $request){
		$rule = new Rule;
		if($request->rulesId != null){
			$rule = Rule::findOrFail(intval($request->rulesId));
		}else{
			$rule->image="";
		}
		$rule->title = $request->rulesTitle;
		$rule->description = $request->rulesDesc;
		
		if($rule->title=="" || $rule->description==""){
			$rule->delete();
			return redirect('/profile');
		}
		$img = $request->file('image');
		if($img){
			$request->validate([
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);
			
			$path=$img->store('rules');
			$rule->image = "/storage/".$path;
		}
		$rule->save();

        //flash()->success("Your changes to your account have been saved",'Saved:');
        //return redirect()->route('pages.profile');
		return redirect('/profile');
    }
}
