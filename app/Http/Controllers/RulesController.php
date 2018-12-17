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
			$rule = Rule::find(intval($request->rulesId));
			if($rule == null){
				$rule = new Rule;
			}
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
            $imageName = $img->hashName();
            $directory = public_path('storage/rules/');
            $imageUrl = $directory.$imageName;
            $width = 300;
            $height = 300;
            $img1 = Image::make($img);
            $img1->resize($width, $height);
            $watermark = Image::make(public_path('storage/watermark/watermark.png'));
            $img1->insert($watermark, 'bottom-right', 10, 10);
			$img1-> save($imageUrl);
			$rule->image = '/'.$imageName;
		}
		$rule->save();

        //flash()->success("Your changes to your account have been saved",'Saved:');
        //return redirect()->route('pages.profile');
		return redirect('/profile');
    }
}
